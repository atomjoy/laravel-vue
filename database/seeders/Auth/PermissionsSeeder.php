<?php

namespace Database\Seeders\Auth;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\Auth\Permissions\ArticlePermissionsSeeder;
use Database\Seeders\Auth\Permissions\DisablePermissionsSeeder;
use Database\Seeders\Auth\Permissions\RolePermissionsSeeder;
use Database\Seeders\Auth\Permissions\UserPermissionsSeeder;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		$this->call([
			RolePermissionsSeeder::class,
			UserPermissionsSeeder::class,
			DisablePermissionsSeeder::class,
			ArticlePermissionsSeeder::class,
		]);
	}
}
