<?php

namespace App\Http\Requests\UserRole;

use App\Http\Requests\Request;
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
        return $rules = [
            'userId' => 'exists:users,id',
            'roleId' => 'exists:roles,id'
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

                if (Hash::check($this->input('current_password'), $user->password)) {
                    $this->request->add(['password' => bcrypt($this->input('password'))]);
                    $this->request->remove('current_password');
                } else {
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
