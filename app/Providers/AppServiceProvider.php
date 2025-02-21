<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Page;
use App\Models\Setting; // Add the Setting model
use App\Models\Slider; // Add the Setting model

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share 'pages' and 'settings' data with the navbar view
        View::composer('frontend.partials.navbar', function ($view) {
            $view->with('pages', Page::select('title', 'slug')->get())
                 ->with('settings', Setting::first());
        });
    
        // Share 'sliders' data by page_id for all views
        View::composer('*', function ($view) {
            // Assuming the page slug or ID is available globally
            if (request()->route('page_slug')) {
                // Fetch sliders based on page_id or slug
                $page = Page::where('slug', request()->route('page_slug'))->first();
                if ($page) {
                    $view->with('sliders', Slider::where('page_id', $page->id)->get());
                }
            }
        });
    }
    
    
}
