<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('contacts', function (Blueprint $table) {
			$table->id();
			$table->string('firstname', 255);
			$table->string('lastname', 255);
			$table->string('email', 255);
			$table->string('mobile', 255);
			$table->string('subject', 255);
			$table->text('message');
			$table->text('note')->nullable();
			$table->string('file')->nullable();
			$table->string('ip', 255);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('contacts');
	}
};
