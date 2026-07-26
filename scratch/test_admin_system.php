<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\Yacht;
use App\Models\Event;
use App\Models\Guide;
use App\Models\Journal;
use App\Models\Destination;
use App\Models\User;
use App\Models\Setting;

echo "=== ADMIN PANEL DEEP AUDIT & TEST ===\n\n";

$adminRoutes = [
    'admin.dashboard',
    'admin.hotels.index',
    'admin.hotels.create',
    'admin.restaurants.index',
    'admin.restaurants.create',
    'admin.yachts.index',
    'admin.yachts.create',
    'admin.guides.index',
    'admin.guides.create',
    'admin.events.index',
    'admin.events.create',
    'admin.journals.index',
    'admin.journals.create',
    'admin.destinations.index',
    'admin.destinations.create',
    'admin.users.index',
    'admin.users.create',
    'admin.settings.index',
];

session(['is_admin' => true]);

foreach ($adminRoutes as $routeName) {
    try {
        $url = route($routeName);
        $req = \Illuminate\Http\Request::create($url, 'GET');
        $req->setLaravelSession(app('session.store'));
        $req->session()->put('is_admin', true);
        
        $response = $app->handle($req);
        $status = $response->getStatusCode();
        
        if ($status === 200) {
            echo "✔ Route [$routeName] -> 200 OK\n";
        } else {
            echo "❌ Route [$routeName] -> Status $status\n";
        }
    } catch (\Throwable $e) {
        echo "❌ Route [$routeName] FAILED: " . $e->getMessage() . "\n";
    }
}

// Check SEO Fields Population in DB
echo "\n=== SEO DATA INTEGRITY CHECK ===\n";
$models = [
    'Hotel' => Hotel::class,
    'Restaurant' => Restaurant::class,
    'Yacht' => Yacht::class,
    'Event' => Event::class,
    'Guide' => Guide::class,
    'Journal' => Journal::class,
    'Destination' => Destination::class,
];

foreach ($models as $name => $class) {
    $total = $class::count();
    $seoTitlesCount = $class::whereNotNull('seo_title_tr')->where('seo_title_tr', '!=', '')->count();
    $seoDescCount = $class::whereNotNull('seo_description_tr')->where('seo_description_tr', '!=', '')->count();
    $slugCount = $class::whereNotNull('slug_tr')->where('slug_tr', '!=', '')->count();

    echo "✔ [$name] Total: $total | SEO Titles: $seoTitlesCount/$total | SEO Descs: $seoDescCount/$total | Slugs: $slugCount/$total\n";
}
