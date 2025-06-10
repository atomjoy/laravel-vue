<?php

namespace App\Http\Controllers\Auth\Admin;

use Exception;
use App\Models\Admin;
use App\Models\Auth\Client\ChangeEmail;
use App\Events\EmailChangeRecover;
use App\Events\EmailChangeConfirmError;
use App\Exceptions\JsonException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Client\EmailChangeRecoverRequest;
use Illuminate\Support\Facades\Validator;

class EmailChangeRecoverController extends Controller
{
	function index(EmailChangeRecoverRequest $request)
	{
		$valid = $request->validated();
		$user = null;

		try {
			$user = Admin::find($valid['id']);

			if (!$user instanceof Admin) {
				throw new Exception('Invalid change email user.', 422);
			}

			$change = ChangeEmail::latest()
				->where('user_id', $user->id)
				->where('code', $valid['code'])
				->whereTime('created_at', '>', now()->subHours(100))
				->first();

			if (app()->isProduction()) {
				$validator = Validator::make(['email' => $change->email_old], [
					'email' => 'required|email:rfc,dns'
				]);

				if ($validator->fails()) {
					throw new Exception("Invalid change email address.", 422);
				}
			}

			if ($change->code != $valid['code']) {
				throw new Exception("Invalid change email code.", 422);
			}

			if ($change->user_id != $user->id) {
				throw new Exception("Invalid change email user id.", 422);
			}

			$user->forceFill([
				'email' => $change->email_old
			])->save();

			EmailChangeRecover::dispatch($user, $change->code);

			return response()->json([
				'message' => __("email.change.confirm.success")
			], 200);
		} catch (Exception $e) {
			report($e->getMessage());
			EmailChangeConfirmError::dispatch([$request->input('id'), $request->input('code')]);
			throw new JsonException(__("email.change.confirm.error"), 422);
		}
	}
}
