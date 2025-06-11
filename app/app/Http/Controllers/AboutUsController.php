<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AboutUsController extends Controller {

	/**
	 * Display the about us page.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index(): View {
		return view('about-us', [
			'title' => 'Chi siamo',
			'location' => 'about-us',
		]);
	}
}
