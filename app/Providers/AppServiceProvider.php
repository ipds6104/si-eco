<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\Paginator;

use Illuminate\Support\Facades\URL;

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
        // Force HTTPS if behind a secure proxy or if env is not local
        if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
            URL::forceScheme('https');
        } elseif (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }

        View::composer(['_navbar', 'modal._notifAll'], function ($view) {
            $user = auth()->user();
            $nipPengaju = $user->nip_lama;
        });

        Paginator::useBootstrapFive();
    }

}
