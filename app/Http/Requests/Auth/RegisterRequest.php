<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class RegisterRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $rules = [
            'fullName'             => 'required|max:160|min:3',
            'userName'             => 'required|max:100|min:3',
            'email'                => 'required|email|max:255|unique:users,email',
            'phone'                => 'required|max:20|min:8|unique:users,phone',
            'password'             => 'min:6|max:50|required_with:password_confirmation',
            'passwordConfirmation' => 'min:6|max:50|required_with:password',
        ];
    }
}
