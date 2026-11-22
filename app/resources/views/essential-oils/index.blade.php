@pushOnce('styles')
    @vite('resources/css/storefront/essential-oils.css')
@endpushOnce

<x-layouts.legacy-main
    :$title
    :$location
    description="{{ __('Scopri i 16 oli essenziali per Aufguss di L’Essenza: formati da 30 ml e 100 ml, consigli d’uso e schede di sicurezza scaricabili.') }}"
>
    {{-- <nav aria-label="{{ __('Percorso') }}" class="oil-breadcrumb">
        <a href="{{ route('home') }}">Home</a><span aria-hidden="true"> / </span
        ><span>{{ __('Oli essenziali Aufguss') }}</span>
    </nav> --}}

    <section class="oil-hero mt-12">
        <div class="oil-hero__text dark">
            <p class="oil-eyebrow">{{ __('Linea Aufguss · :count fragranze', ['count' => $total]) }}</p>
            <x-heading.main>{{ __('Oli essenziali puri per le gettate in sauna') }}</x-heading.main>
            <p class="opacity-80">
                {{ __('Creati per Aufgussmeister e centri benessere. Profumi intensi che restano nell\'aria, in formato 30 ml e 100 ml, con scheda di sicurezza scaricabile per ogni olio.') }}
            </p>
            <x-button href="#oli">{{ __('Scopri le fragranze') }}</x-button>
        </div>
        <div class="oil-hero__image-wrapper relative">
            <img
                class="oil-hero__image absolute"
                src="{{ asset('oli-essenziali/immagini/aufguss_meister_banner.png') }}"
                alt="{{ __('Aufgussmeister durante una gettata in sauna') }}"
                fetchpriority="high"
            />
        </div>
    </section>

    <section class="oil-benefits" aria-label="{{ __('La linea Aufguss') }}">
        <div>
            <x-heading.small-component>{{ __('100% oli essenziali') }}</x-heading.small-component>
            <p>{{ __('Nessun alcol: solo oli essenziali puri, codice CAS in ogni scheda.') }}</p>
        </div>
        <div>
            <x-heading.small-component>{{ __('Etichette a norma CLP') }}</x-heading.small-component>
            <p>{{ __('Etichette, indicazioni di pericolo e schede di sicurezza per ogni prodotto.') }}</p>
        </div>
        <div>
            <x-heading.small-component>{{ __('Due formati') }}</x-heading.small-component>
            <p>{{ __('30 ml per provare, 100 ml per l\'uso quotidiano in SPA.') }}</p>
        </div>
    </section>

    <section id="oli" class="oil-catalogue">
        <div class="oil-tools">
            <div class="grid gap-3">
                <x-subheading.section>{{ __('La collezione') }}</x-subheading.section>
                <x-heading.section>{{ __('Le :count fragranze', ['count' => $total]) }}</x-heading.section>
            </div>
            <form action="{{ route('essential-oils.index') }}#oli" method="GET" role="search" class="oil-search">
                <label for="oil-search">{{ __('Cerca un olio o un profumo') }}</label>
                <div class="flex flex-wrap gap-2">
                    <x-input
                        id="oil-search"
                        type="search"
                        name="q"
                        :value="$query"
                        placeholder="{{ __('Nome, pianta o nota olfattiva…') }}"
                    />
                    <x-button type="submit" size="sm">{{ __('Cerca') }}</x-button>
                </div>
                @if ($query !== '')
                    <a
                        href="{{ route('essential-oils.index') }}#oli"
                        class="underline"
                    >{{ __('Mostra tutte le fragranze') }}</a>
                @endif
            </form>
        </div>
        @if ($oils->isEmpty())
            <p role="status">{{ __('Nessun olio trovato. Prova con un altro nome o profumo.') }}</p>
        @else
            <div class="oil-grid">
                @foreach ($oils as $oil)
                    <x-essential-oil-card :$oil />
                @endforeach
            </div>
        @endif
    </section>
</x-layouts.legacy-main>
