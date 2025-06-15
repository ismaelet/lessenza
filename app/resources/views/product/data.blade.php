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
		<div class="flex flex-wrap gap-4">
			<label class="quantity center-content border-1 grid grow grid-cols-3 rounded border-neutral-300 sm:grow-0">
				<span class="quantity__edit quantity__edit--remove disabled js-quantity-remove">-</span>
				<input
					type="number"
					name="quantity"
					value="1"
					min="1"
					max="99"
					step="1"
				>
				<span class="quantity__edit quantity__edit--add js-quantity-add">+</span>
			</label>

			<x-button
				type="button"
				class="grow"
				data-product-id="{{ $product->id }}"
				data-quantity="1"
				value="{{ $product->id }}"
				:disabled="!$product->inStock"
			>
				<x-icon-cart class="w-[1.25em]" />
				Aggiungi al carrello
			</x-button>
		</div>
	</form>
</section>
