<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;


class MessageSent implements ShouldBroadcast
{
    use SerializesModels;

    public $message;
    public $user;

    public function __construct(Message $message)
    {
        // kirim STRING saja
        $this->message = $message->message;
        $this->user = $message->user;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat-user-'.$this->message->user_id);
    }

    public function broadcastAs()
    {
        return 'message.sent';
    }
}
