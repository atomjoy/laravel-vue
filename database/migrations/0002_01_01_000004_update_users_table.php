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
		Schema::table('users', function (Blueprint $table) {
			$table->string('mobile_prefix')->nullable();
			$table->string('mobile')->nullable();
			$table->string('location')->nullable();
			$table->string('bio')->nullable();
			$table->string('avatar')->nullable()->default('/default/avatar.webp');
			$table->tinyInteger('f2a')->unsigned()->default(0);
			$table->tinyInteger('allow_email')->unsigned()->default(1);
			$table->tinyInteger('allow_sms')->unsigned()->default(1);
			// Address
			$table->string('address_line1', 50)->nullable();
			$table->string('address_line2', 50)->nullable();
			$table->string('address_city', 50)->nullable();
			$table->string('address_state', 50)->nullable();
			$table->string('address_country', 50)->nullable();
			$table->string('address_postal', 50)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::table('users', function (Blueprint $table) {
			$table->dropColumn('f2a');
			$table->dropColumn('mobile_prefix');
			$table->dropColumn('mobile');
			$table->dropColumn('location');
			$table->dropColumn('bio');
			$table->dropColumn('avatar');
			$table->dropColumn('allow_email');
			$table->dropColumn('allow_sms');
			// Address
			$table->dropColumn('address_line1');
			$table->dropColumn('address_line2');
			$table->dropColumn('address_city');
			$table->dropColumn('address_state');
			$table->dropColumn('address_country');
			$table->dropColumn('address_postal');
		});
	}
};
