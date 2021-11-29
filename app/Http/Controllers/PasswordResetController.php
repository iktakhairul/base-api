<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordReset\GenerateTokenRequest;
use App\Http\Requests\PasswordReset\PasswordResetRequest;
use App\Http\Resources\PasswordResetResource;
use App\Http\Resources\UserResource;
use App\Mail\PasswordResetConfirmation;
use App\Repositories\Contracts\PasswordResetRepository;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
     * @return JsonResponse
     */
    public function resetPassword(PasswordResetRequest $request)
    {
        // $passwordReset = $this->repository->findBy(['token' => $request->get('token')])->first(); //todo

        // $passwordReset = PasswordReset::where('token', $request->get('token'));
        $passwordReset  = DB::table('password_resets')->where('token', $request->get('token'))->first();
        if (!$passwordReset) {
            return response()->json(['status' => 404, 'message' => 'Token is invalid.'], 404);
        }

        // $user = $this->repository->resetPassword($passwordReset, $request->all());
        $user  = null;
        $userRepository = app(UserRepository::class);

        if ($passwordReset->email) {
            $user   = $userRepository->findBy(['email' => $passwordReset->email])->first();
        } else if ($passwordReset->phone) {
            $user   = $userRepository->findBy(['phone' => $passwordReset->phone])->first();
        }

        if ($user) {
            $update = $userRepository->update($user, ['password' => Hash::make($request->get('password'))]);
            Mail::to($user->email)->send(new PasswordResetConfirmation($user));
        } else {
            return response()->json(['status' => 404, 'message' => 'Invalid user against token.'], 404);
        }

        return response()->json(['status' => 201, 'message' => 'Password has been reset.', 'user' => new UserResource($update)], 201);
    }
}
