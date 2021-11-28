<?php

namespace App\Models;

use App\Http\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserRole extends Model
{
    use CommonModelFeatures;

    protected $table = 'users_roles';

    const ROLE_SYSTEM_ADMIN = 4;
    const ROLE_GENERAL_ADMIN = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'userId',
        'createdBy',
        'roleId'
    ];

    /**
     * get the user
     *
     * @return HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }

    /**
     * get role of the users
     *
     * @return HasOne
     */
    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'roleId');
    }

    /**
     * get role of the users
     *
     * @return HasOne
     */
    public function createdByUser()
    {
        return $this->hasOne(User::class, 'id', 'createdBy');
    }

}
