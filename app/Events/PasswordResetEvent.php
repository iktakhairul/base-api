<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PasswordResetEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $passwordReset, $receiverName;

    /**
     * Create a new event instance.
     *
     * @param $receiverName
     * @param $passwordReset
     */
    public function __construct($passwordReset, $receiverName)
    {
        $this->passwordReset = $passwordReset;
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
