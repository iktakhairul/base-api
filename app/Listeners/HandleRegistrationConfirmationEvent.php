<?php

namespace App\Listeners;

use App\Mail\RegistrationConfirmation;
use Illuminate\Support\Facades\Mail;

class HandleRegistrationConfirmationEvent
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
        $this->email        = $event->registerEmail;
        $this->receiverName = $event->receiverName;

        Mail::to($this->email)->send(new RegistrationConfirmation($this->email, $this->receiverName));
    }
}
