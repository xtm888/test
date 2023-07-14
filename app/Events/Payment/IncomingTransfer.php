<?php

namespace App\Events\Payment;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Support\Facades\Log;

class IncomingTransfer
{
    use Dispatchable;

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

        Log::info("Incoming Transfer Event triggered" . ' ' . $coinName . ' ' . $coinAmount . ' ' . $user);
    }

}
