<?php

namespace App\Events;

use App\Models\Prodect;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewMessageEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $message;
    /**
     * Create a new event instance.
     */
    public function __construct($user)
    {
        // dd("NewMessageEvent Triggered!", $user);
        $this->user = $user;
        $this->message = "new message from pusher ";
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        // dd("BroadcastOn Triggered!");

        return [
            new PrivateChannel('new-message'),
        ];
    }
    public function broadcastAs()
    {
        return 'newMessage';
    }
    public function broadcastWith()
    {

        // dd("Broadcasting Data:", $data); // تأكد من أن البيانات تُرسل قبل الوصول إلى Pusher

        return [
            'user' =>  $this->user,
            'message' =>  $this->message,
        ];
    }

}
