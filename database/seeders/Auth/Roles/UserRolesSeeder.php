<?php

namespace Database\Seeders\Auth\Roles;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Enums\Spatie\RolesEnum;
use App\Enums\Spatie\UserRolesEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserRolesSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		// Admin
		foreach (RolesEnum::cases() as $item) {
			Role::create(['name' => $item->value, 'guard_name' => 'admin']);
		}

		// User
		foreach (UserRolesEnum::cases() as $item) {
			Role::create(['name' => $item->value, 'guard_name' => 'web']);
		}
	}
}
