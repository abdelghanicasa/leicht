<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CuisinesController extends Controller
{
    public function index(){
        return view('backend.pages.create');
    }
}
