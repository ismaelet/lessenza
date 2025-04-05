<?php

if (!isset($_SESSION['paypal-cartId'])) redirect_legacy('/cart');

$cartId = $_SESSION['paypal-cartId'];

$cart = new Ecommerce\Cart($cartId);

if (!$cart->status) $cart->updateStatusId('waiting-payment');

redirect_legacy('/order/completed?id=' . $cart->id . '&success=1');
