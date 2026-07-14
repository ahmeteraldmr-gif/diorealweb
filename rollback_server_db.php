<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

echo "=== DATABASE ROLLBACK START ===\n";

// Configure original SQLite connection dynamically
Config::set('database.connections.sqlite_original', [
    'driver' => 'sqlite',
    'database' => database_path('database.sqlite'),
    'prefix' => '',
]);

$tables = [
    'hotels' => ['img', 'gallery'],
    'restaurants' => ['img', 'gallery'],
    'yachts' => ['img', 'gallery'],
    'events' => ['img', 'gallery'],
    'guides' => ['img'],
    'journals' => ['img'],
    'destinations' => ['img']
];

$totalUpdated = 0;

foreach ($tables as $table => $fields) {
    echo "Processing table: {$table}...\n";
    
    try {
        $originalRecords = DB::connection('sqlite_original')->table($table)->get();
    } catch (\Exception $e) {
        echo "Error reading SQLite table {$table}: " . $e->getMessage() . "\n";
        continue;
    }
    
    $tableUpdatedCount = 0;
    foreach ($originalRecords as $orig) {
        $active = DB::table($table)->where('id', $orig->id)->first();
        if ($active) {
            $updateData = [];
            foreach ($fields as $field) {
                if (property_exists($orig, $field)) {
                    $updateData[$field] = $orig->$field;
                }
            }
            if (!empty($updateData)) {
                DB::table($table)->where('id', $orig->id)->update($updateData);
                $tableUpdatedCount++;
                $totalUpdated++;
            }
        }
    }
    echo "SUCCESS: Restored {$tableUpdatedCount} records in table {$table}.\n";
}

echo "=== DATABASE ROLLBACK FINISHED. Total restored: {$totalUpdated} ===\n";
