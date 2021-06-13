<?php

namespace App\Http\Resources;

class RoleResource extends Resource
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
            'id'           => $this->id,
            'type'         => $this->type,
            'descriptions' => $this->description
        ];
    }
}
