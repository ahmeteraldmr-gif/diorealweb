<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\Yacht;
use App\Models\Guide;
use App\Models\Event;
use App\Models\Journal;
use App\Models\Destination;

class PageController extends Controller
{
    private function resolveDetailModel($modelClass, $slug_or_id, string $routeName)
    {
        $item = $modelClass::where('slug_tr', $slug_or_id)
            ->orWhere('slug_en', $slug_or_id)
            ->orWhere('id', $slug_or_id)
            ->firstOrFail();

        // If accessed by numeric ID, 301 redirect to canonical slug URL
        if (is_numeric($slug_or_id)) {
            $canonicalSlug = $item->slug_tr ?: ($item->slug_en ?: $item->id);
            if ($canonicalSlug != $slug_or_id) {
                return redirect()->route($routeName, $canonicalSlug, 301);
            }
        }

        return $item;
    }

    public function index()
    {
        $destinations = Destination::orderBy('order')->get()->groupBy('type');
        $seo = get_page_seo('home');
        $activeLang = get_active_locale();
        $canonical = route('home', $activeLang === 'en' ? ['lang' => 'en'] : []);
        $hreflang_tr = route('home', ['lang' => 'tr']);
        $hreflang_en = route('home', ['lang' => 'en']);

        return view("index", compact("destinations", "seo", "canonical", "hreflang_tr", "hreflang_en"));
    }

    public function hakkimizda()
    {
        $seo = get_page_seo('hakkimizda');
        $activeLang = get_active_locale();
        $canonical = route('hakkimizda', $activeLang === 'en' ? ['lang' => 'en'] : []);
        $hreflang_tr = route('hakkimizda', ['lang' => 'tr']);
        $hreflang_en = route('hakkimizda', ['lang' => 'en']);

        return view("hakkimizda", compact("seo", "canonical", "hreflang_tr", "hreflang_en"));
    }

    public function oteller()
    {
        $oteller = Hotel::where('is_archived', 0)->orderBy('order')->orderBy('id', 'desc')->get();
        $seo = get_page_seo('oteller');
        $activeLang = get_active_locale();
        $canonical = route('oteller', $activeLang === 'en' ? ['lang' => 'en'] : []);
        $hreflang_tr = route('oteller', ['lang' => 'tr']);
        $hreflang_en = route('oteller', ['lang' => 'en']);

        return view("oteller", compact("oteller", "seo", "canonical", "hreflang_tr", "hreflang_en"));
    }

    public function yatlar()
    {
        $yatlar = Yacht::all();
        $seo = get_page_seo('yatlar');
        $activeLang = get_active_locale();
        $canonical = route('yatlar', $activeLang === 'en' ? ['lang' => 'en'] : []);
        $hreflang_tr = route('yatlar', ['lang' => 'tr']);
        $hreflang_en = route('yatlar', ['lang' => 'en']);

        return view("yatlar", compact("yatlar", "seo", "canonical", "hreflang_tr", "hreflang_en"));
    }

    public function restoranlar()
    {
        $restoranlar = Restaurant::where('is_archived', 0)->orderBy('order')->orderBy('id', 'desc')->get();
        $seo = get_page_seo('restoranlar');
        $activeLang = get_active_locale();
        $canonical = route('restoranlar', $activeLang === 'en' ? ['lang' => 'en'] : []);
        $hreflang_tr = route('restoranlar', ['lang' => 'tr']);
        $hreflang_en = route('restoranlar', ['lang' => 'en']);

        return view("restoranlar", compact("restoranlar", "seo", "canonical", "hreflang_tr", "hreflang_en"));
    }

    public function geziRehberi()
    {
        $rehberler = Guide::all();
        $seo = get_page_seo('gezi-rehberi');
        $activeLang = get_active_locale();
        $canonical = route('gezi-rehberi', $activeLang === 'en' ? ['lang' => 'en'] : []);
        $hreflang_tr = route('gezi-rehberi', ['lang' => 'tr']);
        $hreflang_en = route('gezi-rehberi', ['lang' => 'en']);

        return view("destinasyonlar", compact("rehberler", "seo", "canonical", "hreflang_tr", "hreflang_en"));
    }

    public function etkinlikler()
    {
        $etkinlikler = Event::all();
        $seo = get_page_seo('etkinlikler');
        $activeLang = get_active_locale();
        $canonical = route('etkinlikler', $activeLang === 'en' ? ['lang' => 'en'] : []);
        $hreflang_tr = route('etkinlikler', ['lang' => 'tr']);
        $hreflang_en = route('etkinlikler', ['lang' => 'en']);

        return view("etkinlikler", compact("etkinlikler", "seo", "canonical", "hreflang_tr", "hreflang_en"));
    }

    public function journal()
    {
        $journals = Journal::all();
        $seo = get_page_seo('journal');
        $activeLang = get_active_locale();
        $canonical = route('journal', $activeLang === 'en' ? ['lang' => 'en'] : []);
        $hreflang_tr = route('journal', ['lang' => 'tr']);
        $hreflang_en = route('journal', ['lang' => 'en']);

        return view("journal", compact("journals", "seo", "canonical", "hreflang_tr", "hreflang_en"));
    }

    public function otelDetay($slug_or_id)
    {
        $result = $this->resolveDetailModel(Hotel::class, $slug_or_id, 'otel.detay');
        if ($result instanceof \Illuminate\Http\RedirectResponse) return $result;
        $otel = $result;

        $slugTr = $otel->slug_tr ?: $otel->id;
        $slugEn = $otel->slug_en ?: $slugTr;

        $activeLang = get_active_locale();
        $activeSlug = $activeLang === 'en' ? $slugEn : $slugTr;

        $canonical = route('otel.detay', $activeSlug);
        $hreflang_tr = route('otel.detay', ['slug_or_id' => $slugTr, 'lang' => 'tr']);
        $hreflang_en = route('otel.detay', ['slug_or_id' => $slugEn, 'lang' => 'en']);

        return view("otel-detay", compact("otel", "canonical", "hreflang_tr", "hreflang_en"));
    }

    public function restoranDetay($slug_or_id)
    {
        $result = $this->resolveDetailModel(Restaurant::class, $slug_or_id, 'restoran.detay');
        if ($result instanceof \Illuminate\Http\RedirectResponse) return $result;
        $restoran = $result;

        $slugTr = $restoran->slug_tr ?: $restoran->id;
        $slugEn = $restoran->slug_en ?: $slugTr;

        $activeLang = get_active_locale();
        $activeSlug = $activeLang === 'en' ? $slugEn : $slugTr;

        $canonical = route('restoran.detay', $activeSlug);
        $hreflang_tr = route('restoran.detay', ['slug_or_id' => $slugTr, 'lang' => 'tr']);
        $hreflang_en = route('restoran.detay', ['slug_or_id' => $slugEn, 'lang' => 'en']);

        return view("restoran-detay", compact("restoran", "canonical", "hreflang_tr", "hreflang_en"));
    }

    public function journalDetay($slug_or_id)
    {
        $result = $this->resolveDetailModel(Journal::class, $slug_or_id, 'journal.detay');
        if ($result instanceof \Illuminate\Http\RedirectResponse) return $result;
        $journal = $result;

        $related = Journal::where('id', '!=', $journal->id)->latest()->take(4)->get();

        $slugTr = $journal->slug_tr ?: $journal->id;
        $slugEn = $journal->slug_en ?: $slugTr;

        $activeLang = get_active_locale();
        $activeSlug = $activeLang === 'en' ? $slugEn : $slugTr;

        $canonical = route('journal.detay', $activeSlug);
        $hreflang_tr = route('journal.detay', ['slug_or_id' => $slugTr, 'lang' => 'tr']);
        $hreflang_en = route('journal.detay', ['slug_or_id' => $slugEn, 'lang' => 'en']);

        return view("journal-detay", compact("journal", "related", "canonical", "hreflang_tr", "hreflang_en"));
    }

    public function destinasyonDetay($slug_or_id)
    {
        $result = $this->resolveDetailModel(Destination::class, $slug_or_id, 'destinasyon.detay');
        if ($result instanceof \Illuminate\Http\RedirectResponse) return $result;
        $destination = $result;
        
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

        $slugTr = $destination->slug_tr ?: $destination->id;
        $slugEn = $destination->slug_en ?: $slugTr;

        $activeLang = get_active_locale();
        $activeSlug = $activeLang === 'en' ? $slugEn : $slugTr;

        $canonical = route('destinasyon.detay', $activeSlug);
        $hreflang_tr = route('destinasyon.detay', ['slug_or_id' => $slugTr, 'lang' => 'tr']);
        $hreflang_en = route('destinasyon.detay', ['slug_or_id' => $slugEn, 'lang' => 'en']);
            
        return view("destinasyon-detay", compact("destination", "hotels", "restaurants", "journals", "canonical", "hreflang_tr", "hreflang_en"));
    }

    public function etkinlikDetay($slug_or_id)
    {
        $result = $this->resolveDetailModel(Event::class, $slug_or_id, 'etkinlik.detay');
        if ($result instanceof \Illuminate\Http\RedirectResponse) return $result;
        $etkinlik = $result;

        $slugTr = $etkinlik->slug_tr ?: $etkinlik->id;
        $slugEn = $etkinlik->slug_en ?: $slugTr;

        $activeLang = get_active_locale();
        $activeSlug = $activeLang === 'en' ? $slugEn : $slugTr;

        $canonical = route('etkinlik.detay', $activeSlug);
        $hreflang_tr = route('etkinlik.detay', ['slug_or_id' => $slugTr, 'lang' => 'tr']);
        $hreflang_en = route('etkinlik.detay', ['slug_or_id' => $slugEn, 'lang' => 'en']);

        return view("etkinlik-detay", compact("etkinlik", "canonical", "hreflang_tr", "hreflang_en"));
    }

    public function rehberDetay($slug_or_id)
    {
        $result = $this->resolveDetailModel(Guide::class, $slug_or_id, 'rehber.detay');
        if ($result instanceof \Illuminate\Http\RedirectResponse) return $result;
        $rehber = $result;

        $otherGuides = Guide::where('id', '!=', $rehber->id)->get();

        $slugTr = $rehber->slug_tr ?: $rehber->id;
        $slugEn = $rehber->slug_en ?: $slugTr;

        $activeLang = get_active_locale();
        $activeSlug = $activeLang === 'en' ? $slugEn : $slugTr;

        $canonical = route('rehber.detay', $activeSlug);
        $hreflang_tr = route('rehber.detay', ['slug_or_id' => $slugTr, 'lang' => 'tr']);
        $hreflang_en = route('rehber.detay', ['slug_or_id' => $slugEn, 'lang' => 'en']);

        return view("rehber-detay", compact("rehber", "otherGuides", "canonical", "hreflang_tr", "hreflang_en"));
    }

    public function yatDetay($slug_or_id)
    {
        $result = $this->resolveDetailModel(Yacht::class, $slug_or_id, 'yat.detay');
        if ($result instanceof \Illuminate\Http\RedirectResponse) return $result;
        $yat = $result;

        $slugTr = $yat->slug_tr ?: $yat->id;
        $slugEn = $yat->slug_en ?: $slugTr;

        $activeLang = get_active_locale();
        $activeSlug = $activeLang === 'en' ? $slugEn : $slugTr;

        $canonical = route('yat.detay', $activeSlug);
        $hreflang_tr = route('yat.detay', ['slug_or_id' => $slugTr, 'lang' => 'tr']);
        $hreflang_en = route('yat.detay', ['slug_or_id' => $slugEn, 'lang' => 'en']);

        return view("yat-detay", compact("yat", "canonical", "hreflang_tr", "hreflang_en"));
    }
}
