<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller
{
    /**
     * Display the shop page
     */
    public function index(Request $request): View
    {
        return view('shop', [
            'title' => 'Catalogo',
            'location' => 'shop',
        ]);
    }
}
