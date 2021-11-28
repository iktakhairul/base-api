<?php

namespace App\Models;

use App\Http\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attachment extends Model
{
    use CommonModelFeatures;

    const ATTACHMENT_TYPE_PROFILE_PIC = 'profile_pic';
    const ATTACHMENT_TYPE_FACTORY_CERTIFICATE = 'factory_certificates';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'attachments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'createdBy',
        'type',
        'resourceId',
        'fileName',
        'descriptions',
        'fileType',
        'fileSize'
    ];

    /**
     * Get the user who created the attachment
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'createdBy');
    }

    /**
     * Get storage directory name by attachment type
     *
     * @param $attachmentType
     * @return string
     */
    public function getDirectoryName($attachmentType)
    {
        $directoryName = 'misc';
        switch ($attachmentType) {
            case self::ATTACHMENT_TYPE_PROFILE_PIC:
                $directoryName = 'profile-pics';
                break;
        }

        return $directoryName;
    }


    /**
     * generate file URL by type
     *
     * @param string $imageType
     * @return mixed
     */
    public function getFileUrl($imageType = '')
    {
        return \Storage::temporaryUrl($this->getDirectoryName($this->type) . '/' . $this->fileName, now()->addMinutes(5));
    }
}
