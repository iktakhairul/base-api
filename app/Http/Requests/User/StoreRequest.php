<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;
use App\Models\User;

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
            'firstName'      => 'required|regex:/^[a-zA-Z0-9.,\s]+$/|min:3|max:100',
            'lastName'       => 'required|regex:/^[a-zA-Z0-9.,\s]+$/|min:3|max:50',
            'fullName'       => 'required|regex:/^[a-zA-Z0-9.,\s]+$/|min:3|max:160',
            'userName'       => 'required|string|min:3|max:100',
            'email'          => 'required|email|unique:users',
            'password'       => 'required|min:6',
            'userDomains'    => 'string|max:100',
            'userType'       => 'required|in:'. User::USER_TYPE_SYSTEM_ADMIN_USER. ',' .User::USER_TYPE_GENERAL_ADMIN_USER. ',' .User::USER_TYPE_GENERAL_USER,
            'userWeight'     => 'string|max:6',
            'address'        => 'string|max:255',
            'zipCode'        => 'string|max:4',
            'phone'          => 'string|max:20|unique:users',
            'secondaryPhone' => 'string|max:20',
            'city'           => 'string|max:100',
            'state'          => 'string|max:100',
            'country'        => 'string|max:100',
            'isActive'       => 'numeric',
            'profileImage'   => 'mimes:jpeg,png,bmp,jpg,gif,webp,svg|max:2048', // 2048 KB Max Size.
            'createdBy'      => 'exists:users,id',
        ];
    }
}
