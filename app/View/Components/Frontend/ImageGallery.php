<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ImageGallery extends Component
{
    /**
     * Create a new component instance.
     */
    public $images;
    public $titles;

    public function __construct($images, $titles = [])
    {
        $this->images = $images;
        $this->titles = $titles;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.image-gallery');
    }
}
