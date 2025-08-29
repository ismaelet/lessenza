<?php

use App\Helpers\ArrayHelper;
use App\Helpers\FileHelper;
use App\Helpers\SettingsHelper;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

/**
 * Check if the user is an admin
 */
function is_admin(): bool {
	return Auth::check() && Auth::user()->is_admin;
}

/**
 * Check if the user is a superadmin
 */
function is_superadmin(): bool {
	return Auth::check() && Auth::user()->is_superadmin;
}

/**
 * Get the path to a public asset
 */
function public_asset(string $path): string {
	if (env('APP_ENV') === 'local') {
		return asset('storage/' . $path);
	}

	return '/public/storage/' . $path;
}

/**
 * Format a price value according to the current currency
 */
function price(?float $value): string {
	$formatter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);

	return $formatter->formatCurrency($value, config('custom.currency', 'EUR'));
}

/**
 * Get the current customer's cart
 */
function cart(): Order {
	if (Auth::check() && Auth::user()->cart) {
		return Auth::user()->cart->load(['order_items']);
	}

	if (session()->has('cart')) {
		return session('cart')->load(['order_items']);
	}

	// If no cart is found, create a new one
	$cart = Order::create([
		'user_id' => Auth::id() ?? null,
	]);

	if (!Auth::check()) {
		session(['cart' => $cart]);
	}

	return $cart;
}
