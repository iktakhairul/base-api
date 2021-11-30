<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PasswordResetConfirmationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $passwordResetEmail, $receiverName;

    /**
     * Create a new event instance.
     *
     * @param $passwordResetEmail
     * @param $receiverName
     */
    public function __construct($passwordResetEmail, $receiverName)
    {
        $this->passwordResetEmail = $passwordResetEmail;
        $this->receiverName  = $receiverName;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
