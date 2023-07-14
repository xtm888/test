<?php

namespace App\Listeners\Payment;

use App\Events\Payment\IncomingTransfer;
use Illuminate\Support\Facades\Log;

class IncomingTransferNotification
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
     * @param IncomingTransfer $event
     * @return void
     */
    public function handle(IncomingTransfer $event)
    {
        $user = \App\Models\User::findByUsername($event->user);
        $amount = $event->coinAmount / 1000000000000;
        $amount90 = ($amount * 90 / 100);
        $amount10 = ($amount * 10 / 100);

        $createdConversation = $user->conversations()->create(['subject' => 'Incoming Transfer Notification (1.stage)']);
        $body = "$amount $event->coinName is coming. Due to safety reasons, balance loading will be completed in 2 transfers. You will receive $amount90 $event->coinName first, then $amount10 $event->coinName. This process may take 30mins ~ 60mins depending on the density of the blockchain. Balances will be spentable after 10 blockchain confirmations.";

        $createdConversation->messages()->create([
            'user_id' => $user->id,
            'body' => $body
        ]);

        Log::info("Also listener triggered");
    }
}
