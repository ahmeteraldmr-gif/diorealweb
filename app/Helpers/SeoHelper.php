<?php

if (!function_exists('format_whatsapp')) {
    /**
     * Sanitizes any input WhatsApp phone number to clean digit format (e.g. 905449157011)
     */
    function format_whatsapp(?string $number): string
    {
        if (empty($number)) {
            return '905320000000';
        }
        $digits = preg_replace('/[^0-9]/', '', $number);
        if (empty($digits)) {
            return '905320000000';
        }
        if (str_starts_with($digits, '0')) {
            $digits = '90' . substr($digits, 1);
        } elseif (!str_starts_with($digits, '90') && strlen($digits) === 10) {
            $digits = '90' . $digits;
        }
        return $digits;
    }
}

if (!function_exists('make_slug')) {
    /**
     * Generates Turkish-character safe URL slugs
     */
    function make_slug($text, string $lang = 'tr'): ?string
    {
        if (empty($text)) return null;
        if (is_array($text)) {
            $text = $text[$lang] ?? reset($text) ?? '';
        }
        $text = (string)$text;
        if (trim($text) === '') return null;

        $turk = ['ç', 'Ç', 'ğ', 'Ğ', 'ı', 'İ', 'ö', 'Ö', 'ş', 'Ş', 'ü', 'Ü'];
        $eng  = ['c', 'c', 'g', 'g', 'i', 'i', 'o', 'o', 's', 's', 'u', 'u'];
        $text = str_replace($turk, $eng, $text);

        return \Illuminate\Support\Str::slug($text);
    }
}

if (!function_exists('get_active_locale')) {
    /**
     * Resolves the current locale from request input 'lang'
     */
    function get_active_locale(): string
    {
        return request('lang') === 'en' ? 'en' : 'tr';
    }
}

if (!function_exists('get_page_seo')) {
    /**
     * Returns page specific default SEO title and description for Turkish and English
     */
    function get_page_seo(string $pageKey): array
    {
        $seoMap = [
            'home' => [
                'title_tr' => 'Dioreal Dijital — Lüks Seyahat, Koleksiyon Oteller & Yaşam Tarzı',
                'title_en' => 'Dioreal Digital — Luxury Travel, Collection Hotels & Lifestyle',
                'desc_tr'  => 'Seçkin destinasyonlar, premium markalar ve eşsiz tatil deneyimlerini bir araya getiren bağımsız lüks seyahat platformu.',
                'desc_en'  => 'An independent luxury travel platform connecting exclusive destinations, boutique hotels, and luxury lifestyle experiences.',
            ],
            'hakkimizda' => [
                'title_tr' => 'Hakkımızda — Dioreal Dijital Lüks Seyahat Medyası',
                'title_en' => 'About Us — Dioreal Digital Luxury Travel Media',
                'desc_tr'  => 'Dioreal Dijital hakkında daha fazla bilgi edinin: Seçkin destinasyonlar ve premium yaşam tarzını buluşturan yayıncılık vizyonumuz.',
                'desc_en'  => 'Discover Dioreal Digital: Our publishing vision bridging exclusive destinations, curated hotels, and luxury lifestyle.',
            ],
            'oteller' => [
                'title_tr' => 'Lüks Oteller & Butik Konaklama Koleksiyonu — Dioreal Dijital',
                'title_en' => 'Luxury Hotels & Boutique Stays Collection — Dioreal Digital',
                'desc_tr'  => 'Türkiye ve dünyanın en seçkin butik otelleri, resortları ve lüks konaklama seçeneklerini keşfedin.',
                'desc_en'  => 'Explore Turkey and the world’s finest boutique hotels, luxury resorts, and bespoke accommodation choices.',
            ],
            'yatlar' => [
                'title_tr' => 'Özel Yat Kiralama & Mavi Yolculuk Filosu — Dioreal Dijital',
                'title_en' => 'Private Yacht Charter & Blue Cruise Fleet — Dioreal Digital',
                'desc_tr'  => 'Ege ve Akdeniz’in en prestijli motor yatları, guletleri ve yelkenlileri ile kişiye özel mavi yolculuk turları.',
                'desc_en'  => 'Bespoke blue cruise journeys with the Aegean and Mediterranean’s most prestigious motor yachts and luxury gulets.',
            ],
            'restoranlar' => [
                'title_tr' => 'Gastronomi & Seçkin Restoran Rehberi — Dioreal Dijital',
                'title_en' => 'Gastronomy & Fine Dining Restaurant Guide — Dioreal Digital',
                'desc_tr'  => 'Michelin yıldızlı restoranlar, gurme lezzetler ve eşsiz manzaralı fine-dining mekanlar.',
                'desc_en'  => 'Michelin-starred dining, fine culinary experiences, and exclusive gourmet restaurant recommendations.',
            ],
            'gezi-rehberi' => [
                'title_tr' => 'Destinasyon ve Gezi Rehberleri — Dioreal Dijital',
                'title_en' => 'Destination & Travel Guides — Dioreal Digital',
                'desc_tr'  => 'Bodrum’dan Kapadokya’ya, Amalfi’den Kyoto’ya derinlemesine destinasyon rehberleri ve rota tavsiyeleri.',
                'desc_en'  => 'Comprehensive destination guides, travel itineraries, and cultural stories from Bodrum to Kyoto.',
            ],
            'etkinlikler' => [
                'title_tr' => 'Küresel Etkinlikler & Özel Festival Calendar — Dioreal Dijital',
                'title_en' => 'Global Events & Exclusive Festivals Calendar — Dioreal Digital',
                'desc_tr'  => 'Dünyanın en saygın kültür, sanat, film festivalleri ve yat şovlarından güncel etkinlik takvimi.',
                'desc_en'  => 'Curated calendar of prestigious international art festivals, film galas, yacht shows, and cultural gatherings.',
            ],
            'journal' => [
                'title_tr' => 'Dioreal Journal — Seyahat, Kültür & Yaşam Tarzı Dergisi',
                'title_en' => 'Dioreal Journal — Travel, Culture & Lifestyle Magazine',
                'desc_tr'  => 'İlham veren seyahat makaleleri, mimari yazıları ve yavaş yaşam felsefesi üzerine edebi içerikler.',
                'desc_en'  => 'Inspiring travel essays, architectural stories, and curated lifestyle articles on the art of slow travel.',
            ],
        ];

        return $seoMap[$pageKey] ?? $seoMap['home'];
    }
}
