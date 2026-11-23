<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Support\EssentialOilCatalogue;
use App\Support\StorefrontItem;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EssentialOilController extends Controller
{
    public function index(Request $request, EssentialOilCatalogue $catalogue): View
    {
        $query = trim($request->string('q')->toString());
        $oils = $catalogue->all();

        return view('essential-oils.index', [
            'title' => __('Oli essenziali Aufguss'),
            'location' => 'essential-oils',
            'query' => $query,
            'total' => $oils->count(),
            'oils' => $catalogue->search($query),
        ]);
    }

    public function show(string $slug, EssentialOilCatalogue $catalogue): View
    {
        $oils = $catalogue->all();
        $oil = $oils->firstWhere('slug', $slug);
        abort_unless($oil, 404);
        $item = new StorefrontItem($oil);

        return view('product', [
            'title' => $oil['olio'].' · '.__('Oli essenziali Aufguss'),
            'location' => 'essential-oils',
            'item' => $item,
            'purchaseProducts' => Product::whereIn('slug', array_column($item->variants, 'productSlug'))->get()->keyBy('slug'),
            'related' => $oils->where('slug', '!=', $slug)->take(4)->map(fn (array $related) => new StorefrontItem($related)),
        ]);
    }
}
