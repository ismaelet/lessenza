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
        $oil = is_array($source) ? $source : app(EssentialOilCatalogue::class)->forProduct($source);
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
                'productSlug' => $productSlug,
                'enquiryUrl' => route('contacts', ['olio' => $oil['slug'], 'formato' => $variant['formato']]),
                'productUrl' => $product ? route('product.show', $productSlug) : null,
            ];
        }
        $this->variants = $variants;
        $this->selectedVariant = $selected;
        $this->gallery = array_merge([['src' => $this->image, 'alt' => $this->name]], $oil ? [[
            'src' => asset('oli-essenziali/'.$oil['varianti'][0]['immagine']),
            'alt' => __('Etichetta :oil :size', ['oil' => $oil['olio'], 'size' => $oil['varianti'][0]['formato']]),
        ]] : []);
        $this->metadata = $oil ? [
            __('Codice') => $variants[$selected]['code'],
            'CAS' => $oil['cas'],
            __('Formati') => implode(' · ', array_column($variants, 'size')),
        ] : [];
        $symbols = [];
        $statements = [];
        if ($oil) {
            preg_match_all('/\b(GHS\d{2})\s+([^,]+)/u', $oil['pittogrammi'], $symbols, PREG_SET_ORDER);
            preg_match_all('/\b((?:EU)?H\d{3})\s+(.+?)(?=\s+(?:EU)?H\d{3}\b|$)/su', $oil['frasi_H'], $statements, PREG_SET_ORDER);
        }
        $this->safety = $oil ? [
            'warning' => $oil['avvertenza'],
            'pictograms' => $oil['pittogrammi'],
            'hazards' => $oil['frasi_H'],
            'symbols' => array_map(fn (array $symbol) => [
                'code' => $symbol[1],
                'label' => trim($symbol[2]),
                'image' => asset('images/ghs/'.$symbol[1].'.png'),
            ], $symbols),
            'statements' => array_map(fn (array $statement) => [
                'code' => $statement[1],
                'text' => trim($statement[2]),
            ], $statements),
            'url' => asset('oli-essenziali/'.$oil['scheda_sicurezza']),
        ] : null;
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
