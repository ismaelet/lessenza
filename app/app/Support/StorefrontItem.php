<?php

namespace App\Support;

use App\Helpers\EcommerceHelper;
use App\Models\Product;

final readonly class StorefrontItem
{
    public ?Product $product;

    public string $name;

    public string $url;

    public string $image;

    public string $priceLabel;

    public bool $priceFrom;

    public string $category;

    public ?string $botanicalName;

    public ?string $scent;

    public string $descriptionHtml;

    public ?string $ingredients;

    public ?string $usageHtml;

    public ?string $warningsHtml;

    public array $variants;

    public int $selectedVariant;

    public array $gallery;

    public array $metadata;

    public ?array $safety;

    public string $collectionUrl;

    public string $collectionLabel;

    public function __construct(Product|array $source)
    {
        $product = $source instanceof Product ? $source : null;
        $oil = is_array($source) ? $source : $this->oilForProduct($source);
        $this->product = $product;
        $this->name = $product ? localized_text($product->name) : $oil['olio'];
        $this->url = $product ? $product->url() : route('essential-oils.show', $oil['slug']);
        $this->image = $oil ? asset('oli-essenziali/'.$oil['anteprima']) : $product->image;
        $this->priceLabel = $product ? $product->priceString() : $this->oilPrice($oil['varianti'][0]['prezzo_iva_esclusa']);
        $this->priceFrom = $product === null;
        $this->category = $oil ? __('Oli essenziali · Linea Aufguss') : localized_text($product->relationLoaded('product_type') ? $product->product_type?->name : '');
        $this->botanicalName = $oil['nome_latino'] ?? null;
        $this->scent = $oil['profumo'] ?? null;
        $this->descriptionHtml = $product ? ($this->optionalHtml($product->description) ?? '') : e($oil['descrizione']);
        $this->ingredients = $product && $this->hasContent($product->ingredients) ? localized_text($product->ingredients) : null;
        $this->usageHtml = $product ? $this->optionalHtml($product->uses) : e($oil['consiglio_uso']);
        $this->warningsHtml = $product ? $this->optionalHtml($product->warnings) : null;
        $this->collectionUrl = $product ? route('shop') : route('essential-oils.index');
        $this->collectionLabel = $product ? __('Catalogo') : __('Oli essenziali Aufguss');

        $variants = [];
        $selected = 0;
        foreach ($oil['varianti'] ?? [] as $index => $variant) {
            $productSlug = 'olio-essenziale-'.$oil['slug'].'-'.str_replace(' ', '', $variant['formato']);
            if ($product?->slug === $productSlug) {
                $selected = $index;
            }
            $variants[] = [
                'size' => $variant['formato'],
                'priceLabel' => $product?->slug === $productSlug ? $product->priceString() : $this->oilPrice($variant['prezzo_iva_esclusa']),
                'code' => $variant['codice'],
                'image' => asset('oli-essenziali/'.$variant['immagine']),
                'imageAlt' => __('Etichetta :oil :size', ['oil' => $oil['olio'], 'size' => $variant['formato']]),
                'enquiryUrl' => route('contacts', ['olio' => $oil['slug'], 'formato' => $variant['formato']]),
                'productUrl' => $product ? route('product.show', $productSlug) : null,
            ];
        }
        $this->variants = $variants;
        $this->selectedVariant = $selected;
        $this->gallery = array_merge([['src' => $this->image, 'alt' => $this->name, 'variant' => null]], $oil ? array_map(fn (array $variant, int $index) => [
            'src' => $variant['image'], 'alt' => $variant['imageAlt'], 'variant' => $index,
        ], $variants, array_keys($variants)) : []);
        $this->metadata = $oil ? [
            __('Nome botanico') => $oil['nome_latino'],
            'CAS' => $oil['cas'],
            __('Formati') => implode(' · ', array_column($variants, 'size')),
        ] : [];
        $this->safety = $oil ? [
            'warning' => $oil['avvertenza'],
            'pictograms' => $oil['pittogrammi'],
            'hazards' => $oil['frasi_H'],
            'url' => asset('oli-essenziali/'.$oil['scheda_sicurezza']),
        ] : null;
    }

    private function oilForProduct(Product $product): ?array
    {
        if (! preg_match('/^olio-essenziale-(.+)-(?:30|100)ml$/', $product->slug ?? '', $matches)) {
            return null;
        }

        return app(EssentialOilCatalogue::class)->all()->firstWhere('slug', $matches[1]);
    }

    private function oilPrice(string $price): string
    {
        return EcommerceHelper::formatPrice((float) str_replace(',', '.', $price));
    }

    private function hasContent(?string $value): bool
    {
        return preg_replace('/[\s\x{00a0}]+/u', '', html_entity_decode(strip_tags($value ?? ''), ENT_QUOTES, 'UTF-8')) !== '';
    }

    private function optionalHtml(?string $value): ?string
    {
        return $this->hasContent($value) ? localized_html($value) : null;
    }
}
