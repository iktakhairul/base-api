<?php

namespace App\Http\Traits;

use Illuminate\Database\Eloquent\SoftDeletes;

trait CommonModelFeatures
{
    use SoftDeletes, CommonModelHelperFeatures;
}
