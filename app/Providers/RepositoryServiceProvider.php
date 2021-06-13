<?php

namespace App\Providers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;

use App\Repositories\Contracts\RoleRepository;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\Contracts\UserRoleRepository;
use App\Repositories\EloquentRoleRepository;
use App\Repositories\EloquentUserRepository;
use App\Repositories\EloquentUserRoleRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepository::class, function () {
            return new EloquentUserRepository(new User());
        });

        $this->app->bind(RoleRepository::class, function () {
            return new EloquentRoleRepository(new Role());
        });

        $this->app->bind(UserRoleRepository::class, function () {
            return new EloquentUserRoleRepository(new UserRole());
        });
    }
}
