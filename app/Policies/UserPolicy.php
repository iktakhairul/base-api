<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Intercept checks like constructor.
     *
     * @param User $currentUser
     * @return bool
     */
    public function before(User $currentUser)
    {
        if ($currentUser->isSystemAdminUser() || $currentUser->isGeneralAdminUser()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param User $currentUser
     * @return bool
     */
    public function list(User $currentUser)
    {
        if ($currentUser->isSystemAdminUser() || $currentUser->isGeneralAdminUser()) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $currentUser
     * @return bool
     */
    public function store(User $currentUser)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $currentUser
     * @param User $user
     * @return bool
     */
    public function show(User $currentUser, User $user)
    {
        return $currentUser['id'] === $user['id'];
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $currentUser
     * @param User $user
     * @return bool
     */
    public function update(User $currentUser, User $user)
    {
        return $currentUser['id'] === $user['id'];
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $currentUser
     * @param User $user
     * @return null
     */
    public function destroy(User $currentUser, User $user)
    {
        return false;
    }
}
