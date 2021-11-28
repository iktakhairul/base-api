<?php

namespace App\Models;

use App\Http\Traits\CommonModelFeatures;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use CommonModelFeatures;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'email', 'token'
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    const UPDATED_AT = null;
}
