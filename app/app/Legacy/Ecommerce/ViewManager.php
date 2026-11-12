<?php

namespace App\Legacy\Ecommerce;

class ViewManager
{
    // Like button
    public static function renderLikeButton($product)
    {
        ob_start();
        ?>

		<div class="wishlist-icon mar-t-2 wishlist_box js-wishlist-module <?= $product->isLiked ? 'added' : '' ?>">
			<div class="flex-line gap05 js-add-to-wishlist" data-product-id="<?= $product->id ?>" data-added="<?= $product->isLiked ? 1 : 0 ?>" data-logged="<?= logged() ?>">
				<div class="">
					<span class="wishlist_svg wishlist_svg--to-add"><?= embed_svg('star') ?></span>
					<span class="wishlist_svg wishlist_svg--added"><?= embed_svg('star-full') ?></span>
				</div>

				<p class="wishlist-icon__text wishlist_text wishlist_text--to-add txt-14px txt-med txt-ls05"><?= __('Add to wishlist') ?></p>
				<p class="wishlist-icon__text wishlist_text wishlist_text--added txt-14px txt-med txt-ls05"><?= __('In wishlist') ?></p>
			</div>
		</div>

	<?php

                return ob_get_clean();
    }

    // Shipping method
    public static function renderShippingMethod(object $shippingMethod, ?object $cart = null)
    {

        $cart = self::getCart($cart);

        ob_start();

        ?>

		<label class="shipping-method <?= ! $cart->status ? 'interactive' : '' ?>">
			<div class="shipping-method__checkbox">
				<div class="checkbox">
					<input type="radio" class="<?= ! $cart->status ? 'js-shipping-method-checkbox' : '' ?>" name="shippingMethodId" value="<?= $shippingMethod->id ?>" <?= $cart->shippingMethodId == $shippingMethod->id ? 'checked' : '' ?>>
					<span></span>
				</div>
			</div>

			<div class="shipping-method__content grid" data-spacing="100">
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

    // Cart list

    // Cart recap panel
    public static function renderCartRecap(?object $cart = null)
    {

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
    private static function getCart(?object $cart = null)
    {
        return $cart ?: cart();
    }
}
