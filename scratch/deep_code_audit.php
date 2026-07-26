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
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;

echo "=== DIOREAL DEEP CODE & SYSTEM AUDIT ===\n\n";

$errors = [];
$warnings = [];

// 1. Check Model Data & Translatable Attributes Safety
echo "1. Auditing Models & Translatable Attributes...\n";
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
    $items = $class::all();
    echo "   Checking $name (" . count($items) . " records)...\n";
    foreach ($items as $item) {
        // Check slug
        if (empty($item->slug_tr) && empty($item->slug_en)) {
            $warnings[] = "[$name ID {$item->id}] Has empty slugs.";
        }
        // Check image path
        if (!empty($item->img) && !file_exists(public_path($item->img))) {
            $warnings[] = "[$name ID {$item->id}] Image path defined but file does not exist: {$item->img}";
        }
    }
}

// 2. Check All PageController Routes in both TR & EN
echo "\n2. Testing PageController Routes in TR & EN...\n";
$firstHotel = Hotel::first();
$firstRest = Restaurant::first();
$firstYacht = Yacht::first();
$firstEvent = Event::first();
$firstGuide = Guide::first();
$firstJournal = Journal::first();
$firstDest = Destination::first();

$pageRoutes = [
    '/',
    '/hakkimizda',
    '/oteller',
    '/otel/' . ($firstHotel ? ($firstHotel->slug_tr ?? $firstHotel->id) : '1'),
    '/yatlar',
    '/yat/' . ($firstYacht ? ($firstYacht->slug_tr ?? $firstYacht->id) : '1'),
    '/restoranlar',
    '/restoran/' . ($firstRest ? ($firstRest->slug_tr ?? $firstRest->id) : '1'),
    '/gezi-rehberi',
    '/destinasyon/' . ($firstDest ? ($firstDest->slug_tr ?? $firstDest->id) : '1'),
    '/etkinlikler',
    '/etkinlik/' . ($firstEvent ? ($firstEvent->slug_tr ?? $firstEvent->id) : '1'),
    '/journal',
    '/journal/' . ($firstJournal ? ($firstJournal->slug_tr ?? $firstJournal->id) : '1'),
    '/login',
    '/sitemap.xml',
];

foreach (['tr', 'en'] as $lang) {
    foreach ($pageRoutes as $uri) {
        try {
            $req = \Illuminate\Http\Request::create($uri . '?lang=' . $lang, 'GET');
            $response = $app->handle($req);
            $status = $response->getStatusCode();
            if ($status >= 400) {
                $errors[] = "Route GET [$uri] (lang=$lang) returned HTTP status $status";
            }
        } catch (\Throwable $e) {
            $errors[] = "Route GET [$uri] (lang=$lang) FAILED: " . $e->getMessage() . " in " . $e->getFile() . ":" . $e->getLine();
        }
    }
}

// 3. Check All Registered Routes for Syntax or Controller Resolution Errors
echo "\n3. Validating All Registered Rotes...\n";
$routeCount = 0;
foreach (Route::getRoutes() as $route) {
    $routeCount++;
    $action = $route->getActionName();
    if ($action === 'Closure') continue;
    
    // Check if controller method exists
    if (strpos($action, '@') !== false) {
        list($controller, $method) = explode('@', $action);
        if (!class_exists($controller)) {
            $errors[] = "Route controller does not exist: $controller";
        } elseif (!method_exists($controller, $method)) {
            $errors[] = "Route method does not exist: $action";
        }
    }
}
echo "   ✔ Verified $routeCount registered routes.\n";

// 4. Check CSS & JS Static Files Existence
echo "\n4. Verifying Static Assets (CSS/JS)...\n";
$cssFiles = ['base.css', 'nav-footer.css', 'components.css', 'responsive.css', 'admin-new.css', 'events.css'];
foreach ($cssFiles as $css) {
    $fullPath = public_path("css/$css");
    if (!file_exists($fullPath)) {
        $errors[] = "Static CSS file missing: css/$css";
    } else {
        echo "   ✔ CSS css/$css exists (" . filesize($fullPath) . " bytes).\n";
    }
}

// 5. Final Audit Summary
echo "\n=== AUDIT SUMMARY ===\n";
if (empty($errors)) {
    echo "🎉 ZERO ERRORS FOUND IN CODEBASE!\n";
} else {
    echo "❌ FOUND " . count($errors) . " ERRORS:\n";
    foreach ($errors as $err) {
        echo "   - $err\n";
    }
}

if (!empty($warnings)) {
    echo "\n⚠️ " . count($warnings) . " INFORMATIONAL WARNINGS:\n";
    foreach (array_slice($warnings, 0, 10) as $warn) {
        echo "   - $warn\n";
    }
}
