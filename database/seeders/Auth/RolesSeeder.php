<?php

namespace Database\Seeders\Auth;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\Auth\Roles\UserRolesSeeder;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		$this->call([
			UserRolesSeeder::class,
		]);
	}
}
