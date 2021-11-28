<?php

namespace App\Listeners;

use App\Mail\ResetUserPassword;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class HandlePasswordResetEvent
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $passwordReset = $event->passwordReset;
        Mail::to('psarjis@gmail.com')->send(new ResetUserPassword($passwordReset));
    }
}
