<?php

namespace Database\Seeders\Auth\Permissions;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\Spatie\Permissions\Model\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RolePermissionsSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		foreach (RoleEnum::cases() as $item) {
			Permission::create(['name' => $item->value, 'guard_name' => 'admin']);
		}
	}
}
