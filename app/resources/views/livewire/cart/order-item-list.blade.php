<div class="">
	@foreach ($orderItems as $orderItem)
		<article
			class="cart-order js-cart-order"
			wire:key="order-item-{{ $orderItem->id }}"
		>

			@if ($editable)
				<div
					class="cart-order__remove"
					wire:click="removeOrderItem({{ $orderItem->id }})"
					data-order-id="<?= $orderItem->id ?>"
				>
					<x-icon-close class="w-3" />
				</div>
			@endif

			<div class="cart-order__data">
				<p class="font-heading text-lg font-medium leading-none text-neutral-700"><a
						href="<?= $orderItem->product->url() ?>"><?= $orderItem->name ?></a></p>

				<p class=""><?= $orderItem->quantity == 1 ? 'tanica' : 'taniche' ?> da 5L</p>

				<p><?= $orderItem->quantity ?> x {{ price($orderItem->unit_price_net) }}
				</p>
			</div>

			<div class="cart-order__image">
				<img
					class="image-fit"
					src="<?= $orderItem->product->image ?>"
					alt=""
				>
			</div>
		</article>
	@endforeach
</div>
