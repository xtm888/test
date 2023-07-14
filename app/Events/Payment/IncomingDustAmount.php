<?php

namespace App\Events\Payment;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class IncomingDustAmount
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($coinName, $coinAmount, $user)
    {
        $this->coinName = $coinName;
        $this->coinAmount = $coinAmount;
        $this->user = $user;

        Log::info("Incoming Dust Event triggered" . ' ' . $coinName . ' ' . $coinAmount . ' ' . $user);
    }
}
