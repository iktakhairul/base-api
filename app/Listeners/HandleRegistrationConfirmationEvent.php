<?php

namespace App\Listeners;

use App\Jobs\SendEmailJob;

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

        dispatch(new SendEmailJob($this->email, $this->receiverName));
    }
}
