<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller {

	/**
	 * Display the reviews page.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index(): \Illuminate\View\View {
		$reviews = Review::latest()->get();

		return view('reviews', [
			'title' => 'Recensioni',
			'location' => 'reviews',
			'reviews' => $reviews,
		]);
	}
}
