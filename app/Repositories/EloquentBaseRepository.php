<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\BaseRepository;
use Illuminate\Database\Eloquent\Model;

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
    public function save(array $data): \ArrayAccess
    {
        // set createdBy by loggedInUser if not passed
        if (!isset($data['createdBy'])) {
            $loggedInUser = auth()->user()['id'];
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
     * @inheritdoc
     */
    public function updateIn(string $key, array $values, array $data): \IteratorAggregate
    {
        $this->model->whereIn($key, $values)->update($data);

        return $this->model->whereIn($key, $values)->get();
    }
}
