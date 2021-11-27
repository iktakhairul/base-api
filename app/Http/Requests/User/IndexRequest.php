<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class IndexRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $rules = [
            'id'    => 'numeric',
            'email' => 'email',
            'name'  => 'string',
        ];
    }

}
