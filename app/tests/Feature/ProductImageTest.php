<?php

use App\Models\Product;
use Illuminate\Support\Facades\Storage;

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
