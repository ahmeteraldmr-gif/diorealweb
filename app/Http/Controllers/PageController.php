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



    public function otelDetay($slug_or_id)
    {
        $otel = Hotel::where('id', $slug_or_id)->orWhere('slug_tr', $slug_or_id)->orWhere('slug_en', $slug_or_id)->firstOrFail();
        return view("otel-detay", compact("otel"));
    }

    public function restoranDetay($slug_or_id)
    {
        $restoran = Restaurant::where('id', $slug_or_id)->orWhere('slug_tr', $slug_or_id)->orWhere('slug_en', $slug_or_id)->firstOrFail();
        return view("restoran-detay", compact("restoran"));
    }

    public function journalDetay($slug_or_id)
    {
        $journal = \App\Models\Journal::where('id', $slug_or_id)->orWhere('slug_tr', $slug_or_id)->orWhere('slug_en', $slug_or_id)->firstOrFail();
        // Get related/recent articles for sidebar (excluding current)
        $related = \App\Models\Journal::where('id', '!=', $journal->id)->latest()->take(4)->get();
        return view("journal-detay", compact("journal", "related"));
    }

    public function destinasyonDetay($slug_or_id)
    {
        $destination = \App\Models\Destination::where('id', $slug_or_id)->orWhere('slug_tr', $slug_or_id)->orWhere('slug_en', $slug_or_id)->firstOrFail();
        
        $hotels = Hotel::where('destination_id', $destination->id)
            ->where('is_archived', 0)
            ->orderBy('order')
            ->orderBy('id', 'desc')
            ->get();
            
        $restaurants = Restaurant::where('destination_id', $destination->id)
            ->where('is_archived', 0)
            ->orderBy('order')
            ->orderBy('id', 'desc')
            ->get();
            
        $journals = Journal::where('destination_id', $destination->id)
            ->latest()
            ->get();
            
        return view("destinasyon-detay", compact("destination", "hotels", "restaurants", "journals"));
    }

    public function etkinlikDetay($slug_or_id)
    {
        $etkinlik = Event::findOrFail($id);
        return view("etkinlik-detay", compact("etkinlik"));
    }

    public function rehberDetay($slug_or_id)
    {
        $rehber = Guide::findOrFail($id);
        $otherGuides = Guide::where('id', '!=', $journal->id)->get();
        return view("rehber-detay", compact("rehber", "otherGuides"));
    }

    public function yatDetay($slug_or_id)
    {
        $yat = Yacht::findOrFail($id);
        return view("yat-detay", compact("yat"));
    }
}
