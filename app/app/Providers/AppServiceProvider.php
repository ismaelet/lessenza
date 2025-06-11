<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Register any application services.
	 */
	public function register(): void {
		$files = glob(app_path('Helpers') . "/*.php");

		foreach ($files as $key => $file) {
			require_once $file;
		}
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot(): void {
		// Set the default locale for Carbon
		Carbon::setLocale('it');

		// Register Vite image helper
		Vite::macro('image', fn(string $asset) => $this->asset("resources/images/{$asset}"));

		// Prevent lazy loading in non-production environments
		Model::preventLazyLoading(!app()->isProduction());
	}
}
