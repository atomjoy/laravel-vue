<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\Auth\PermissionsSeeder;
use Database\Seeders\Auth\RolesSeeder;
use Database\Seeders\Auth\Users\AdminSeeder;
use Database\Seeders\Auth\Users\SuperAdminSeeder;
use Database\Seeders\Auth\Users\WriterSeeder;
use Database\Seeders\Auth\Users\UserSeeder;
use Illuminate\Database\Seeder;

class AppSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		$this->call([
			RolesSeeder::class,
			PermissionsSeeder::class,
			SuperAdminSeeder::class,
			AdminSeeder::class,
			WriterSeeder::class,
			UserSeeder::class,
		]);
	}
}
