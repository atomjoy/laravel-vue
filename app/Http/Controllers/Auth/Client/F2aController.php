<?php

namespace App\Http\Controllers\Auth\Client;

use App\Http\Controllers\Controller;
use App\Exceptions\JsonException;
use App\Http\Requests\Auth\Client\F2aRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class F2aController extends Controller
{
	function index(F2aRequest $request)
	{
		$request->authenticate();

		if (Auth::check()) {
			return response()->json([
				'message' => __('login.authenticated'),
				'user' => Auth::user()->fresh()
			], 200);
		} else {
			throw new JsonException(__('login.f2a_error'), 422);
		}
	}

	function enable()
	{
		if (Auth::check() && Hash::check(
			request('password_current'),
			Auth::user()->password
		)) {
			$user = Auth::user();
			$user->f2a = 1;
			$user->save();

			return response()->json([
				'message' => __('updated'),
			], 200);
		} else {
			return response()->json([
				'message' => __('confirm.invalid.current.password'),
			], 422);
		}
	}

	function disable()
	{
		if (Auth::check() && Hash::check(
			request('password_current'),
			Auth::user()->password
		)) {
			$user = Auth::user();
			$user->f2a = 0;
			$user->save();

			return response()->json([
				'message' => __('updated'),
			], 200);
		} else {
			return response()->json([
				'message' => __('confirm.invalid.current.password'),
			], 422);
		}
	}
}
