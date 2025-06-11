<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product\ProductType;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ShopController extends Controller {

	/**
	 * Display the shop page.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\View\View
	 */
	public function index(Request $request): View {
		return view('shop', [
			'title' => 'Catalogo',
			'location' => 'shop'
		]);
	}
}
