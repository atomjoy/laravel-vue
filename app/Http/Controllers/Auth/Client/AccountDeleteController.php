<?php

namespace App\Http\Controllers\Auth\Client;

use App\Events\AccountDelete;
use App\Events\AccountDeleteError;
use App\Exceptions\JsonException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Client\AccountDeleteRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountDeleteController extends Controller
{
	/**
	 * Update the specified resource in storage.
	 */
	public function update(AccountDeleteRequest $request)
	{
		$valid = $request->validated();

		try {
			$user = Auth::user();

			if (Hash::check($valid['current_password'], $user->password)) {
				// See Listeners/AccountDeleteNotification
				AccountDelete::dispatch($user);

				if (config('account_delete_logout', true)) {
					Auth::logout();
					$request->session()->invalidate();
					$request->session()->regenerateToken();
				}

				return response()->json([
					'message' => __("account.delete.success"),
				], 200);
			} else {
				return response()->json([
					'message' => __("account.delete.invalid_password"),
				], 422);
			}
		} catch (Exception $e) {
			report($e);
			AccountDeleteError::dispatch($valid);
			throw new JsonException(__("account.delete.error"), 422);
		}
	}
}
