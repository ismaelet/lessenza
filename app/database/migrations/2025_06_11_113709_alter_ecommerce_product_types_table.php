<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::rename('ecommerce_product_types', 'product_types');

		Schema::table('product_types', function (Blueprint $table) {
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::rename('product_types', 'ecommerce_product_types');

		Schema::table('ecommerce_product_types', function (Blueprint $table) {
			$table->dropTimestamps();
		});
	}
};
