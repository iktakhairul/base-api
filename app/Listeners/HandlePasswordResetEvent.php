<?php

namespace App\Listeners;

use App\Mail\ResetUserPassword;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendEmailJob;

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
     * @param object $event
     * @return void
     */
    public function handle(object $event)
    {
        // todo
//        $this->passwordReset = $event->passwordReset;
//        $this->email         = $this->passwordReset->email;
//        $this->receiverName  = $event->receiverName;
//        Mail::to($this->email)->send(new ResetUserPassword($this->passwordReset, $this->receiverName));

        dispatch(new SendEmailJob($event));
    }
}
