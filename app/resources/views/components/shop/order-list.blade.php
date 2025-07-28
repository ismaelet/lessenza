@props(['orders' => null])

@if ($orders?->count())
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

			@foreach ($orders as $key => $order)
				<div class="cart-list__cart {{ $key % 2 ? 'bg-neutral-100' : 'bg-neutral-150' }}">
					<p class="cart-list__field">{{ $order->id_code }}</p>
					<p class="cart-list__field">

						@foreach ($order->order_items as $orderItem)
							{{ $orderItem->full_name }}<br>
						@endforeach

					</p>
					<p class="cart-list__field">{{ price($order->price) }}</p>
					<p class="cart-list__field">
						<span class="cart-list__status background-status-color--{{ $order->statusTag() }} text-white">
							{{ $order->statusLabel() }}
						</span>
					</p>
					<p class="cart-list__field">{{ $order->date() }}</p>
					<p class="cart-list__field">
						<a
							class="text-primary underline"
							href="{{ $order->url }}"
						>
							visualizza
						</a>
					</p>
				</div>
			@endforeach
		</div>
	</section>
@else
	<p class="">Nessun ordine effetuato</p>
@endif
