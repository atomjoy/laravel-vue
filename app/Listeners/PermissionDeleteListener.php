<?php

namespace App\Listeners;

use App\Events\PermissionDelete;
use Illuminate\Support\Facades\Log;

class PermissionDeleteListener
{
	public function handle(PermissionDelete $event)
	{
		Log::build([
			'driver' => 'single',
			'path' => storage_path('logs/permissions.log'),
		])->info(
			'[DEL] User permission has been deleted.',
			['id' => $event->user->id, 'permission' => $event->permission->name]
		);
	}
}
