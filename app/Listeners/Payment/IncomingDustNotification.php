<?php

namespace App\Listeners\Payment;

use App\Events\Payment\IncomingDustAmount;
use Illuminate\Support\Facades\Log;

class IncomingDustNotification
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
     * @param IncomingDustAmount $event
     * @return void
     */
    public function handle(IncomingDustAmount $event)
    {
        $user = \App\Models\User::findByUsername($event->user);
        $amount = $event->coinAmount / 1000000000000;

        $createdConversation = $user->conversations()->create(['subject' => 'Incoming Payment (2.stage)']);
        $body = "$amount $event->coinName is coming.";

        $createdConversation->messages()->create([
            'user_id' => $user->id,
            'body' => $body
        ]);

        Log::info("Also dust-listener triggered");
    }
}
