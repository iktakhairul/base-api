<?php


namespace App\Repositories\Contracts;


interface PasswordResetRepository extends BaseRepository
{
    /**
     * reset user's password
     *
     * @param \ArrayAccess $model
     * @param array $data
     * @return bool
     */
    public function resetPassword(\ArrayAccess $model, array $data);
}
