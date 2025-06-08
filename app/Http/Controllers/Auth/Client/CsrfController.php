<?php

namespace App\Http\Controllers\Auth\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Event;

class CsrfController extends Controller
{
	function index(Request $request)
	{
		$this->setSampleCookie($request);

		$request->session()->regenerateToken();

		session(['apilogin_counter' => session('apilogin_counter') + 1]);

		// Dispatch custom event
		Event::dispatch('csrf', 'Hi from csrf controller!');

		// Register custom event listener in
		// boot() method in service provider
		// Event::listen('csrf', CsrfListener::class);

		return response()->json([
			'message' => __('Csrf token created.'),
			'counter' => session('apilogin_counter'),
		]);
	}

	function setSampleCookie($request)
	{
		if (cookie('dummy_token') != null) {
			$token = 'token5678';
			// Set cookie: $name, $val, $minutes, $path, $domain, $secure, $httpOnly = true, $raw = false, $sameSite = 'strict'
			Cookie::queue(
				'dummy_token',
				$token,
				env('APP_REMEBER_ME_MINUTES', 3456789),
				'/',
				'.' . request()->getHost(),
				request()->secure(), // or true for https only
				true,
				false,
				'lax' // Or 'strict' for max security
			);
		}
	}
}
