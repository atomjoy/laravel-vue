<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Ftp storage class
 *
 * https://laravel.com/docs/12.x/filesystem#sftp-driver-configuration
 * composer require league/flysystem-ftp "^3.0"
 */
class StorageFtpProvider extends ServiceProvider
{
	/**
	 * Register services.
	 */
	public function register(): void
	{
		// Change storage disk to ftp (or in .env)
		// if (config('filesystems.default') == 'local' || config('filesystems.default') == 'public') {
		// 	config(['filesystems.default' => 'ftp']);
		// }

		// Add storage ftp
		$this->app->config['filesystems.disks.ftp'] = [
			'driver' => 'ftp',
			'username' => env('FTP_USERNAME', 'laravel'),
			'password' => env('FTP_PASSWORD', 'password'),
			'host' => env('FTP_HOST', 'localhost'),
			'port' => (int) env('FTP_PORT', 21),
			'ssl' => env('FTP_SSL', true),
			'passive' => true,
			'timeout' => 30,

			// Optional FTP Settings...
			// 'root' => env('FTP_ROOT'),
		];
	}

	/**
	 * Bootstrap services.
	 */
	public function boot(): void
	{
		//
	}
}
