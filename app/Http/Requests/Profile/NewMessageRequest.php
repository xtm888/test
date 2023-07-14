<?php

namespace App\Http\Requests\Profile;

use App\Events\Message\MessageSent;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Foundation\Http\FormRequest;

class NewMessageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'message' => 'required|string'
        ];
    }

    public function persist(Conversation $conversation)
    {
        $sender = auth()->user();

//        $receiver = $conversation->otherUser();
//        $newMessage = new Message;
//        $newMessage->setConversation($conversation);
//        $newMessage->setSender($sender);
//        $newMessage->setReceiver($receiver);
//        $newMessage->setContent($this->message, $sender, $receiver);
//        $newMessage->save();

        $newMessage = $conversation->messages()->create([
            'user_id' => $sender->id,
            'body' => $this->message
        ]);

        foreach ($conversation->users as $conUser) {
            $conUser->pivot->update(['unRead' => 1]);
        }

        $otherUser = $conversation->users->where('id','!=', $sender->id)->first();

        if ($otherUser == null) {
            $system = true;
        } else {
            $system = false;
        }

        event(new MessageSent($conversation,$otherUser->id,$system, $sender));

    }
}
