<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\Yacht;
use App\Models\Destination;
use App\Models\Event;
use App\Models\Journal;
use App\Models\Guide;

class SitemapController extends Controller
{
    public function index()
    {
        $hotels = Hotel::where('seo_noindex', 0)->orWhereNull('seo_noindex')->get();
        $restaurants = Restaurant::where('seo_noindex', 0)->orWhereNull('seo_noindex')->get();
        $yachts = Yacht::where('seo_noindex', 0)->orWhereNull('seo_noindex')->get();
        $destinations = Destination::where('seo_noindex', 0)->orWhereNull('seo_noindex')->get();
        $events = Event::where('seo_noindex', 0)->orWhereNull('seo_noindex')->get();
        $journals = Journal::where('seo_noindex', 0)->orWhereNull('seo_noindex')->get();
        $guides = Guide::where('seo_noindex', 0)->orWhereNull('seo_noindex')->get();

        return response()->view('sitemap', compact(
            'hotels',
            'restaurants',
            'yachts',
            'destinations',
            'events',
            'journals',
            'guides'
        ))->header('Content-Type', 'text/xml');
    }
}
