<?php

namespace App\Providers;

use App\Http\Middleware\LocalesMiddleware;
use Illuminate\Support\ServiceProvider;

class LocalesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Change locales
        $this->app['router']->aliasMiddleware('locales', LocalesMiddleware::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
