<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordReset\GenerateTokenRequest;
use App\Http\Requests\PasswordReset\PasswordResetRequest;
use App\Http\Resources\PasswordResetResource;
use App\Repositories\Contracts\PasswordResetRepository;

class PasswordResetController extends Controller
{
    /**
     * @var PasswordResetRepository
     */
    private $passwordResetRepository;

    public function __construct(PasswordResetRepository $passwordResetRepository)
    {
        $this->passwordResetRepository = $passwordResetRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param GenerateTokenRequest $request
     * @return PasswordResetResource
     */
    public function generateResetToken(GenerateTokenRequest $request)
    {
        $passwordReset = $this->passwordResetRepository->save($request->all());
        if ($passwordReset) {
            $this->passwordResetRepository->sendToken($passwordReset);
        }

        return new PasswordResetResource($passwordReset);
    }

    /**
     * Display the specified resource.
     *
     * @param PasswordResetRequest $request
     * @return object
     */
    public function resetPassword(PasswordResetRequest $request)
    {
        return $this->passwordResetRepository->updatePasswordTry($request->all());
    }
}
