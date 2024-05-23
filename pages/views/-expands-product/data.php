<?php

use Ecommerce\ViewManager;

use function Ecommerce\ecommerce_config;
use function Ecommerce\format_price;

?>

<section class="product-data">
	<form class="product-wrap grid-flow" data-spacing="800" method="POST">

		<div class="grid-flow" data-spacing="400">
			<!-- Basic data -->
			<div class="grid-flow" data-spacing="200">
				<h1 class="product-name section-title"><?= $product->name ?></h1>
				<p class="product-type section-subtitle"><?= $product->type->name ?></p>
			</div>

			<!-- Price and availability -->
			<div class="flex-group" data-spacing="400">

				<?php if (logged()) { ?>

					<p class="product-price heading-like">

						<?php if ($product->onSale) { ?>

							<span class="product-price--base js-full-price"><?= $product->basePriceStr ?></span>
							<span class="product-price--promo js-discounted-price"><?= $product->priceString ?></span>

						<?php } else { ?>
							<span class="js-full-price"><?= $product->priceString ?></span>
						<?php } ?>

					</p>

					<?php if (ecommerce_config('product-page')['installments']) { ?>

						<p class="product-price-installments txt-c2 txt-14px txt-med">ou 2x <?= format_price($product->price / 2) ?></p>

					<?php } ?>
				<?php } ?>

				<?php if (ecommerce_config('product-page')['availability']) { ?>

					<div class="product-availability <?= $product->inStock ? 'product-availability--available' : 'product-availability--unavailable' ?>">
						<?= icon_embed($product->inStock ? 'checked' : 'close-border') ?>
						<p class="product-availability__text"><?= $product->inStock ? __('In stock') : __('Out of stock') ?></p>
					</div>

				<?php } ?>

			</div>
		</div>

		<!-- Description -->
		<div class="grid-flow" data-spacing="400">
			<p class="product-desc"><?= $product->description ?></p>

			<?php if ($product->ingredients) { ?>
				<p class="product-desc">Ingredienti: <span class="fy-italic"><?= $product->ingredients ?></span></p>
			<?php } ?>
		</div>

		<?php if (ecommerce_config('whishlist') && !$giftCard) { ?>

			<!-- Add to wishlist -->
			<div class="mar-b-2">
				<?= ViewManager::renderLikeButton($product) ?>
			</div>

		<?php } ?>

		<?php if ($giftCard) { ?>

			<!-- Gift card -->
			<div class="gift-card grid gap1 mar-t-1 mar-b-2">
				<input type="hidden" name="gift-price" value="79">
				<input type="hidden" name="gift-type" value="1">

				<h3 class="gift-title">Valor</h3>
				<div class="gift-values">
					<?php foreach ([79, 100, 150, 200, 250] as $key => $giftValue) { ?>
						<p class="gift-value gift-option <?= !$key ? 'active' : '' ?>" data-price="<?= $giftValue ?>"><?= format_price($giftValue) ?></p>
					<?php } ?>
				</div>

				<p class="gift-title">Para quem é o vale-presente?</p>
				<div class="gift-types">
					<?php foreach (['Para outra pessoa', 'Para mim'] as $key => $giftType) { ?>
						<p class="gift-type gift-option <?= !$key ? 'active' : '' ?>" data-type="<?= ($key + 1) ?>"><?= $giftType ?></p>
					<?php } ?>
				</div>

				<div class="gift-form grid gap1">
					<div class="form-field">
						<p class="form-lbl">E-mail do destinatario *</p>
						<input type="email" class="inp inp_empty" name="gift-email" placeholder="E-mail do destinatario" required>
					</div>
					<div class="form-field">
						<p class="form-lbl">Nome do destinatario *</p>
						<input type="text" class="inp inp_empty" name="gift-name" placeholder="Nome do destinatario" maxlength="100" required>
					</div>
					<div class="form-field">
						<p class="form-lbl">Mensagem</p>
						<textarea class="textarea textarea_empty" name="gift-text" maxlength="500" placeholder="Mensagem"></textarea>
					</div>
				</div>
			</div>

		<?php } ?>

		<?php if ($product->variations) { ?>

			<!-- Variations -->
			<div class="variations mar-b-1">
				<?php foreach ($product->variations as $variation) { ?>
					<div class="variation">
						<h3><?= $variation['title'] ?></h3>
						<select class="sel" name="variation">
							<?php foreach ($variation['variants'] as $key => $variant) { ?>
								<option value="<?= $key ?>"><?= $variant[0] ?> (<?= format_price($variant[1]) ?>)</option>
							<?php } ?>
						</select>
					</div>
				<?php } ?>
			</div>

		<?php } ?>

		<?php if (false && !$product->inStock) { ?>

			<!-- Request for out of stock products -->
			<section class="stock-request">
				<h3 class="txt-red txt-bold">Il prodotto è attualmente esaurito.</h3>
				<p class="mar-v-05">Se vuoi essere avvisato quando sarà nuovamente disponibile, inserisci qui il tuo indirizzo email:</p>
				<input type="email" class="inp js-stock-request-email" value="<?= $user->email ?: '' ?>" placeholder="Indirizzo email">
				<div class="stock-request_btn pbtn block push-right mar-t-05 js-stock-request" data-item-id="<?= $product->id ?>">Invia la richiesta</div>
				<p class="stock-request_confirmation confirmation js-stock-request-confirmation">Abbiamo registrato la tua richiesta, ti avviseremo non appena il prodotto sarà nuovamente disponibile.</p>
			</section>

		<?php } ?>

		<!-- Quantity and add to cart -->
		<div class="cta-panel <?= $giftCard ? 'cta-panel_grift-card' : '' ?>">

			<?php if ($giftCard) { ?>

				<button type="submit" class="pbtn" name="add-to-cart" value="<?= $product->id ?>" <?= $existsGiftCard ? 'disabled' : '' ?>>Comprar</button>

			<?php } else { ?>

				<label class="quantity grid-flow center-content" data-columns="3">
					<span class="quantity__edit quantity__edit--remove disabled js-quantity-remove">-</span>
					<input type="number" name="quantity" value="1" min="1" max="99" step="1">
					<span class="quantity__edit quantity__edit--add js-quantity-add">+</span>
				</label>

				<?php if (logged()) { ?>

					<button type="button" class="button add-to-cart js-add-to-cart" data-product-id="<?= $product->id ?>" data-quantity="1" value="<?= $product->id ?>" <?= !$product->inStock ? 'disabled' : '' ?>>
						<?= icon_embed('cart') ?>
						<?= __('Add to cart') ?>
					</button>

				<?php } else { ?>

					<a class="button add-to-cart" href="<?= client_url('/login') ?>" <?= !$product->inStock ? 'disabled' : '' ?>>
						<?= icon_embed('cart') ?>
						<?= __('Add to cart') ?>
					</a>

			<?php }
			} ?>

		</div>
	</form>

	<!-- Other infos -->
	<?php if ($product->details) { ?>

		<h2 class="item-subtitle mar-t-3">Caratteristiche del prodotto</h2>
		<div class="product-details">

			<?php foreach ($product->details as $key => $value) {
				if ($value) { ?>

					<div class="product-detail">
						<p class="txt-sbold"><?= $key ?></p>
						<p class=""><?= $value ?></p>
					</div>

			<?php }
			} ?>

		</div>

	<?php } ?>

</section>