<?php

namespace App\Http\Requests\Role;

use App\Http\Requests\Request;

class StoreRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $rules = [
            'type'        => 'required|max:50|unique:roles,type',
            'description' => 'max:250'
        ];
    }
}
