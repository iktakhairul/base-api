<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class UserRoleResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'        => $this['id'],
            'userId'    => $this['userId'],
            'user'      => $this->when($this->needToInclude($request, 'ur.user'), function () {
                return new UserResource($this['user']);
            }),
            'roleId'    => $this['roleId'],
            'role'      => $this->when($this->needToInclude($request, 'ur.role'), function () {
                return new RoleResource($this['role']);
            }),
            'createdBy' => $this->when($this->needToInclude($request, 'ur.createdBy'), function () {
                return new UserResource($this['createdByUser']);
            }),
        ];
    }
}
