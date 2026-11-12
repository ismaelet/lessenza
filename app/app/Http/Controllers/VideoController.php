<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VideoController extends Controller
{
    /**
     * Display the list of videos.
     */
    public function index(Request $request): View
    {
        $videos = Video::all();

        return view('videos', [
            'title' => 'Video',
            'location' => 'videos',
            'videos' => $videos,
        ]);
    }
}
