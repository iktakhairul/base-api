<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = $this->route('user');

        return $rules = [
            'password'         => 'min:5|required_with:current_password',
            'current_password' => 'required_with:password',

            'firstName'      => 'required|regex:/^[a-zA-Z0-9.,\s]+$/|min:3|max:100',
            'lastName'       => 'required|regex:/^[a-zA-Z0-9.,\s]+$/|min:3|max:50',
            'fullName'       => 'required|regex:/^[a-zA-Z0-9.,\s]+$/|min:3|max:160',
            'userName'       => 'required|string|min:3|max:100',
            'email'          => 'required|email|unique:users,email,'. $user->id, // Correct unique email validation.
            'userDomain'     => 'string|max:100',
            'userType'       => 'required|in:'. User::USER_TYPE_SYSTEM_ADMIN_USER. ',' .User::USER_TYPE_GENERAL_ADMIN_USER. ',' .User::USER_TYPE_GENERAL_USER,
            'userWeight'     => 'string|max:6',
            'address'        => 'string|max:255',
            'zipCode'        => 'string|max:4',
            'phone'          => 'string|max:20|unique:users,phone,'. $user->id, // Correct unique phone validation.
            'secondaryPhone' => 'string|max:20',
            'city'           => 'string|max:100',
            'state'          => 'string|max:100',
            'country'        => 'string|max:100',
            'isActive'       => 'numeric',
            'profileImage'   => 'mimes:jpeg,png,bmp,jpg,gif,webp,svg|max:2048', // 2048 KB Max Size.
            'createdBy'      => 'exists:users,id',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator $validator
     * @return void
     */
    public function withValidator($validator)
    {
        parent::withValidator($validator);

        $validator->after(function ($validator) {
            if ($this->input('password')) {

                // get User model from route binding
                $user = $this->route('user');

                if (empty($user->password)) {
                    $this->request->add(['password' => $this->input('password')]);
                    $this->request->remove('current_password');
                }elseif (Hash::check($this->input('current_password'), $user->password)) {
                    $this->request->add(['password' => $this->input('password')]);
                    $this->request->remove('current_password');
                }else {
                    $validator->errors()->add('current_password', 'Current password doesn\'t match.');
                }
            }
        });
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'password.required_with' => 'New password is required when current password is present.',
        ];
    }

}
