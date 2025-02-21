<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::first(); // Get settings
        return view('backend.admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = Setting::firstOrNew([]); // Retrieve or create settings object
        $settings->fill($request->except(['logo', 'logoblack'])); // Fill in other settings, excluding logo and logoblack
    
        // Handle logo upload
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $settings->logo = $path; // Save logo path
        }
    
        // Handle logo black upload
        if ($request->hasFile('logoblack')) {
            $path = $request->file('logoblack')->store('logos', 'public');
            $settings->logoblack = $path; // Save logoblack path
        }
    
        $settings->save(); // Save changes to the settings
    
        return redirect()->back()->with('success', 'Modifications enregistrées');
    }
    
}

