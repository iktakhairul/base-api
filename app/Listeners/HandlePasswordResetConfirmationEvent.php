<?php

namespace App\Listeners;

use App\Mail\PasswordResetConfirmation;
use Illuminate\Support\Facades\Mail;

class HandlePasswordResetConfirmationEvent
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
        $this->email         = $event->passwordResetEmail;
        $this->receiverName  = $event->receiverName;

        Mail::to($this->email)->send(new PasswordResetConfirmation($this->email, $this->receiverName));
    }
}
