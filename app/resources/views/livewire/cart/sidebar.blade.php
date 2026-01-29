@pushOnce('styles')
	<style>
		.cart-sidebar {
			position: fixed;
			inset: 0;
			pointer-events: none;
			z-index: 100;
		}

		.cart-sidebar__backdrop {
			background-color: rgba(0, 0, 0, 0.6);
			position: absolute;
			inset: 0;
			opacity: 0;
			cursor: pointer;
			transition: opacity 0.2s;
		}

		.cart-sidebar.active .cart-sidebar__backdrop {
			opacity: 1;
			pointer-events: all;
		}

		.cart-sidebar__body {
			position: absolute;
			right: 0;
			translate: 100% 0;
			width: 22rem;
			height: 100%;
			padding: 1rem;
			background-color: #fff;
			box-shadow: -0.5rem 0 1rem rgba(0, 0, 0, 0.1);
			pointer-events: all;
			transition: translate 0.2s;
		}

		.cart-sidebar.active .cart-sidebar__body {
			translate: none;
		}

		.cart-sidebar__content {
			display: grid;
			height: 100%;
			grid-template-rows: max-content minmax(0, 1fr) max-content;
		}

		.cart-sidebar__header {
			justify-content: space-between;
			padding-bottom: 1rem;
			border-bottom: var(--border);
		}

		.cart-sidebar__title {
			font-size: var(--text-600);
		}

		.cart-sidebar__close {
			width: 0.75rem;
			cursor: pointer;
		}

		.cart-sidebar .cart-orders {
			overflow-y: auto;
		}

		.cart-sidebar .cart-order {
			grid-template-columns: 0.66rem minmax(0, 1fr) 4.5rem;
			grid-template-areas: "remove data image";
		}

		.cart-sidebar .cart-order_title {
			font-size: 0.9rem;
		}

		.cart-sidebar__recap {
			justify-content: space-between;
			padding-block: 1rem;
			margin-bottom: 1rem;
			border-block: var(--border);
		}
	</style>
@endpushOnce

@pushOnce('scripts')
	<script defer>
		function closeCartSidebar() {
			document.querySelector('.cart-sidebar').classList.remove('active');
		}
	</script>
@endpushOnce

<section class="cart-sidebar js-cart-sidebar {{ $show ? 'active' : '' }}">
	<div
		class="cart-sidebar__backdrop"
		@click="closeCartSidebar"
	></div>
	<div class="cart-sidebar__body">
		<div class="cart-sidebar__content">
			<!-- Header -->
			<div class="cart-sidebar__header flex-group">
				<x-heading.small-component class="cart-sidebar__title">Carrello</x-heading.small-component>
				<div
					class="cart-sidebar__close"
					@click="closeCartSidebar"
				>
					<x-icon-close />
				</div>
			</div>

			<!-- Order items -->
			<div class="">
				@if (!$orderItems || $orderItems->isEmpty())
					<p class="mt-8 text-center">Il carrello è vuoto</p>
				@else
					<livewire:cart.order-item-list
						:$orderItems
						:editable="(bool) $cart->status"
						:key="'order-items:' . $orderItems->pluck('id')->implode('-') . ',q:' . $cart->quantity"
					/>
				@endif
			</div>

			<!-- Footer -->
			<div class="cart-sidebar__footer">
				<div class="cart-sidebar__recap flex-group">
					<p>Subtotale:</p>
					<p class="font-semibold text-neutral-700">
						{{ price($cart?->items_price_net ?: 0) }}</p>
				</div>

				<div
					class="grid"
					data-spacing="200"
				>
					<x-button
						class=""
						variant="secondary"
						size="small"
						@click="closeCartSidebar"
					>Chiudi</x-button>

					<x-button
						class=""
						href="{{ route('cart') }}"
						size="small"
						:disabled="$cart?->isEmpty()"
					>Aquista ora</x-button>
				</div>
			</div>
		</div>
	</div>
</section>
