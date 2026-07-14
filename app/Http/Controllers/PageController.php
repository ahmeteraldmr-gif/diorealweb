<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\Yacht;
use App\Models\Guide;
use App\Models\Event;
use App\Models\Journal;

class PageController extends Controller
{
    public function index()
    {
        $destinations = \App\Models\Destination::orderBy('order')->get()->groupBy('type');
        return view("index", compact("destinations"));
    }

    public function hakkimizda()
    {
        return view("hakkimizda");
    }

    public function oteller()
    {
        $oteller = Hotel::where('is_archived', 0)->orderBy('order')->orderBy('id', 'desc')->get();
        return view("oteller", compact("oteller"));
    }

    public function yatlar()
    {
        $yatlar = Yacht::all();
        return view("yatlar", compact("yatlar"));
    }

    public function restoranlar()
    {
        $restoranlar = Restaurant::where('is_archived', 0)->orderBy('order')->orderBy('id', 'desc')->get();
        return view("restoranlar", compact("restoranlar"));
    }

    public function geziRehberi()
    {
        $rehberler = Guide::all();
        return view("destinasyonlar", compact("rehberler"));
    }

    public function etkinlikler()
    {
        $etkinlikler = Event::all();
        return view("etkinlikler", compact("etkinlikler"));
    }

    public function journal()
    {
        $journals = Journal::all();
        return view("journal", compact("journals"));
    }



    public function otelDetay($id)
    {
        $otel = Hotel::findOrFail($id);
        return view("otel-detay", compact("otel"));
    }

    public function restoranDetay($id)
    {
        $restoran = Restaurant::findOrFail($id);
        return view("restoran-detay", compact("restoran"));
    }

    public function journalDetay($id)
    {
        $journal = \App\Models\Journal::findOrFail($id);
        // Get related/recent articles for sidebar (excluding current)
        $related = \App\Models\Journal::where('id', '!=', $id)->latest()->take(4)->get();
        return view("journal-detay", compact("journal", "related"));
    }

    public function destinasyonDetay($id)
    {
        $destination = \App\Models\Destination::findOrFail($id);
        
        $hotels = Hotel::where('destination_id', $id)
            ->where('is_archived', 0)
            ->orderBy('order')
            ->orderBy('id', 'desc')
            ->get();
            
        $restaurants = Restaurant::where('destination_id', $id)
            ->where('is_archived', 0)
            ->orderBy('order')
            ->orderBy('id', 'desc')
            ->get();
            
        $journals = Journal::where('destination_id', $id)
            ->latest()
            ->get();
            
        return view("destinasyon-detay", compact("destination", "hotels", "restaurants", "journals"));
    }

    public function etkinlikDetay($id)
    {
        $etkinlik = Event::findOrFail($id);
        return view("etkinlik-detay", compact("etkinlik"));
    }

    public function rehberDetay($id)
    {
        $rehber = Guide::findOrFail($id);
        $otherGuides = Guide::where('id', '!=', $id)->get();
        return view("rehber-detay", compact("rehber", "otherGuides"));
    }

    public function yatDetay($id)
    {
        $yat = Yacht::findOrFail($id);
        return view("yat-detay", compact("yat"));
    }
}
