<?php

global $cart;

if (isset($_POST['advance'])) {
	$cart->updateStatusId('waiting-payment');
	redirect('/order/completed?id=' . $cart->id);
}
