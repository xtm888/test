<?php

namespace App\Listeners\Purchase;

use App\Events\Purchase\NewPurchase;

class ProductBoughtNotification
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
     * @param NewPurchase $event
     * @return void
     */
    public function handle(NewPurchase $event)
    {
        $content = 'Your product has been purchased by [' . $event->buyer->username . ']';
        $routeName = 'profile.vendor.receivedorders';
        $routeParams = null;
        $event->vendor->user->notify($content, $routeName, $routeParams);
    }
}
