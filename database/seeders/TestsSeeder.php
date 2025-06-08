<?php

namespace Database\Seeders;

use Database\Seeders\Dev\AuthSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestsSeeder extends Seeder
{
	/**
	 * Seed the application's database.
	 */
	public function run(): void
	{
		$this->call([
			AuthSeeder::class,
		]);
	}
}
