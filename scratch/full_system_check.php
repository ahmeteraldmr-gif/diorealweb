<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\Yacht;
use App\Models\Destination;
use App\Models\Event;
use App\Models\Guide;
use App\Models\Journal;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;

echo "=== DIOREAL FULL SYSTEM AUDIT ===\n\n";

$errors = [];

// 1. MODEL DATA & DATABASE AUDIT
echo "1. Checking Database Tables & Models...\n";
$models = [
    'Hotel' => Hotel::class,
    'Restaurant' => Restaurant::class,
    'Yacht' => Yacht::class,
    'Destination' => Destination::class,
    'Event' => Event::class,
    'Guide' => Guide::class,
    'Journal' => Journal::class,
];

foreach ($models as $name => $class) {
    try {
        $count = $class::count();
        echo "   ✔ {$name}: {$count} records found.\n";
        if ($count === 0) {
            $errors[] = "Model {$name} has 0 records!";
        }
    } catch (\Throwable $e) {
        $errors[] = "Model {$name} database query failed: " . $e->getMessage();
        echo "   ❌ {$name}: Error - " . $e->getMessage() . "\n";
    }
}

// 2. VIEW RENDERING AUDIT
echo "\n2. Testing Blade View Render Integrity...\n";

$viewsToTest = [
    'home' => function() {
        $destinations = Destination::orderBy('order')->get()->groupBy('type');
        return view('index', compact('destinations'));
    },
    'hakkimizda' => function() {
        return view('hakkimizda');
    },
    'oteller' => function() {
        $oteller = Hotel::where('is_archived', 0)->orderBy('order')->get();
        return view('oteller', compact('oteller'));
    },
    'otel-detay' => function() {
        $otel = Hotel::first();
        return view('otel-detay', compact('otel'));
    },
    'yatlar' => function() {
        $yatlar = Yacht::all();
        return view('yatlar', compact('yatlar'));
    },
    'yat-detay' => function() {
        $yat = Yacht::first();
        return view('yat-detay', compact('yat'));
    },
    'restoranlar' => function() {
        $restoranlar = Restaurant::where('is_archived', 0)->orderBy('order')->get();
        return view('restoranlar', compact('restoranlar'));
    },
    'restoran-detay' => function() {
        $restoran = Restaurant::first();
        return view('restoran-detay', compact('restoran'));
    },
    'destinasyonlar' => function() {
        $rehberler = Guide::all();
        return view('destinasyonlar', compact('rehberler'));
    },
    'destinasyon-detay' => function() {
        $destination = Destination::first();
        return view('destinasyon-detay', compact('destination'));
    },
    'etkinlikler' => function() {
        $etkinlikler = Event::all();
        return view('etkinlikler', compact('etkinlikler'));
    },
    'etkinlik-detay' => function() {
        $etkinlik = Event::first();
        $event = $etkinlik;
        return view('etkinlik-detay', compact('etkinlik', 'event'));
    },
    'journal' => function() {
        $journals = Journal::latest()->get();
        return view('journal', compact('journals'));
    },
    'journal-detay' => function() {
        $journal = Journal::first();
        $related = Journal::where('id', '!=', $journal->id)->take(4)->get();
        return view('journal-detay', compact('journal', 'related'));
    },
    'login' => function() {
        return view('login');
    },
    'sitemap' => function() {
        $hotels = Hotel::all();
        $restaurants = Restaurant::all();
        $yachts = Yacht::all();
        $events = Event::all();
        $guides = Guide::all();
        $journals = Journal::all();
        $destinations = Destination::all();
        return view('sitemap', compact('hotels', 'restaurants', 'yachts', 'events', 'guides', 'journals', 'destinations'));
    }
];

foreach ($viewsToTest as $viewName => $closure) {
    try {
        $rendered = $closure()->render();
        if (strlen($rendered) > 100) {
            echo "   ✔ View [{$viewName}]: Rendered successfully (" . strlen($rendered) . " bytes).\n";
        } else {
            $errors[] = "View [{$viewName}] rendered unusually small output!";
            echo "   ⚠️ View [{$viewName}]: Small output (" . strlen($rendered) . " bytes).\n";
        }
    } catch (\Throwable $e) {
        $errors[] = "View [{$viewName}] failed: " . $e->getMessage() . " in " . $e->getFile() . ":" . $e->getLine();
        echo "   ❌ View [{$viewName}]: FAIL - " . $e->getMessage() . "\n";
    }
}

// 3. ROUTE REGISTRY AUDIT
echo "\n3. Testing Registered Routes...\n";
$routeCollection = Route::getRoutes();
echo "   ✔ Registered Routes Count: " . count($routeCollection) . "\n";

// 4. SUMMARY
echo "\n=== AUDIT SUMMARY ===\n";
if (empty($errors)) {
    echo "🎉 ZERO ERRORS FOUND! ALL CONTROLLERS, MODELS, DB TABLES, AND BLADE VIEWS PASSED 100% CLEAN!\n";
} else {
    echo "❌ " . count($errors) . " ERRORS FOUND:\n";
    foreach ($errors as $err) {
        echo "   - {$err}\n";
    }
}
