<?php

namespace App\Providers;

use App\Events\PasswordResetEvent;
use App\Listeners\HandlePasswordResetEvent;
use App\Events\PasswordResetConfirmationEvent;
use App\Listeners\HandlePasswordResetConfirmationEvent;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        PasswordResetEvent::class => [
            HandlePasswordResetEvent::class,
        ],
        PasswordResetConfirmationEvent::class => [
            HandlePasswordResetConfirmationEvent::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
