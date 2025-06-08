<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class MultiGuardsProvider extends ServiceProvider
{
	/**
	 * Register services.
	 */
	public function register(): void
	{
		// Add guard web
		$this->app->config['auth.guards.web'] = [
			'driver' => 'session',
			'provider' => 'users',
			'remember' => 525600,  // Set the duration here (minutes)
		];

		// Add guard admin
		$this->app->config['auth.guards.admin'] = [
			'driver' => 'session',
			'provider' => 'admins',
			'remember' => 525600, // Set the duration here (minutes)
		];

		// Add provider
		$this->app->config['auth.providers.admins'] = [
			'driver' => 'eloquent',
			'model' => \App\Models\Admin::class,
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
