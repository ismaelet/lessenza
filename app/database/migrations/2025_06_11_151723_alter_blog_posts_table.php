<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void {
		Schema::rename('blog_posts', 'posts');

		Schema::table('posts', function (Blueprint $table) {
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void {
		Schema::rename('posts', 'blog_posts');

		Schema::table('blog_posts', function (Blueprint $table) {
			$table->dropTimestamps();
		});
	}
};
