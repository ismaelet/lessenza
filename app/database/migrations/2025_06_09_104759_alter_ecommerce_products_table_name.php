<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::rename('ecommerce_products', 'products');

		Schema::table('products', function (Blueprint $table) {
			$table->timestamps();
		});

		$products = DB::table('products')->get();

		foreach ($products as $product) {
			$slug = $product->id . '-' . $product->slug;

			DB::table('products')
				->where('id', $product->id)
				->update(['slug' => $slug]);
		}
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::rename('products', 'ecommerce_products');

		Schema::table('ecommerce_products', function (Blueprint $table) {
			$table->dropTimestamps();
		});

		$products = DB::table('ecommerce_products')->get();

		foreach ($products as $product) {
			$slugParts = explode('-', $product->slug);
			$originalSlug = end($slugParts);

			DB::table('ecommerce_products')
				->where('id', $product->id)
				->update(['slug' => $originalSlug]);
		}
	}
};
