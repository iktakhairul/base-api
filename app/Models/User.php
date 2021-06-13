<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'contact_no',
        'type',
        'domain',
        'role',
        'weight',
        'access',
        'status',
        'password',
        'createdBy',
    ];

    /**
     * Get the user's roles
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
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
     * get full name of a user
     *
     */
    public function getFullNameAttribute()
    {
        $fullName = $this->firstName;
        if (!empty($this->middleName)) {
            $fullName .= ' ' . $this->middleName;
        }
        return $fullName . ' ' . $this->lastName;
    }

    /**
     * set full name attribute
     *
     * @param $fullName
     */
    public function setFullNameAttribute($fullName)
    {
        $nameArray = explode(' ', $fullName);
        $this->attributes['firstName'] = $nameArray[0];
        $this->attributes['middleName'] = count($nameArray) === 3 ? $nameArray[1] : null;
        $this->attributes['lastName'] =  count($nameArray) === 2 ? $nameArray[1] : (count($nameArray) === 3 ? $nameArray[2] : null);
    }

    /**
     * is a system admin user of the app
     *
     * @return bool
     */
    public function isSystemAdmin()
    {
        foreach ($this->userRoles as $userRole) {
            if (in_array($userRole->role->type, [Role::ROLE_SYSTEM])) {
                return true;
            }
        }
        return false;
    }

    /**
     * is a developer user of the app
     *
     * @return bool
     */
    public function isDeveloper()
    {
        foreach ($this->userRoles as $userRole) {
            if (in_array($userRole->role->type, [Role::ROLE_DEVELOPER])) {
                return true;
            }
        }
        return false;
    }

    /**
     * is a app admin user of the app
     *
     * @return bool
     */
    public function isAppAdmin()
    {
        foreach ($this->userRoles as $userRole) {
            if (in_array($userRole->role->type, [Role::ROLE_ADMIN])) {
                return true;
            }
        }
        return false;
    }

    /**
     * is a auditor
     *
     * @return bool
     */
    public function isAuditor()
    {
        foreach ($this->userRoles as $userRole) {
            if (in_array($userRole->role->type, [Role::ROLE_AUDITOR])) {
                return true;
            }
        }
        return false;
    }

    /**
     * is a accountant
     *
     * @return bool
     */
    public function isAccountant()
    {
        foreach ($this->userRoles as $userRole) {
            if (in_array($userRole->role->type, [Role::ROLE_ACCOUNTANT])) {
                return true;
            }
        }
        return false;
    }

    /**
     * is a operator
     *
     * @return bool
     */
    public function isOperator()
    {
        foreach ($this->userRoles as $userRole) {
            if (in_array($userRole->role->type, [Role::ROLE_OPERATOR])) {
                return true;
            }
        }
        return false;
    }

    /**
     * is a support
     *
     * @return bool
     */
    public function isSupport()
    {
        foreach ($this->userRoles as $userRole) {
            if (in_array($userRole->role->type, [Role::ROLE_SUPPORT])) {
                return true;
            }
        }
        return false;
    }

    /**
     * is a merchant
     *
     * @return bool
     */
    public function isMerchant()
    {
        foreach ($this->userRoles as $userRole) {
            if (in_array($userRole->role->type, [Role::ROLE_MERCHANT])) {
                return true;
            }
        }
        return false;
    }
    /**
     * is a member
     *
     * @return bool
     */
    public function isMember()
    {
        foreach ($this->userRoles as $userRole) {
            if (in_array($userRole->role->type, [Role::ROLE_MEMBER])) {
                return true;
            }
        }
        return false;
    }
}
