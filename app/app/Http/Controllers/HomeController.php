<?php

namespace App\Http\Controllers;

use App\Support\EssentialOilCatalogue;
use App\Support\StorefrontItem;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index(Request $request, EssentialOilCatalogue $catalogue): View
    {
        return view('home', [
            'location' => 'home',
            'essentialOils' => $catalogue->all()->map(fn (array $oil) => new StorefrontItem($oil))->values(),
        ]);
    }
}
