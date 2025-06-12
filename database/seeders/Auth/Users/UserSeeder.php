<?php

namespace Database\Seeders\Auth\Users;

use App\Models\User;
use App\Enums\Spatie\UserRolesEnum;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		$user = User::factory()->create([
			'name' => 'Demo User',
			'email' => 'user@example.com',
			'password' => 'Password123#'
		]);

		$this->roles($user);
	}

	function roles($user)
	{
		$role = app(Role::class)->findOrCreate(UserRolesEnum::EDITOR->value, 'web');

		$user->assignRole($role);
	}
}
