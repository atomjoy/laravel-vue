<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ChangePublicDirectoryProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Create symlinks
        config(['filesystems.links' => [
            public_path('storage') => storage_path('app/public'),
            base_path('public_html') => base_path('public')
        ]]);

        // Change directory
        $this->app->usePublicPath(app()->basePath('public_html'));

        // Or
        // $this->app->bind('path.public', function () {
        //     // return base_path('public_html');
        //     return base_path() . '/public_html';
        // });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
