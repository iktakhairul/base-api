<?php

namespace App\Listeners;

use App\Mail\ResetUserPassword;
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
     * @param object $event
     * @return void
     */
    public function handle(object $event)
    {
        $this->passwordReset = $event->passwordReset;
        $this->email         = $this->passwordReset->email;
        $this->receiverName  = $event->receiverName;
        Mail::to($this->email)->send(new ResetUserPassword($this->passwordReset, $this->receiverName));
    }
}
