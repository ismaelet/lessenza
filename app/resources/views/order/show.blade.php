@use('App\Helpers\EcommerceHelper')
@use('App\Helpers\PreviewHelper')

@pushOnce('styles')
	<style>
		.status-bar {
			h3 {
				color: inherit;
			}
		}

		.status-icon {
			--icon-size: 50%;
			border-color: currentColor;
		}

		.page-panel p-4 rounded border border-neutral-200 grid grid-cols-1 gap-2 {
			display: grid;
			gap: 1rem;
			padding: 1.5rem;
		}
	</style>
@endpushOnce

<x-layouts.legacy-main>

	<div class="full-width justify-items-center bg-neutral-200 py-20 text-center">
		<x-heading.section>
			Ordine <span class="text-primary">{{ $order->id_code }}</span>
		</x-heading.section>
	</div>

	<div class="mb-20 mt-12 grid gap-12">
		<div class="status-bar text-status-{{ $order->status }} flex items-center justify-center gap-4">
			<span class="status-icon grid aspect-square w-12 place-items-center rounded-full border">
				<x-dynamic-component
					:component="'icon-' . $order->statusIcon()"
					class="w-1/2"
				/>
			</span>

			<x-heading.small-component>
				{{ $order->statusLabel() }}
			</x-heading.small-component>
		</div>

		@if ($order->statusTag() == 'payment_pending')
			<div class="flex justify-center">
				<x-button href="{{ route('paypal.orders.create', ['order_id' => $order->id]) }}">Procedi al pagamento</x-button>
			</div>
		@endif

		<div class="grid items-start gap-6 sm:gap-8 lg:grid-cols-2 lg:gap-12">
			<div class="grid gap-6 sm:gap-8">
				{{-- Payment --}}
				<article class="grid grid-cols-1 gap-2 rounded border border-neutral-200 p-4">
					<x-subheading.component>
						Metodo di pagamento
					</x-subheading.component>

					<x-heading.small-component>{{ $order->payment_method?->name }}</x-heading.small-component>
				</article>

				{{-- Shipping --}}
				<article class="grid grid-cols-1 gap-2 rounded border border-neutral-200 p-4">
					<x-subheading.component>Metodo di spedizione</x-subheading.component>

					<x-heading.small-component>
						{!! $order->shipping_method->name !!}
					</x-heading.small-component>

					<div>
						<p>
							{!! $order->shipping_method->deliveryDateString() !!}
						</p>
					</div>
				</article>

				{{-- Address --}}
				<article class="grid grid-cols-1 gap-2 rounded border border-neutral-200 p-4">
					<x-heading.small-component>Indirizzo</x-heading.small-component>

					<p>
						{!! implode('<br>', $order->address?->full_address) !!}<br>
						-<br>
						{{ $order->address?->email ?? '' }}<br>
						{{ $order->address?->phone ?? '' }}
					</p>

				</article>
			</div>

			<div class="grid gap-6 sm:gap-8">
				<article class="grid grid-cols-1 gap-2 rounded border border-neutral-200 p-4">
					<x-heading.small-component>Articoli</x-heading.small-component>

					@foreach ($order->order_items as $orderItem)
						<div class="grid grid-cols-2 items-center gap-4 md:grid-cols-4">
							<a
								href="{{ $orderItem->product ? $orderItem->product->url() : '' }}"
								class="img_cont"
							>
								<img
									src="{{ $orderItem->product->image }}"
									class="rounded"
								>
							</a>

							<!--Data-->
							<div class="md:col-span-3">
								<a href="{{ $orderItem->product ? $orderItem->product->url() : null }}">
									<h3 class="art_name">{{ $orderItem->full_name }}</h3>
								</a>

								<p class="font-semibold">
									{{ $orderItem->price }}
								</p>
							</div>
						</div>
					@endforeach

				</article>

				<article class="grid grid-cols-1 gap-2 rounded border border-neutral-200 p-4">
					<x-heading.small-component>Riepilogo</x-heading.small-component>

					<ul class="divide-neutral-border divide-y">
						<li class="flex justify-between gap-4 py-3">
							<p class="">Articoli</p>
							<p class="font-medium text-neutral-700">{{ price($order->items_price_net) }}</p>
						</li>

						<li class="flex justify-between gap-4 py-3">
							<p class="">Spedizione</p>
							<p class="font-medium text-neutral-700">{{ price($order->shipping_fee_net) }}</p>
						</li>

						<li class="flex justify-between gap-4 py-3">
							<p class="">IVA</p>
							<p class="font-medium text-neutral-700">{{ price($order->vat) }}</p>
						</li>

						<li class="flex justify-between gap-4 py-3 text-lg">
							<p class="">Totale</p>
							<p class="font-medium text-neutral-700">{{ price($order->total_price_gross) }}</p>
						</li>
					</ul>
				</article>
			</div>
		</div>
	</div>

</x-layouts.legacy-main>
