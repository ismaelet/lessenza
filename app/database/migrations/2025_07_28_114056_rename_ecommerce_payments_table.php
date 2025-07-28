<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::rename('ecommerce_payments', 'payment_methods');

		Schema::table('payment_methods', function (Blueprint $table) {
			$table->timestamps();
			$table->dropColumn('slug');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::rename('payment_methods', 'ecommerce_payments');

		Schema::table('ecommerce_payments', function (Blueprint $table) {
			$table->dropTimestamps();
			$table->string('slug')->nullable();
		});
	}
};
