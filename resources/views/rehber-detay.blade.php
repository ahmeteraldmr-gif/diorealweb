@php
    $locale = get_active_locale();
    $seo_title = ($locale === 'en')
        ? ($rehber->seo_title_en ?: ($rehber->title['en'] ?? 'Detay') . ' - Dioreal')
        : ($rehber->seo_title_tr ?: ($rehber->title['tr'] ?? 'Detay') . ' - Dioreal');
    $seo_desc = ($locale === 'en')
        ? ($rehber->seo_description_en ?: \Illuminate\Support\Str::limit(strip_tags($rehber->desc['en'] ?? ''), 155))
        : ($rehber->seo_description_tr ?: \Illuminate\Support\Str::limit(strip_tags($rehber->desc['tr'] ?? ''), 155));
    $og_image = $rehber->og_image ? asset($rehber->og_image) : asset($rehber->img);
    $canonical = $canonical ?? route('rehber.detay', $rehber->slug_tr ?: $rehber->id);
    $noindex = $rehber->seo_noindex;
    
    $hreflang_tr = $hreflang_tr ?? route('rehber.detay', $rehber->slug_tr ?: $rehber->id);
    $hreflang_en = $hreflang_en ?? ($rehber->slug_en ? route('rehber.detay', $rehber->slug_en) : null);
    $og_type = 'Article' == 'Article' ? 'article' : 'website';

    $schema_json = '<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Article",
      "name": "'.addslashes($rehber->title['tr'] ?? '').'",
      "description": "'.addslashes($seo_desc).'",
      "image": "'.$og_image.'",
      "url": "'.$canonical.'"
    }
    </script>';
@endphp
<!DOCTYPE html>
<html lang="{{ get_active_locale() }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url('/') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>{{ $seo_title }}</title>
    <meta name="description" content="{{ $seo_desc }}">
    
    <link rel="canonical" href="{{ $canonical }}">
    @if(isset($hreflang_tr)) <link rel="alternate" hreflang="tr" href="{{ $hreflang_tr }}" /> @endif
    @if(isset($hreflang_en)) <link rel="alternate" hreflang="en" href="{{ $hreflang_en }}" /> @endif
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
    <meta property="og:type" content="{{ $og_type }}">
    <meta property="og:site_name" content="Dioreal">
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seo_title }}">
    <meta name="twitter:description" content="{{ $seo_desc }}">
    <meta name="twitter:image" content="{{ $og_image }}">

    @if(isset($schema_json))
    {!! $schema_json !!}
    @endif
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Jost:wght@200;300;400;500;600&family=Oswald:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/nav-footer.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/about.css') }}?v={{ time() }}">
    <style>
        /* ── DESTINATION GUIDE DETAIL PAGE ── */
        .jd-hero {
            position: relative;
            height: 70vh;
            min-height: 480px;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: flex-end;
            overflow: hidden;
        }
        .jd-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(11,10,9,0.2) 0%, rgba(11,10,9,0.85) 100%);
            z-index: 1;
        }
        .jd-hero-content {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            padding: 4rem 4rem;
        }
        .jd-eyebrow {
            font-family: var(--font-condensed);
            font-size: 0.8rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }
        .jd-title {
            font-family: var(--font-display);
            font-size: clamp(2.2rem, 4.5vw, 4rem);
            font-weight: 300;
            line-height: 1.1;
            color: var(--white);
            max-width: 900px;
        }
        .jd-title em {
            font-style: italic;
            font-weight: 300;
            color: var(--accent);
        }

        .jd-body {
            max-width: 1200px;
            margin: 0 auto;
            padding: 7rem 4rem;
            display: grid;
            grid-template-columns: 1.8fr 1fr;
            gap: 6rem;
        }

        .jd-article {
            font-family: var(--font-body);
        }
        .jd-lead {
            font-family: var(--font-display);
            font-size: 1.5rem;
            line-height: 1.6;
            color: var(--near-black);
            margin-bottom: 2.5rem;
            font-weight: 300;
            border-left: 2px solid var(--accent);
            padding-left: 1.5rem;
        }
        .jd-content {
            font-size: 1.05rem;
            line-height: 1.95;
            color: var(--dark-gray);
        }
        .jd-content p {
            margin-bottom: 2rem;
        }

        /* Sidebar Styles */
        .jd-sidebar {
            position: sticky;
            top: 120px;
            height: fit-content;
        }
        .jd-back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-family: var(--font-condensed);
            font-size: 0.8rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--near-black);
            text-decoration: none;
            margin-bottom: 3.5rem;
            transition: color 0.3s;
        }
        .jd-back-btn:hover {
            color: var(--accent);
        }
        .jd-sidebar-title {
            font-family: var(--font-condensed);
            font-size: 0.8rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--mid-gray);
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--light-gray);
        }

        .jd-related-item {
            display: grid;
            grid-template-columns: 90px 1fr;
            gap: 1.2rem;
            align-items: center;
            cursor: pointer;
            padding: 1.2rem 0;
            border-bottom: 1px solid var(--light-gray);
            text-decoration: none;
            transition: opacity 0.3s;
        }
        .jd-related-item:hover { opacity: 0.7; }
        .jd-related-item img {
            width: 100%;
            aspect-ratio: 4/3;
            object-fit: cover;
        }
        .jd-related-date {
            font-size: 0.65rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--mid-gray);
            display: block;
            margin-bottom: 0.4rem;
        }
        .jd-related-name {
            font-family: var(--font-display);
            font-size: 1rem;
            color: var(--near-black);
            line-height: 1.3;
        }

        .jd-share {
            margin-top: 3.5rem;
        }
        .jd-share-label {
            font-family: var(--font-condensed);
            font-size: 0.8rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--mid-gray);
            display: block;
            margin-bottom: 1rem;
        }
        .jd-share-btns {
            display: flex;
            gap: 0.8rem;
        }
        .jd-share-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            border: 1px solid var(--light-gray);
            font-size: 0.75rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s;
            background: none;
            color: var(--dark-gray);
            text-decoration: none;
        }
        .jd-share-btn:hover {
            background: var(--near-black);
            color: var(--white);
            border-color: var(--near-black);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .jd-body { grid-template-columns: 1fr; gap: 3rem; padding: 4rem 2rem; }
            .jd-hero-content { padding: 3rem 2rem; }
            .jd-title { font-size: 2.2rem; }
        }
    </style>
    @php
        $seo_title = $seo_title ?? 'Dioreal Dijital - Global Deneyim & Medya Platformu';
        $seo_desc = $seo_desc ?? 'Türkiye ve dünyada seçkin deneyimlerin kapısını aralıyoruz. Lüks oteller, yatlar ve yaşam tarzı markaları için yeni nesil medya platformu.';
        $og_image = $og_image ?? asset('foto.img/hero_4k.jpg');
        $canonical = $canonical ?? url()->current();
        $noindex = $noindex ?? false;
    @endphp

    <title>{{ $seo_title }}</title>
    <meta name="description" content="{{ $seo_desc }}">
    
    <link rel="canonical" href="{{ $canonical }}">
    @if(isset($hreflang_tr)) <link rel="alternate" hreflang="tr" href="{{ $hreflang_tr }}" /> @endif
    @if(isset($hreflang_en)) <link rel="alternate" hreflang="en" href="{{ $hreflang_en }}" /> @endif
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
            <li><a href="{{ route('gezi-rehberi') }}" class="active-page" data-i18n="nav_guide">Destinasyonlar</a></li>
            <li><a href="{{ route('etkinlikler') }}" data-i18n="nav_events">Etkinlikler</a></li>
            <li><a href="{{ route('journal') }}" data-i18n="nav_journal">Journal</a></li>
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
            <li><a href="{{ route('gezi-rehberi') }}" class="active-page" data-i18n="nav_guide">Destinasyonlar</a></li>
            <li><a href="{{ route('etkinlikler') }}" data-i18n="nav_events">Etkinlikler</a></li>
            <li><a href="{{ route('journal') }}" data-i18n="nav_journal">Journal</a></li>
            <li style="font-size:1.5rem;font-family:var(--font-display);margin-top:2rem;"><span id="lang-tr-fs" class="lang-btn active">TR</span> | <span id="lang-en-fs" class="lang-btn">EN</span></li>
        </ul>
    </div>

    <!-- Hero Banner -->
    @php
        $showVideoCover = !empty($rehber->show_video_on_cover) && (!empty($rehber->video_file) || !empty($rehber->video_url));
        $rehberImg = !empty($rehber->img) ? $rehber->img : 'foto.img/etkinlik_hero.jpg';
        $rehberImgUrl = str_starts_with($rehberImg, 'data:') || str_starts_with($rehberImg, 'http') ? $rehberImg : asset($rehberImg);
    @endphp
    <div class="jd-hero" style="@if(!$showVideoCover) background-image: url('{{ $rehberImgUrl }}'); @endif">
        @if($showVideoCover)
            <div class="hero-video-container" style="position: absolute; inset: 0; width: 100%; height: 100%; overflow: hidden; z-index: 0;">
                @if(!empty($rehber->video_file))
                    <video src="{{ asset($rehber->video_file) }}" autoplay loop muted playsinline style="width: 100%; height: 100%; object-fit: cover;"></video>
                @elseif(!empty($rehber->video_url))
                    @php
                        $embedUrl = $rehber->video_url;
                        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $rehber->video_url, $matches)) {
                            $embedUrl = 'https://www.youtube.com/embed/' . $matches[1] . '?autoplay=1&mute=1&loop=1&playlist=' . $matches[1] . '&controls=0&showinfo=0&rel=0&iv_load_policy=3&playsinline=1';
                        }
                    @endphp
                    <iframe src="{{ $embedUrl }}" frameborder="0" allow="autoplay; encrypted-media" style="position: absolute; top: 50%; left: 50%; width: 100vw; height: 56.25vw; min-width: 100%; min-height: 100%; transform: translate(-50%, -50%); pointer-events: none; object-fit: cover;"></iframe>
                @endif
                <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.5); z-index: 1;"></div>
            </div>
        @endif
        <div class="jd-hero-content" style="position: relative; z-index: 2;">
            <div class="jd-eyebrow">
                <span class="lang-text-tr">{{ $rehber->tag['tr'] ?? 'Destinasyon Rehberi' }}</span>
                <span class="lang-text-en">{{ $rehber->tag['en'] ?? 'Destination Guide' }}</span>
            </div>
            <h1 class="jd-title">
                <span class="lang-text-tr">{{ $rehber->title['tr'] ?? '' }}</span>
                <span class="lang-text-en">{{ $rehber->title['en'] ?? '' }}</span>
            </h1>
        </div>
    </div>

    <!-- Article Body -->
    <div class="jd-body">
        <!-- Main Article Content -->
        <article class="jd-article">
            <div class="jd-content">
                <!-- We render long descriptions with paragraphs -->
                <div class="lang-text-tr">{!! nl2br($rehber->desc['tr'] ?? '') !!}</div>
                <div class="lang-text-en">{!! nl2br($rehber->desc['en'] ?? '') !!}</div>
            </div>
        </article>

        <!-- Sidebar -->
        <aside class="jd-sidebar">
            <a href="{{ route('gezi-rehberi') }}" class="jd-back-btn">
                ← <span class="lang-text-tr">Destinasyonlara Dön</span>
                <span class="lang-text-en">Back to Destinations</span>
            </a>

            @if($otherGuides->count() > 0)
                <div class="jd-sidebar-title">
                    <span class="lang-text-tr">Diğer Destinasyonlar</span>
                    <span class="lang-text-en">Other Destinations</span>
                </div>

                @foreach($otherGuides as $item)
                    <a href="{{ route('rehber.detay', $item->slug_tr ?? $item->slug_en ?? $item->id) }}" class="jd-related-item">
                        <img src="{{ asset($item->img) }}" alt="{{ $item->title['tr'] ?? '' }}">
                        <div>
                            <div class="jd-related-name">
                                <span class="lang-text-tr">{{ $item->title['tr'] ?? '' }}</span>
                                <span class="lang-text-en">{{ $item->title['en'] ?? '' }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif

            <!-- Share -->
            <div class="jd-share">
                <span class="jd-share-label">
                    <span class="lang-text-tr">Paylaş</span>
                    <span class="lang-text-en">Share</span>
                </span>
                <div class="jd-share-btns">
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($rehber->title['tr'] ?? '') }}"
                       target="_blank" class="jd-share-btn">
                        <i class="fab fa-x-twitter"></i> X
                    </a>
                    <a href="https://wa.me/?text={{ urlencode(($rehber->title['tr'] ?? '') . ' ' . url()->current()) }}"
                       target="_blank" class="jd-share-btn">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                </div>
            </div>
        </aside>
    </div>

    @include('partials.footer')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="{{ asset('js/i18n.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/common.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/nav.js') }}?v={{ time() }}"></script>
</body>
</html>
