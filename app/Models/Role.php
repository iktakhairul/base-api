<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    const ROLE_SYSTEM = 'system';
    const ROLE_DEVELOPER = 'developer';
    const ROLE_ADMIN = 'admin';
    const ROLE_AUDITOR = 'auditor';
    const ROLE_ACCOUNTANT = 'accountant';
    const ROLE_OPERATOR = 'operator';
    const ROLE_SUPPORT = 'support';
    const ROLE_MERCHANT = 'merchant';
    const ROLE_MEMBER = 'member';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'descriptions'
    ];
}
