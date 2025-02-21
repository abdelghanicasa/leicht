<?php
// PagesController
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Image;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


class PagesController extends Controller
{
    // Show all pages
    public function index()
    {
        $pages = Page::all();
        return view('backend.admin.pages.index', compact('pages'));
        
    }

    // Show form to create a new page
    public function create()
    {
        $categories = Category::all(); // Fetch all categories
        return view('backend.admin.pages.create', compact('categories')); // Pass categories to the view
    }

    // Store a new page in the database
    public function store(Request $request)
    {
        // Validate input data
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:pages,slug|max:255',
            'content' => 'required|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_categories' => 'nullable|array',
            'image_categories.*' => 'exists:categories,id|nullable',
        ]);
    
        // Ensure 'is_home' is explicitly set
        $isHome = $request->has('is_home') ? 1 : 0;
    
        // If this page is set as home, remove home from others
        if ($isHome) {
            Page::where('is_home', 1)->update(['is_home' => 0]);
        }
    
        // Store the page data
        $page = new Page();
        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->content = $request->content;
        $page->text_block_title = $request->text_block_title; // Save title if enabled
        $page->text_block_content = $request->text_block_content; // Save content if enabled
        $page->is_home = $isHome;
    
        // Save the page to generate the ID
        $page->save();
    
        // Handle image uploads if they exist
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                // Store the image file
                $path = $image->store('pages', 'public');
    
                // Retrieve corresponding title, order, and category
                $title = $request->image_titles[$index] ?? null;
                $order = isset($request->image_orders[$index]) ? intval($request->image_orders[$index]) : ($index + 1);
                $categoryId = isset($request->image_categories[$index]) ? intval($request->image_categories[$index]) : null;

                Log::info("Creating Image Record:");
                Log::info("Page ID: " . $page->id);
                Log::info("Path: " . $path);
                Log::info("Title: " . $title);
                Log::info("Order: " . $order);
                Log::info("Category ID: " . $categoryId);

                // Create image record in the images table
                $page->images()->create([
                    'page_id' => $page->id, // Ensure this is passed after saving the page
                    'path' => $path,
                    'type' => null,
                    'title' => $title,
                    'order' => $order,
                    'category_id' => $categoryId,
                ]);
            }
        }
    
        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully!');
    }
    
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'slug' => 'required|string|unique:pages,slug',
    //     ]);
    
    //     $slug = Str::slug($request->title);
    
    //     // Ensure slug is unique
    //     $count = \App\Models\Page::where('slug', $slug)->count();
    //     if ($count > 0) {
    //         $slug .= '-' . ($count + 1);
    //     }
    
    //     Page::create([
    //         'title' => $request->title,
    //         'slug' => $slug,
    //     ]);
    
    //     return redirect()->route('admin.pages.index')->with('success', 'Page created successfully!');
    // }

    // Show the edit form
    public function edit($id)
    {
        // Fetch the page by ID
        $page = Page::with('images')->findOrFail($id);
    
        // Fetch all categories for the dropdown
        $categories = Category::all();
    
        // Pass the page and categories to the view
        return view('backend.admin.pages.edit', compact('page', 'categories'));
    }

    //******* */ Update the page
    // public function update(Request $request, $id)
    // {
    //     $page = Page::findOrFail($id);
    
    //     $request->validate([
    //         'title' => 'required|string|max:255',
    //         'slug' => 'required|string|unique:pages,slug,' . $page->id,
    //         'content' => 'required|string',
    //         'images' => 'nullable|array',
    //         'is_home' => 'nullable|boolean',
    //         'images.*' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',  // Adjust file validation
    //     ]);
    
    //     // If 'is_home' is checked, unset it for all other pages
    //     if ($request->has('is_home')) {
    //         Page::where('is_home', 1)->where('id', '!=', $page->id)->update(['is_home' => 0]);
    //     }

    //     $page->title = $request->title;
    //     $page->slug = $request->slug;
    //     $page->content = $request->content;
    //     $page->is_home = $request->has('is_home') ? 1 : 0; // Explicitly set 0 if not checked
    //     $page->save();

    //     // Handle image uploads
    //     if ($request->hasFile('images')) {
    //         foreach ($request->images as $image) {
    //             $imagePath = $image->store('pages', 'public');
    //             $page->images()->create([
    //                 'path' => $imagePath,
    //             ]);
    //         }
    //     }
    
    //     return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully');
    // }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:pages,slug,' . $id,
            'content' => 'required|string',
            'new_images' => 'nullable|array',
            'new_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_orders' => 'nullable|array',
            'image_titles' => 'nullable|array',
            'image_categories' => 'nullable|array',
            'new_image_orders' => 'nullable|array',
            'new_image_titles' => 'nullable|array',
            'new_image_categories' => 'nullable|array',
        ]);
    
        $page = Page::findOrFail($id);
    
        // Update page details
        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->content = $request->content;
        $page->text_block_title = $request->text_block_title; // Save title if enabled
        $page->text_block_content = $request->text_block_content; // Save content if enabled
        $page->is_home = $request->has('is_home') ? 1 : 0;
        $page->save();
    
        // Update existing images
        if ($request->has('image_orders')) {
            foreach ($request->image_orders as $index => $order) {
                $imageId = $page->images[$index]->id;
                $page->images()->where('id', $imageId)->update([
                    'order' => $order,
                    'title' => $request->image_titles[$index] ?? null,
                    'category_id' => $request->image_categories[$index] ?? null,
                ]);
            }
        }
    
        // Handle new image uploads
        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $index => $image) {
                $path = $image->store('pages', 'public');
                $title = $request->new_image_titles[$index] ?? null;
                $order = isset($request->new_image_orders[$index]) ? intval($request->new_image_orders[$index]) : ($index + 1);
                $categoryId = isset($request->new_image_categories[$index]) ? intval($request->new_image_categories[$index]) : null;
    
                $page->images()->create([
                    'path' => $path,
                    'title' => $title,
                    'order' => $order,
                    'category_id' => $categoryId,
                ]);
            }
        }
    
        return redirect()->route('admin.pages.index')->with('success', 'Page mise à jour avec succès!');
    }

    // Delete a page
    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();

        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully!');
    }

    // Delete a specific image from a page
    public function deleteImage(Request $request, $id)
    {
        try {
            $image = Image::findOrFail($id);
    
            // Ensure file exists before deleting
            if (Storage::exists('public/' . $image->path)) {
                Storage::delete('public/' . $image->path);
            }
    
            $image->delete();
    
            return response()->json(['success' => true, 'message' => 'Image deleted successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error deleting image.']);
        }
    }
    
    /* Images */

    public function destroyImage($id)
    {
        $image = Image::findOrFail($id);

        // Delete the image file from storage
        if ($image->path) {
            Storage::disk('public')->delete($image->path);
        }

        // Delete the image record from the database
        $image->delete();

        return response()->json(['success' => true]);
    }
}
