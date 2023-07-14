<?php

namespace App\Events\Message;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Foundation\Events\Dispatchable;

class MessageSent
{
    use Dispatchable;

    /**
     * Message that is being sent
     *
     * @var Message
     */
    public $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Conversation $conversation, $receiver, $isSystem, $sender = null)
    {
        $this->conversation = $conversation;
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->isSystem = $isSystem;
    }
}
