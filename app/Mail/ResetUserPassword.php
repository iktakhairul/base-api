<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetUserPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $passwordResetToken;

    public $receiverName;

    /**
     * Create a new message instance.
     *
     * @param $passwordResetToken
     * @param $receiverName
     */
    public function __construct($passwordResetToken, $receiverName = '')
    {
        $this->passwordResetToken   = $passwordResetToken;
        $this->receiverName         = $receiverName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Reset your password.")
            // ->view('user.reset-password')
            ->markdown('user.reset-password') // todo
            ->text('user.reset-password-plain'); // todo
    }
}
