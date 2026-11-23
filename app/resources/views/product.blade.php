@pushOnce('styles')
    @vite('resources/css/storefront/product.css')
@endpushOnce

@if ($item->product)
    @pushOnce('scripts')
        @vite('resources/js/storefront/product.ts')
    @endpushOnce
@endif

<x-layouts.legacy-main :$title :$location :description="strip_tags($item->descriptionHtml)">
    <nav aria-label="{{ __('Percorso') }}" class="item-breadcrumb">
        <a href="{{ route('home') }}">Home</a><span aria-hidden="true"> / </span>
        <a href="{{ $item->collectionUrl }}">{{ $item->collectionLabel }}</a><span aria-hidden="true"> / </span>
        <span>{{ $item->name }}</span>
    </nav>

    <section class="item-detail" x-data="{ selected: {{ $item->selectedVariant }} }">
        <div class="item-gallery">
            @foreach ($item->gallery as $image)
                <img
                    @if ($image['variant'] !== null)
                        x-show="selected === {{ $image['variant'] }}"
                        @if ($image['variant'] !== $item->selectedVariant) style="display: none" @endif
                    @endif
                    src="{{ $image['src'] }}"
                    alt="{{ $image['alt'] }}"
                    @class(['item-label', 'product-spotlight product-img active' => $item->product !== null])
                />
            @endforeach
            @if ($item->variants)
                <img src="{{ $item->image }}" alt="{{ $item->name }}" class="item-gallery__preview" loading="lazy" />
            @endif
        </div>
        <div class="item-detail__info product-data">
            @if ($item->category)
                <p class="item-eyebrow">{{ $item->category }}</p>
            @endif
            <x-heading.main>{{ $item->name }}</x-heading.main>
            @if ($item->botanicalName)
                <p class="italic">{{ $item->botanicalName }}</p>
            @endif
            @if ($item->scent)
                <p class="item-scent">{{ $item->scent }}</p>
            @endif
            @if ($item->descriptionHtml)
                <div class="item-description">{!! $item->descriptionHtml !!}</div>
            @endif
            @if ($item->variants)
                <fieldset class="item-formats">
                    <legend>{{ __('Scegli il formato') }}</legend>
                    @foreach ($item->variants as $index => $variant)
                        <label>
                            <input
                                type="radio"
                                name="formato"
                                value="{{ $index }}"
                                x-model.number="selected"
                                @checked($index === $item->selectedVariant)
                                @if ($variant['productUrl']) @change="window.location.href = @js($variant['productUrl'])" @endif
                            />
                            <span>{{ $variant['size'] }}<strong>{{ $variant['priceLabel'] }}</strong></span>
                        </label>
                    @endforeach
                </fieldset>
            @endif

            @if ($item->product)
                <div class="grid gap-3">
                    <p class="product-price heading-like">
                        <span class="js-full-price text-600 font-heading text-heading-400 font-semibold">{{ $item->priceLabel }}</span>
                    </p>
                    <div @class(['product-availability flex items-center gap-1', 'text-good-400' => $item->product->inStock, 'text-bad-400' => ! $item->product->inStock])>
                        @if ($item->product->inStock) <x-icon-checked /> @else <x-icon-close-border /> @endif
                        <p>{{ $item->product->inStock ? ($item->product->longDelivery() ? __('Disponibile su ordinazione') : __('Disponibile')) : __('Non disponibile') }}</p>
                    </div>
                </div>
            @endif
            <p class="text-sm">{{ __('Prezzi IVA esclusa · spedizione calcolata a parte') }}</p>

            @if ($item->product)
                @if ($item->product->hasPromotion())
                    <x-banners.discount size="sm" />
                @endif
                @if ($item->product->canBeExtraConcentrated())
                    <livewire:product.extra-concentrated-check />
                @endif
                <livewire:product.add-to-cart :product="$item->product" />
            @endif
            @foreach ($item->variants as $index => $variant)
                <div class="item-enquiry" x-show="selected === {{ $index }}" @if ($index !== $item->selectedVariant) style="display: none" @endif>
                    <x-button :href="$variant['enquiryUrl']">{{ __('Richiedi preventivo') }}</x-button>
                    <p class="text-sm">{{ __('Codice prodotto:') }} {{ $variant['code'] }}</p>
                </div>
            @endforeach

            @if ($item->ingredients)
                <div class="grid gap-2">
                    <strong class="text-heading-400">{{ __('Ingredienti:') }}</strong>
                    <p class="italic">{{ $item->ingredients }}</p>
                </div>
            @endif
            @if ($item->usageHtml)
                <div class="item-usage">
                    <strong class="text-heading-400">{{ $item->safety ? __('Consiglio d\'uso') : __('Modalità d\'uso:') }}</strong>
                    <div>{!! $item->usageHtml !!}</div>
                </div>
            @endif
            @if ($item->warningsHtml)
                <div class="grid gap-2">
                    <strong class="text-heading-400">{{ __('Avvertenze:') }}</strong>
                    <div>{!! $item->warningsHtml !!}</div>
                </div>
            @endif
            @if ($item->metadata)
                <dl class="item-meta">
                    @foreach ($item->metadata as $label => $value)
                        <div><dt>{{ $label }}</dt><dd>{{ $value }}</dd></div>
                    @endforeach
                </dl>
            @endif
        </div>
    </section>

    @if ($item->safety)
        <section class="item-safety">
            <div class="grid gap-4">
                <x-subheading.section>{{ __('Documentazione') }}</x-subheading.section>
                <x-heading.section>{{ __('Informazioni di sicurezza') }}</x-heading.section>
                <p>{{ __('Elementi dell\'etichetta secondo il Regolamento CE 1272/2008 (CLP). Consulta l\'etichetta e la scheda di sicurezza prima dell\'uso.') }}</p>
            </div>
            <div class="item-safety__body">
                <div class="grid content-start gap-3">
                    <x-heading.small-component>{{ $item->safety['warning'] }}</x-heading.small-component>
                    <p>{{ $item->safety['pictograms'] }}</p>
                    <p>{{ __('Consulta i pittogrammi sull\'etichetta del prodotto.') }}</p>
                </div>
                <p>{{ $item->safety['hazards'] }}</p>
            </div>
            <div class="item-download">
                <strong class="text-heading-400">{{ __('Scheda di sicurezza') }} {{ $item->name }} (PDF)</strong>
                <x-button :href="$item->safety['url']" variant="secondary" size="sm" download>{{ __('Scarica SDS') }}</x-button>
            </div>
        </section>
    @endif

    @if ($related->isNotEmpty())
        <section class="item-related">
            <x-heading.section>{{ __('Altre fragranze') }}</x-heading.section>
            <div class="product-grid">
                @foreach ($related as $relatedItem)
                    <x-product-card :product="$relatedItem" />
                @endforeach
            </div>
        </section>
    @endif

    @if ($item->product && app()->environment('production'))
        <script defer>
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({
                event: "view_item",
                ecommerce: {
                    items: [@js([
                        'item_name' => $item->name,
                        'item_id' => $item->product->sku(),
                        'price' => number_format($item->product->price(), 2, '.', ''),
                        'item_category' => $item->product->product_type->name ?? '',
                        'quantity' => 1,
                    ])]
                }
            });
        </script>
    @endif
</x-layouts.legacy-main>
