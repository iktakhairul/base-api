<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRole extends Model
{
    use SoftDeletes;

    protected $table = 'users_roles';

    const ROLE_FACTORY_ADMIN = 4;
    const ROLE_BRAND_ADMIN = 2;

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
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'userId');
    }

    /**
     * get role of the users
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'roleId');
    }

    /**
     * get role of the users
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function createdByUser()
    {
        return $this->hasOne(User::class, 'id', 'createdBy');
    }
}
