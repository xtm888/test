<?php

namespace App\Listeners\Purchase;

use App\Events\Purchase\ProductSent;

class ProductSentNotification
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
     * @param ProductSent $event
     * @return void
     */
    public function handle(ProductSent $event)
    {
        $content = 'Your product has been sent by vendor [' . $event->vendor->user->username . ']';
        $routeName = 'profile.purchases';
        $routeParams = null;
        $event->buyer->notify($content, $routeName, $routeParams);
    }
}
