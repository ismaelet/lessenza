<?php

namespace App\View\Components;

use App\Models\Product;
use App\Support\StorefrontItem;
use Illuminate\View\Component;
use Illuminate\View\View;

class ProductCard extends Component
{
    public StorefrontItem $item;

    public function __construct(Product|array|StorefrontItem $product)
    {
        $this->item = $product instanceof StorefrontItem ? $product : new StorefrontItem($product);
    }

    public function render(): View
    {
        return view('components.product-card');
    }
}
