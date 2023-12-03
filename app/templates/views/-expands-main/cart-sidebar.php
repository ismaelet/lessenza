<?php

use Ecommerce\ViewManager;

use function Ecommerce\cart;

?>

<section class="cart-sidebar js-cart-sidebar">
	<div class="cart-sidebar__backdrop js-close-cart-sidebar"></div>
	<div class="cart-sidebar__body">
		<div class="cart-sidebar__content">
			<!-- Header -->
			<div class="cart-sidebar__header flex-group">
				<h2 class="cart-sidebar__title">Carrello</h2>
				<div class="cart-sidebar__close js-close-cart-sidebar">
					<?= icon_embed('close') ?>
				</div>
			</div>

			<!-- Orders -->
			<form class="js-order-list" method="POST">
				<?= ViewManager::renderOrderList() ?>
			</form>

			<!-- Footer -->
			<div class="cart-sidebar__footer">
				<div class="cart-sidebar__recap flex-group">
					<p>Subtotale:</p>
					<p class="cart-sidebar__price fw-semibold js-cart-product-price-string"><?= cart()->productPriceString ?></p>
				</div>
				<div class="grid-flow" data-spacing="200">
					<div class="button button--secondary button--full-width button--small js-close-cart-sidebar">Chiudi</div>
					<a class="button button--full-width button--small" href="<?= client_url('/cart') ?>">Aquista ora</a>
				</div>
			</div>
		</div>
	</div>
</section>