<?php

namespace App\Providers;

use App\Http\Middleware\ForceJsonMiddleware;
use Illuminate\Support\ServiceProvider;

class ForceJsonProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Accept json for /web/api/*
        $this->app['router']->aliasMiddleware('forcejson', ForceJsonMiddleware::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
