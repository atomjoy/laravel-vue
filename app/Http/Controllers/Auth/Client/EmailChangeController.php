<?php

namespace App\Http\Controllers\Auth\Client;

use Exception;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Auth\Client\ChangeEmail;
use App\Events\EmailChange;
use App\Events\EmailChangeError;
use App\Exceptions\JsonException;
use App\Http\Requests\Auth\Client\EmailChangeRequest;
use Illuminate\Support\Facades\Auth;

class EmailChangeController extends Controller
{
	function index(EmailChangeRequest $request)
	{
		$valid = $request->validated();
		$user = null;

		if (Auth::user()->email == $valid['email']) {
			throw new JsonException(__("email.change.current"), 422);
		}

		try {
			$user = Auth::user();

			if (!$user instanceof User) {
				throw new Exception('Invalid change email user.');
			}

			$code = hash('sha256', uniqid() . microtime() . $user->id);

			ChangeEmail::create([
				'user_id' => $user->id,
				'email_old' => $user->email,
				'email_new' => $valid['email'],
				'code' => $code,
			]);

			EmailChange::dispatch($user, $code);

			return response()->json([
				'message' => __("email.change.success")
			], 200);
		} catch (Exception $e) {
			report($e);
			EmailChangeError::dispatch($valid);
			throw new JsonException(__("email.change.error"), 422);
		}
	}
}
