<article class="product-card">
    <a href="{{ $item->url }}" class="product-card__link">
        <div class="product-card__image-wrapper">
            <img class="product-card__image" src="{{ $item->image }}" alt="{{ $item->name }}" loading="lazy" />
        </div>
        <div class="product-card__body">
            <x-heading.small-component class="product-card__name">{{ $item->name }}</x-heading.small-component>
            @if ($item->botanicalName)
                <p class="text-sm italic">{{ $item->botanicalName }}</p>
            @endif
            @if ($item->scent)
                <p>{{ $item->scent }}</p>
            @endif
            <div class="product-card__footer">
                <span>
                    @if ($item->priceFrom) {{ __('da') }} @endif
                    <strong class="product-card__price">{{ $item->priceLabel }}</strong>
                    <small>{{ __('+ IVA') }}</small>
                </span>
                <span class="text-primary-400 text-sm font-semibold">{{ __('Scheda →') }}</span>
            </div>
        </div>
    </a>
</article>
