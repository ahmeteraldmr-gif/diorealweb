<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Hotel;
use App\Models\Restaurant;
use App\Models\Yacht;
use App\Models\Destination;
use App\Models\Event;
use App\Models\Guide;
use App\Models\Journal;
use Illuminate\Support\Str;

echo "=== GENERATING COMPLETE SEO META DATA & SLUGS FOR ALL DATABASE RECORDS ===\n\n";

// 1. HOTELS
$hotels = Hotel::all();
foreach ($hotels as $hotel) {
    $trName = is_array($hotel->name) ? ($hotel->name['tr'] ?? '') : $hotel->name;
    $enName = is_array($hotel->name) ? ($hotel->name['en'] ?? $trName) : $hotel->name;
    $trDesc = is_array($hotel->desc) ? ($hotel->desc['tr'] ?? '') : $hotel->desc;
    $enDesc = is_array($hotel->desc) ? ($hotel->desc['en'] ?? $trDesc) : $hotel->desc;
    $trLoc = is_array($hotel->location) ? ($hotel->location['tr'] ?? '') : ($hotel->location ?? '');

    $hotel->slug_tr = $hotel->slug_tr ?: Str::slug($trName);
    $hotel->slug_en = $hotel->slug_en ?: Str::slug($enName);
    $hotel->seo_title_tr = $hotel->seo_title_tr ?: ($trName . ($trLoc ? ' - ' . $trLoc : '') . ' | Lüks Otel Deneyimi — Dioreal Dijital');
    $hotel->seo_title_en = $hotel->seo_title_en ?: ($enName . ($trLoc ? ' - ' . $trLoc : '') . ' | Luxury Hotel Experience — Dioreal Digital');
    $hotel->seo_description_tr = $hotel->seo_description_tr ?: Str::limit(strip_tags($trDesc), 155);
    $hotel->seo_description_en = $hotel->seo_description_en ?: Str::limit(strip_tags($enDesc), 155);
    $hotel->save();
}
echo "✔ Updated " . count($hotels) . " Hotels with SEO metadata\n";

// 2. RESTAURANTS
$restaurants = Restaurant::all();
foreach ($restaurants as $rest) {
    $trName = is_array($rest->name) ? ($rest->name['tr'] ?? '') : $rest->name;
    $enName = is_array($rest->name) ? ($rest->name['en'] ?? $trName) : $rest->name;
    $trDesc = is_array($rest->desc) ? ($rest->desc['tr'] ?? '') : $rest->desc;
    $enDesc = is_array($rest->desc) ? ($rest->desc['en'] ?? $trDesc) : $rest->desc;
    $trLoc = is_array($rest->location) ? ($rest->location['tr'] ?? '') : ($rest->location ?? '');

    $rest->slug_tr = $rest->slug_tr ?: Str::slug($trName);
    $rest->slug_en = $rest->slug_en ?: Str::slug($enName);
    $rest->seo_title_tr = $rest->seo_title_tr ?: ($trName . ($trLoc ? ' - ' . $trLoc : '') . ' | Gourmet Restoran & Gastronomi — Dioreal Dijital');
    $rest->seo_title_en = $rest->seo_title_en ?: ($enName . ($trLoc ? ' - ' . $trLoc : '') . ' | Fine Dining & Gastronomy — Dioreal Digital');
    $rest->seo_description_tr = $rest->seo_description_tr ?: Str::limit(strip_tags($trDesc), 155);
    $rest->seo_description_en = $rest->seo_description_en ?: Str::limit(strip_tags($enDesc), 155);
    $rest->save();
}
echo "✔ Updated " . count($restaurants) . " Restaurants with SEO metadata\n";

// 3. YACHTS
$yachts = Yacht::all();
foreach ($yachts as $yacht) {
    $trName = is_array($yacht->name) ? ($yacht->name['tr'] ?? '') : $yacht->name;
    $enName = is_array($yacht->name) ? ($yacht->name['en'] ?? $trName) : $yacht->name;
    $trDesc = is_array($yacht->desc) ? ($yacht->desc['tr'] ?? '') : $yacht->desc;
    $enDesc = is_array($yacht->desc) ? ($yacht->desc['en'] ?? $trDesc) : $yacht->desc;

    $yacht->slug_tr = $yacht->slug_tr ?: Str::slug($trName);
    $yacht->slug_en = $yacht->slug_en ?: Str::slug($enName);
    $yacht->seo_title_tr = $yacht->seo_title_tr ?: ($trName . ' | Lüks Yat Kiralama & Mavi Yolculuk — Dioreal Dijital');
    $yacht->seo_title_en = $yacht->seo_title_en ?: ($enName . ' | Luxury Yacht Charter & Blue Cruise — Dioreal Digital');
    $yacht->seo_description_tr = $yacht->seo_description_tr ?: Str::limit(strip_tags($trDesc), 155);
    $yacht->seo_description_en = $yacht->seo_description_en ?: Str::limit(strip_tags($enDesc), 155);
    $yacht->save();
}
echo "✔ Updated " . count($yachts) . " Yachts with SEO metadata\n";

// 4. DESTINATIONS
$destinations = Destination::all();
foreach ($destinations as $dest) {
    $trName = is_array($dest->name) ? ($dest->name['tr'] ?? '') : $dest->name;
    $enName = is_array($dest->name) ? ($dest->name['en'] ?? $trName) : $dest->name;
    $trDesc = is_array($dest->desc) ? ($dest->desc['tr'] ?? '') : $dest->desc;
    $enDesc = is_array($dest->desc) ? ($dest->desc['en'] ?? $trDesc) : $dest->desc;
    $trRegion = is_array($dest->region) ? ($dest->region['tr'] ?? '') : ($dest->region ?? '');

    $dest->slug_tr = $dest->slug_tr ?: Str::slug($trName);
    $dest->slug_en = $dest->slug_en ?: Str::slug($enName);
    $dest->seo_title_tr = $dest->seo_title_tr ?: ($trName . ($trRegion ? ' - ' . $trRegion : '') . ' Gezi & Tatil Rehberi — Dioreal Dijital');
    $dest->seo_title_en = $dest->seo_title_en ?: ($enName . ($trRegion ? ' - ' . $trRegion : '') . ' Travel & Vacation Guide — Dioreal Digital');
    $dest->seo_description_tr = $dest->seo_description_tr ?: Str::limit(strip_tags($trDesc), 155);
    $dest->seo_description_en = $dest->seo_description_en ?: Str::limit(strip_tags($enDesc), 155);
    $dest->save();
}
echo "✔ Updated " . count($destinations) . " Destinations with SEO metadata\n";

// 5. EVENTS
$events = Event::all();
foreach ($events as $event) {
    $trTitle = is_array($event->title) ? ($event->title['tr'] ?? '') : $event->title;
    $enTitle = is_array($event->title) ? ($event->title['en'] ?? $trTitle) : $event->title;
    $trDesc = is_array($event->desc) ? ($event->desc['tr'] ?? '') : $event->desc;
    $enDesc = is_array($event->desc) ? ($event->desc['en'] ?? $trDesc) : $event->desc;
    $trLoc = is_array($event->loc) ? ($event->loc['tr'] ?? '') : ($event->loc ?? '');

    $event->slug_tr = $event->slug_tr ?: Str::slug($trTitle);
    $event->slug_en = $event->slug_en ?: Str::slug($enTitle);
    $event->seo_title_tr = $event->seo_title_tr ?: ($trTitle . ($trLoc ? ' - ' . $trLoc : '') . ' | Seçkin Dünya Etkinlikleri — Dioreal Dijital');
    $event->seo_title_en = $event->seo_title_en ?: ($enTitle . ($trLoc ? ' - ' . $trLoc : '') . ' | Exclusive World Events — Dioreal Digital');
    $event->seo_description_tr = $event->seo_description_tr ?: Str::limit(strip_tags($trDesc), 155);
    $event->seo_description_en = $event->seo_description_en ?: Str::limit(strip_tags($enDesc), 155);
    $event->save();
}
echo "✔ Updated " . count($events) . " Events with SEO metadata\n";

// 6. GUIDES
$guides = Guide::all();
foreach ($guides as $guide) {
    $trTitle = is_array($guide->title) ? ($guide->title['tr'] ?? '') : $guide->title;
    $enTitle = is_array($guide->title) ? ($guide->title['en'] ?? $trTitle) : $guide->title;
    $trDesc = is_array($guide->desc) ? ($guide->desc['tr'] ?? '') : $guide->desc;
    $enDesc = is_array($guide->desc) ? ($guide->desc['en'] ?? $trDesc) : $guide->desc;

    $guide->slug_tr = $guide->slug_tr ?: Str::slug($trTitle);
    $guide->slug_en = $guide->slug_en ?: Str::slug($enTitle);
    $guide->seo_title_tr = $guide->seo_title_tr ?: ($trTitle . ' | Özel Seyahat Rehberi — Dioreal Dijital');
    $guide->seo_title_en = $guide->seo_title_en ?: ($enTitle . ' | Exclusive Travel Guide — Dioreal Digital');
    $guide->seo_description_tr = $guide->seo_description_tr ?: Str::limit(strip_tags($trDesc), 155);
    $guide->seo_description_en = $guide->seo_description_en ?: Str::limit(strip_tags($enDesc), 155);
    $guide->save();
}
echo "✔ Updated " . count($guides) . " Guides with SEO metadata\n";

// 7. JOURNALS
$journals = Journal::all();
foreach ($journals as $journal) {
    $trTitle = is_array($journal->title) ? ($journal->title['tr'] ?? '') : $journal->title;
    $enTitle = is_array($journal->title) ? ($journal->title['en'] ?? $trTitle) : $journal->title;
    $trDesc = is_array($journal->desc) ? ($journal->desc['tr'] ?? '') : $journal->desc;
    $enDesc = is_array($journal->desc) ? ($journal->desc['en'] ?? $trDesc) : $journal->desc;

    $journal->slug_tr = $journal->slug_tr ?: Str::slug($trTitle);
    $journal->slug_en = $journal->slug_en ?: Str::slug($enTitle);
    $journal->seo_title_tr = $journal->seo_title_tr ?: ($trTitle . ' | Dioreal Journal & Lüks Yaşam');
    $journal->seo_title_en = $journal->seo_title_en ?: ($enTitle . ' | Dioreal Journal & Luxury Lifestyle');
    $journal->seo_description_tr = $journal->seo_description_tr ?: Str::limit(strip_tags($trDesc), 155);
    $journal->seo_description_en = $journal->seo_description_en ?: Str::limit(strip_tags($enDesc), 155);
    $journal->save();
}
echo "✔ Updated " . count($journals) . " Journals with SEO metadata\n";

echo "\n🎉 ALL SEO META DATA AND SLUGS ARE 100% GENERATED!\n";
