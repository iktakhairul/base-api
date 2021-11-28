<?php

namespace App\Repositories;

use App\Models\Attachment;
use App\Helpers\AttachmentHelper;
use App\Repositories\Contracts\AttachmentRepository;
use Illuminate\Http\UploadedFile;

class EloquentAttachmentRepository extends EloquentBaseRepository implements AttachmentRepository
{
    /**
     * Model name
     *
     * @var string
     */
    protected $modelName = Attachment::class;

    /*
     * @inheritdoc
     */
    public function save(array $data): \ArrayAccess
    {
        if ($data['fileSource'] instanceof UploadedFile) {
            $image = file_get_contents($data['fileSource']);
        } else {
            $image = base64_decode(AttachmentHelper::getFileSourceFromInput($data));
        }
        $directoryName = $this->model->getDirectoryName($data['type']);
        $data['fileName'] = str_random(20) . '_'.$data['resourceId'].'_'.$data['fileName'];
        \Storage::put($directoryName . '/' . $data['fileName'], $image, 'public');
        return parent::save($data);
    }

    public function update(\ArrayAccess $model, array $data): \ArrayAccess
    {
        $image = AttachmentHelper::getFileSourceFromInput($data);
        $directoryName = $this->model->getDirectoryName($data['type']);
        $data['fileName'] = str_random(20) . '_'.$data['resourceId'].'_'.$data['fileName'];
        AttachmentHelper::deleteFile($directoryName.'/'.$model->fileName);
        \Storage::put($directoryName . '/' . $data['fileName'], base64_decode($image), 'public');
        return parent::update($model, $data);
    }

    public function getAttachmentByFactoryCertificateId($factoryCertificateId)
    {
        return $this->model->where('resourceId', $factoryCertificateId)
            ->where('type', Attachment::ATTACHMENT_TYPE_FACTORY_CERTIFICATE)
            ->orderBy('id', 'desc')
            ->first();
    }

    public function delete(\ArrayAccess $model): bool
    {
        $directoryName = $this->model->getDirectoryName($model->type);
        AttachmentHelper::deleteFile($directoryName.'/'.$model->fileName);
        return parent::delete($model);
    }
}
