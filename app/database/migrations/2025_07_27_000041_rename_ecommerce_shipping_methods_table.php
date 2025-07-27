<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::rename('ecommerce_shipping_methods', 'shipping_methods');

		Schema::table('shipping_methods', function (Blueprint $table) {
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::rename('shipping_methods', 'ecommerce_shipping_methods');

		Schema::table('ecommerce_shipping_methods', function (Blueprint $table) {
			$table->dropTimestamps();
		});
	}
};
