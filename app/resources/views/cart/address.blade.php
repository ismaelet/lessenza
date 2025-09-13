<x-layouts.cart>
	<form
		method="POST"
		action="{{ route('cart.address.store') }}"
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
						<livewire:cart.region-selector />
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
						<livewire:cart.shipping-method
							:shippingMethod="$shippingMethod"
							:cart="$cart"
						/>
					@endforeach

				</div>
			</section>

			<div class="flex justify-end">
				<x-button
					type="submit"
					class="button"
					name="advance"
				>Procedi</x-button>
			</div>
		</div>
	</form>
</x-layouts.cart>
