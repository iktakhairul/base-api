<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;

class AttachmentResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'fileName'     => $this->fileName,
            'descriptions' => $this->descriptions,
            'type'         => $this->type,
            'resourceId'   => $this->resourceId,
            'fileType'     => $this->fileType,
            'fileSize'     => $this->fileSize,
            'fileUrl'      => $this->getFileUrl(),
        ];
    }
}
