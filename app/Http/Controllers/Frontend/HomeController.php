<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home');
    }

    public function show($slug)
    {
        // Find the page by slug and eager load images, ordered by the 'order' field
        $page = Page::with(['images' => function ($query) {
            $query->orderBy('order'); // Sort images by 'order' field
        }])->where('slug', 'nos-univers')->firstOrFail();
    
        // Get the images and titles
        $images = $page->images;
        $titles = $images->pluck('title'); // Assuming each image has a 'title' attribute

        //print($images);
        // Return the view with the page, images, and titles
        return view('frontend.home', compact('page', 'images', 'titles'));
    }
}
