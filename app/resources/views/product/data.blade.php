@props(['product'])

@pushOnce('styles')
	<style>
		.product-data ol {
			list-style: inside decimal;
		}

		.product-data ol li::marker {
			color: var(--color-neutral-700);
			font-weight: bold;
		}

		.product-data ul {
			list-style: inside disc;
		}

		.product-data ul li::marker {
			color: var(--color-primary-400);
		}

		.product-data ol p,
		.product-data ul p {
			display: inline;
		}
	</style>
@endpushOnce

<section class="product-data self-center">
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
		<div class="grid gap-4">
			<p class="product-desc">{!! $product->description !!}</p>

			@if ($product->ingredients && strip_tags($product->ingredients) !== '')
				<div class="grid grid-cols-1 gap-2">
					<p class="product-desc font-medium italic tracking-wide text-neutral-700">Ingredienti:</p>
					<div class="italic">{{ $product->ingredients }}</div>
				</div>
			@endif

			@if ($product->uses && strip_tags($product->uses) !== '')
				<div class="grid grid-cols-1 gap-2">
					<p class="font-medium italic tracking-wide text-neutral-700">Modalità d'uso:</p>
					<div class="italic">{!! $product->uses !!}</div>
				</div>
			@endif

			@if ($product->warnings && strip_tags($product->warnings) !== '')
				<div class="grid grid-cols-1 gap-2">
					<p class="font-medium italic tracking-wide text-neutral-700">Avvertenze:</p>
					<div class="italic">{!! $product->warnings !!}</div>
				</div>
			@endif
		</div>

		<!-- Quantity and add to cart -->
		<livewire:product.add-to-cart :product="$product" />
	</form>
</section>
