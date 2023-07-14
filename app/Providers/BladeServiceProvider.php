<?php

namespace App\Providers;

use App\Marketplace\ModuleManager;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
//        Blade::if('error', function ($name, $errors) {
//            return $errors->has($name);
//        });

        // if we are on  this route custom blade directive
        Blade::if('isroute', function ($routeName) {
            return str_contains(Route::currentRouteName(), $routeName);
        });

        Blade::if('vendor', function () {
            return auth()->check() && auth()->user()->isVendor();
        });
        // check if the logged user is admin
        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->isAdmin();
        });

        Blade::if('moderator', function () {
            return auth()->check() && auth()->user()->hasPermissions() && !auth()->user()->isAdmin();
        });

        Blade::if('hasAccess', function ($permission) {
            return auth()->check() && (auth()->user()->isAdmin() || auth()->user()->hasPermission($permission));
        });

        Blade::if('isModuleEnabled', function ($moduleName) {
            return ModuleManager::isEnabled($moduleName);
        });

        Blade::if('search', function () {

            $display = false;
            $routes = [
                'home',
                'category'
            ];
            foreach ($routes as $route) {

                if (str_contains(Route::currentRouteName(), $route)) {

                    $display = true;
                    break;
                }
            }
            return $display;


        });
    }
}
