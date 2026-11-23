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
        <div class="item-gallery" x-data="{ selectedImage: 0 }">
            <div class="item-gallery__stage">
                @foreach ($item->gallery as $index => $image)
                    <img
                        x-show="selectedImage === {{ $index }}"
                        @if ($index !== 0) style="display: none" @endif
                        src="{{ $image['src'] }}"
                        alt="{{ $image['alt'] }}"
                        class="item-gallery__image"
                    />
                @endforeach
            </div>
            @if (count($item->gallery) > 1)
                <div class="item-gallery__thumbnails" role="group" aria-label="{{ __('Immagini del prodotto') }}">
                    @foreach ($item->gallery as $index => $image)
                        <button
                            type="button"
                            class="item-gallery__thumbnail"
                            @click="selectedImage = {{ $index }}"
                            :aria-pressed="(selectedImage === {{ $index }}).toString()"
                            aria-label="{{ $image['alt'] }}"
                        >
                            <img src="{{ $image['src'] }}" alt="" />
                        </button>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="item-detail__info product-data">
            <div class="">
                @if ($item->category)
                    <p class="item-eyebrow">{{ $item->category }}</p>
                @endif
                <x-heading.main>{{ $item->name }}</x-heading.main>
            </div>
            @if ($item->botanicalName)
                <p class="italic">{{ $item->botanicalName }}</p>
            @endif
            @if ($item->scent)
                <p class="item-scent bg-background-500 text-trim text-secondary-300 w-fit rounded-full px-3 py-3 text-sm font-medium">
                    {{ $item->scent }}
                </p>
            @endif
            @if ($item->descriptionHtml)
                <div class="item-description text-secondary-300">{!! $item->descriptionHtml !!}</div>
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
                        @if ($item->product->inStock)
                            <x-icon-checked />
                        @else
                            <x-icon-close-border />
                        @endif
                        <p>
                            {{ $item->product->inStock ? ($item->product->longDelivery() ? __('Disponibile su ordinazione') : __('Disponibile')) : __('Non disponibile') }}
                        </p>
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
                @if (! $item->variants)
                    <livewire:product.add-to-cart :product="$item->product" />
                @endif
            @endif
            @foreach ($item->variants as $index => $variant)
                <div
                    class="item-enquiry"
                    x-show="selected === {{ $index }}"
                    @if ($index !== $item->selectedVariant) style="display: none" @endif
                >
                    <div class="flex flex-wrap gap-4">
                        @isset($purchaseProducts[$variant['productSlug']])
                            <livewire:product.add-to-cart
                                :product="$purchaseProducts[$variant['productSlug']]"
                                label="Aggiungi all'ordine"
                                :show-quantity="$item->product !== null"
                                :key="'oil-cart-'.$purchaseProducts[$variant['productSlug']]->id"
                            />
                        @endisset
                        <x-button
                            :href="$variant['enquiryUrl']"
                            variant="secondary"
                        >{{ __('Richiedi preventivo') }}</x-button>
                    </div>
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
                    <strong class="text-heading-400">{{ $item->safety ? __('Consiglio d\'uso:') : __('Modalità d\'uso:') }}</strong>
                    <div class="text-secondary-300">{!! $item->usageHtml !!}</div>
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
                        <div>
                            <dt>{{ $label }}</dt>
                            <dd
                                @if ($label === __('Codice')) x-text="@js(array_column($item->variants, 'code'))[selected]" @endif
                            >
                                {{ $value }}
                            </dd>
                        </div>
                    @endforeach
                </dl>
            @endif
        </div>
    </section>

    @if ($item->safety)
        <section class="item-safety">
            <div class="grid gap-4">
                <x-heading.small-component>{{ __('Informazioni di sicurezza') }}</x-heading.small-component>
                <p>
                    {{ __('Elementi dell\'etichetta secondo il Regolamento CE 1272/2008 (CLP). Consulta l\'etichetta e la scheda di sicurezza prima dell\'uso.') }}
                </p>
            </div>
            <div class="item-safety__body">
                <div class="grid content-start gap-3">
                    <p class="item-safety__warning">{{ $item->safety['warning'] }}</p>
                    <div class="item-safety__symbols">
                        @foreach ($item->safety['symbols'] as $symbol)
                            <figure>
                                <img src="{{ $symbol['image'] }}" alt="{{ $symbol['label'] }}" width="64" height="64" loading="lazy" />
                                <figcaption><span>{{ $symbol['code'] }}</span>{{ $symbol['label'] }}</figcaption>
                            </figure>
                        @endforeach
                    </div>
                </div>
                <table class="item-safety__statements" aria-label="{{ __('Informazioni di sicurezza') }}">
                    <tbody>
                        @foreach ($item->safety['statements'] as $statement)
                            <tr><th scope="row">{{ $statement['code'] }}</th><td>{{ $statement['text'] }}</td></tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="item-download">
                <strong class="text-heading-400">{{ __('Scheda di sicurezza') }} {{ $item->name }} (PDF)</strong>
                <x-button
                    :href="$item->safety['url']"
                    variant="secondary"
                    size="sm"
                    download
                >{{ __('Scarica SDS') }}</x-button>
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
                event: 'view_item',
                ecommerce: {
                    items: [@js([
                        'item_name' => $item->name,
                        'item_id' => $item->product->sku(),
                        'price' => number_format($item->product->price(), 2, '.', ''),
                        'item_category' => $item->product->product_type->name ?? '',
                        'quantity' => 1,
                    ])],
                },
            });
        </script>
    @endif
</x-layouts.legacy-main>
