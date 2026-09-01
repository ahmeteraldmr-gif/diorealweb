<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Destination;
use App\Models\Setting;

try {
    echo "1. Fetching destinations...\n";
    $destinations = Destination::orderBy('order')->get()->groupBy('type');
    echo "   Destinations count: " . count($destinations) . "\n";
    
    echo "2. Checking destination region/name data types...\n";
    foreach (Destination::all() as $d) {
        if (!is_array($d->name)) {
            echo "   [WARNING] Destination ID {$d->id} name is not array: " . var_export($d->name, true) . "\n";
        }
        if (!is_array($d->region)) {
            echo "   [WARNING] Destination ID {$d->id} region is not array: " . var_export($d->region, true) . "\n";
        }
    }
    
    echo "3. Fetching settings...\n";
    $settings = Setting::pluck('value', 'key')->toArray();
    echo "   Settings count: " . count($settings) . "\n";
    
    echo "4. Attempting to render home view...\n";
    $html = view('index', [
        'destinations' => $destinations,
        'seo' => get_page_seo('home'),
        'canonical' => route('home'),
        'hreflang_tr' => route('home', ['lang' => 'tr']),
        'hreflang_en' => route('home', ['lang' => 'en']),
    ])->render();
    
    echo "✔ SUCCESS! Home view rendered cleanly (" . strlen($html) . " bytes)\n";
} catch (\Throwable $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
    echo "   File: " . $e->getFile() . " on line " . $e->getLine() . "\n";
    echo "   Trace: " . $e->getTraceAsString() . "\n";
}
