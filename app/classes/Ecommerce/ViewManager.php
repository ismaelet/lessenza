<?php

namespace Ecommerce;

class ViewManager {

	/*
	* Render methods
	*/
	public static function renderProductCard(object $product) {
		ob_start();
?>

		<div class="product-card">
			<div class="product-card__image-wrapper grid-flow stack-content">

				<!-- Image -->
				<a href="<?= $product->clientUrl ?>" class="stack-content">
					<img class="product-card__image image-fill" src="<?= $product->clientImage ?>" alt="<?= $product->name ?>" loading="lazy">
				</a>

				<?php if (ecommerce_config('product-card')['functionalities']) { ?>

					<!-- Functionalities -->
					<div class="product-functionalities">

						<?php if ($product->inStock) { ?>

							<!-- Add to cart -->
							<div class="product-functionality">
								<div class="product-functionality-icon" data-functionality="add-to-cart" data-product-id="<?= $product->id ?>" data-quantity="1">
									<?= icon_embed('bag-stroke') ?>
								</div>
								<h3 class="product-functionality-name txt-c3">Aggiungi al carrello</h3>
							</div>

						<?php } ?>

						<!-- View -->
						<a href="<?= $product->clientUrl ?>" class="product-functionality">
							<div class="product-functionality-icon">
								<?= icon_embed('view') ?>
							</div>
							<h3 class="product-functionality-name txt-c3">Visualizzare</h3>
						</a>

						<!-- Wishlist -->
						<div class="product-functionality wishlist_box js-wishlist-module <?= $product->isLiked ? 'added' : '' ?>">
							<div class="product-functionality-icon js-add-to-wishlist" data-product-id="<?= $product->id ?>" data-added="<?= $product->isLiked ? 1 : 0 ?>" data-logged="<?= logged() ?>">
								<span class="wishlist_svg wishlist_svg--to-add"><?= icon_embed('star') ?></span>
								<span class="wishlist_svg wishlist_svg--added"><?= icon_embed('star-full') ?></span>
							</div>
							<h3 class="product-functionality-name txt-c3 wishlist_text wishlist_text--to-add"><?= __('Add to wishlist') ?></h3>
							<h3 class="product-functionality-name txt-c3 wishlist_text wishlist_text--added"><?= __('In wishlist') ?></h3>
						</div>
					</div>

				<?php } ?>

			</div>

			<!-- Content -->
			<div class="product-card__body">
				<h3 class="product-card__name"><?= $product->name ?></h3>
				<h3 class="product-card__description limit-lines"><?= $product->description ?></h3>
				<div class="product-card__footer">
					<h3 class="product-card__price">

						<?php if (!$product->inStock) { ?>

							<span class="fc-warning">Esaurito</span>

						<?php } else if ($product->onSale) { ?>

							<span class="product-price--base"><?= $product->basePriceString ?></span>
							<span class="product-price--promo"><?= $product->priceString ?></span>

						<?php } else { ?>
							<?= $product->priceString ?>
						<?php } ?>

					</h3>

					<?php if ($product->inStock) { ?>

						<div class="product-card__cta" data-product-id="<?= $product->id ?>" data-quantity="1">
							<?= icon_embed('bag') ?>
						</div>

					<?php } ?>

				</div>
			</div>

		</div>

	<?php

		return ob_get_clean();
	}

	// Like button
	public static function renderLikeButton($product) {
		ob_start();
	?>

		<div class="wishlist-icon mar-t-2 wishlist_box js-wishlist-module <?= $product->isLiked ? 'added' : '' ?>">
			<div class="flex-line gap05 js-add-to-wishlist" data-product-id="<?= $product->id ?>" data-added="<?= $product->isLiked ? 1 : 0 ?>" data-logged="<?= logged() ?>">
				<div class="">
					<span class="wishlist_svg wishlist_svg--to-add"><?= icon_embed('star') ?></span>
					<span class="wishlist_svg wishlist_svg--added"><?= icon_embed('star-full') ?></span>
				</div>

				<p class="wishlist-icon__text wishlist_text wishlist_text--to-add txt-14px txt-med txt-ls05"><?= __('Add to wishlist') ?></p>
				<p class="wishlist-icon__text wishlist_text wishlist_text--added txt-14px txt-med txt-ls05"><?= __('In wishlist') ?></p>
			</div>
		</div>

	<?php

		return ob_get_clean();
	}

	// Shipping method
	public static function renderShippingMethod(object $shippingMethod, object $cart = null) {

		$cart = self::getCart($cart);

		ob_start();

	?>

		<label class="shipping-method <?= !$cart->status ? 'interactive' : '' ?>">
			<div class="shipping-method__checkbox">
				<div class="checkbox">
					<input type="radio" class="<?= !$cart->status ? 'js-shipping-method-checkbox' : '' ?>" name="shippingMethodId" value="<?= $shippingMethod->id ?>" <?= $cart->shippingMethodId == $shippingMethod->id ? 'checked' : '' ?>>
					<span></span>
				</div>
			</div>

			<div class="shipping-method__content grid-flow" data-spacing="100">
				<h3 class="shipping-method__name"><?= $shippingMethod->name ?></h3>

				<?php if (manager() && $shippingMethod->hasApi) { ?>

					<p class="<?= $shippingMethod->activeApi ? 'fc-confirmation' : 'fc-warning' ?>"><?= $shippingMethod->activeApi ? 'API online' : 'API offline' ?></p>

				<?php } ?>

				<p class="shipping-method__deliveryDate"><?= $shippingMethod->deliveryDateString ?></p>
				<p class="shipping-method__description"><?= $shippingMethod->description ?></p>
				<p class="shipping-method__price js-cart-shipping-price-string" data-shipping-method-id="<?= $shippingMethod->id ?>"><?= $shippingMethod->priceString ?></p>
			</div>

		</label>

		<?php

		return ob_get_clean();
	}

	// Order list
	public static function renderOrderList(object $cart = null) {

		$cart = self::getCart($cart);

		ob_start();

		foreach ($cart->orders as $order) { ?>

			<div class="cart-order js-cart-order">

				<?php if (!$cart->statusId) { ?>

					<div class="cart-order__remove js-remove-from-cart" data-order-id="<?= $order->id ?>">
						<?= icon_embed('close') ?>
					</div>

				<?php } ?>

				<div class="cart-order__data">
					<h3 class="cart-order__title">
						<a href="<?= $order->product->url ?>">
							<?= $order->product->name ?><br><span class="fc-300"><?= $order->quantity == 1 ? 'tanica' : 'taniche' ?> da 5L</span>
						</a>
					</h3>
					<p>
						<?= $order->quantity ?> x <?= $order->discount ? '<span class="promo-price">' . $order->priceString . '</span>' . ' <span class="original-price">' . $order->originalPriceString . '</span>' : $order->priceString ?>
					</p>
				</div>

				<div class="cart-order__image">
					<img class="image-fit" src="<?= $order->product->clientImage ?>" alt="">
				</div>
			</div>

		<?php }

		return ob_get_clean();
	}

	// Cart list
	public static function renderCartList() {
		ob_start();

		if (customer()->confirmedCartsCount) { ?>

			<section class="cart-list">
				<div class="cart-list__wrapper">
					<div class="cart-list__header">
						<p class="cart-list__field cart-list__field--header">Ordine</p>
						<p class="cart-list__field cart-list__field--header">Prodotto</p>
						<p class="cart-list__field cart-list__field--header">Totale</p>
						<p class="cart-list__field cart-list__field--header">Stato</p>
						<p class="cart-list__field cart-list__field--header">Data</p>
						<div class="cart-list__field cart-list__field--header"></div>
					</div>

					<?php foreach (customer()->confirmedCarts as $cart) { ?>

						<div class="cart-list__cart">
							<p class=" cart-list__field"><?= $cart->idCode ?></p>
							<p class="cart-list__field">

								<?php foreach ($cart->orders as $order) {
									echo $order->name . '<br>';
								} ?>

							</p>
							<p class="cart-list__field"><?= $cart->priceString ?></p>
							<p class="cart-list__field">
								<span class="cart-list__status background-status-color--<?= $cart->statusCode ?>">
									<?= $cart->statusName ?>
								</span>
							</p>
							<p class="cart-list__field"><?= $cart->dateString ?></p>
							<p class="cart-list__field">
								<a class="cart-list__link text-link" href="<?= $cart->url ?>">
									visualizza
								</a>
							</p>
						</div>

					<?php } ?>

				</div>
			</section>

		<?php } else { ?>

			<p class="">Nessun ordine effetuato</p>

		<?php }

		return ob_get_clean();
	}

	// Cart recap panel
	public static function renderCartRecap(object $cart = null) {

		$cart = self::getCart($cart);

		ob_start();

		?>

		<section class="recap">
			<div class="recap-row">
				<p class="recap-text">Prodotti</p>
				<p class="recap-price js-cart-product-price-string"><?= $cart->fullProductPriceString ?></p>
			</div>

			<div class="recap-row">
				<p class="recap-text">Spedizione</p>
				<p class="recap-price js-recap-shipping-field js-cart-shipping-price-string" data-shipping-method-id="<?= $cart->shippingMethodId ?>"><?= $cart->shippingPriceString ?></p>
			</div>

			<?php if ($cart->productDiscount) { ?>

				<div class="recap-row">
					<p class="recap-text">Sconto</p>
					<p class="recap-price">- <?= $cart->productDiscountString ?></p>
				</div>

			<?php } ?>

			<div class="recap-row recap-row_total">
				<p class="recap-text">Totale</p>
				<p class="recap-price js-cart-price-string"><?= $cart->priceString ?></p>
			</div>
		</section>

<?php

		return ob_get_clean();
	}

	/*
	* Support function
	*/
	private static function getCart(object $cart = null) {
		return $cart ?: cart();
	}
}
