<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetConfirmation extends Mailable
{
    use Queueable, SerializesModels;


    public $receiver;

    /**
     * Create a new message instance.
     *
     * @param User $receiver
     */
    public function __construct(User $receiver)
    {
        $this->receiver = $receiver;
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
