<?php

namespace App\Listeners;

use App\Events\Message\MessageSent;
use App\Models\User;

class SendMessageNotifications
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
     * @param MessageSent $event
     * @return void
     */
    public function handle(MessageSent $event)
    {
//        $receivers = $event->conversation->first()->conversation->users->where('username', '!=', $event->sender->username);

        $receiver = $event->receiver;
        $receiver = User::where('id', $receiver)->first();

        if ($event->isSystem) {
            $content = 'You have received new message from SYSTEM';
            $routeName = 'profile.messages';
            //$routeParams = serialize(['conversation' => $event->message->conversation()->first()->id]);

            $routeParams = null;

            $receiver->notify($content, $routeName, $routeParams);

//            foreach ($receivers as $receiver) {
//                $receiver->notify($content, $routeName, $routeParams);
//            }
        }

        if (!is_null($event->sender)) {
            $content = 'You have received new message from [' . $event->sender->username . ']';
            $routeName = 'profile.messages';

            $routeParams = serialize($event->conversation->id);


            $receiver->notify($content, $routeName, $routeParams);
//            foreach ($receivers as $receiver) {
//                $receiver->notify($content, $routeName, $routeParams);
//            }
        }
    }
}
