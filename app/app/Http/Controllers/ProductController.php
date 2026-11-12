<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display the product page.
     */
    public function show(Product $product): View
    {
        return view('product', [
            'title' => $product->name,
            'location' => 'shop',
            'product' => $product,
        ]);
    }
}
