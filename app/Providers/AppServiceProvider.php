<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Response;
use URL;

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

        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }
        
        URL::forceScheme('https'); //Production

        // Modify the Content Security Po
        // licy header globally
        Response::macro('csp', function () {
            return response()->header('Content-Security-Policy', "default-src 'self'; connect-src 'self' http://simzat.kemenag.go.id");
        });
    }
}
