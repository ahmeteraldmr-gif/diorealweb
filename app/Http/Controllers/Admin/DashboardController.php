<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\Yacht;
use App\Models\Guide;
use App\Models\Event;
use App\Models\Journal;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'hotels' => Hotel::count(),
            'restaurants' => Restaurant::count(),
            'yachts' => Yacht::count(),
            'guides' => Guide::count(),
            'events' => Event::count(),
            'journals' => Journal::count(),
        ];

        // Fetch recent entries to show active listings on the dashboard
        $recentHotels = Hotel::latest()->take(3)->get();
        $recentRestaurants = Restaurant::latest()->take(3)->get();

        return view('admin.dashboard', compact('stats', 'recentHotels', 'recentRestaurants'));
    }
}
