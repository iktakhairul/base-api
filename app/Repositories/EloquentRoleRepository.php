<?php

namespace App\Repositories;

use App\Repositories\Contracts\RoleRepository;

class EloquentRoleRepository extends EloquentBaseRepository implements RoleRepository
{

    /**
     * @inheritdoc
     */
    public function getAllRoles(): array
    {
        $reflectionClass = new \ReflectionClass($this->model);

        return array_filter($reflectionClass->getConstants(), function ($constant) {
            return strpos($constant, 'ROLE_') === 0;
        }, ARRAY_FILTER_USE_KEY);
    }
}
