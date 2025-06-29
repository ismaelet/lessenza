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
		Schema::rename('ecommerce_addresses', 'addresses');

		Schema::table('addresses', function (Blueprint $table) {
			$table->renameColumn('fullName', 'full_name');
			$table->renameColumn('address', 'street');
			$table->unsignedBigInteger('user_id')->nullable()->after('id');
			$table->timestamps();
		});

		$addresses = DB::table('addresses')->get();

		foreach ($addresses as $address) {
			$userId = DB::table('ecommerce_customers')
				->where('id', $address->customerId)
				->value('userId');

			if ($userId) {
				DB::table('addresses')
					->where('id', $address->id)
					->update(['user_id' => $userId]);
			}
		}

		Schema::table('addresses', function (Blueprint $table) {
			$table->dropColumn('customerId');
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::table('addresses', function (Blueprint $table) {
			$table->dropColumn('user_id');
			$table->dropTimestamps();
			$table->renameColumn('full_name', 'fullName');
			$table->renameColumn('street', 'address');
			$table->unsignedBigInteger('customerId')->nullable()->after('id');
		});

		Schema::rename('addresses', 'ecommerce_addresses');
	}
};
