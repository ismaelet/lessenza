<?php

use Ecommerce\PaymentMethod;

global $customer;

// fetch payments
$payments = \Legacy\System\Classes\DB::select('id FROM ecommerce_payments ORDER BY id ASC');

// advance
if (isset($_POST['submit'])) {
	$paymentId = $_POST['paymentId'];
	$payment = new PaymentMethod($paymentId);

	\Legacy\System\Classes\DB::update('ecommerce_carts SET paymentId=? WHERE id=?', [$payment->id, $customer->cart->id]);

	redirect_legacy('/payment/' . $payment->slug);
}
