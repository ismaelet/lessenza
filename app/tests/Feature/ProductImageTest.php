<?php

use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Vite;

it('uses the public storage URL for product images in production', function () {
    app()->instance('env', 'production');
    Storage::fake('public');
    Storage::disk('public')->put('products/8-1024.webp', 'image');

    $product = new Product;
    $product->id = 8;

    expect(parse_url($product->image, PHP_URL_PATH))->toBe('/storage/products/8-1024.webp');
});

it('provides a path relative to the public disk for admin product images', function () {
    $product = new Product;
    $product->id = 8;

    expect($product->storage_image_path)->toBe('products/8-1024.webp');
});

it('uses the base catalogue image for either oil size at all image resolutions', function (string $size) {
    Storage::fake('public');
    $product = new Product;
    $product->id = 9999;
    $product->slug = 'olio-essenziale-anice-'.$size;
    $expected = asset('oli-essenziali/immagini/anteprima/Anice.jpg');

    expect($product->image)->toBe($expected);
    foreach ([100, 400, 1024] as $resolution) {
        expect($product->getImage($resolution))->toBe($expected);
    }
})->with(['30ml', '100ml']);

it('keeps uploaded product images ahead of the catalogue fallback', function () {
    Storage::fake('public');
    Storage::disk('public')->put('products/9999-1024.webp', 'uploaded image');
    $product = new Product;
    $product->id = 9999;
    $product->slug = 'olio-essenziale-anice-100ml';

    expect(parse_url($product->image, PHP_URL_PATH))->toBe('/storage/products/9999-1024.webp');
});

it('retains the placeholder for unknown oil slugs', function () {
    Storage::fake('public');
    $product = new Product;
    $product->id = 9999;
    $product->slug = 'olio-essenziale-unknown-30ml';

    expect($product->image)->toBe(Vite::image('no-image.webp'));
});

it('renders the oil base image in cart line items', function () {
    Storage::fake('public');
    $product = new Product;
    $product->id = 9999;
    $product->name = 'Anice Aufguss 100 ml';
    $product->slug = 'olio-essenziale-anice-100ml';
    $line = new OrderItem;
    $line->id = 1;
    $line->quantity = 1;
    $line->unit_price_net = 35.9;
    $line->setRelation('product', $product);

    $html = view('livewire.cart.order-item-list', [
        'orderItems' => new Collection([$line]),
        'editable' => false,
    ])->render();

    expect($html)->toContain(asset('oli-essenziali/immagini/anteprima/Anice.jpg'));
});
