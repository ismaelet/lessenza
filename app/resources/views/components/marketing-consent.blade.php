<x-checkbox name="marketing_opt_in" :checked="old('marketing_opt_in', false)">
    <x-slot:label>
        {{ __('Desidero ricevere') }} <span class="text-primary-400 font-bold">{{ __('comunicazioni promozionali') }}</span>, <span class="text-primary-400 font-bold">{{ __('offerte') }}</span> {{ __('e aggiornamenti su prodotti e servizi e acconsento al trattamento dei miei dati personali per finalità di marketing.') }}
    </x-slot:label>
</x-checkbox>
