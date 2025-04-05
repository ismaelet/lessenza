<?php

use Ecommerce\PaymentMethod;

global $customer;

// fetch payments
$payments = DB::select('id FROM ecommerce_payments ORDER BY id ASC');

// advance
if (isset($_POST['submit'])) {
	$paymentId = $_POST['paymentId'];
	$payment = new PaymentMethod($paymentId);

	DB::update('ecommerce_carts SET paymentId=? WHERE id=?', [$payment->id, $customer->cart->id]);

	redirect('/payment/' . $payment->slug);
}
