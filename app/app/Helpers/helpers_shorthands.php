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
	return asset('storage/' . $path);
}

/**
 * Format a price value according to the current currency
 */
function price(float $value): string {
	$formatter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);

	return $formatter->formatCurrency($value, config('custom.currency', 'EUR'));
}

/**
 * Get the current customer's cart
 */
function cart(): Order|null {
	if (Auth::check()) {
		return Auth::user()->cart;
	}

	if (session()->has('cart')) {
		return session('cart');
	}

	return null;
}
