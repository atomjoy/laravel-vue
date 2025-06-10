<?php

namespace App\Http\Controllers\Auth\Client;

use App\Enums\Spatie\Permissions\Model\DisableEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Client\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
	function __construct()
	{
		Auth::shouldUse('web'); // Default guard
	}

	function index(LoginRequest $request)
	{
		$request->authenticate();

		$request->session()->regenerate();

		if (Auth::check()) {
			if (Auth::guard('web')->user()->hasRole(DisableEnum::DISABLE_LOGIN)) {
				Auth::logout();
				return response()->json([
					'message' => __('login.allow_login_banned'),
					'user' => null,
					'redirect' => null,
					'guard' => 'web',
				], 422);
			}

			if (Auth::user()->f2a == 1) {
				return response()->json([
					'message' => __('login.authenticated'),
					'user' => null,
					'redirect' => '/login/f2a/' . $request->f2a(),
					'guard' => 'web',
				], 200);
			}

			return response()->json([
				'message' => __('login.authenticated'),
				'user' => Auth::user()->fresh(),
				'redirect' => null,
				'guard' => 'web',
			], 200);
		} else {
			return response()->json([
				'message' => __('login.unauthenticated'),
				'user' => null,
				'redirect' => null,
				'guard' => 'web',
			], 422);
		}
	}
}
