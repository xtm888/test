<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Marketplace\Wallet;

class CreateUserWallet
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
        Wallet::createUserWallet($user);
    }
}
