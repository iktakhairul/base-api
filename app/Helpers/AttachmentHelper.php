<?php

namespace App\Helpers;

class AttachmentHelper
{
    /**
     * get file data from a base64 encoded file
     *
     * @param $data
     * @return mixed
     */
    public static function getFileSourceFromInput($data)
    {
        list($baseType, $image) = explode(';', $data['fileSource']);
        list(, $image) = explode(',', $image);
        return $image;
    }

    /**
     * delete a file from s3
     *
     * @param $name
     */
    public static function deleteFile($name)
    {
        \Storage::delete($name);
    }
}