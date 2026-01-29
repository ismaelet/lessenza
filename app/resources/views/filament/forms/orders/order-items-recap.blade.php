@php

	$orderItems = $getRecord()->order_items->load('product');

@endphp

@pushOnce('styles')
	<style>
		.grid {
			display: grid;
		}

		.flex {
			display: flex;
			align-items: center;
			justify-content: space-between;
		}

		.text-lg {
			font-size: 1.125rem;
		}

		.font-semibold {
			font-weight: 600;
		}

		.order-item {
			padding-block: .75rem;
			border-bottom: 1px solid color-mix(in hsl, var(--gray-400), transparent 70%);

			&:first-child {
				padding-top: 0;
			}

			&:last-child {
				padding-bottom: 0;
				border-bottom: none;
			}

		}
	</style>
@endpushOnce

<div class="order-list grid gap-x-4 text-lg">

	<div class="order-item col-span-full flex">
		<p class="">Articoli</p>
		<p class="font-semibold">{{ price($getRecord()->items_price_net) }}</p>
	</div>

	<div class="order-item col-span-full flex">
		<p class="">Spedizione</p>
		<p class="font-semibold">{{ price($getRecord()->shipping_fee_net) }}</p>
	</div>

	<div class="order-item col-span-full flex">
		<p class="">IVA</p>
		<p class="font-semibold">{{ price($getRecord()->vat) }}</p>
	</div>

	<div class="order-item col-span-full flex">
		<p class="">Totale</p>
		<p class="font-semibold">{{ price($getRecord()->total_price_gross) }}</p>
	</div>
</div>
