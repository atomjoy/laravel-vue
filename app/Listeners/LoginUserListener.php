<?php

namespace App\Listeners;

use App\Events\LoginUser;
use Illuminate\Support\Facades\Log;

class LoginUserListener
{
	public function handle(LoginUser $event)
	{
		Log::build([
			'driver' => 'single',
			'path' => storage_path('logs/user.log'),
		])->info(
			'[OK] User logged.',
			['id' => $event->user->id, 'ip' => request()->ip()]
		);
	}
}
