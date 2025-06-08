<?php

namespace App\Http\Controllers\Auth\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\Client\AccountRequest;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
	function update(AccountRequest $request)
	{
		try {
			Auth::user()->update($request->validated());

			return response()->json([
				'message' => __("account.update.success"),
				'user' => Auth::user(),
			], 200);
		} catch (Exception $e) {
			report($e);
			throw new JsonException(__("account.update.error"), 422);
		}
	}
}
