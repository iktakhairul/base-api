<?php

namespace App\Http\Requests\User;

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
            'name'       => 'max:50',
            'email'      => 'email|required|unique:users',
            'contact_no' => 'max:20',
            'type'       => '',
            'domain'     => '',
            'role'       => '',
            'weight'      => '',
            'access'      => '',
            'status'      => '',
            'password'    => 'required|min:5'
        ];
    }

}
