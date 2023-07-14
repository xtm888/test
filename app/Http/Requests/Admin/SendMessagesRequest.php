<?php

namespace App\Http\Requests\Admin;

use App\Events\Message\MessageSent;
use App\Exceptions\RequestException;
use App\Models\Admin;
use App\Models\Conversation;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Foundation\Http\FormRequest;


class SendMessagesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'message' => 'required|string',
            'groups' => 'required|array|min:1',
            'encrypted' => 'boolean',
        ];
    }

    public function messages()
    {
        return [
            'message.min' => 'At least one group must be selected!'
        ];
    }

    public function persist()
    {

        // make collections of receivers
        $receivers = collect();

        // add admins id
        if (in_array('admins', $this->groups)) {
            $receivers = $receivers->merge(Admin::allUsers());
        }

        // add vendors
        if (in_array('vendors', $this->groups)) {
            $receivers = $receivers->merge(Vendor::allUsers());
        }

        // buyers
        if (in_array('buyers', $this->groups)) {
            $receivers = $receivers->merge(User::buyers());
        }

        if ($receivers->isEmpty())
            throw new RequestException('There are no users in selected group/s.');


        $receivers = $receivers->unique(function ($receiver) {
            return $receiver->id;
        });

        // Create conversations
        foreach ($receivers as $receiver) {

            $receiver = $this->setReceiver($receiver);

            $newMessage = Conversation::createSystemMessage($receiver, $this->title, $this->message);


//            $newConversation = Conversation::findOrCreateMassMessageConversation($receiver);
//            $newMessage = new Message;
//            $newMessage -> setConversation($newConversation);
//            $newMessage -> setReceiver($receiver);
//            $newMessage -> setMassMessageContent($this -> message, $receiver);
//            $newMessage -> save();

            event(new MessageSent($newMessage, $receiver, true));

        }

        return $receivers->count();

    }

    /**
     * Set the user receiver of the message
     *
     * @param User $user
     */
    public function setReceiver(User $user)
    {
        return $this->receiver_id = $user->id;
    }
}
