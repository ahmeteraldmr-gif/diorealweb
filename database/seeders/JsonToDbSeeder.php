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
            'dioreal_destinations_data.json' => \App\Models\Destination::class,
        ];

        foreach ($mappings as $file => $modelClass) {
            $path = $dataDir . '/' . $file;
            if (File::exists($path)) {
                $json = File::get($path);
                $data = json_decode($json, true);
                if (is_array($data)) {
                    foreach ($data as $item) {
                        $trName = is_array($item['name'] ?? null) ? ($item['name']['tr'] ?? '') : ($item['name'] ?? '');
                        $enName = is_array($item['name'] ?? null) ? ($item['name']['en'] ?? $trName) : ($item['name'] ?? '');
                        if (!$trName) {
                            $trName = is_array($item['title'] ?? null) ? ($item['title']['tr'] ?? '') : ($item['title'] ?? '');
                            $enName = is_array($item['title'] ?? null) ? ($item['title']['en'] ?? $trName) : ($item['title'] ?? '');
                        }

                        $trDesc = is_array($item['desc'] ?? null) ? ($item['desc']['tr'] ?? '') : ($item['desc'] ?? '');
                        $enDesc = is_array($item['desc'] ?? null) ? ($item['desc']['en'] ?? $trDesc) : ($item['desc'] ?? '');

                        if (empty($item['slug_tr']) && $trName) $item['slug_tr'] = \Illuminate\Support\Str::slug($trName);
                        if (empty($item['slug_en']) && $enName) $item['slug_en'] = \Illuminate\Support\Str::slug($enName);
                        if (empty($item['seo_title_tr']) && $trName) $item['seo_title_tr'] = $trName . ' | Dioreal Dijital Lüks Yaşam Platformu';
                        if (empty($item['seo_title_en']) && $enName) $item['seo_title_en'] = $enName . ' | Dioreal Digital Luxury Platform';
                        if (empty($item['seo_description_tr']) && $trDesc) $item['seo_description_tr'] = \Illuminate\Support\Str::limit(strip_tags($trDesc), 155);
                        if (empty($item['seo_description_en']) && $enDesc) $item['seo_description_en'] = \Illuminate\Support\Str::limit(strip_tags($enDesc), 155);

                        $modelClass::firstOrCreate(
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
