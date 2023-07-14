<?php

namespace App\Events\Purchase;

use App\Models\Purchase;
use Illuminate\Foundation\Events\Dispatchable;

class CanceledPurchase
{
    use Dispatchable;

    public Purchase $purchase;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Purchase $purchase)
    {
        $this->purchase = $purchase;
    }
}
