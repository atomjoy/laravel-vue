<?php

namespace App\Listeners;

use App\Events\LoginAdmin;
use Illuminate\Support\Facades\Log;

class LoginAdminListener
{
	public function handle(LoginAdmin $event)
	{
		Log::build([
			'driver' => 'single',
			'path' => storage_path('logs/admin.log'),
		])->info(
			'[OK] Admin logged.',
			['id' => $event->user->id, 'ip' => request()->ip()]
		);
	}
}
