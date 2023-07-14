<?php

namespace App\Providers;

use App\Models\MarketPlace;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->isDatabaseConnected() && $this->tableExists('market_places')) {
            Cache::tags('MarketPlace')->rememberForever('MPCACHE', function () {
                return MarketPlace::first();
            });
        }
    }

    /**
     * Check if the database is connected.
     *
     * @return bool
     */
    private function isDatabaseConnected(): bool
    {
        try {
            DB::connection()->getPdo();
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Check if a table exists in the database.
     *
     * @param string $table
     * @return bool
     */
    private function tableExists(string $table): bool
    {
        return Schema::hasTable($table);
    }
}
