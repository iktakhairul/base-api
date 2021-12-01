<?php

namespace App\Models;

use App\Http\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, CommonModelFeatures;

    /**
     * The attributes that are mass hidden.
     *
     * @var array
     */
    protected $hidden = ['password'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'fullName',
        'userName',
        'email',
        'password',
        'userDomain',
        'userType',
        'userWeight',
        'address',
        'zipCode',
        'phone',
        'secondaryPhone',
        'city',
        'state',
        'country',
        'isActive',
        'profileImage',
        'createdBy',
    ];

    /**
     * User Types
     */

    const USER_TYPE_SYSTEM_ADMIN_USER = 'system';
    const USER_TYPE_GENERAL_ADMIN_USER = 'admin';
    const USER_TYPE_GENERAL_USER = 'user';

    /**
     * Get the user's roles
     *
     * @return HasMany
     */
    public function userRoles()
    {
        return $this->hasMany(UserRole::class, 'userId');
    }

    /**
     * set password attribute
     *
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    /**
     * Is a system admin user?
     *
     * @return bool
     */
    public function isSystemAdminUser()
    {
        foreach ($this->userRoles as $userRole) {
            if (in_array($userRole->role->type, [Role::ROLE_SYSTEM_ADMIN, Role::ROLE_SYSTEM_ADMIN])) {
                return true;
            }
        }
        return false;
    }

    /**
     * Is a general admin user?
     *
     * @return bool
     */
    public function isGeneralAdminUser()
    {
        foreach ($this->userRoles as $userRole) {
            if (in_array($userRole->role->type, [Role::ROLE_GENERAL_ADMIN, Role::ROLE_GENERAL_ADMIN])) {
                return true;
            }
        }
        return false;
    }

    /**
     * Is a general user?
     *
     * @return bool
     */
    public function isGeneralUser()
    {
        foreach ($this->userRoles as $userRole) {
            if (in_array($userRole->role->type, [Role::ROLE_GENERAL_USER, Role::ROLE_GENERAL_USER])) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get the user profile pic
     *
     * @return HasOne
     */
    public function profilePic()
    {
        return $this->hasOne(Attachment::class, 'resourceId', 'id')->where('type', Attachment::ATTACHMENT_TYPE_PROFILE_PIC)->orderBy('created_at', 'desc');
    }
}
