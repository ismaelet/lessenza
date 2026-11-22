@props(['oil'])

<article class="oil-card">
    <a href="{{ route('essential-oils.show', $oil['slug']) }}" class="oil-card__link">
        <div class="oil-card__image-wrapper">
            <img src="{{ asset('oli-essenziali/'.$oil['anteprima']) }}" alt="{{ $oil['olio'] }}" loading="lazy" />
        </div>
        <div class="oil-card__body">
            <x-heading.small-component>{{ $oil['olio'] }}</x-heading.small-component>
            <p class="text-sm italic">{{ $oil['nome_latino'] }}</p>
            <p>{{ $oil['profumo'] }}</p>
            <div class="oil-card__price">
                <span
                    >da <strong class="text-heading-400">{{ $oil['varianti'][0]['prezzo_iva_esclusa'] }} €</strong>
                    <small>+ IVA</small></span>
                <span class="text-secondary-300">Scopri →</span>
            </div>
        </div>
    </a>
</article>
