<?php

namespace App\Http\Controllers;

use App\Models\Bloc;
use Illuminate\Http\Request;

class BlocController extends Controller {
    public function index() {
        $blocs = Bloc::all();
        return view('backend.admin.blocs.index', compact('blocs'));
    }

    public function create() {
        return view('backend.admin.blocs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bloc_type' => 'required|string|unique:blocs,bloc_type',
            'title' => 'required|string',
            'text' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'url' => 'nullable|string',
            'url_text' => 'nullable|string'
        ]);
    
        $imagePaths = [];
    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('blocs', 'public');
                $imagePaths[] = $path;
            }
        }
    
        Bloc::create([
            'bloc_type' => $request->bloc_type,
            'title' => $request->title,
            'text' => $request->text,
            'images' => json_encode($imagePaths),
            'url' => $request->url,
            'url_text' => $request->url_text,
        ]);
    
        return redirect()->route('blocs.index')->with('success', 'Bloc ajouté avec succès!');
    }
    

    public function edit(Bloc $bloc) {
        return view('backend.admin.blocs.edit', compact('bloc'));
    }

    public function update(Request $request, Bloc $bloc)
    {
        $request->validate([
            'title' => 'required|string',
            'text' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'url' => 'nullable|string',
            'bloc_type' => 'nullable|string',
            'url_text' => 'nullable|string',
        ]);
    
        // Ensure $bloc->images is a string before decoding
        $imagePaths = is_string($bloc->images) ? json_decode($bloc->images, true) : [];
    
        if (!is_array($imagePaths)) {
            $imagePaths = []; // Fallback in case of an issue
        }
    
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('blocs', 'public');
                $imagePaths[] = $path;
            }
        }
    
        $bloc->update([
            'title' => $request->title,
            'text' => $request->text,
            'images' => json_encode($imagePaths), // Ensure images are stored as a JSON string
            'url' => $request->url,
            'url_text' => $request->url_text,
            'bloc_type' => $request->bloc_type,
        ]);
    
        return redirect()->route('blocs.index')->with('success', 'Bloc mis à jour avec succès!');
    }
    
    

    public function destroy(Bloc $bloc) {
        $bloc->delete();
        return redirect()->route('blocs.index')->with('success', 'Bloc deleted successfully!');
    }
    
}
