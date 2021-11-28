<?php

namespace App\Http\Requests\Attachment;

use App\Models\Attachment;
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
            'createdBy'    => 'exists:users,id',
            'type'         => 'required|in:' . implode(',', Attachment::getConstantsByPrefix('ATTACHMENT_TYPE_')),
            'fileSource'   => 'required|max:2048',
            'resourceId'   => 'required',
            'fileName'     => 'required',
            'descriptions' => '',
            'fileType'     => '',
            'fileSize'     => '',
        ];
    }
}
