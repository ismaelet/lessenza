@props(['product'])

<section class="product-data">
	<form
		class="product-wrap grid"
		data-spacing="800"
		method="POST"
	>

		<div
			class="grid"
			data-spacing="400"
		>
			<!-- Basic data -->
			<div
				class="grid"
				data-spacing="200"
			>
				<x-heading.section class="">{{ $product->name }}</x-heading.section>
				<x-subheading.section class="">{{ $product->product_type->name }}</x-subheading.section>
			</div>

			<!-- Price and availability -->
			<div
				class="flex-group"
				data-spacing="400"
			>

				<p class="product-price heading-like">
					<span
						class="js-full-price text-600 font-heading font-semibold text-neutral-700">{{ $product->priceString() }}</span>
				</p>

				<div @class([
					'product-availability flex items-center gap-1',
					'text-good-400' => $product->inStock,
					'text-bad-400' => !$product->inStock,
				])>

					@if ($product->inStock)
						<x-icon-checked />
					@else
						<x-icon-close-border />
					@endif

					<p class="product-availability__text text-good-400">{{ $product->inStock ? 'Disponibile' : 'Non disponibile' }}</p>
				</div>

			</div>
		</div>

		<!-- Description -->
		<div
			class="grid"
			data-spacing="400"
		>
			<p class="product-desc">{{ $product->description }}</p>

			@if ($product->ingredients)
				<p class="product-desc">Ingredienti: <span class="fy-italic">{{ $product->ingredients }}</span></p>
			@endif
		</div>

		<!-- Quantity and add to cart -->
		<livewire:product.add-to-cart :product="$product" />
	</form>
</section>
