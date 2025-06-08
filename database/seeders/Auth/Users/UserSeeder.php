<?php

namespace Database\Seeders\Auth\Users;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
	}
}
