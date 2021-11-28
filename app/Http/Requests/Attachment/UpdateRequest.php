<?php

namespace App\Http\Requests\Attachment;

use App\Models\Attachment;
use App\Http\Requests\Request;

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
            'createdBy' => 'exists:users,id',
            'type'         => 'in:' . implode(',', Attachment::getConstantsByPrefix('ATTACHMENT_TYPE_')),
            'fileSource' => 'required',
            'resourceId' => 'required',
            'fileName' => 'required',
            'descriptions' => '',
            'fileType' => '',
            'fileSize' => '',
            'id' => ''
        ];
    }
}
