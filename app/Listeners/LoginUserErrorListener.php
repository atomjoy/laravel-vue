<?php

namespace App\Listeners;

use App\Events\LoginUserError;
use Illuminate\Support\Facades\Log;

class LoginUserErrorListener
{
	public function handle(LoginUserError $event)
	{
		Log::build([
			'driver' => 'single',
			'path' => storage_path('logs/user.log'),
		])->info(
			'[ERR] User login error.',
			['payload' => $event->email, 'ip' => request()->ip()]
		);
	}
}
