<?php

namespace App\Http\Requests\UserRole;

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
            'userId' => 'required|exists:users,id',
            'roleId' => 'required|exists:roles,id'
        ];
    }
}
