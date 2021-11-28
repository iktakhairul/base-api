<?php

namespace App\Http\Requests\PasswordReset;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'token'                 => 'required|max:255',
            'password'              => 'required|min:5|confirmed',
            'password_confirmation' => 'required',
        ];
    }
}
