<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class PasswordProvider extends ServiceProvider
{
	/**
	 * Register services.
	 */
	public function register(): void
	{
		//
	}

	/**
	 * Bootstrap services.
	 */
	public function boot(): void
	{
		// Use with
		// 'password' => ['required', Password::defaults()]
		Password::defaults(function () {
			return $this->app->isProduction()
				? Password::min(11)->mixedCase()->letters()->numbers()->symbols()->uncompromised()
				: Password::min(11);
		});
	}
}
