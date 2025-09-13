@php
	$orderItems = cart()->order_items;
@endphp

@pushOnce('styles')
	<link
		rel="stylesheet"
		href="{{ asset('css/legacy/cart.css') }}"
	>

	<style>
		.form-row {
			display: grid;
			gap: 0.5rem;
		}

		.content-grid {
			align-content: flex-start;
		}
	</style>
@endpushOnce

<x-layouts.legacy-main title="Carrello">
	<div class="page-header stack-content center-content grid">
		<div
			class="page-header__background fill-all background-fill"
			<?= background_image('cart-background.webp') ?>
		></div>

		<div class="main-wrap py-28">
			<x-heading.section>Carrello</x-heading.section>
		</div>
	</div>

	<div class="main-wrap">
		<div class="page-body">
			<div class="">
				{{ $slot }}
			</div>

			<!-- Side bar -->
			<aside class="sidebar">

				<label class="sidebar__header">
					<input
						type="checkbox"
						class="sidebar__checkbox hidden"
						checked
					>
					<div class="sidebar__icon"><x-icon-arrow1-down /></div>
					<h3 class="sidebar__menu">Dettagli dell'ordine</h3>
				</label>

				<div class="sidebar__body">

					<div class="sidebar__content">

						<!-- Orders -->
						<div class="sidebar__wrapper">
							<x-heading.small-component class="mb-4">Articoli</x-heading.small-component>
							<section class="orders">
								<livewire:cart.order-item-list :$orderItems />
							</section>
						</div>

						<!-- Recap -->
						<div class="sidebar__wrapper">
							<livewire:cart.recap :cart="cart()" />
						</div>
					</div>
				</div>
			</aside>
		</div>
	</div>
</x-layouts.legacy-main>
