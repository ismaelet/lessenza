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
		// Reviews
		$reviews = DB::table('reviews')
			->select('id', 'time')
			->get();

		foreach ($reviews as $review) {
			DB::table('reviews')
				->where('id', $review->id)
				->update([
					'created_at' => $review->time,
					'updated_at' => $review->time
				]);
		}

		Schema::table('reviews', function (Blueprint $table) {
			$table->dropColumn('time');
		});

		// Products
		$products = DB::table('products')
			->select('id', 'time')
			->get();

		foreach ($products as $product) {
			DB::table('products')
				->where('id', $product->id)
				->update([
					'created_at' => $product->time,
					'updated_at' => $product->time
				]);
		}

		Schema::table('products', function (Blueprint $table) {
			$table->dropColumn('time');
		});

		// Blog posts
		$posts = DB::table('posts')
			->select('id', 'time')
			->get();

		foreach ($posts as $post) {
			DB::table('posts')
				->where('id', $post->id)
				->update([
					'created_at' => $post->time,
					'updated_at' => $post->time
				]);
		}

		Schema::table('posts', function (Blueprint $table) {
			$table->dropColumn('time');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		//
	}
};
