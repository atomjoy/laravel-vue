<?php

namespace App\Listeners;

use App\Events\RoleDelete;
use Illuminate\Support\Facades\Log;

class RoleDeleteListener
{
	public function handle(RoleDelete $event)
	{
		Log::build([
			'driver' => 'single',
			'path' => storage_path('logs/roles.log'),
		])->info(
			'[DEL] User role has been deleted.',
			['id' => $event->user->id, 'role' => $event->role->name]
		);
	}
}
