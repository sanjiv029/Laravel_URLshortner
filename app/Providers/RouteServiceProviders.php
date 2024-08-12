<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RouteServiceProviders extends ServiceProvider
{
    /**
     * Register services.
     */
   public const HOME ='/';

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
