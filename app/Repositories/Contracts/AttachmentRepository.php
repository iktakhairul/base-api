<?php

namespace App\Repositories\Contracts;

interface AttachmentRepository extends BaseRepository
{
    public function getAttachmentByFactoryCertificateId($factoryCertificateId);
}