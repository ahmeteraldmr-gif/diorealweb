<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Comprehensive high-quality English translations for Destinations
$destTranslations = [
    1 => [ // İstanbul
        'region' => 'Metropolis',
        'desc' => "When you first look at Istanbul, the historic silhouette of the Bosphorus captures your eyes. A few minutes later, its ancient minarets, grand palaces, and vibrant avenues begin to unfold.

Founded as Byzantium and later becoming Constantinople, Istanbul served as the imperial capital for the Roman, Byzantine, and Ottoman empires. The majestic Hagia Sophia and Topkapi Palace stand as living witnesses to this extraordinary heritage.

Istanbul is a captivating bridge between Europe and Asia, blending rich history, gourmet dining, and a world-class luxury lifestyle."
    ],
    2 => [ // Bodrum
        'region' => 'Luxury & Beach',
        'desc' => "Many first-time visitors head straight to Yalıkavak Marina or vibrant beach clubs. Yet Bodrum's story goes far deeper.

For nearly 2,500 years, this peninsula has been one of the Mediterranean's most vital maritime hubs. From the ancient stones of Halicarnassus to the medieval Castle of St. Peter, generations have marveled at these crystal-clear turquoise waters.

Exploring Bodrum means discovering white-washed villages, olive groves, secluded coves, and world-class superyacht marinas."
    ],
    3 => [ // Fethiye
        'region' => 'Nature & Yachting',
        'desc' => "When you first look at Fethiye, the deep turquoise sea captures your attention. A few minutes later, surrounding pine forests, soaring mountains, and scattered islands begin to unfold.

Originally established thousands of years ago as Telmessos in the Lycian civilization, Fethiye is famous for its rock-cut Amyntas Tombs overlooking the gulf.

From the serene lagoon of Ölüdeniz and the ghost village of Kayaköy to the dramatic cliffs of Butterfly Valley and the famous Lycian Way, Fethiye is a paradise for nature and yachting enthusiasts."
    ],
    4 => [ // Kapadokya
        'region' => 'Culture & Magic',
        'desc' => "Cappadocia presents a surreal landscape sculpted by millions of years of volcanic erosion and human craftsmanship.

Famous for its fairy chimneys, underground cities, and centuries-old cave dwellings, Cappadocia offers a truly magical experience.

Floating above the valleys in a hot air balloon at sunrise is one of the world's most unforgettable journeys."
    ],
    5 => [ // Çeşme
        'region' => 'Aegean Spirit',
        'desc' => "Located on the westernmost tip of Turkey, Çeşme is renowned for its crystal waters, thermal springs, and windsurfing bays.

The cobblestone streets of Alaçatı, adorned with stone houses and bougainvillea, offer a vibrant culinary and boutique lifestyle.

With pristine beaches and warm Aegean hospitality, Çeşme is a quintessential summer retreat."
    ],
    6 => [ // Kaş
        'region' => 'Boutique & Slow',
        'desc' => "Kaş retains the bohemian charm of an authentic Mediterranean fishing village surrounded by dramatic coastal cliffs.

With ancient Antiphellos theater ruins, vibrant bougainvillea-lined alleys, and world-class scuba diving, Kaş invites travelers to slow down and savor life.

The world-famous Kaputaş Beach and sunken ruins of Kekova lie just a short boat ride away."
    ],
    7 => [ // Datça
        'region' => 'Pure Nature',
        'desc' => "Datça peninsula separates the Aegean and Mediterranean seas, offering pure air, secluded coves, and ancient olive trees.

Home to the ancient city of Knidos where Eudoxus and Praxiteles once lived, Datça is celebrated for its pristine almond groves and crystal bays.

It is the ultimate destination for those seeking tranquility, unblemished nature, and authentic coastal life."
    ],
    8 => [ // Maldivler
        'region' => 'Tropical',
        'desc' => "The Maldives is an archipelago of over a thousand coral islands scattered across the turquoise expanse of the Indian Ocean.

Renowned for overwater villas, powder-white sand beaches, and vibrant coral reefs, it represents the epitome of tropical luxury.

Unwind in absolute privacy with world-class spa treatments, private dining on sandbanks, and swimming alongside whale sharks."
    ],
    9 => [ // Japonya
        'region' => 'Asia & Culture',
        'desc' => "Japan offers an extraordinary harmony between ancient traditions and futuristic innovation.

From the neon-lit avenues of Tokyo and zen temples of Kyoto to the snow-capped peaks of Mount Fuji, Japan captivates every traveler.

Immerse yourself in tea ceremonies, Michelin-starred gastronomy, and timeless omotenashi hospitality."
    ],
    10 => [ // Patagonya
        'region' => 'Wild Nature',
        'desc' => "Stretching across the southern tips of Chile and Argentina, Patagonia is one of the planet's last true wildernesses.

Towering granite spires of Torres del Paine, massive glaciers of Perito Moreno, and vast windswept steppes create breathtaking vistas.

An ideal haven for trekkers, adventurers, and travelers seeking untouched natural grandeur."
    ],
    11 => [ // Amalfi Kıyısı
        'region' => 'Mediterranean Dream',
        'desc' => "The Amalfi Coast is a dramatic stretch of coastline in southern Italy where pastel-colored towns cling to vertical cliffside slopes.

From Positano's steep streets and Ravello's garden villas to the lemon groves of Amalfi, this UNESCO World Heritage coast exudes classic Italian glamour.

Enjoy panoramic sea vistas, cliffside dining, and luxury yacht charters along the Tyrrhenian Sea."
    ],
    12 => [ // Norveç Fiyortları
        'region' => 'Northern Lights',
        'desc' => "Norway's fjords carved by ancient glaciers present some of the earth's most dramatic natural sceneries.

Cascading waterfalls, sheer mountain cliffs, and tranquil waters frame picturesque Scandinavian coastal villages.

Sail through Geirangerfjord or witness the dancing colors of the Aurora Borealis in the northern skies."
    ],
    13 => [ // Sahra Çölü
        'region' => 'Infinity',
        'desc' => "The Sahara Desert is an awe-inspiring ocean of golden sand dunes stretching across North Africa.

Experience starlit nights in luxury Berber desert camps, camel treks across Erg Chebbi dunes, and mesmerizing sunrises.

The silence and vastness of the desert offer a profound spiritual connection to nature."
    ],
    14 => [ // İsviçre Alpleri
        'region' => 'Adventure & Snow',
        'desc' => "The Swiss Alps feature majestic snow-capped peaks, iconic glaciers, and alpine villages like Zermatt and St. Moritz.

Home to the famous Matterhorn, world-class skiing, and panoramic glacier express train routes.

Enjoy cozy chalet fireplaces, fondue dining, and breathtaking high-altitude alpine views."
    ],
    15 => [ // İzlanda
        'region' => 'Fire & Ice',
        'desc' => "Iceland is a land of dramatic contrasts, where roaring geysers, volcanic landscapes, and massive glaciers coexist.

Soak in the geothermal waters of the Blue Lagoon, walk behind Gullfoss waterfall, and explore black sand beaches of Vik.

In winter, the night sky lights up with mesmerising displays of the Northern Lights."
    ],
    16 => [ // Kosta Rika
        'region' => 'Eco-Tourism',
        'desc' => "Costa Rica is a pioneer in eco-tourism, boasting lush rainforests, active volcanoes, and pristine Pacific and Caribbean coasts.

Discover sloths, toucans, and zip-line through cloud forest canopies in Monteverde.

Embrace the 'Pura Vida' lifestyle surrounded by rich biodiversity and sustainable luxury retreats."
    ],
    17 => [ // Toskana
        'region' => 'Tuscan Sun',
        'desc' => "Tuscany captivates with rolling hills, cypress-lined avenues, medieval hilltop towns, and world-renowned vineyards.

Explore Florence's Renaissance art, Chianti wine estates, and historic stone villas.

Savor authentic Italian cuisine prepared with fresh local truffles, olive oil, and aged wines."
    ],
    18 => [ // Kyoto
        'region' => 'Zen & Heritage',
        'desc' => "Kyoto is Japan's cultural heart, preserving thousands of classical Buddhist temples, shinto shrines, and geisha districts.

Walk through Arashiyama's bamboo groves and marvel at the golden pavilion of Kinkaku-ji.

Kyoto offers peaceful zen gardens, traditional ryokan lodging, and seasonal cherry blossom splendor."
    ],
    19 => [ // Lapland
        'region' => 'Winter Wonder',
        'desc' => "Lapland in northern Finland is an enchanted winter wonderland covered in crisp white snow.

Home to Santa Claus Village, husky sled safaris, reindeer rides, and glass igloo hotels under the Northern Lights.

Experience authentic Finnish sauna culture in a serene arctic atmosphere."
    ],
    20 => [ // Seyşeller
        'region' => 'Island Paradise',
        'desc' => "The Seychelles is an archipelago of 115 granite and coral islands in the Indian Ocean.

Famous for Anse Source d'Argent beach with sculptured granite boulders and crystal blue lagoons.

A private island haven for snorkeling, diving, and romantic luxury getaways."
    ],
    21 => [ // Petra Antik Kenti
        'region' => 'Ancient Wonder',
        'desc' => "Petra is an ancient Nabataean city carved directly into rose-red desert rock cliffs in southern Jordan.

Walk through the narrow Siq canyon to behold the breath-taking facade of Al-Khazneh (The Treasury).

A world heritage site showcasing ancient engineering, royal tombs, and timeless desert mystery."
    ],
    22 => [ // Paris
        'region' => 'City of Light',
        'desc' => "Paris stands as a global capital of art, fashion, gastronomy, and culture.

Iconic landmarks including the Eiffel Tower, Louvre Museum, and Notre-Dame line the romantic banks of the Seine.

Enjoy sidewalk cafes, haute couture shopping, and Michelin-starred dining in the City of Light."
    ]
];

// Update Destinations JSON
$destPath = storage_path('app/data/dioreal_destinations_data.json');
$destData = json_decode(file_get_contents($destPath), true);

foreach ($destData as &$d) {
    $id = (int)$d['id'];
    if (isset($destTranslations[$id])) {
        $d['region']['en'] = $destTranslations[$id]['region'];
        $d['desc']['en'] = $destTranslations[$id]['desc'];
    }
}
file_put_contents($destPath, json_encode($destData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "✔ Updated dioreal_destinations_data.json with English translations!\n";

// Update Guides (Bodrum & Yalıkavak)
$guidePath = storage_path('app/data/dioreal_guide_data.json');
$guideData = json_decode(file_get_contents($guidePath), true);

foreach ($guideData as &$g) {
    if ((int)$g['id'] === 4) { // Bodrum
        $g['desc']['en'] = "Many first-time visitors head straight to Yalıkavak Marina or popular beach clubs. Yet Bodrum's story goes far deeper.

For nearly 2,500 years, this peninsula has been one of the Mediterranean's most vital maritime hubs. From the ancient stones of Halicarnassus to the medieval Castle of St. Peter, generations have marveled at these crystal-clear turquoise waters.

Exploring Bodrum means discovering white-washed villages, olive groves, secluded coves, and world-class superyacht marinas.";
    } elseif ((int)$g['id'] === 5) { // Yalıkavak
        $g['desc']['en'] = "Yalıkavak has transformed from a quiet fishing village into one of the Mediterranean's premier superyacht destinations.

Home to Yalıkavak Marina, high-end gastronomy, and luxury boutiques, it seamlessly blends modern glamour with Aegean heritage.

Explore nearby Sandima village stone houses, historic windmills, and pristine coastal coves.";
    }
}
file_put_contents($guidePath, json_encode($guideData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "✔ Updated dioreal_guide_data.json with English translations!\n";

echo "\n=== NOW RUNNING JSON SEEDER ===\n";
