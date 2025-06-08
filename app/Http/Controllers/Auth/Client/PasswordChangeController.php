<?php

namespace App\Http\Controllers\Auth\Client;

use Exception;
use App\Http\Controllers\Controller;
use App\Exceptions\JsonException;
use App\Http\Requests\Auth\Client\PasswordChangeRequest;
use App\Events\PasswordChange;
use App\Events\PasswordChangeError;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordChangeController extends Controller
{
	function index(PasswordChangeRequest $request)
	{
		$valid = $request->validated();

		if (Auth::check()) {
			$user = Auth::user();

			if (Hash::check($valid['password_current'], $user->password)) {
				try {
					$user->update([
						'password' => Hash::make($valid['password']),
					]);

					PasswordChange::dispatch($user);
					return response()->json([
						'message' => __('change.success')
					], 200);
				} catch (Exception $e) {
					report($e);
					PasswordChangeError::dispatch($valid);
					throw new JsonException(__('change.error'), 422);
				}
			} else {
				PasswordChangeError::dispatch($valid);
				throw new JsonException(__('change.invalid.current.password'), 422);
			}
		} else {
			PasswordChangeError::dispatch($valid);
			throw new JsonException(__('change.unauthenticated.'), 422);
		}
	}
}
