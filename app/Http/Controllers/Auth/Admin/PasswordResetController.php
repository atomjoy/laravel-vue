<?php

namespace App\Http\Controllers\Auth\Admin;

use Exception;
use App\Http\Controllers\Controller;
use App\Events\PasswordReset;
use App\Events\PasswordResetError;
use App\Exceptions\JsonException;
use App\Http\Requests\Auth\Admin\PasswordResetRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
	function index(PasswordResetRequest $request)
	{
		$valid = $request->validated();
		$password = uniqid('Wow8#');
		$user = null;

		try {
			$user = Admin::where('email', $valid['email'])->first();

			if (!$user instanceof Admin) {
				throw new Exception(__("reset.password.error.user"), 422);
			}
		} catch (Exception $e) {
			report($e);
			PasswordResetError::dispatch($valid);
			throw new JsonException(__("reset.password.invalid"), 422);
		}

		try {
			if (empty($user->email_verified_at)) {
				$user->email_verified_at = now();
			}
			$user->password = Hash::make($password);
			$user->save();

			PasswordReset::dispatch($user, $password);

			return response()->json([
				'message' => __("reset.password.success")
			], 200);
		} catch (Exception $e) {
			PasswordResetError::dispatch($valid);
			throw new JsonException(__("reset.password.error"), 422);
		}
	}
}
