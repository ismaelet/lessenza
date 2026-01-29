<x-layouts.cart>
	<form
		method="POST"
		action="{{ route('cart.address.store') }}"
	>
		@csrf

		<div class="grid gap-8">
			<!-- Shipping address -->
			<section
				class="address"
				x-data="{ is_company: {{ old('is_company', $address?->is_company ?? true) ? 'true' : 'false' }} }"
			>
				<x-heading.small-component class="mb-4">Indirizzo</x-heading.small-component>

				<div class="form-panel mt-8 grid gap-4">
					<div class="flex flex-wrap gap-4">
						<x-checkbox
							type="radio"
							name="is_company"
							label="Azienda"
							value="1"
							:checked="$address?->is_company ?? true"
							x-on:click="is_company = true"
						/>

						<x-checkbox
							type="radio"
							name="is_company"
							label="Privato"
							value="0"
							:checked="!($address?->is_company ?? true)"
							x-on:click="is_company = false"
						/>
					</div>

					<div class="form-row">
						<x-label><span x-text="is_company ? 'Dati aziendali:' : 'Dati personali:'"></span></x-label>
						<x-input
							name="full_name"
							placeholder="Nominativo di spedizione"
							:value="$address?->full_name ?? ''"
							required
						/>
						<x-input
							name="vat_number"
							placeholder="Partita IVA"
							maxlength="11"
							:value="$address?->vat_number ?? ''"
							x-bind:required="is_company"
							x-show="is_company"
						/>
						<x-input
							name="cu"
							placeholder="Codice Univoco"
							maxlength="6"
							:value="$address?->cu ?? ''"
							x-bind:required="is_company"
							x-show="is_company"
						/>
						<x-input
							name="cf"
							placeholder="Codice Fiscale"
							maxlength="16"
							:value="$address?->cf ?? ''"
							x-bind:required="!is_company"
							x-show="!is_company"
							x-cloak
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
							:value="$address?->street ?? ''"
							required
						/>
						<x-input
							name="number"
							placeholder="Numero civico"
							class="md:col-span-1"
							:value="$address?->number ?? ''"
						/>
						<x-input
							name="city"
							placeholder="Città"
							class="md:col-span-4"
							:value="$address?->city ?? ''"
							required
						/>
						<x-input
							name="zip"
							placeholder="CAP"
							class="md:col-span-2"
							:value="$address?->zip ?? ''"
							required
						/>
						<livewire:cart.region-selector />
					</div>
					<div class="form-row">
						<x-label label="Email:" />
						<x-input
							name="email"
							placeholder="Indirizzo Email"
							type="email"
							:value="$address?->email ?? ''"
							required
						/>
						<x-input
							name="pec"
							placeholder="Indirizzo PEC"
							type="email"
							:value="$address?->pec ?? ''"
							x-bind:required="is_company"
							x-bind:placeholder="is_company ? 'Indirizzo PEC' : 'Indirizzo PEC (opzionale)'"
						/>
					</div>
					<div class="form-row">
						<x-label label="Telefono:" />
						<x-input
							name="phone"
							placeholder="Telefono"
							:value="$address?->phone ?? ''"
						/>
					</div>
					<div class="form-row">
						<x-label label="Note aggiuntive:" />
						<x-textarea
							name="notes"
							placeholder="Note aggiuntive"
							:value="$address?->notes ?? ''"
						/>
					</div>
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
