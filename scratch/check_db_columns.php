<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;

echo "Hotels: " . implode(', ', Schema::getColumnListing('hotels')) . "\n";
echo "Restaurants: " . implode(', ', Schema::getColumnListing('restaurants')) . "\n";
echo "Events: " . implode(', ', Schema::getColumnListing('events')) . "\n";
echo "Guides: " . implode(', ', Schema::getColumnListing('guides')) . "\n";
echo "Destinations: " . implode(', ', Schema::getColumnListing('destinations')) . "\n";
