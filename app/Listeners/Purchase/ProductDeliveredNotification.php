<?php

namespace App\Listeners\Purchase;

use App\Events\Purchase\ProductDelivered;

class ProductDeliveredNotification
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
     * @param object $event
     * @return void
     */
    public function handle(ProductDelivered $event)
    {
        $content = 'Your product has been marked delivered by buyer [' . $event->buyer->username . ']';
        $routeName = 'profile.vendor.receivedorders';
        $routeParams = null;
        $event->vendor->user->notify($content, $routeName, $routeParams);
    }
}
