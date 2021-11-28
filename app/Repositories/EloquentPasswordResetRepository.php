<?php


namespace App\Repositories;


use App\Models\PasswordReset;
use App\Models\User;
use App\Events\PasswordResetEvent;
use App\Repositories\Contracts\PasswordResetRepository;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EloquentPasswordResetRepository extends EloquentBaseRepository implements PasswordResetRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data) : \ArrayAccess
    {
        if (isset($data['emailOrPhone']))  {
            if (strpos($data['emailOrPhone'], '@') !== false) {
                $data['email'] = $data['emailOrPhone'];
            } else {
                $data['phone'] = $data['emailOrPhone'];
            }
            unset($data['emailOrPhone']);
        }

        $data['token'] = time() . '-' . Str::Random(32);
        $passwordReset = parent::save($data);

        event(new PasswordResetEvent($passwordReset));

        return $passwordReset;
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
