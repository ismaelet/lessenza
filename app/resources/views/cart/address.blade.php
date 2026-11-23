<x-layouts.cart>
    <form method="POST" action="{{ route('cart.address.store') }}">
        @csrf

        <div class="grid gap-8">
            <!-- Shipping address -->
            <section
                class="address"
                x-data="{ is_company: {{ old('is_company', $address?->is_company ?? true) ? 'true' : 'false' }} }"
            >
                <x-heading.small-component-sans class="mb-4"> {{ __('Indirizzo') }}</x-heading.small-component-sans>

                <div class="form-panel mt-8 grid gap-4">
                    <div class="flex flex-wrap gap-4">
                        <x-checkbox
                            type="radio"
                            name="is_company"
                            label="{{ __('Azienda') }}"
                            value="1"
                            :checked="$address?->is_company ?? true"
                            x-on:click="is_company = true"
                        />

                        <x-checkbox
                            type="radio"
                            name="is_company"
                            label="{{ __('Privato') }}"
                            value="0"
                            :checked="! ($address?->is_company ?? true)"
                            x-on:click="is_company = false"
                        />
                    </div>

                    <div class="form-row">
                        <x-label><span x-text="is_company ? 'Dati aziendali:' : 'Dati personali:'"></span></x-label>
                        <x-input
                            name="full_name"
                            placeholder="{{ __('Nominativo di spedizione') }}"
                            maxlength="255"
                            :value="$address?->full_name ?? ''"
                            required
                        />
                        <x-input
                            name="vat_number"
                            placeholder="{{ __('Partita IVA') }}"
                            maxlength="11"
                            :value="$address?->vat_number ?? ''"
                            x-bind:required="is_company"
                            x-show="is_company"
                        />
                        <x-input
                            name="cu"
                            placeholder="{{ __('Codice Univoco') }}"
                            maxlength="6"
                            :value="$address?->cu ?? ''"
                            x-bind:required="is_company"
                            x-show="is_company"
                        />
                        <x-input
                            name="cf"
                            placeholder="{{ __('Codice Fiscale') }}"
                            maxlength="16"
                            :value="$address?->cf ?? ''"
                            x-bind:required="! is_company"
                            x-show="! is_company"
                            x-cloak
                        />
                    </div>
                    <div class="form-row md:grid-cols-4">
                        <x-label label="{{ __('Indirizzo:') }}" class="md:col-span-full" />
                        <x-input
                            name="street"
                            placeholder="{{ __('Indirizzo') }}"
                            class="md:col-span-3"
                            maxlength="255"
                            :value="$address?->street ?? ''"
                            required
                        />
                        <x-input
                            name="number"
                            placeholder="{{ __('Numero civico') }}"
                            class="md:col-span-1"
                            maxlength="255"
                            :value="$address?->number ?? ''"
                        />
                        <x-input
                            name="city"
                            placeholder="{{ __('Città') }}"
                            class="md:col-span-4"
                            maxlength="255"
                            :value="$address?->city ?? ''"
                            required
                        />
                        <x-input
                            name="zip"
                            placeholder="{{ __('CAP') }}"
                            class="md:col-span-2"
                            maxlength="5"
                            :value="$address?->zip ?? ''"
                            required
                        />
                        <livewire:cart.region-selector />
                    </div>
                    <div class="form-row">
                        <x-label label="{{ __('Email:') }}" />
                        <x-input
                            name="email"
                            placeholder="{{ __('Indirizzo Email') }}"
                            type="email"
                            maxlength="255"
                            :value="$address?->email ?? ''"
                            required
                        />
                        <x-input
                            name="pec"
                            placeholder="{{ __('Indirizzo PEC') }}"
                            type="email"
                            maxlength="255"
                            :value="$address?->pec ?? ''"
                            x-bind:required="is_company"
                            x-bind:placeholder="is_company ? '{{ __('Indirizzo PEC') }}' : '{{ __('Indirizzo PEC (opzionale)') }}'"
                        />
                    </div>
                    <div class="form-row">
                        <x-label label="{{ __('Telefono:') }}" />
                        <x-input
                            name="phone"
                            placeholder="{{ __('Telefono') }}"
                            maxlength="255"
                            :value="$address?->phone ?? ''"
                        />
                    </div>
                    <div class="form-row">
                        <x-label label="{{ __('Note aggiuntive:') }}" />
                        <x-textarea
                            name="notes"
                            placeholder="{{ __('Note aggiuntive') }}"
                            :value="$address?->notes ?? ''"
                        />
                    </div>
                </div>
            </section>

            <!-- Shipping method -->
            <section class="shipping-methods">
                <x-heading.small-component-sans>{{ __('Spedizione') }}</x-heading.small-component-sans>

                <div class="shipping-method__list">
                    @foreach ($shippingMethods as $shippingMethod)
                        <livewire:cart.shipping-method :shippingMethod="$shippingMethod" :cart="$cart" />
                    @endforeach
                </div>
            </section>

            <div class="">
                <x-checkbox
                    name="accept_terms"
                    :checked="old('accept_terms', $address?->accept_terms ?? false)"
                    :required="true"
                >
                    <x-slot:label>
                        {{ __('Dichiaro di aver letto ed accettato i termini e le condizioni di vendita indicate') }}
                        <a class="text-link" href="{{ route('terms') }}" target="_blank">{{ __('qui') }}</a>
                    </x-slot:label>
                </x-checkbox>
            </div>

            <div class="flex justify-end">
                <x-button type="submit" class="button" name="advance">{{ __('Procedi') }}</x-button>
            </div>
        </div>
    </form>
</x-layouts.cart>
