<?php

namespace App\Models;

use App\Http\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use CommonModelFeatures;

    const ROLE_SYSTEM_ADMIN = 'system_admin';
    const ROLE_GENERAL_ADMIN = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'description'
    ];
}
