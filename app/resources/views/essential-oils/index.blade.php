@pushOnce('styles')
    @vite('resources/css/storefront/essential-oils.css')
@endpushOnce

<x-layouts.legacy-main :$title :$location description="Scopri i 16 oli essenziali per Aufguss di L’Essenza: formati da 30 ml e 100 ml, consigli d’uso e schede di sicurezza scaricabili.">
    <nav aria-label="Percorso" class="oil-breadcrumb">
        <a href="{{ route('home') }}">Home</a><span aria-hidden="true"> / </span><span>Oli essenziali Aufguss</span>
    </nav>

    <section class="oil-hero">
        <div class="oil-hero__text dark">
            <p class="oil-eyebrow">Linea Aufguss · {{ $total }} fragranze</p>
            <x-heading.main>Oli essenziali puri per le gettate in sauna</x-heading.main>
            <p>Creati per Aufgussmeister e centri benessere. Profumi intensi che restano nell'aria, in formato 30 ml e 100 ml, con scheda di sicurezza scaricabile per ogni olio.</p>
            <x-button href="#oli">Scopri le fragranze</x-button>
        </div>
        <img class="oil-hero__image" src="{{ asset('oli-essenziali/immagini/aufguss_meister_banner.png') }}" alt="Aufgussmeister durante una gettata in sauna" width="1254" height="1254" fetchpriority="high" />
    </section>

    <section class="oil-benefits" aria-label="La linea Aufguss">
        <div>
            <x-heading.small-component>100% oli essenziali</x-heading.small-component>
            <p>Nessun alcol: solo oli essenziali puri, codice CAS in ogni scheda.</p>
        </div>
        <div>
            <x-heading.small-component>Etichette a norma CLP</x-heading.small-component>
            <p>Etichette, indicazioni di pericolo e schede di sicurezza per ogni prodotto.</p>
        </div>
        <div>
            <x-heading.small-component>Due formati</x-heading.small-component>
            <p>30 ml per provare, 100 ml per l'uso quotidiano in SPA.</p>
        </div>
    </section>

    <section id="oli" class="oil-catalogue">
        <div class="oil-tools">
            <div class="grid gap-3">
                <x-subheading.section>La collezione</x-subheading.section>
                <x-heading.section>Le {{ $total }} fragranze</x-heading.section>
                <p>Prezzi IVA esclusa · spedizione calcolata a parte</p>
            </div>
            <form action="{{ route('essential-oils.index') }}#oli" method="GET" role="search" class="oil-search">
                <label for="oil-search">Cerca un olio o un profumo</label>
                <div class="flex flex-wrap gap-2">
                    <x-input id="oil-search" type="search" name="q" :value="$query" placeholder="Nome, pianta o nota olfattiva…" />
                    <x-button type="submit" size="sm">Cerca</x-button>
                </div>
                @if ($query !== '')
                    <a href="{{ route('essential-oils.index') }}#oli" class="underline">Mostra tutte le fragranze</a>
                @endif
            </form>
        </div>
        @if ($oils->isEmpty())
            <p role="status">Nessun olio trovato. Prova con un altro nome o profumo.</p>
        @else
            <div class="oil-grid">
                @foreach ($oils as $oil)
                    <x-essential-oil-card :$oil />
                @endforeach
            </div>
        @endif
    </section>
</x-layouts.legacy-main>
