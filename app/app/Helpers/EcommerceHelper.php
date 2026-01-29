<?php

namespace App\Helpers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Number;
use NumberFormatter;

class EcommerceHelper {

    /**
     * Get the ID of the active cart
     */
    public static function cartId(): ?int {
        // If the user is logged in, return the ID of their cart
        if (Auth::check()) {
            return Auth::user()->cart?->id;
        }

        // Otherwise, return the ID of the cart stored in the session
        $sessionCart = Order::where('id', session('cart_id'))
            ->where('status', [EcommerceHelper::status('open')])
            ->first();

        // Return the ID of the session cart if it exists, otherwise null
        return $sessionCart?->id;
    }

    /**
     * Get the active cart
     */
    public static function cart(): ?Order {
        return Order::find(self::cartId());
    }

    /**
     * Get the status index based on the given status tag
     */
    public static function status(string $statusTag): int {
        $statusKeyPosition = array_search($statusTag, array_column(config('ecommerce.order_statuses'), 'tag'));

        if ($statusKeyPosition === false) {
            return false;
        }

        return array_keys(config('ecommerce.order_statuses'))[$statusKeyPosition];
    }


    /**
     * Format a price value according to the current currency
     */
    public static function formatPrice(?float $value): string {
        $formatter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);

        return $formatter->formatCurrency($value, config('custom.currency', 'EUR'));
    }
}
