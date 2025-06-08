<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Enums\Spatie\Permissions\Model\DisableEnum;
use App\Events\LoginUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Admin\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
	function __construct()
	{
		Auth::shouldUse('admin'); // Default guard
	}

	function index(LoginRequest $request)
	{
		$request->authenticate();

		$request->session()->regenerate();

		if (Auth::check()) {
			LoginUser::dispatch(Auth::user());

			if (Auth::guard('admin')->user()->hasRole(DisableEnum::DISABLE_LOGIN)) {
				Auth::logout();
				$request->session()->invalidate();
				return response()->json([
					'message' => __('login.allow_login_banned'),
					'user' => null,
					'redirect' => null,
					'guard' => 'admin'
				], 422);
			}

			if (Auth::user()->f2a == 1) {
				return response()->json([
					'message' => __('login.authenticated'),
					'user' => null,
					'redirect' => '/admin/login/f2a/' . $request->f2a(),
					'guard' => 'admin'
				], 200);
			}

			return response()->json([
				'message' => __('login.authenticated'),
				'user' => Auth::user()->fresh(),
				'redirect' => null,
				'guard' => 'admin'
			], 200);
		} else {
			return response()->json([
				'message' => __('login.unauthenticated'),
				'user' => null,
				'redirect' => null,
				'guard' => 'admin'
			], 422);
		}
	}
}
