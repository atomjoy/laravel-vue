<?php

namespace Database\Seeders\Auth\Roles;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\Spatie\RolesEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserRolesSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		foreach (RolesEnum::cases() as $item) {
			Role::create(['name' => $item->value, 'guard_name' => 'admin']);
		}
	}
}
