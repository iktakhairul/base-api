<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $receiverEmail, $receiverName;

    /**
     * Create a new message instance.
     *
     * @param $receiverEmail
     * @param $receiverName
     */
    public function __construct($receiverEmail, $receiverName)
    {
        $this->receiverEmail = $receiverEmail;
        $this->receiverName  = $receiverName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Registration confirmation email.")
            ->markdown('user.registration-confirmation')
            ->text('user.registration-confirmation-plain');
    }
}
