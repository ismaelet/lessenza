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
		<p class="shipping-method__description">Le spese di trasporto vengono calcolate in base alla località e alla zona di
			spedizione</p>
		<p
			class="shipping-method__price"
			data-shipping-method-id="<?= $shippingMethod->id ?>"
		>{{ price($shippingMethod->price()) }}</p>
	</div>

</label>
