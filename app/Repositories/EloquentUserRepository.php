<?php

namespace App\Repositories;

use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\UserRoleRepository;

class EloquentUserRepository extends EloquentBaseRepository implements UserRepository
{
    /**
     * @inheritdoc
     */
    public function findOne($id, $withTrashed = false): ?\ArrayAccess
    {
        if ($id === 'me') {
            return $this->getLoggedInUser();
        }

        return parent::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public function findBy(array $searchCriteria = [], $withTrashed = false)
    {
        if (isset($searchCriteria['role'])) {
            $usersArray = $this->findUsersByRoleId($searchCriteria['role']);
            $searchCriteria['id'] = implode(',', $usersArray);
            unset($searchCriteria['role']);
        }

        //restrict find method to get only see the own user data
        if (!$this->getLoggedInUser()->isSystemAdmin()) {
            $searchCriteria['id'] = $this->getLoggedInUser()->id;
        }

        if (isset($searchCriteria['query'])) {
            $userIds = $this->model->where('firstName', 'like', '%'.$searchCriteria['query'].'%')
                ->orWhere('name', 'like', '%'.$searchCriteria['query'].'%')
                ->orWhere('email', 'like', '%'.$searchCriteria['query'].'%')
                ->pluck('id')->toArray();
            $searchCriteria['id'] = implode(",", $userIds);
            unset($searchCriteria['query']);
        }

        return parent::findBy($searchCriteria);
    }

    /**
     * find users by roleId
     *
     * @param $roleId
     * @return array
     */
    private function findUsersByRoleId($roleId) : array
    {
        $userRoleRepository = app(UserRoleRepository::class);
        return $userRoleRepository->findBy(['roleId' => $roleId])->pluck('userId')->unique()->toArray();
    }
}
