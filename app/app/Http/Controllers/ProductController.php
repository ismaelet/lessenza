<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Support\StorefrontItem;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display the product page.
     */
    public function show(Product $product): View
    {
        $product->loadMissing('product_type');

        return view('product', [
            'title' => $product->name,
            'location' => 'shop',
            'item' => new StorefrontItem($product),
            'purchaseProducts' => collect([$product])->keyBy('slug'),
            'related' => $product->relatedProducts()->map(fn (Product $related) => new StorefrontItem($related)),
        ]);
    }
}
