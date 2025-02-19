<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EmailNotification
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $emailType; // Tipo de email a enviar, baja, bienvenida, etc.

    public $data; // Datos del usuario, nombre, email, etc.

    /**
     * Create a new event instance.
     */
    public function __construct($emailType, $data)
    {
        $this->emailType = $emailType;
        $this->data = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
