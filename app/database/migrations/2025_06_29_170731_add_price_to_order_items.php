<?php

use App\Models\OrderItem;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::table('order_items', function (Blueprint $table) {
			$table->decimal('price', 10, 2)
				->after('product_id')
				->nullable();
			$table->decimal('product_price', 10, 2)
				->after('price')
				->nullable();
		});

		$orderItems = OrderItem::with('product')
			->get();

		foreach ($orderItems as $orderItem) {
			$orderItem->price = $orderItem->dynamicPrice();
			$orderItem->product_price = $orderItem->dynamicProductPrice();
			$orderItem->save();
		}
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::table('order_items', function (Blueprint $table) {
			$table->dropColumn(['price', 'product_price']);
		});
	}
};
