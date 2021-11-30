<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetConfirmation extends Mailable implements ShouldQueue
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
        return $this->subject("Password reset confirmation email.")
            ->markdown('user.password-reset-confirmation')
            ->text('user.password-reset-confirmation-plain');
    }
}
