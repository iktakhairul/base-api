<?php

namespace App\Repositories\Contracts;

interface RoleRepository extends BaseRepository
{

    /**
     * Get all roles
     *
     * @return array
     * @throws \ReflectionException
     */
    public function getAllRoles() : array;

}
