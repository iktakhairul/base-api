<?php

namespace App\Http\Requests\Role;

use App\Http\Requests\Request;

class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $role = $this->route('role');

        return $rules = [
            'type'        => 'required|max:50|unique:roles,type,' . $role['id'],
            'description' => 'max:250'
        ];
    }
}
