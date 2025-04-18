<?php
namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat.store.' . $this->message->conversation_id);
    }
    public function broadcastAs()
    {
        return 'chatEvent';
    }
    public function broadcastWith()
    {
        return [
            'message' => [
                'id' => $this->message->id,
                'text' => $this->message->text,
                'is_admin' => $this->message->is_admin,
                'created_at' => $this->message->created_at->toISOString(),
            ],
        ];
    }
}
