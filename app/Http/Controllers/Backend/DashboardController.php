<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Slider;
use App\Models\Bloc;

class DashboardController extends Controller
{
    public function index()
    {
        $pageCount = Page::count();
        $sliderCount = Slider::count();
        $blocCount = Bloc::count();

        return view('backend.admin.dashboard', compact('pageCount', 'sliderCount', 'blocCount'));
    }
}
