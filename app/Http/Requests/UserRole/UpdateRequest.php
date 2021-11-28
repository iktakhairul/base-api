<?php

namespace App\Http\Requests\UserRole;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $rules = [
            'userId' => 'exists:users,id',
            'roleId' => 'exists:roles,id'
        ];
    }
}
