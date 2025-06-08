<?php

namespace Database\Seeders\Auth\Users;

use App\Models\Admin;
use App\Enums\Spatie\RolesEnum;
use App\Enums\Spatie\Permissions\WriterPermissionsEnum;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WriterSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		$user = Admin::factory()->create([
			'name' => 'Writer User',
			'email' => 'writer@example.com',
			'password' => 'Password123#'
		]);

		$this->roles($user);

		$this->permissions($user);
	}

	function roles($user)
	{
		$role = app(Role::class)->findOrCreate(RolesEnum::WRITER->value, 'admin');

		$user->assignRole($role);
	}

	function permissions($user)
	{
		$permissions = WriterPermissionsEnum::cases();

		foreach ($permissions as $item) {
			$permission = app(Permission::class)->findOrCreate($item->value, 'admin');

			$user->givePermissionTo($permission);
		}
	}
}
