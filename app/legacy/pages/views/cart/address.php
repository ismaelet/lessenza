{% block content %}

<form method="POST">
	<div class="grid" data-spacing="700">
		<!-- Shipping address -->
		<section class="address">
			<h2 class="subsection-title">Indirizzo</h2>

			<div class="form-panel grid" data-spacing="400">
				<?php

				use Ecommerce\ViewManager;

				use function Ecommerce\cart;

				generate_form($addressData) ?>
			</div>
		</section>

		<!-- Shipping method -->
		<section class="shipping-methods">
			<h2 class="subsection-title">Spedizione</h2>

			<div class="shipping-method__list">

				<?php foreach ($shippingMethods as $key => $shippingMethod) {
					echo ViewManager::renderShippingMethod($shippingMethod);
				} ?>

			</div>
		</section>

		<button type="submit" class="button" name="advance">Procedi</button>
	</div>
</form>

{% end content %}