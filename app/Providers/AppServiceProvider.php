<?php

namespace App\Providers;

use App\Models\subscription;
use App\Observers\SubscriptionObserver;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

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

        Paginator::useBootstrapFive();
        // subscription::observe(SubscriptionObserver::class);

        RateLimiter::for('api', function ($request) {
            return Limit::perMinute(60)->by(optional($request->user('customer'))->id ?: $request->ip());
        });

        RateLimiter::for('drivers', function ($request) {
            return Limit::perMinute(30)->by(optional($request->user('driver'))->id ?: $request->ip());
        });
    }

}
