<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Category;

class galleryCuisines extends Component
{
    /**
     * Create a new component instance.
     */
    public $categories;

    public function __construct($categorySlug = null)
    {
        if ($categorySlug) {
            $this->categories = Category::where('slug', $categorySlug)->with('images')->get();
        } else {
            $this->categories = Category::with('images')->get();
        }
    }

    public function render()
    {
        return view('components.frontend.gallery-cuisines');
    }
}
