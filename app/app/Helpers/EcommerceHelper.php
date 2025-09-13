<?php

namespace App\Helpers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Number;

class EcommerceHelper {

	/**
	 * Get the ID of the active cart
	 */
	public static function cartId(): ?int {
		// If the user is logged in, return the ID of their cart
		if (Auth::check() && Auth::user()->cart) {
			return Auth::user()->cart->id;
		}

		// Otherwise, return the ID of the cart stored in the session
		$sessionCart = Order::find(session('cart_id'));

		if ($sessionCart && !$sessionCart->status) {
			return $sessionCart->id;
		}

		// If no cart is found, return null
		return null;
	}

	/**
	 * Get the active cart
	 */
	public static function cart(): ?Order {
		if (Auth::check()) {
			return Auth::user()->cart ?? null;
		}

		if (session('cart_id')) {
			return Order::where('id', session('cart_id'))
				->whereIn('status', [EcommerceHelper::statusFromTag('open'), EcommerceHelper::statusFromTag('received')])
				->first();
		}

		return null;
	}

	/**
	 * Get the number of items in the cart
	 */
	public static function cartQuantity(): int {
		return self::cart() ? self::cart()->order_items->count() : 0;
	}

	/**
	 * Format a price
	 */
	public static function formatPrice(float $price, bool $forceNumber = true): string {
		if ($price || $forceNumber) {
			return Number::currency($price, 'EUR', config('app.locale'));
		} else {
			return __('Gratis');
		}
	}

	/**
	 * Get the step index based on the given step tag
	 */
	public static function stepFromTag(string $stepTag): int {
		$stepKeyPosition = array_search($stepTag, array_column(config('custom.ecommerce.cart.steps'), 'tag'));

		if ($stepKeyPosition === false) {
			return false;
		}

		return array_keys(config('custom.ecommerce.cart.steps'))[$stepKeyPosition];
	}

	/**
	 * Get the status index based on the given status tag
	 */
	public static function statusFromTag(string $statusTag): int {
		$statusKeyPosition = array_search($statusTag, array_column(config('custom.order_statuses'), 'tag'));

		if ($statusKeyPosition === false) {
			return false;
		}

		return array_keys(config('custom.order_statuses'))[$statusKeyPosition];
	}

	/**
	 * Get the status index based on the given status tag
	 */
	public static function statusColor(int $status): string {
		return config('custom.order_statuses.' . $status . '.color', 'gray');
	}

	/**
	 * Get the label for the order status
	 */
	public static function statusIcon(int $status): string {
		return config('custom.order_statuses.' . $status . '.icon', 'cart');
	}

	/**
	 * Get the label for the order status
	 */
	public static function statusLabel(int $status): string {
		return config('custom.order_statuses.' . $status . '.label', '');
	}
}
