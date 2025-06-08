<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ChangeUploadDirectoryProvider extends ServiceProvider
{
	/**
	 * Register services.
	 */
	public function register(): void
	{
		// Disk change local to public or ftp
		if (config('filesystems.default') == 'local') {
			config(['filesystems.default' => 'public']);
		}
	}

	/**
	 * Bootstrap services.
	 */
	public function boot(): void
	{
		//
	}
}
