<?php

namespace App\Listeners;

use App\Events\UserRegistered;

class SendWelcomePM
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param UserRegistered $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $user = $event->user;

        $createdConversation = $user->conversations()->create(['subject' => 'Welcome To The Emperor Market']);
        $body = "You are really welcome to our market. Please check sections and if you have a problem dont hesitate to contact with admins.";

        $createdConversation->messages()->create([
            'user_id' => $user->id,
            'body' => $body
        ]);
    }
}
