<?php

use App\Helpers\EcommerceHelper;
use App\Models\Order;

/**
 * Get the ID of the active cart
 */
function cart_id(): ?int {
    return EcommerceHelper::cartId();
}

/**
 * Get the active cart
 */
function cart(): ?Order {
    return EcommerceHelper::cart();
}

/**
 * Formats the given price value as a string
 */
function price(?float $value): string {
    return EcommerceHelper::formatPrice($value);
}
