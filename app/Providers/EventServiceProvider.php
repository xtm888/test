<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        'App\Events\Message\MessageSent' => [
            'App\Listeners\SendMessageNotifications',
        ],
        'App\Events\Payment\IncomingTransfer' => [
            'App\Listeners\Payment\IncomingTransferNotification'
        ],
        'App\Events\Payment\IncomingDustAmount' => [
            'App\Listeners\Payment\IncomingDustNotification'
        ],
        'App\Events\Purchase\NewPurchase' => [
            'App\Listeners\Purchase\ProductBoughtNotification'
        ],
        'App\Events\Purchase\ProductSent' => [
            'App\Listeners\Purchase\ProductSentNotification'
        ],
        'App\Events\Purchase\ProductDelivered' => [
            'App\Listeners\Purchase\ProductDeliveredNotification',
            'App\Listeners\Experience\ProductDeliveredXPUpdate'
        ],
        'App\Events\Purchase\ProductDisputed' => [
            'App\Listeners\Purchase\ProductDisputedNotification'
        ],
        'App\Events\Purchase\ProductDisputeResolved' => [
            'App\Listeners\Purchase\ProductDisputeResolvedNotification',
            'App\Listeners\Experience\ProductDisputeResolvedXPUpdate'
        ],
        'App\Events\Purchase\ProductDisputeNewMessageSent' => [
            'App\Listeners\Purchase\ProductDisputeNewMessageNotification'
        ],
        'App\Events\Purchase\NewFeedback' => [
            'App\Listeners\Experience\NewFeedbackXPUpdate'
        ],
        'App\Events\Purchase\CanceledPurchase' => [
            'App\Listeners\Purchase\PurchaseCanceledNotification'
        ],
        'App\Events\UserRegistered' => [
            'App\Listeners\SendWelcomePM',
            'App\Listeners\CreateUserWallet'
        ],
        'App\Events\ModelDataChanged' => [
            'App\Listeners\ClearModelCache',
        ],
    ];
    /**
     * Event subscribers
     *
     * @var array
     */
    protected $subscribe = [
        'App\Listeners\AdminActionSubscriber',
        'App\Listeners\SupportEventSubscriber'
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
