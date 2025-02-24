<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Page;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; // Use GD (or Imagick\Driver for Imagick)
use Illuminate\Support\Facades\Storage;

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

    /* Store a new slider */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'image' => 'required|image',
    //         'title' => 'required|string|max:255',
    //         'description' => 'nullable|string',
    //         'url' => 'nullable|url',
    //         'page_id' => 'required|exists:pages,id',
    //     ]);

    //     $path = $request->file('image')->store('sliders', 'public'); // Store the image

    //     Slider::create([
    //         'image' => $path,
    //         'title' => $request->title,
    //         'description' => $request->description,
    //         'url' => $request->url,
    //         'page_id' => $request->page_id,
    //     ]);

    //     return redirect()->route('sliders.index')->with('success', 'Slider created successfully');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'nullable|url',
            'page_id' => 'required|exists:pages,id',
        ]);
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // Generate unique filename
            $filename = time() . '.webp';
            $path = 'sliders/' . $filename;
    
            // Create ImageManager instance with GD driver
            $manager = new ImageManager(new Driver()); 
    
            // Process image (resize & convert to WebP)
            $img = $manager->read($image->getPathname())
                ->scale(width: 1200) // Resize while maintaining aspect ratio
                ->toWebp(80); // Convert to WebP with 80% quality
    
            // Save to storage
            Storage::disk('public')->put($path, (string) $img);
    
            // Store in database
            Slider::create([
                'image' => $path, // Save WebP image path
                'title' => $request->title,
                'description' => $request->description,
                'url' => $request->url,
                'page_id' => $request->page_id,
            ]);
    
            return redirect()->route('sliders.index')->with('success', 'Slider created successfully with WebP image.');
        }
    
        return redirect()->route('sliders.index')->with('error', 'Image upload failed.');
    }

    // Show the edit form
    public function edit(Slider $slider)
    {
        $pages = Page::all(); // Get all pages to associate with the slider
        return view('backend.admin.sliders.edit', compact('slider', 'pages'));
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
        // Check if image exists and delete it from storage
        if ($slider->image && Storage::disk('public')->exists($slider->image)) {
            Storage::disk('public')->delete($slider->image);
        }
    
        // Delete the slider record from database
        $slider->delete();
    
        return redirect()->route('sliders.index')->with('success', 'Slider deleted successfully with image.');
    }
}