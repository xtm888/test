<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

/**
 * Trait Displayable
 *
 * All methods used for displaying User or User's properties
 *
 * @package App\Traits
 */
trait DisplayablePurchase
{
    /**
     * Display 5 latest COMPLETED purchases
     */
    public static function latestOrders()
    {
        return Cache::remember('latest_orders_frontpage', config('marketplace.front_page_cache.latest_orders'), function () {
            return self::orderBy('created_at', 'desc')->where('state', 'delivered')->limit(5)->get();
        });
    }
}
