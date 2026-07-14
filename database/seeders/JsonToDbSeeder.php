<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\Yacht;
use App\Models\Event;
use App\Models\Guide;
use App\Models\Journal;

class JsonToDbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataDir = storage_path('app/data');

        $mappings = [
            'dioreal_hotels_data.json' => Hotel::class,
            'dioreal_restaurants_data.json' => Restaurant::class,
            'dioreal_yachts_data.json' => Yacht::class,
            'dioreal_events_data.json' => Event::class,
            'dioreal_guide_data.json' => Guide::class,
            'dioreal_journal_data.json' => Journal::class,
        ];

        foreach ($mappings as $file => $modelClass) {
            $path = $dataDir . '/' . $file;
            if (File::exists($path)) {
                $json = File::get($path);
                $data = json_decode($json, true);
                if (is_array($data)) {
                    foreach ($data as $item) {
                        // Remove id to allow auto-increment, or keep it if we want to preserve URLs
                        // Since URLs depend on IDs currently, preserving IDs is safer!
                        $modelClass::updateOrCreate(
                            ['id' => $item['id'] ?? null],
                            $item
                        );
                    }
                    $this->command->info("Migrated {$file} into " . class_basename($modelClass));
                }
            } else {
                $this->command->warn("File not found: {$file}");
            }
        }
    }
}
