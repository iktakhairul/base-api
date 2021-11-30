<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetUserPassword extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $passwordResetToken;

    public $receiverName;

    /**
     * Create a new message instance.
     *
     * @param $passwordReset
     * @param $receiverName
     */
    public function __construct($passwordReset, $receiverName)
    {
        $this->passwordResetToken = $passwordReset['token'];
        $this->receiverName       = $receiverName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Reset your password.")
            ->markdown('user.reset-password')
            ->text('user.reset-password-plain');
    }
}
