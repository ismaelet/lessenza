<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller {

	/**
	 * Display the product page.
	 * 
	 * @return \Illuminate\View\View
	 */
	public function show(Product $product): \Illuminate\View\View {
		return view('product', [
			'title' => $product->name,
			'location' => 'shop',
			'product' => $product,
		]);
	}
}
