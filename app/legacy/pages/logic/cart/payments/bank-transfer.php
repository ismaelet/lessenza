<?php

global $cart;

if (isset($_POST['advance'])) {
	$cart->updateStatusId('waiting-payment');
	redirect_legacy('/order/completed?id=' . $cart->id);
}
