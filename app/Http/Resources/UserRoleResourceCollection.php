<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Request;

class UserRoleResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param Request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
