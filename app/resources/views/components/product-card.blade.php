@props(['product'])

<div class="product-card">
	<div class="product-card__image-wrapper stack-content grid">

		<!-- Image -->
		<a
			href="{{ $product->url() }}"
			class="stack-content"
		>
			<img
				class="product-card__image image-fill"
				src="{{ $product->image() }}"
				alt="{{ $product->name }}"
				loading="lazy"
			>
		</a>
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

			@if ($product->inStock)
				<div
					class="product-card__cta"
					data-product-id="<?= $product->id ?>"
					data-quantity="1"
				>
					<x-icon-bag />
				</div>
			@endif

		</div>
	</div>

</div>
