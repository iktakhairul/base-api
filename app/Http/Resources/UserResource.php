<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class UserResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request
     * @return array
     */
    public function toArray($request)
    {
        $userRoles = [];
        if ($this->needToInclude($request, 'userRoles')) {
            foreach ($this['userRoles'] as $userRole) {
                $userRoles[] = new RoleResource($userRole->role);
            }
        }

        return [
            'id'              => $this['id'],
            'firstName'       => $this['firstName'],
            'lastName'        => $this['lastName'],
            'fullName'        => $this['fullName'],
            'userName'        => $this['userName'],
            'email'           => $this['email'],
            'userDomain'      => $this['userDomain'],
            'userType'        => $this['userType'],
            'userWeight'      => $this['userWeight'],
            'address'         => $this['address'],
            'zipCode'         => $this['zipCode'],
            'phone'           => $this['phone'],
            'secondaryPhone'  => $this['secondaryPhone'],
            'city'            => $this['city'],
            'state'           => $this['state'],
            'country'         => $this['country'],
            'isActive'        => $this['isActive'],
            'profileImage'    => new AttachmentResource($this['profileImage']),
            'createdByUserId' => $this['createdBy'],
            'created_at' => $this['created_at'],
            'updated_at' => $this['updated_at'],
            $this->mergeWhen($this->needToInclude($request, 'userRoles'), [
                'userRoles'      => $userRoles
            ]),
        ];
    }
}
