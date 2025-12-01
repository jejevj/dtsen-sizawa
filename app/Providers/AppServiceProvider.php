<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
            // Modify the Content Security Policy header globally
    Response::macro('csp', function () {
        return response()->header('Content-Security-Policy', "default-src 'self'; connect-src 'self' http://simzat.kemenag.go.id");
    });
    }
}
