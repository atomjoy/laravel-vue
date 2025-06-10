<?php

namespace App\Listeners;

use App\Events\PermissionChange;
use Illuminate\Support\Facades\Log;

class PermissionChangeListener
{
	public function handle(PermissionChange $event)
	{
		Log::build([
			'driver' => 'single',
			'path' => storage_path('logs/permissions.log'),
		])->info(
			'[ADD] User permission has been added.',
			['id' => $event->user->id, 'permission' => $event->permission->name]
		);
	}
}
