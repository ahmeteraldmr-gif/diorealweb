<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    
    <!-- Static Pages -->
    <url>
        <loc>{{ route('home') }}</loc>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc>{{ route('hakkimizda') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ route('oteller') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ route('yatlar') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ route('restoranlar') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ route('gezi-rehberi') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ route('etkinlikler') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>
    <url>
        <loc>{{ route('journal') }}</loc>
        <changefreq>daily</changefreq>
        <priority>0.9</priority>
    </url>

    <!-- Dynamic Content -->
    @foreach ($hotels as $hotel)
    <url>
        <loc>{{ route('otel.detay', $hotel->slug_tr ?: ($hotel->slug_en ?: $hotel->id)) }}</loc>
        <lastmod>{{ $hotel->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    @foreach ($restaurants as $restaurant)
    <url>
        <loc>{{ route('restoran.detay', $restaurant->slug_tr ?: ($restaurant->slug_en ?: $restaurant->id)) }}</loc>
        <lastmod>{{ $restaurant->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    @foreach ($yachts as $yacht)
    <url>
        <loc>{{ route('yat.detay', $yacht->slug_tr ?: ($yacht->slug_en ?: $yacht->id)) }}</loc>
        <lastmod>{{ $yacht->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    @foreach ($destinations as $destination)
    <url>
        <loc>{{ route('destinasyon.detay', $destination->slug_tr ?: ($destination->slug_en ?: $destination->id)) }}</loc>
        <lastmod>{{ $destination->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach
    
    @foreach ($guides as $guide)
    <url>
        <loc>{{ route('rehber.detay', $guide->slug_tr ?: ($guide->slug_en ?: $guide->id)) }}</loc>
        <lastmod>{{ $guide->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    @foreach ($events as $event)
    <url>
        <loc>{{ route('etkinlik.detay', $event->slug_tr ?: ($event->slug_en ?: $event->id)) }}</loc>
        <lastmod>{{ $event->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    @foreach ($journals as $journal)
    <url>
        <loc>{{ route('journal.detay', $journal->slug_tr ?: ($journal->slug_en ?: $journal->id)) }}</loc>
        <lastmod>{{ $journal->updated_at->tz('UTC')->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

</urlset>
