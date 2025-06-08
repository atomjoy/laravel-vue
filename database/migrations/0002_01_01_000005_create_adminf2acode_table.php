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
		Schema::create('adminf2acodes', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('user_id');
			$table->string('hash')->nullable();
			$table->string('code')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->unique('hash');
			$table->foreign('user_id')
				->references('id')
				->on('admins')
				->cascadeOnUpdate()
				->cascadeOnDelete();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('adminf2acodes');
	}
};
