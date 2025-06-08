<?php

namespace App\Http\Controllers\Auth\Client;

use App\Http\Controllers\Controller;
use App\Events\PasswordConfirm;
use App\Events\PasswordConfirmError;
use App\Exceptions\JsonException;
use App\Http\Requests\Auth\PasswordConfirmRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordConfirmController extends Controller
{
	function index(PasswordConfirmRequest $request)
	{
		$valid = $request->validated();

		if (Auth::check()) {
			if (Hash::check($valid['password'], Auth::user()->password)) {
				PasswordConfirm::dispatch(Auth::user());
				return response()->json(['message' => __('confirm.confirmed')], 200);
			} else {
				// PasswordConfirmError::dispatch($valid);
				throw new JsonException(__('confirm.invalid.current.password'), 422);
			}
		} else {
			PasswordConfirmError::dispatch($valid);
			throw new JsonException(__('confirm.unauthenticated'), 422);
		}
	}
}
