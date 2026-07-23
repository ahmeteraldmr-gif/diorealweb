<!DOCTYPE html>
<html lang="{{ get_active_locale() }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url('/') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Jost:wght@200;300;400;500;600&family=Oswald:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/nav-footer.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/about.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/journal.css') }}?v={{ time() }}">
    @php
        $locale = get_active_locale();
        $seoData = get_page_seo('journal');
        $seo_title = $seo_title ?? ($locale === 'en' ? $seoData['title_en'] : $seoData['title_tr']);
        $seo_desc = $seo_desc ?? ($locale === 'en' ? $seoData['desc_en'] : $seoData['desc_tr']);
        $og_image = $og_image ?? asset('foto.img/amalfi.jpg');
        $canonical = $canonical ?? route('journal');
        $hreflang_tr = $hreflang_tr ?? route('journal');
        $hreflang_en = $hreflang_en ?? route('journal');
        $noindex = $noindex ?? false;
    @endphp

    <title>{{ $seo_title }}</title>
    <meta name="description" content="{{ $seo_desc }}">
    
    <link rel="canonical" href="{{ $canonical }}">
    <link rel="alternate" hreflang="tr" href="{{ $hreflang_tr }}" />
    <link rel="alternate" hreflang="en" href="{{ $hreflang_en }}" />
    <link rel="alternate" hreflang="x-default" href="{{ $canonical }}" />

    @if($noindex)
    <meta name="robots" content="noindex, nofollow">
    @else
    <meta name="robots" content="index, follow">
    @endif

    <meta property="og:title" content="{{ $seo_title }}">
    <meta property="og:description" content="{{ $seo_desc }}">
    <meta property="og:image" content="{{ $og_image }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:type" content="{{ $og_type ?? 'website' }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seo_title }}">
    <meta name="twitter:description" content="{{ $seo_desc }}">
    <meta name="twitter:image" content="{{ $og_image }}">

    @if(isset($schema_json))
    {!! $schema_json !!}
    @endif
</head>
<body>
    <nav id="mainNav">
        <div class="nav-logo-wrapper">
            <a href="{{ route('home') }}" class="nav-logo">
                <span class="logo-text">DIOREAL</span>
            </a>
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('hakkimizda') }}" data-i18n="nav_about">Hakkımızda</a></li>
            <li><a href="{{ route('oteller') }}" data-i18n="nav_hotels">Oteller</a></li>
            <li><a href="{{ route('yatlar') }}" data-i18n="nav_yachts">Yatlar</a></li>
            <li><a href="{{ route('restoranlar') }}" data-i18n="nav_restaurants">Restoranlar</a></li>
            <li><a href="{{ route('gezi-rehberi') }}" data-i18n="nav_guide">Gezi Rehberi</a></li>
            <li><a href="{{ route('etkinlikler') }}" data-i18n="nav_events">Etkinlikler</a></li>
            <li><a href="{{ route('journal') }}" class="active-page" data-i18n="nav_journal">Journal</a></li>
        </ul>
        <div class="nav-right">
            <div class="lang-switch desk-lang">
                <span id="lang-tr" class="lang-btn active">TR</span>
                <span>|</span>
                <span id="lang-en" class="lang-btn">EN</span>
            </div>
            <div class="hamburger" id="hamb">
                <span></span><span></span><span></span>
            </div>
        </div>
    </nav>
    <div class="fs-menu" id="fsMenu">
        <ul class="fs-links">
            <li><a href="{{ route('hakkimizda') }}" data-i18n="nav_about">Hakkımızda</a></li>
            <li><a href="{{ route('oteller') }}" data-i18n="nav_hotels">Oteller</a></li>
            <li><a href="{{ route('yatlar') }}" data-i18n="nav_yachts">Yatlar</a></li>
            <li><a href="{{ route('restoranlar') }}" data-i18n="nav_restaurants">Restoranlar</a></li>
            <div class="fs-divider"></div>
            <li><a href="{{ route('gezi-rehberi') }}" data-i18n="nav_guide">Gezi Rehberi</a></li>
            <li><a href="{{ route('etkinlikler') }}" data-i18n="nav_events">Etkinlikler</a></li>
            <li><a href="{{ route('journal') }}" data-i18n="nav_journal">Journal</a></li>
            <li style="font-size:1.5rem;font-family:var(--font-display);margin-top:2rem;"><span id="lang-tr-fs" class="lang-btn active">TR</span> | <span id="lang-en-fs" class="lang-btn">EN</span></li>
        </ul>
    </div>

    <div class="page-hero" style="background-image:url('{{ asset('foto.img/amalfi.jpg') }}');">
        <div class="page-hero-content">
            <span class="page-eyebrow" data-i18n="journal_hero_eye">Hikayeler & İçgörüler</span>
            <h1 class="page-title" data-i18n="nav_journal">Dioreal <em>Journal</em></h1>
        </div>
    </div>

    <section class="content-section">
        <!-- Featured + Sidebar -->
        <div class="journal-grid reveal">
            @if($featured = $journals->first())
                <div class="journal-featured">
                    <img src="{{ asset($featured->img) }}" alt="{{ $featured->title['tr'] ?? '' }}">
                    <div class="journal-featured-info">
                        <span class="card-tag">
                            <span class="lang-text-tr">{{ $featured->tag['tr'] ?? '' }}</span>
                            <span class="lang-text-en">{{ $featured->tag['en'] ?? '' }}</span>
                        </span>
                        <div class="journal-title" style="font-family: var(--font-display); font-size: 2rem; font-weight: 300; margin: 1rem 0;">
                            <span class="lang-text-tr">{{ $featured->title['tr'] ?? '' }}</span>
                            <span class="lang-text-en">{{ $featured->title['en'] ?? '' }}</span>
                        </div>
                        <p style="color:var(--dark-gray);font-size:.95rem;line-height:1.8;margin-bottom:1.5rem;">
                            <span class="lang-text-tr">{{ $featured->desc['tr'] ?? '' }}</span>
                            <span class="lang-text-en">{{ $featured->desc['en'] ?? '' }}</span>
                        </p>
                        <a href="{{ route('journal.detay', $featured->slug_tr ?? $featured->slug_en ?? $featured->id) }}" class="btn btn-outline">
                            <span class="lang-text-tr">Okumaya Devam Et</span>
                            <span class="lang-text-en">Continue Reading</span>
                        </a>
                    </div>
                </div>
            @endif

            <div class="journal-side">
                @foreach($journals->slice(1, 4) as $sideItem)
                    <div class="journal-side-item" onclick="window.location='{{ route('journal.detay', $sideItem->slug_tr ?? $sideItem->slug_en ?? $sideItem->id) }}'" style="cursor:pointer;">
                        <img src="{{ asset($sideItem->img) }}" alt="{{ $sideItem->title['tr'] ?? '' }}">
                        <div>
                            <span class="journal-date">{{ $sideItem->date }}</span>
                            <div class="journal-title">
                                <span class="lang-text-tr">{{ $sideItem->title['tr'] ?? '' }}</span>
                                <span class="lang-text-en">{{ $sideItem->title['en'] ?? '' }}</span>
                            </div>
                            <a href="{{ route('journal.detay', $sideItem->slug_tr ?? $sideItem->slug_en ?? $sideItem->id) }}" class="journal-read-more">
                                <span class="lang-text-tr">Oku &rarr;</span>
                                <span class="lang-text-en">Read &rarr;</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- More Articles -->
        @if($journals->count() > 5)
            <h2 class="content-title reveal" style="margin-bottom:2.5rem;" data-i18n="journal_latest_title">Son <em>Yazılar</em></h2>
            <div class="card-grid">
                @foreach($journals->slice(5) as $index => $item)
                    <a href="{{ route('journal.detay', $item->slug_tr ?? $item->slug_en ?? $item->id) }}" class="card reveal" style="transition-delay:{{ ($index % 3) * 0.1 }}s; text-decoration: none; color: inherit; display: block;">
                        <div class="card-img" style="background-image:url('{{ asset($item->img) }}');"></div>
                        <div class="card-body">
                            <span class="card-tag">
                                <span class="lang-text-tr">{{ $item->tag['tr'] ?? '' }} | {{ $item->date }}</span>
                                <span class="lang-text-en">{{ $item->tag['en'] ?? '' }} | {{ $item->date }}</span>
                            </span>
                            <h3 class="card-title">
                                <span class="lang-text-tr">{{ $item->title['tr'] ?? '' }}</span>
                                <span class="lang-text-en">{{ $item->title['en'] ?? '' }}</span>
                            </h3>
                            <p class="card-desc">
                                <span class="lang-text-tr">{{ $item->desc['tr'] ?? '' }}</span>
                                <span class="lang-text-en">{{ $item->desc['en'] ?? '' }}</span>
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </section>

    @include('partials.footer')
    <script src="{{ asset('js/i18n.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/common.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/nav.js') }}?v={{ time() }}"></script>
</body>
</html>
