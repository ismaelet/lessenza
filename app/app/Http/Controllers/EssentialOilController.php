<?php

namespace App\Http\Controllers;

use App\Support\EssentialOilCatalogue;
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

        return view('essential-oils.show', [
            'title' => $oil['olio'].' · '.__('Oli essenziali Aufguss'),
            'location' => 'essential-oils',
            'oil' => $oil,
            'related' => $oils->where('slug', '!=', $slug)->take(4),
        ]);
    }
}
