<?php

namespace App\Listeners;

use App\Events\RoleChange;
use Illuminate\Support\Facades\Log;

class RoleChangeListener
{
	public function handle(RoleChange $event)
	{
		Log::build([
			'driver' => 'single',
			'path' => storage_path('logs/roles.log'),
		])->info(
			'[ADD] User role has been added.',
			['id' => $event->user->id, 'role' => $event->role->name]
		);
	}
}
