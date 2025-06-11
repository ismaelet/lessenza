<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller {

	/**
	 * Display the home page.
	 *
	 * @param Request $request
	 * @return View
	 */
	public function index(Request $request): View {
		return view('home', [
			'location' => 'home',
		]);
	}
}
