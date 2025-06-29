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
		Schema::rename('ecommerce_orders', 'order_items');

		Schema::table('order_items', function (Blueprint $table) {
			$table->renameColumn('cartId', 'order_id');
			$table->renameColumn('productId', 'product_id');
			$table->dropColumn('staticFullPrice');
			$table->dropColumn('staticDiscount');
			$table->unsignedBigInteger('user_id')->nullable()->after('order_id');
			$table->timestamps();
		});

		$order_items = DB::table('order_items')->get();

		foreach ($order_items as $order_item) {
			$userId = DB::table('ecommerce_customers')
				->where('id', $order_item->customerId)
				->value('userId');

			if ($userId) {
				DB::table('order_items')
					->where('id', $order_item->id)
					->update(['user_id' => $userId]);
			}
		}

		Schema::table('order_items', function (Blueprint $table) {
			$table->dropColumn('customerId');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::table('order_items', function (Blueprint $table) {
			$table->renameColumn('order_id', 'cartId');
			$table->renameColumn('product_id', 'productId');
			$table->decimal('staticFullPrice', 10, 2)->nullable()->after('price');
			$table->decimal('staticDiscount', 10, 2)->nullable()->after('staticFullPrice');
			$table->dropColumn('user_id');
			$table->dropTimestamps();
		});

		Schema::rename('order_items', 'ecommerce_orders');

		DB::table('ecommerce_orders')->update(['customerId' => null]);
		DB::table('ecommerce_orders')->update(['customerId' => DB::raw('(SELECT id FROM ecommerce_customers WHERE userId = user_id)')]);

		Schema::table('ecommerce_orders', function (Blueprint $table) {
			$table->unsignedBigInteger('customerId')->nullable()->after('id');
		});
	}
};
