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
		Schema::rename('ecommerce_carts', 'orders');

		Schema::table('orders', function (Blueprint $table) {
			$table->renameColumn('addressId', 'address_id');
			$table->renameColumn('shippingMethodId', 'shipping_method_id');
			$table->renameColumn('paymentMethodId', 'payment_method_id');
			$table->renameColumn('statusId', 'status');
			$table->dropColumn('staticFullShippingPrice');
			$table->dropColumn('staticShippingDiscount');
			$table->dropColumn('couponId');
			$table->dropColumn('gift');
			$table->dropColumn('trackingCode');
			$table->unsignedBigInteger('user_id')->nullable()->after('id');
			$table->timestamps();
		});

		$orders = DB::table('orders')->get();

		foreach ($orders as $order) {
			$userId = DB::table('ecommerce_customers')
				->where('id', $order->customerId)
				->value('userId');

			if ($userId) {
				DB::table('orders')
					->where('id', $order->id)
					->update(['user_id' => $userId]);
			}
		}

		Schema::table('orders', function (Blueprint $table) {
			$table->dropColumn('customerId');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::table('orders', function (Blueprint $table) {
			$table->dropTimestamps();
			$table->dropColumn('user_id');
			$table->renameColumn('address_id', 'addressId');
			$table->renameColumn('shipping_method_id', 'shippingMethodId');
			$table->renameColumn('payment_method_id', 'paymentMethodId');
			$table->renameColumn('status', 'statusId');
			$table->unsignedBigInteger('customerId')->after('id');
			$table->unsignedDecimal('staticFullShippingPrice', 10, 2)->nullable()->after('shippingMethodId');
			$table->unsignedDecimal('staticShippingDiscount', 10, 2)->nullable()->after('staticFullShippingPrice');
			$table->unsignedBigInteger('couponId')->nullable()->after('staticShippingDiscount');
			$table->boolean('gift')->default(false)->after('couponId');
			$table->string('trackingCode')->nullable()->after('gift');
		});

		Schema::rename('orders', 'ecommerce_carts');
	}
};
