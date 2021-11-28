<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class RoleResource extends Resource
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
            'id'           => $this->id,
            'type'         => $this->type,
            'descriptions' => $this->description
        ];
    }
}
