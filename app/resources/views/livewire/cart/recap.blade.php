<section class="recap">
	<div class="recap-row">
		<p class="recap-text">Articoli</p>
		<p class="recap-price js-cart-product-price-string">{{ price($cart->items_price_net) }}</p>
	</div>

	<div class="recap-row">
		<p class="recap-text">Spedizione</p>
		<p class="recap-price js-recap-shipping-field js-cart-shipping-price-string">{{ price($cart->shipping_fee_net) }}</p>
	</div>

	<div class="recap-row">
		<p class="recap-text">IVA</p>
		<p class="recap-price js-recap-shipping-field js-cart-shipping-price-string">{{ price($cart->vat) }}</p>
	</div>

	<div class="recap-row recap-row_total">
		<p class="recap-text">Totale</p>
		<p class="recap-price js-cart-price-string">{{ price($cart->total_price_gross) }}</p>
	</div>
</section>
