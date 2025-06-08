<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Events\LoggedUser;
use App\Events\LoggedUserError;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoggedController extends Controller
{
	function index(Request $request)
	{
		try {
			if (Auth::guard('admin')->check()) {
				LoggedUser::dispatch(Auth::guard('admin')->user());

				return response()->json([
					'message' => __('logged.authenticated'),
					'guard' => 'admin',
					'user' => Auth::guard('admin')->user()->fresh(),
				], 200);
			} else {
				LoggedUserError::dispatch();
				throw new \Exception("Admin not logged");
			}
		} catch (\Throwable $e) {
			if (config('app.debug')) {
				// report($e);
			}

			return response()->json([
				'message' => __('logged.unauthenticated'),
				'guard' => 'admin',
				'user' => null,
			], 422);
		}
	}
}
