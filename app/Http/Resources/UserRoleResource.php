<?php

namespace App\Http\Resources;

class UserRoleResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'user'      => $this->needDetailed($request) ? new UserResource($this->user) : $this->userId,
            'role'      => $this->needDetailed($request) ? new RoleResource($this->role) : $this->roleId,
            'createdBy' => $this->needDetailed($request) ? new UserResource($this->createdByUser) : $this->createdBy
        ];
    }
}
