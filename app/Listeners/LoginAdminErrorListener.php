<?php

namespace App\Listeners;

use App\Events\LoginAdminError;
use Illuminate\Support\Facades\Log;

class LoginAdminErrorListener
{
	public function handle(LoginAdminError $event)
	{
		Log::build([
			'driver' => 'single',
			'path' => storage_path('logs/admin.log'),
		])->info(
			'[ERR] Admin login error.',
			['payload' => $event->email, 'ip' => request()->ip()]
		);
	}
}
