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
	</style>
@endpushOnce

<x-layouts.legacy-main>
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

		<!-- Page body -->
		<div class="page-body">
			<!-- Page content -->
			<div class="page-content">

				<form
					method="POST"
					action="{{ route('cart.update') }}"
				>
					@csrf
					<div class="grid gap-8">
						<!-- Shipping address -->
						<section class="address">
							<x-heading.small-component class="mb-4">Indirizzo</x-heading.small-component>

							<div class="form-panel grid gap-4">
								<div class="form-row">
									<x-label label="Nominativo:" />
									<x-input
										name="full_name"
										placeholder="Nominativo di spedizione"
										:value="$address->full_name ?? ''"
										required
									/>
								</div>
								<div class="form-row md:grid-cols-4">
									<x-label
										label="Indirizzo:"
										class="md:col-span-full"
									/>
									<x-input
										name="street"
										placeholder="Indirizzo"
										class="md:col-span-3"
										:value="$address->street ?? ''"
										required
									/>
									<x-input
										name="number"
										placeholder="Numero civico"
										class="md:col-span-1"
										:value="$address->number ?? ''"
									/>
									<x-input
										name="city"
										placeholder="Città"
										class="md:col-span-4"
										:value="$address->city ?? ''"
										required
									/>
									<x-input
										name="zip"
										placeholder="CAP"
										class="md:col-span-2"
										:value="$address->zip ?? ''"
										required
									/>
									<x-input
										name="region"
										placeholder="Provincia"
										class="md:col-span-2"
										:value="$address->region ?? ''"
										required
									/>
								</div>
								<div class="form-row">
									<x-label label="Contatti:" />
									<x-input
										name="email"
										placeholder="Email"
										type="email"
										:value="$address->email ?? ''"
										required
									/>
									<x-input
										name="phone"
										placeholder="Telefono"
										:value="$address->phone ?? ''"
										required
									/>
								</div>
								<div class="form-row">
									<x-label label="Note aggiuntive:" />
									<x-textarea
										name="notes"
										placeholder="Note aggiuntive"
										:value="$address->notes ?? ''"
									/>
								</div>
						</section>

						<!-- Shipping method -->
						<section class="shipping-methods">
							<x-heading.small-component>Spedizione</x-heading.small-component>

							<div class="shipping-method__list">

								@foreach ($shippingMethods as $shippingMethod)
									<x-cart.shipping-method
										:shippingMethod="$shippingMethod"
										:cart="$cart"
									/>
								@endforeach

							</div>
						</section>

						<div class="">
							<x-button
								type="submit"
								class="button"
								name="advance"
							>Procedi</x-button>
						</div>
					</div>
				</form>

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
							<section class="recap">
								<div class="recap-row">
									<p class="recap-text">Prodotti</p>
									<p class="recap-price js-cart-product-price-string">{{ price($cart->item_price) }}</p>
								</div>

								<div class="recap-row">
									<p class="recap-text">Spedizione</p>
									<p
										class="recap-price js-recap-shipping-field js-cart-shipping-price-string"
										data-shipping-method-id="{{ $cart->shippingMethodId }}"
									>{{ price($cart->shipping_fee) }}</p>
								</div>

								<div class="recap-row recap-row_total">
									<p class="recap-text">Totale</p>
									<p class="recap-price js-cart-price-string">{{ price($cart->price) }}</p>
								</div>
							</section>
						</div>
					</div>
				</div>
			</aside>
		</div>
	</div>
</x-layouts.legacy-main>
