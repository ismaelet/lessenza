<?php

use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::table('orders', function (Blueprint $table) {
			$table->decimal('price', 10, 2)
				->after('payment_method_id')
				->nullable();
			$table->decimal('item_price', 10, 2)
				->after('price')
				->nullable();
			$table->decimal('shipping_fee', 10, 2)
				->after('item_price')
				->nullable();
		});

		$orders = Order::with('order_items')
			->get();

		foreach ($orders as $order) {
			$order->price = $order->dynamicPrice();
			$order->item_price = $order->dynamicItemPrice();
			$order->shipping_fee = $order->dynamicShippingFee();
			$order->save();
		}
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::table('orders', function (Blueprint $table) {
			$table->dropColumn(['price', 'item_price', 'shipping_fee']);
		});
	}
};
