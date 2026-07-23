<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\Destination;
use App\Models\Journal;
use App\Models\Event;
use App\Models\Guide;
use App\Models\Yacht;

class PopulateSlugsSeeder extends Seeder
{
    public static function makeSlug($text, $lang = 'tr')
    {
        if (empty($text)) return null;
        if (is_array($text)) {
            $text = $text[$lang] ?? reset($text) ?? '';
        }
        
        $text = (string)$text;
        if (trim($text) === '') return null;

        // Custom replacements for Turkish characters
        $turk = ['ç', 'Ç', 'ğ', 'Ğ', 'ı', 'İ', 'ö', 'Ö', 'ş', 'Ş', 'ü', 'Ü'];
        $eng  = ['c', 'c', 'g', 'g', 'i', 'i', 'o', 'o', 's', 's', 'u', 'u'];
        $text = str_replace($turk, $eng, $text);

        return Str::slug($text);
    }

    public static function runSlugs()
    {
        $models = [
            Hotel::class,
            Restaurant::class,
            Destination::class,
            Journal::class,
            Event::class,
            Guide::class,
            Yacht::class,
        ];

        foreach ($models as $modelClass) {
            $items = $modelClass::all();
            foreach ($items as $item) {
                $nameTr = is_array($item->name) ? ($item->name['tr'] ?? '') : (is_array($item->title) ? ($item->title['tr'] ?? '') : ($item->name ?? $item->title ?? ''));
                $nameEn = is_array($item->name) ? ($item->name['en'] ?? '') : (is_array($item->title) ? ($item->title['en'] ?? '') : '');

                $slugTr = self::makeSlug($nameTr, 'tr') ?: self::makeSlug($item->id, 'tr');
                $slugEn = self::makeSlug($nameEn, 'en') ?: $slugTr;

                // Ensure unique slug per table
                $baseTr = $slugTr;
                $count = 1;
                while ($modelClass::where('slug_tr', $slugTr)->where('id', '!=', $item->id)->exists()) {
                    $slugTr = $baseTr . '-' . $count++;
                }

                $baseEn = $slugEn;
                $count = 1;
                while ($modelClass::where('slug_en', $slugEn)->where('id', '!=', $item->id)->exists()) {
                    $slugEn = $baseEn . '-' . $count++;
                }

                $item->slug_tr = $slugTr;
                $item->slug_en = $slugEn;
                $item->save();
            }
        }
    }
}
