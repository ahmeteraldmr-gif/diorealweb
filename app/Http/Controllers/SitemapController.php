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
        $hotels = Hotel::all();
        $restaurants = Restaurant::all();
        $yachts = Yacht::all();
        $destinations = Destination::all();
        $events = Event::all();
        $journals = Journal::all();
        $guides = Guide::all();

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
