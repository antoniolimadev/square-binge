<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
//
use \App\MovieDB\ApiRequest;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // singleton always returns the same instance
        \App::singleton(ApiRequest::class, function () {
            return new ApiRequest((config('squarebinge.api_key')));
        });
    }
}
