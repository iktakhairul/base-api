<?php

namespace App\Http\Resources;

class UserResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $userRoles = [];
        if ($this->needToInclude($request, 'userRoles')) {
            foreach ($this->userRoles as $userRole) {
                $userRoles[] = new RoleResource($userRole->role);
            }
        }

        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'email'        => $this->email,
            'contact_no'   => $this->contact_no,
            'type'         => $this->type,
            'domain'       => $this->domain,
            'role'         => $this->role,
            'weight'       => $this->weight,
            'access'       => $this->access,
            'status'       => $this->status,
            'createdBy'    => $this->createdBy,
            $this->mergeWhen($this->needToInclude($request, 'userRoles'), [
                'userRoles'      => $userRoles
            ])
        ];
    }
}
