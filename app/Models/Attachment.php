<?php

namespace App\Models;

use App\Http\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attachment extends Model
{
    use CommonModelFeatures;

    const ATTACHMENT_TYPE_PROFILE_PIC = 'profile-pic';

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
        $directoryName = 'asset';
        switch ($attachmentType) {
            case self::ATTACHMENT_TYPE_PROFILE_PIC:
                $directoryName = 'profile-pics';
                break;
        }

        return $directoryName;
    }
}
