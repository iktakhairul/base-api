<?php

namespace App\Repositories;

use App\Events\PasswordResetConfirmationEvent;
use App\Events\PasswordResetEvent;
use App\Http\Resources\UserResource;
use App\Repositories\Contracts\PasswordResetRepository;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class EloquentPasswordResetRepository extends EloquentBaseRepository implements PasswordResetRepository
{
    /**
     * Save resource to reset password table.
     *
     * @inheritDoc
     */
    public function save(array $data) : \ArrayAccess
    {
        if (isset($data['emailOrPhone']))  {
            if (strpos($data['emailOrPhone'], '@') !== false) {
                $data['email'] = $data['emailOrPhone'];
            }else {
                $data['phone'] = $data['emailOrPhone'];
            }
            unset($data['emailOrPhone']);
        }
        $data['token'] = time() . '-' . Str::Random(32);

        return $this->model->create($data);
    }

    /**
     * If user exists against to input email or phone then send token.
     *
     */
    public function sendToken($passwordReset)
    {
        $user = null;
        if ($passwordReset['email']) {
            $user = app(UserRepository::class)->findBy(['email' => $passwordReset['email']])->first();
        }elseif ($passwordReset['phone']) {
            $user = app(UserRepository::class)->findBy(['phone' => $passwordReset['phone']])->first();
        }
        if ($user) {
            event(new PasswordResetEvent($passwordReset, $user['fullName']));
        }else {
            return response()->json(['status' => 404, 'message' => 'Invalid user against to this mail or phone.'], 404);
        }
    }

    /**
     * Check valid token, check valid token, update password field for user. Delete password reset token after update password.
     *
     */
    public function updatePasswordTry($request)
    {
        DB::beginTransaction();
        /**
         * Check valid token.
         */
        $passwordReset = app(PasswordResetRepository::class)->findBy(['token' => $request['token']])->last();
        if (!$passwordReset) {
            return response()->json(['status' => 404, 'message' => 'Token is invalid.'], 404);
        }

        /**
         * Get user by email or phone.
         */
        $user = null;
        if ($passwordReset['email']) {
            $user = app(UserRepository::class)->findBy(['email' => $passwordReset['email']])->first();
        }elseif ($passwordReset['phone']) {
            $user = app(UserRepository::class)->findBy(['phone' => $passwordReset['phone']])->first();
        }

        /**
         * Update password for user, Do not use repository to update password.
         */
        if ($user) {
            $passwordResetUpdate = DB::table('users')->where('id', $user->id)->update(['password' => bcrypt($request['password'])]);
            if ($passwordResetUpdate) {
                event(new PasswordResetConfirmationEvent($user['email'], $user['fullName']));
                $passwordResetUpdate = response()->json(['status' => 201, 'message' => 'Password has been successfully updated.', 'user' => new UserResource($user)], 201);
            }else {
                return response()->json(['status' => 404, 'message' => 'User password cann\'t update.'], 404);
            }
        }else {
            return response()->json(['status' => 404, 'message' => 'Invalid user against token.'], 404);
        }

        /**
         * Delete token after update.
         */
        $passwordReset->delete();
        DB::commit();

        return $passwordResetUpdate;
    }
}
