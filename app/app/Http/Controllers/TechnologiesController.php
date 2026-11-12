<?php

namespace App\Http\Controllers;

use App\Models\Product;

class TechnologiesController extends Controller
{
    /**
     * Display a listing of the resource
     */
    public function index()
    {
        $location = 'technologies';
        $title = 'Tecnologie';

        $products = Product::whereHas('product_type', fn ($query) => $query->where('name', 'Kit'))->latest()->get();

        return view('technologies.index', compact('location', 'title', 'products'));
    }
}
