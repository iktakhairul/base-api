<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\PasswordReset;
use App\Models\Role;
use App\Models\UserRole;
use App\Models\Attachment;
use App\Repositories\Contracts\UserRepository;
use App\Repositories\EloquentUserRepository;
use App\Repositories\Contracts\PasswordResetRepository;
use App\Repositories\EloquentPasswordResetRepository;
use App\Repositories\Contracts\RoleRepository;
use App\Repositories\EloquentRoleRepository;
use App\Repositories\Contracts\UserRoleRepository;
use App\Repositories\EloquentUserRoleRepository;
use App\Repositories\Contracts\AttachmentRepository;
use App\Repositories\EloquentAttachmentRepository;


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

        $this->app->bind(PasswordResetRepository::class, function () {
            return new EloquentPasswordResetRepository(new PasswordReset());
        });

        $this->app->bind(RoleRepository::class, function () {
            return new EloquentRoleRepository(new Role());
        });

        $this->app->bind(UserRoleRepository::class, function () {
            return new EloquentUserRoleRepository(new UserRole());
        });

        $this->app->bind(AttachmentRepository::class, function () {
            return new EloquentAttachmentRepository(new Attachment());
        });
    }
}
