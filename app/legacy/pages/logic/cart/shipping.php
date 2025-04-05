<?php

global $user, $cart;

include_once(SERVER_ROOT . '/app/functions/vendor/melhor-envio.php');

/*if (!in_array($_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
	vendor_melhor_envio_refresh_token();
}*/

$onlyGiftCard = !DB::exists('ecommerce_orders WHERE cartId=? AND itemId<>61', [$cart->id]);

$shippingTypes = !$onlyGiftCard ?
	DB::select('id FROM ecommerce_shipping WHERE visible=1 ORDER BY id ASC') :
	DB::select('id FROM ecommerce_shipping WHERE id=3 ORDER BY id ASC');

//advance
if (isset($_POST['submit'])) {
	$cart->updateShipping($_POST['shippingId']);
	advance_cart();
}

//debug(vendor_melhor_envio_calc_shipping_fee());
