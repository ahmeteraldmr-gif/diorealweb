<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
    
    <!-- Static Pages -->
    @php
        $staticRoutes = [
            'home' => ['freq' => 'daily', 'prio' => '1.0'],
            'hakkimizda' => ['freq' => 'weekly', 'prio' => '0.8'],
            'oteller' => ['freq' => 'daily', 'prio' => '0.9'],
            'yatlar' => ['freq' => 'daily', 'prio' => '0.9'],
            'restoranlar' => ['freq' => 'daily', 'prio' => '0.9'],
            'gezi-rehberi' => ['freq' => 'daily', 'prio' => '0.9'],
            'etkinlikler' => ['freq' => 'daily', 'prio' => '0.9'],
            'journal' => ['freq' => 'daily', 'prio' => '0.9'],
        ];
    @endphp

    @foreach($staticRoutes as $routeName => $meta)
    <url>
        <loc>{{ route($routeName) }}</loc>
        <xhtml:link rel="alternate" hreflang="tr" href="{{ route($routeName, ['lang' => 'tr']) }}"/>
        <xhtml:link rel="alternate" hreflang="en" href="{{ route($routeName, ['lang' => 'en']) }}"/>
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ route($routeName) }}"/>
        <changefreq>{{ $meta['freq'] }}</changefreq>
        <priority>{{ $meta['prio'] }}</priority>
    </url>
    @endforeach

    <!-- Dynamic Content -->
    @foreach ($hotels as $hotel)
    @php
        $slugTr = $hotel->slug_tr ?: $hotel->id;
        $slugEn = $hotel->slug_en ?: $slugTr;
    @endphp
    <url>
        <loc>{{ route('otel.detay', $slugTr) }}</loc>
        <xhtml:link rel="alternate" hreflang="tr" href="{{ route('otel.detay', ['slug_or_id' => $slugTr, 'lang' => 'tr']) }}"/>
        <xhtml:link rel="alternate" hreflang="en" href="{{ route('otel.detay', ['slug_or_id' => $slugEn, 'lang' => 'en']) }}"/>
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ route('otel.detay', $slugTr) }}"/>
        <lastmod>{{ $hotel->updated_at ? $hotel->updated_at->tz('UTC')->toAtomString() : date('c') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    @foreach ($restaurants as $restaurant)
    @php
        $slugTr = $restaurant->slug_tr ?: $restaurant->id;
        $slugEn = $restaurant->slug_en ?: $slugTr;
    @endphp
    <url>
        <loc>{{ route('restoran.detay', $slugTr) }}</loc>
        <xhtml:link rel="alternate" hreflang="tr" href="{{ route('restoran.detay', ['slug_or_id' => $slugTr, 'lang' => 'tr']) }}"/>
        <xhtml:link rel="alternate" hreflang="en" href="{{ route('restoran.detay', ['slug_or_id' => $slugEn, 'lang' => 'en']) }}"/>
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ route('restoran.detay', $slugTr) }}"/>
        <lastmod>{{ $restaurant->updated_at ? $restaurant->updated_at->tz('UTC')->toAtomString() : date('c') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    @foreach ($yachts as $yacht)
    @php
        $slugTr = $yacht->slug_tr ?: $yacht->id;
        $slugEn = $yacht->slug_en ?: $slugTr;
    @endphp
    <url>
        <loc>{{ route('yat.detay', $slugTr) }}</loc>
        <xhtml:link rel="alternate" hreflang="tr" href="{{ route('yat.detay', ['slug_or_id' => $slugTr, 'lang' => 'tr']) }}"/>
        <xhtml:link rel="alternate" hreflang="en" href="{{ route('yat.detay', ['slug_or_id' => $slugEn, 'lang' => 'en']) }}"/>
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ route('yat.detay', $slugTr) }}"/>
        <lastmod>{{ $yacht->updated_at ? $yacht->updated_at->tz('UTC')->toAtomString() : date('c') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    @foreach ($destinations as $destination)
    @php
        $slugTr = $destination->slug_tr ?: $destination->id;
        $slugEn = $destination->slug_en ?: $slugTr;
    @endphp
    <url>
        <loc>{{ route('destinasyon.detay', $slugTr) }}</loc>
        <xhtml:link rel="alternate" hreflang="tr" href="{{ route('destinasyon.detay', ['slug_or_id' => $slugTr, 'lang' => 'tr']) }}"/>
        <xhtml:link rel="alternate" hreflang="en" href="{{ route('destinasyon.detay', ['slug_or_id' => $slugEn, 'lang' => 'en']) }}"/>
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ route('destinasyon.detay', $slugTr) }}"/>
        <lastmod>{{ $destination->updated_at ? $destination->updated_at->tz('UTC')->toAtomString() : date('c') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach
    
    @foreach ($guides as $guide)
    @php
        $slugTr = $guide->slug_tr ?: $guide->id;
        $slugEn = $guide->slug_en ?: $slugTr;
    @endphp
    <url>
        <loc>{{ route('rehber.detay', $slugTr) }}</loc>
        <xhtml:link rel="alternate" hreflang="tr" href="{{ route('rehber.detay', ['slug_or_id' => $slugTr, 'lang' => 'tr']) }}"/>
        <xhtml:link rel="alternate" hreflang="en" href="{{ route('rehber.detay', ['slug_or_id' => $slugEn, 'lang' => 'en']) }}"/>
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ route('rehber.detay', $slugTr) }}"/>
        <lastmod>{{ $guide->updated_at ? $guide->updated_at->tz('UTC')->toAtomString() : date('c') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    @foreach ($events as $event)
    @php
        $slugTr = $event->slug_tr ?: $event->id;
        $slugEn = $event->slug_en ?: $slugTr;
    @endphp
    <url>
        <loc>{{ route('etkinlik.detay', $slugTr) }}</loc>
        <xhtml:link rel="alternate" hreflang="tr" href="{{ route('etkinlik.detay', ['slug_or_id' => $slugTr, 'lang' => 'tr']) }}"/>
        <xhtml:link rel="alternate" hreflang="en" href="{{ route('etkinlik.detay', ['slug_or_id' => $slugEn, 'lang' => 'en']) }}"/>
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ route('etkinlik.detay', $slugTr) }}"/>
        <lastmod>{{ $event->updated_at ? $event->updated_at->tz('UTC')->toAtomString() : date('c') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    @foreach ($journals as $journal)
    @php
        $slugTr = $journal->slug_tr ?: $journal->id;
        $slugEn = $journal->slug_en ?: $slugTr;
    @endphp
    <url>
        <loc>{{ route('journal.detay', $slugTr) }}</loc>
        <xhtml:link rel="alternate" hreflang="tr" href="{{ route('journal.detay', ['slug_or_id' => $slugTr, 'lang' => 'tr']) }}"/>
        <xhtml:link rel="alternate" hreflang="en" href="{{ route('journal.detay', ['slug_or_id' => $slugEn, 'lang' => 'en']) }}"/>
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ route('journal.detay', $slugTr) }}"/>
        <lastmod>{{ $journal->updated_at ? $journal->updated_at->tz('UTC')->toAtomString() : date('c') }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

</urlset>
