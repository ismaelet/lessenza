<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\View\View;

class ReviewController extends Controller
{
    /**
     * Display the reviews page.
     */
    public function index(): View
    {
        $reviews = Review::latest()->get();

        return view('reviews', [
            'title' => 'Recensioni',
            'location' => 'reviews',
            'reviews' => $reviews,
        ]);
    }
}
