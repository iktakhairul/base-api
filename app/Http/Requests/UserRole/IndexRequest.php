<?php

namespace App\Http\Requests\UserRole;

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
            'id'        => 'list:numeric',
            'userId'    => 'list:numeric',
            'roleId'    => 'list:numeric'
        ];
    }

}
