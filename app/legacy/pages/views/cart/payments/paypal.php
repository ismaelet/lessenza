{% block main %}

<form id="pp_form" class="pp_form" action="https://www.paypal.com/cgi-bin/webscr" method="POST">

	<!--PAYPAL DATA-->
	<input type="hidden" name="cmd" value="_cart">
	<input type="hidden" name="business" value="<?= ecommerce_config('paypal-user') ?>">
	<input type="hidden" name="upload" value="1">
	<input type="hidden" name="lc" value="it_IT">
	<input type="hidden" name="currency_code" value="EUR">

	<!-- Articles -->
	<?php foreach ($orders as $key => $order) { ?>
		<input type="hidden" name="item_name_<?= ($key + 1) ?>" value="<?= $order->item->name ?>">
		<input type="hidden" name="amount_<?= ($key + 1) ?>" value="<?= $order->price ?>">
		<input type="hidden" name="quantity_<?= ($key + 1) ?>" value="<?= $order->quantity ?>">
		<input type="hidden" name="item_number_<?= ($key + 1) ?>" value="<?= $order->id ?>">

	<?php } ?>

	<!-- Discount -->
	<?php if ($cart->discount) { ?>
		<input type="hidden" name="discount_amount_cart" value="<?= format($cart->discount) ?>">
	<?php } ?>

	<!-- Shipping data -->
	<input type="hidden" name="shipping_1" value="<?= $cart->shippingPrice ?>">
	<input type="hidden" name="first_name" value="<?= $cart->address->fistname ?>">
	<input type="hidden" name="last_name" value="<?= $cart->address->lastName ?>">
	<input type="hidden" name="address1" value="<?= $cart->address->address . ' ' . $cart->address->number ?>">
	<input type="hidden" name="city" value="<?= $cart->address->city ?>">
	<input type="hidden" name="state" value="<?= $cart->address->region ?>">
	<input type="hidden" name="zip" value="<?= $cart->address->zip ?>">
	<input type="hidden" name="lc" value="IT">
	<input type="hidden" name="country" value="IT">
	<input type="hidden" name="email" value="<?= $cart->address->email ?>">
	<input type="hidden" name="night_phone_a" value="<?= $cart->address->phone ?>">

	<!--CUSTOM DATA-->
	<input type="hidden" name="custom" value="<?= $cart->id ?>">
</form>

<!-- Load icon -->
<div class="page-content center-items">
	<div class="load-icon"></div>
</div>

<script>
	document.getElementById('pp_form').submit();
</script>

{% end main %}