<label class="shipping-method <?= !$cart->status ? 'interactive' : '' ?>">
	<div class="shipping-method__checkbox">
		<div class="checkbox">
			<input
				type="radio"
				checked
				name="shipping_method_id"
				value="<?= $shippingMethod->id ?>"
				<?= $cart->shippingMethodId == $shippingMethod->id ? 'checked' : '' ?>
			>
			<span></span>
		</div>
	</div>

	<div
		class="shipping-method__content grid"
		data-spacing="100"
	>
		<h3 class="font-medium text-neutral-700"><?= $shippingMethod->name ?></h3>

		<p class="font-medium text-neutral-700"><?= $shippingMethod->deliveryDateString() ?></p>
		<p class="shipping-method__description"><?= $shippingMethod->description ?></p>
		<p
			class="shipping-method__price js-cart-shipping-price-string"
			data-shipping-method-id="<?= $shippingMethod->id ?>"
		><?= $shippingMethod->priceString ?></p>
	</div>

</label>
