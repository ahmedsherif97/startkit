<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {

            Route::prefix('api')
                ->middleware('api')
                ->as('api.')
                ->namespace("{$this->namespace}\\API")
                ->group(base_path('routes/api/api.router.php'));

            Route::middleware('web')
                ->prefix(config('custom.dashboard.prefix', 'dashboard'))
                ->namespace("{$this->namespace}\\Dashboard")
                ->as('dashboard.')
                ->group(base_path('routes/dashboard/dashboard.router.php'));

            Route::middleware('web')
                ->prefix(config('custom.merchant.prefix', 'merchant'))
                ->namespace("{$this->namespace}\\Merchant")
                ->as('merchant.')
                ->group(base_path('routes/merchant/merchant.router.php'));
        });
    }


    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
