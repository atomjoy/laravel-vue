<?php

namespace App\Http\Controllers\Auth\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Events\ActivateUser;
use App\Events\ActivateUserError;
use App\Events\ActivateUserInvalid;
use App\Exceptions\JsonException;
use App\Http\Requests\Auth\Client\ActivateRequest;
use Exception;

class ActivateController extends Controller
{
	function index(ActivateRequest $request)
	{
		$valid = $request->validated();

		try {
			$user = User::findOrFail($valid['id']);

			if ($user->email_verified_at != null) {
				return response()->json([
					'message' => __('activate.already')
				], 200);
			}

			if (hash_equals($user->remember_token ?? '', $valid['code'])) {
				$user->forceFill([
					'email_verified_at' => now()
				])->save();

				ActivateUser::dispatch($user);
				return response()->json([
					'message' => __('activate.success')
				], 200);
			}
		} catch (Exception $e) {
			report($e);
			ActivateUserError::dispatch($valid);
			throw new JsonException(__('activate.error'), 422);
		}

		ActivateUserInvalid::dispatch($valid);
		throw new JsonException(__('activate.invalid'), 422);
	}
}
