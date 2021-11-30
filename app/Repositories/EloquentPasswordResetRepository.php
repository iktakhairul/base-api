<?php

namespace App\Repositories;

use App\Models\User;
use App\Events\PasswordResetEvent;
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
     * @inheritdoc
     */
    public function resetPassword($passwordReset, array $data): \ArrayAccess
    {
        DB::beginTransaction();

        $userRepository = app(UserRepository::class);
        $emailOrPhone = $passwordReset['email'] ?? $passwordReset['phone'];

        $user = $userRepository->findUserByEmailPhone($emailOrPhone);

        $user = User::where('email', '=', $emailOrPhone)->orWhere('phone', '=', $emailOrPhone)->first();

        $userRepository->update($user, ['password' => $data['password']]);

        $passwordReset->delete();

        DB::commit();

        return $user;
    }

}
