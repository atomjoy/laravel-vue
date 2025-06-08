<?php

namespace Database\Seeders\Auth\Users;

use App\Models\Admin;
use App\Enums\Spatie\RolesEnum;
use App\Enums\Spatie\Permissions\AdminPermissionsEnum;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		$user = Admin::factory()->create([
			'name' => 'Admin User',
			'email' => 'admin@example.com',
			'password' => 'Password123#'
		]);

		$this->roles($user);

		$this->permissions($user);
	}

	function roles($user)
	{
		$role = app(Role::class)->findOrCreate(RolesEnum::ADMIN->value, 'admin');

		$user->assignRole($role);
	}

	function permissions($user)
	{
		// Admin
		$permissions = AdminPermissionsEnum::cases();

		foreach ($permissions as $item) {
			$permission = app(Permission::class)->findOrCreate($item->value, 'admin');
			$user->givePermissionTo($permission);
		}
	}
}
