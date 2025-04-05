<?php

// update the cart
$cart = new Ecommerce\Cart($cartId);

$cart->updateStatusId('confirmed');

// coupon
if ($cart->couponId) {
	\Legacy\System\Classes\DB::delete('ecommerce_coupons WHERE id=? AND reusable=0', [$cart->id]);
}
