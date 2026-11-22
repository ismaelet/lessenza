@pushOnce('styles')
    @vite('resources/css/storefront/essential-oils.css')
@endpushOnce

<x-layouts.legacy-main :$title :$location :description="$oil['descrizione']">
    <nav aria-label="{{ __('Percorso') }}" class="oil-breadcrumb">
        <a href="{{ route('home') }}">Home</a><span aria-hidden="true"> / </span>
        <a href="{{ route('essential-oils.index') }}">{{ __('Oli essenziali Aufguss') }}</a><span aria-hidden="true"> / </span>
        <span>{{ $oil['olio'] }}</span>
    </nav>

    <section class="oil-product" x-data="{ selected: 0 }">
        <div class="oil-gallery">
            @foreach ($oil['varianti'] as $index => $variant)
                <img
                    x-show="selected === {{ $index }}"
                    @if ($index !== 0) style="display: none" @endif
                    src="{{ asset('oli-essenziali/'.$variant['immagine']) }}"
                    alt="{{ __('Etichetta :oil :size', ['oil' => $oil['olio'], 'size' => $variant['formato']]) }}"
                    class="oil-label"
                />
            @endforeach
            <img
                src="{{ asset('oli-essenziali/'.$oil['anteprima']) }}"
                alt="{{ $oil['olio'] }}"
                class="oil-gallery__preview"
                loading="lazy"
            />
        </div>
        <div class="oil-product__info">
            <p class="oil-eyebrow">{{ __('Oli essenziali · Linea Aufguss') }}</p>
            <x-heading.main>{{ $oil['olio'] }}</x-heading.main>
            <p class="italic">{{ $oil['nome_latino'] }}</p>
            <p class="oil-scent">{{ $oil['profumo'] }}</p>
            <p>{{ $oil['descrizione'] }}</p>
            <fieldset class="oil-formats">
                <legend>{{ __('Scegli il formato') }}</legend>
                @foreach ($oil['varianti'] as $index => $variant)
                    <label>
                        <input
                            type="radio"
                            name="formato"
                            value="{{ $index }}"
                            x-model.number="selected"
                            @checked($index === 0)
                        />
                        <span>{{ $variant['formato'] }}<strong>{{ $variant['prezzo_iva_esclusa'] }} €</strong></span>
                    </label>
                @endforeach
            </fieldset>
            <p class="text-sm">{{ __('Prezzi IVA esclusa · spedizione calcolata a parte') }}</p>
            @foreach ($oil['varianti'] as $index => $variant)
                <div
                    class="oil-enquiry"
                    x-show="selected === {{ $index }}"
                    @if ($index !== 0) style="display: none" @endif
                >
                    <x-button :href="route('contacts', ['olio' => $oil['slug'], 'formato' => $variant['formato']])">{{ __('Richiedi preventivo') }}</x-button>
                    <p class="text-sm">{{ __('Codice prodotto:') }} {{ $variant['codice'] }}</p>
                </div>
            @endforeach
            <div class="oil-usage">
                <strong class="text-heading-400">{{ __('Consiglio d\'uso') }}</strong>
                <p>{{ $oil['consiglio_uso'] }}</p>
            </div>
            <dl class="oil-meta">
                <div>
                    <dt>{{ __('Nome botanico') }}</dt>
                    <dd>{{ $oil['nome_latino'] }}</dd>
                </div>
                <div>
                    <dt>CAS</dt>
                    <dd>{{ $oil['cas'] }}</dd>
                </div>
                <div>
                    <dt>{{ __('Formati') }}</dt>
                    <dd>30 ml · 100 ml</dd>
                </div>
            </dl>
        </div>
    </section>

    <section class="oil-safety">
        <div class="grid gap-4">
            <x-subheading.section>{{ __('Documentazione') }}</x-subheading.section>
            <x-heading.section>{{ __('Informazioni di sicurezza') }}</x-heading.section>
            <p>
                {{ __('Elementi dell\'etichetta secondo il Regolamento CE 1272/2008 (CLP). Consulta l\'etichetta e la scheda di sicurezza prima dell\'uso.') }}
            </p>
        </div>
        <div class="oil-safety__body">
            <div class="grid content-start gap-3">
                <x-heading.small-component>{{ $oil['avvertenza'] }}</x-heading.small-component>
                <p>{{ $oil['pittogrammi'] }}</p>
                <p>{{ __('Consulta i pittogrammi sull\'etichetta del prodotto.') }}</p>
            </div>
            <p>{{ $oil['frasi_H'] }}</p>
        </div>
        <div class="oil-download">
            <strong class="text-heading-400">{{ __('Scheda di sicurezza') }} {{ $oil['olio'] }} (PDF)</strong>
            <x-button :href="asset('oli-essenziali/'.$oil['scheda_sicurezza'])" variant="secondary" size="sm" download
                >{{ __('Scarica SDS') }}</x-button>
        </div>
    </section>

    <section class="oil-related">
        <x-heading.section>{{ __('Altre fragranze') }}</x-heading.section>
        <div class="oil-grid">
            @foreach ($related as $oil)
                <x-essential-oil-card :$oil />
            @endforeach
        </div>
    </section>
</x-layouts.legacy-main>
