<?php


namespace App\Repositories\Contracts;


interface PasswordResetRepository extends BaseRepository
{
    /**
     * reset user's password
     *
     * @param array $request
     * @return object
     */
    public function updatePasswordTry(array $request);
}
