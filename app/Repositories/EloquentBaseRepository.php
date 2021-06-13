<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EloquentBaseRepository implements BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * EloquentBaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritdoc
     */
    public function findOne($id, $withTrashed = false): ?\ArrayAccess
    {
        $queryBuilder = $this->model;

        if ($withTrashed) {
            $queryBuilder = $queryBuilder->withTrashed();
        }

        return $queryBuilder->find($id);
    }

    /**
     * @inheritdoc
     */
    public function findOneBy(array $criteria, $withTrashed = false): ?\ArrayAccess
    {
        $queryBuilder =  $this->model->where($criteria);

        if ($withTrashed) {
            $queryBuilder = $queryBuilder->withTrashed();
        }

        return $queryBuilder->first();
    }

    /**
     * @inheritdoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        $limit = !empty($searchCriteria['per_page']) ? (int)$searchCriteria['per_page'] : 50;
        $orderBy = !empty($searchCriteria['order_by']) ? $searchCriteria['order_by'] : 'id';
        $orderDirection = !empty($searchCriteria['order_direction']) ? $searchCriteria['order_direction'] : 'desc';
        $queryBuilder = $this->model->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria);
        });

        if ($withTrashed) {
            $queryBuilder = $queryBuilder->withTrashed();
        }
        if (isset($searchCriteria['eagerLoad'])) {
            $queryBuilder->with($searchCriteria['eagerLoad']);
        }
        if (isset($searchCriteria['rawOrder'])) {
            $queryBuilder->orderByRaw(DB::raw("FIELD(id, {$searchCriteria['id']})"));
        }else {
            $queryBuilder->orderBy($orderBy, $orderDirection);
        }

        return $queryBuilder->paginate($limit);
    }

    /**
     * @inheritdoc
     */
    public function findByPartialText(array $searchCriteria = [], $withTrashed = false)
    {
        // almost a duplicate of findBy. Created a separate function just in case if want to make it intelligent in the future.
        $limit = !empty($searchCriteria['per_page']) ? (int)$searchCriteria['per_page'] : 50; // it's needed for pagination
        $orderBy = !empty($searchCriteria['order_by']) ? $searchCriteria['order_by'] : 'id';
        $orderDirection = !empty($searchCriteria['order_direction']) ? $searchCriteria['order_direction'] : 'desc';
        $queryBuilder = $this->model->where(function ($query) use ($searchCriteria) {
            $this->applySearchCriteriaInQueryBuilder($query, $searchCriteria, 'like');
        });

        if ($withTrashed) {
            $queryBuilder->withTrashed();
        }

        if (isset($searchCriteria['eagerLoad'])) {
            $queryBuilder->with($searchCriteria['eagerLoad']);
        }
        if (isset($searchCriteria['rawOrder'])) {
            $queryBuilder->orderByRaw(DB::raw("FIELD(id, {$searchCriteria['id']})"));
        } else {
            $queryBuilder->orderBy($orderBy, $orderDirection);
        }

        return $queryBuilder->paginate($limit);
    }

    /**
     * @inheritdoc
     */
    public function save(array $data): \ArrayAccess
    {
        // set createdBy by loggedInUser if not passed
        if (!isset($data['createdBy'])) {
            $loggedInUser = $this->getLoggedInUser();
            if ($loggedInUser instanceof User) {
                $data['createdBy'] = $loggedInUser->id;
            }
        }

        return $this->model->create($data);
    }

    /**
     * @inheritdoc
     */
    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        $fillAbleProperties = $this->model->getFillable();
        foreach ($data as $key => $value) {
            if (in_array($key, $fillAbleProperties)) {
                $model->$key = $value;
            }
        }
        $model->save();
        $model = $this->findOne($model->id);

        return $model;
    }

    /**
     * @inheritdoc
     */
    public function findIn(string $key, array $values, $withTrashed = false): ?\IteratorAggregate
    {
        $queryBuilder = $this->model->whereIn($key, $values);
        if ($withTrashed) {
            $queryBuilder->withTrashed();
        }

        return $queryBuilder->get();
    }

    /**
     * @inheritdoc
     */
    public function delete(\ArrayAccess $model): bool
    {
        return $model->delete();
    }

    /**
     * @inheritdoc
     */
    public function patch(array $searchCriteria, array $data) : \ArrayAccess
    {
        $userNotificationSetting = $this->findOneBy($searchCriteria);

        if ($userNotificationSetting instanceof Model) {
            $userNotificationSetting = $this->update($userNotificationSetting, $data);
            return $userNotificationSetting;
        } else {
            return $this->save($data);
        }

    }

    /**
     * Apply condition on query builder based on search criteria
     *
     * @param Object $queryBuilder
     * @param array $searchCriteria
     * @param string $operator
     * @return mixed
     */
    protected function applySearchCriteriaInQueryBuilder(
        $queryBuilder,
        array $searchCriteria = [],
        string $operator = '='
    ) {
        unset($searchCriteria['include'], $searchCriteria['eagerLoad'], $searchCriteria['rawOrder'], $searchCriteria['detailed']); //don't need that field for query. only needed for transformer.

        foreach ($searchCriteria as $key => $value) {

            //skip pagination related query params
            if (in_array($key, ['page', 'per_page', 'order_by', 'order_direction'])) {
                continue;
            }

            if ($value == 'null') {
                $queryBuilder->whereNull($key);
            } else {
                if ($value == 'notNull') {
                    $queryBuilder->whereNotNull($key);
                } else {
                    //we can pass multiple params for a filter with commas
                    $allValues = explode(',', $value);

                    if (count($allValues) > 1) {
                        $queryBuilder->whereIn($key, $allValues);
                    } else {
                        if ($operator == 'like') {
                            $queryBuilder->where($key, $operator, '%' . $value . '%');
                        } else {
                            $queryBuilder->where($key, $operator, $value);
                        }
                    }
                }
            }
        }

        return $queryBuilder;
    }

    /**
     * @inheritdoc
     */
    public function updateIn(string $key, array $values, array $data): \IteratorAggregate
    {
        // updated records
        $this->model->whereIn($key, $values)->update($data);

        // return updated records QueryBuilder
        return $this->model->whereIn($key, $values)->get();
    }

    /**
     * get modified fields
     *
     * @param $model
     * @param $data
     * @return array
     */
    public function getModifiedFields($model, $data)
    {
        $fillAbleProperties = $model->getFillable();

        foreach ($data as $key => $value) {
            // update only fillAble properties
            if (in_array($key, $fillAbleProperties)) {
                $model->$key = $value;
            }
        }

        return $model->getDirty();
    }

    /**
     * get loggedIn user
     *
     * @return User
     */
    protected function getLoggedInUser()
    {
        if (Auth::user() instanceof User) {
            return Auth::user();
        } else {
            return new User();
        }
    }

    /**
     * paginate custom data
     *
     * @param array $items
     * @param int $perPage
     * @param null $page
     * @param array $options
     * @return LengthAwarePaginator
     */
    protected function paginateData($items, $perPage = 15, $page = null, array $options = []) : LengthAwarePaginator
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
