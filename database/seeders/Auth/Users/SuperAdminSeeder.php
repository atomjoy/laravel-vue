<?php

namespace Database\Seeders\Auth\Users;

use App\Models\Admin;
use App\Enums\Spatie\RolesEnum;
use App\Enums\Spatie\Permissions\SuperAdminPermissionsEnum;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		$user = Admin::factory()->create([
			'name' => 'Super User',
			'email' => 'superadmin@example.com',
			'password' => 'Password123#'
		]);

		$this->roles($user);
	}

	function roles($user)
	{
		$role = app(Role::class)->findOrCreate(RolesEnum::SUPERADMIN->value, 'admin');

		$user->assignRole($role);

		$this->permissions($user);
	}

	function permissions($user)
	{
		// Super Admin
		$permissions = SuperAdminPermissionsEnum::cases();

		foreach ($permissions as $item) {
			$permission = app(Permission::class)->findOrCreate($item->value, 'admin');
			$user->givePermissionTo($permission);
		}
	}
}
