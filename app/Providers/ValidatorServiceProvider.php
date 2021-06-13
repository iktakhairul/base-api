<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Use this function to register any new validation rules
     *
     * @return void
     */
    public function boot()
    {
        //lists
        \Validator::extend('list', 'App\Http\Validators\ListValidator@validateList');
        \Validator::replacer('list', 'App\Http\Validators\ListValidator@validationMessage');

        //json_ids
        \Validator::extend('json_ids', 'App\Http\Validators\JsonIdsValidators@validateJsonIds');
        \Validator::replacer('json_ids', 'App\Http\Validators\JsonIdsValidators@validationMessage');

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }
}
