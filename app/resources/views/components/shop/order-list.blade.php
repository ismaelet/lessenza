@props(['orders' => null])

@if ($orders?->count())
	<section class="cart-list">
		<div class="cart-list__wrapper">
			<div class="cart-list__header">
				<p class="cart-list__field cart-list__field--header">{{ __('Ordine') }}</p>
				<p class="cart-list__field cart-list__field--header">{{ __('Prodotto') }}</p>
				<p class="cart-list__field cart-list__field--header">{{ __('Totale') }}</p>
				<p class="cart-list__field cart-list__field--header">{{ __('Stato') }}</p>
				<p class="cart-list__field cart-list__field--header">{{ __('Data') }}</p>
				<div class="cart-list__field cart-list__field--header"></div>
			</div>

			@foreach ($orders as $key => $order)
				<div class="cart-list__cart {{ $key % 2 ? 'bg-neutral-100' : 'bg-neutral-150' }}">
					<p class="cart-list__field">{{ $order->id_code }}</p>
					<p class="cart-list__field">

						@foreach ($order->order_items as $orderItem)
							{{ $orderItem->full_name }}<br>
						@endforeach

					</p>
					<p class="cart-list__field">{{ price($order->total_price_gross) }}</p>
					<p class="cart-list__field">
						<span class="cart-list__status bg-status-{{ $order->status }} text-white">
							{{ $order->statusLabel() }}
						</span>
					</p>
					<p class="cart-list__field">{{ $order->date() }}</p>
					<p class="cart-list__field">
						<a
							class="text-primary underline"
							href="{{ $order->recapUrlWithToken() }}"
						>
							{{ __('visualizza') }}
						</a>
					</p>
				</div>
			@endforeach
		</div>
	</section>
@else
	<p class="">{{ __('Nessun ordine effetuato') }}</p>
@endif
