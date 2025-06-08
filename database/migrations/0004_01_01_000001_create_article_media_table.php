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
		Schema::create('article_media', function (Blueprint $table) {
			$table->id();
			$table->string('path', 255)->nullable();
			$table->string('title', 255)->nullable();
			$table->timestamps();
			$table->unsignedBigInteger('admin_id')->nullable();
			$table->foreign('admin_id')->references('id')->on('admins')->onUpdate('cascade')->onDelete('set null');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('article_media');
	}
};
