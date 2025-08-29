<section class="recap">
	<div class="recap-row">
		<p class="recap-text">Prodotti</p>
		<p class="recap-price js-cart-product-price-string">{{ price($cart->item_price) }}</p>
	</div>

	<div class="recap-row">
		<p class="recap-text">Spedizione</p>
		<p class="recap-price js-recap-shipping-field js-cart-shipping-price-string">{{ price($cart->shipping_fee) }}</p>
	</div>

	<div class="recap-row recap-row_total">
		<p class="recap-text">Totale</p>
		<p class="recap-price js-cart-price-string">{{ price($cart->price) }}</p>
	</div>
</section>
