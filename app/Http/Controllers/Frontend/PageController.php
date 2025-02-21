<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Category;
use App\Models\Slider; // Add Slider model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;
use Illuminate\View\View;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use GuzzleHttp\Client;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function home()
    {
        $items = $this->getInstagramPosts();
        // Find the page by slug and eager load images, ordered by the 'order' field
        $page = Page::with(['images' => function ($query) {
            $query->orderBy('order'); // Sort images by 'order' field
        }])->where('is_home', 1)->firstOrFail();
    
        // Fetch sliders by page_id (assuming it's the home page)
        $sliders = Slider::where('page_id', $page->id)->get();

        // Get the images and titles
        $images = $page->images;
        $titles = $images->pluck('title'); // Assuming each image has a 'title' attribute
        $items = $this->getInstagramPosts(); // Pass the Instagram posts to the view
        
        return view('frontend.pages.page', compact('page', 'images', 'titles', 'sliders', 'items'));
    }

    public function getPages()
    {
        $pages = Page::select('title', 'slug')->get(); // Fetch titles and slugs
        //return view('frontend.partials.navbar', compact('pages'));
    }

    public function show($slug)
    {
        // Find the page by slug and eager load images, ordered by the 'order' field
        $page = Page::with(['images' => function ($query) {
            $query->orderBy('order'); // Sort images by 'order' field
        }])->where('slug', $slug)->firstOrFail();
    
        // Fetch sliders by page_id
        $sliders = Slider::where('page_id', $page->id)->get();

        // Get the images and titles
        $images = $page->images;
        $titles = $images->pluck('title'); // Assuming each image has a 'title' attribute

        // Return the view with the page, images, titles, and sliders
        return view('frontend.pages.page', compact('page', 'images', 'titles', 'sliders'));
    }

    public function cuisines()
    {
        // Fetch the page with id = 19 and eager load its images, ordered by 'order'
        $page = Page::with(['images' => function ($query) {
            $query->orderBy('order'); // Sort images by 'order' field
        }])->where('id', 19)->firstOrFail();

        // Fetch sliders for the 'nos-cuisines' page (fixed page_id = 19)
        $sliders = Slider::where('page_id', $page->id)->get();

        // Fetch all categories with their associated images
        $categories = Category::with('images')->get();

        return view('frontend.pages.nos-cuisines', compact('page', 'categories', 'sliders'));
    }

    public function dressings()
    {
        // Fetch the page with id = 20 and eager load its images, ordered by 'order'
        $page = Page::with(['images' => function ($query) {
            $query->orderBy('order'); // Sort images by 'order' field
        }])->where('id', 20)->firstOrFail();

        // Fetch sliders for the 'nos-dressings' page (fixed page_id = 20)
        $sliders = Slider::where('page_id', $page->id)->get();

        // Log the fetched page and its images
        Log::info('Fetched Page:', ['id' => $page->id, 'title' => $page->title]);
        Log::info('Images for Page ID 20:', $page->images->pluck('id', 'path')->toArray());

        // Fetch all categories with their associated images
        $categories = Category::with('images')->get();

        return view('frontend.pages.nos-dressings', compact('page', 'categories', 'sliders'));
    }

    public function realisations()
    {
        // Fetch the page with id = 21 and eager load its images, ordered by 'order'
        $page = Page::with(['images' => function ($query) {
            $query->orderBy('order'); // Sort images by 'order' field
        }])->where('id', 21)->firstOrFail();

        // Fetch sliders for the 'nos-realisations' page (fixed page_id = 21)
        $sliders = Slider::where('page_id', $page->id)->get();

        // Log the fetched page and its images
        Log::info('Fetched Page:', ['id' => $page->id, 'title' => $page->title]);
        Log::info('Images for Page ID 21:', $page->images->pluck('id', 'path')->toArray());

        // Fetch all categories with their associated images
        $categories = Category::with('images')->get();

        return view('frontend.pages.nos-realisations', compact('page', 'categories', 'sliders'));
    }

    public function contact()
    {
        // // Fetch the page with id = 21 and eager load its images, ordered by 'order'
        $page = Page::with(['images' => function ($query) {
            $query->orderBy('order'); // Sort images by 'order' field
        }])->where('id', 39)->firstOrFail();

        // Fetch sliders for the 'nos-realisations' page (fixed page_id = 21)
        $sliders = Slider::where('page_id', $page->id)->get();

        // Log the fetched page and its images
        Log::info('Fetched Page:', ['id' => $page->id, 'title' => $page->title]);
        Log::info('Images for Page ID 21:', $page->images->pluck('id', 'path')->toArray());

        // Fetch all categories with their associated images
        $categories = Category::with('images')->get();

        return view('frontend.pages.contact', compact('page', 'categories', 'sliders'));
    }

    // public function sendEmail(Request $request)
    // {
    //     // Validate form data
    //     $request->validate([
    //         'nom' => 'required|string|max:255',
    //         'prenom' => 'required|string|max:255',
    //         'phone' => 'required|string|max:20',
    //         'email' => 'required|email',
    //         'message' => 'required|string',
    //     ]);
    
    //     // Prepare email data
    //     $data = [
    //         'nom' => $request->nom,
    //         'prenom' => $request->prenom,
    //         'phone' => $request->phone,
    //         'email' => $request->email,
    //         'userMessage' => $request->message,  // Change from message to userMessage to avoid conflict
    //     ];
    
    //     // Send email
    //     try {
    //         Mail::send('frontend.pages.email', $data, function ($message) use ($data) {
    //             $message->to('darafital@gmail.com')
    //                     ->subject('Nouveau message');
    //         });
    
    //         return back()->with('success', 'Votre message a été envoyé avec succès.');
    //     } catch (\Exception $e) {
    //         return back()->with('error', 'Erreur lors de l\'envoi de l\'email. Veuillez réessayer.');
    //     }
    // }
    

    public function sendEmail(Request $request) //: //view
    {

        // Fetch the email from settings table
        $adminEmail = $this->getEmail();

        Mail::to($adminEmail)->send(new Contact($request->except('_token')));

        // return view('emails.confirm');
        return redirect()->route('page.contact', ['#envoye'])->with('success', 'Votre message a été envoyé avec succès !');
    }

    private function getInstagramToken()
    {
        return DB::table('settings')->value('access_token'); 
    }

    private function getEmail()
    {
        return DB::table('settings')->value('email'); 
    }

    public function getInstagramPosts()
    {
        $items = [];

        // Fetch token from database
        $accessToken = $this->getInstagramToken();

        if ($accessToken) {
            $client = new Client();
            $url = sprintf(
                'https://graph.instagram.com/me/media?fields=id,media_type,media_url,caption,timestamp&access_token=%s&limit=1',
                $accessToken
            );

        try {
            $response = $client->get($url);
            $data = json_decode((string)$response->getBody(), true);
            $items = $data['data'] ?? [];

            // Collect only image URL and caption
            $items = array_map(function ($item) {
                return [
                    'media_url' => $item['media_url'],
                    'caption' => $item['caption'] ?? 'No title',
                ];
            }, $items);

            // Only return the first post if multiple exist
            return count($items) > 0 ? [$items[0]] : [];
        } catch (\Exception $e) {
            Log::error('Failed to fetch Instagram posts: ' . $e->getMessage());
            return [];
        }
    } else {
        Log::error('Instagram access token not found.');
        return [];
    }
}


    
    







}
