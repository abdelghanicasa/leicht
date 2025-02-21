<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Page;
class SliderController extends Controller
{
    // Show all sliders
    // public function index()
    // {
    //     $sliders = Slider::all(); // Get all sliders
    //     return view('backend.admin.sliders.index', compact('sliders'));
    // }

    public function index()
    {
        $sliders = Slider::with('page')->get();  // Eager load the 'page' relationship
        return view('backend.admin.sliders.index', compact('sliders'));
    }

    // Show the create form
    public function create()
    {
        $pages = Page::all(); // Get all pages to associate with the slider
        return view('backend.admin.sliders.create', compact('pages'));
    }

    // Store a new slider
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'nullable|url',
            'page_id' => 'required|exists:pages,id',
        ]);

        $path = $request->file('image')->store('sliders', 'public'); // Store the image

        Slider::create([
            'image' => $path,
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
            'page_id' => $request->page_id,
        ]);

        return redirect()->route('sliders.index')->with('success', 'Slider created successfully');
    }

    // Show the edit form
    public function edit(Slider $slider)
    {
        $pages = Page::all(); // Get all pages to associate with the slider
        return view('sliders.edit', compact('slider', 'pages'));
    }

    // Update an existing slider
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'image' => 'nullable|image',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'nullable|url',
            'page_id' => 'required|exists:pages,id',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('sliders', 'public'); // Store the new image
            $slider->image = $path;
        }

        $slider->update([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
            'page_id' => $request->page_id,
        ]);

        return redirect()->route('sliders.index')->with('success', 'Slider updated successfully');
    }

    // Delete a slider
    public function destroy(Slider $slider)
    {
        $slider->delete();
        return redirect()->route('sliders.index')->with('success', 'Slider deleted successfully');
    }
}