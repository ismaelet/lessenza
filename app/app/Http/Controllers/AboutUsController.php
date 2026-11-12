<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class AboutUsController extends Controller
{
    /**
     * Display the about us page.
     */
    public function index(): View
    {
        return view('about-us', [
            'title' => 'Chi siamo',
            'location' => 'about-us',
        ]);
    }
}
