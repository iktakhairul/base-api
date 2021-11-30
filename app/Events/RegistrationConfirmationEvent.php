<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RegistrationConfirmationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $registerEmail, $receiverName;

    /**
     * Create a new event instance.
     *
     * @param $registerEmail
     * @param $receiverName
     */
    public function __construct($registerEmail, $receiverName)
    {
        $this->registerEmail = $registerEmail;
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
