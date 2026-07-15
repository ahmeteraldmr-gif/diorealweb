<!DOCTYPE html>
<html lang="tr">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url('/') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Jost:wght@200;300;400;500;600&family=Oswald:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/nav-footer.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}?v={{ time() }}">
    <style>
        body {
            background-color: #0b0a09; /* Deep premium black to mirror Beautiful Destinations */
            color: #f5f4f0; /* Off-white text */
            font-family: var(--font-body), 'Jost', sans-serif;
            overflow-x: hidden;
        }
        
        #mainNav {
            background: rgba(11, 10, 9, 0.85);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        .nav-links a {
            color: rgba(255, 255, 255, 0.6) !important;
        }
        .nav-links a:hover, .nav-links a.active-page {
            color: #ffffff !important;
        }
        .logo-text {
            color: #ffffff !important;
        }
        
        /* Fullscreen Hero Block */
        .bd-hero {
            position: relative;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
            display: flex;
            align-items: center;
            padding-left: 8%;
        }
        .bd-hero-bg {
            position: absolute;
            inset: 0;
            background-image: url('foto.img/otel_hero.jpg');
            background-size: cover;
            background-position: center;
            transform: scale(1.03);
            filter: brightness(0.55);
            z-index: 1;
            transition: transform 2.5s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .bd-hero:hover .bd-hero-bg {
            transform: scale(1);
        }
        .bd-hero-content {
            position: relative;
            z-index: 2;
            max-width: 850px;
            padding-right: 2rem;
        }
        .bd-eyebrow {
            font-family: var(--font-condensed), sans-serif;
            font-size: 0.85rem;
            letter-spacing: 0.45em;
            text-transform: uppercase;
            color: var(--accent, #c8a96e);
            margin-bottom: 1.5rem;
            display: block;
        }
        .bd-title {
            font-family: var(--font-display), Georgia, serif;
            font-size: clamp(3.5rem, 8vw, 6.5rem);
            font-weight: 300;
            line-height: 0.95;
            text-transform: uppercase;
            letter-spacing: -0.02em;
        }
        .bd-title em {
            font-style: italic;
            font-weight: 300;
            color: var(--accent, #c8a96e);
            text-transform: lowercase;
        }

        /* Editorial Container Grid */
        .bd-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 10rem 4rem;
        }
        
        .bd-intro {
            margin-bottom: 12rem;
            display: grid;
            grid-template-columns: 1.3fr 1fr;
            gap: 7rem;
            align-items: center;
        }
        .bd-intro-title {
            font-family: var(--font-display), Georgia, serif;
            font-size: clamp(2.5rem, 5vw, 4.2rem);
            line-height: 1.05;
            font-weight: 300;
        }
        .bd-intro-title em {
            font-style: italic;
            color: var(--accent, #c8a96e);
        }
        .bd-intro-text {
            font-size: 1.15rem;
            line-height: 1.9;
            color: #a09e9a;
            font-weight: 300;
        }

        /* Alternate Staggered Rows */
        .hotel-row {
            display: flex;
            align-items: center;
            gap: 8rem;
            margin-bottom: 15rem;
        }
        .hotel-row:nth-child(even) {
            flex-direction: row-reverse;
        }
        
        .hotel-image-col {
            flex: 1.3;
            position: relative;
            overflow: hidden;
            border-radius: 4px;
            aspect-ratio: 16/10;
            box-shadow: 0 30px 60px rgba(0,0,0,0.5);
            background: #161514;
        }
        .hotel-row-image {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            transition: transform 1.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .hotel-image-col:hover .hotel-row-image {
            transform: scale(1.06);
        }
        
        .hotel-info-col {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .hotel-num {
            font-family: var(--font-condensed), sans-serif;
            font-size: 0.9rem;
            letter-spacing: 0.3em;
            color: var(--accent, #c8a96e);
            margin-bottom: 1rem;
            display: block;
        }
        .hotel-name {
            font-family: var(--font-display), Georgia, serif;
            font-size: clamp(2.2rem, 3.8vw, 3.4rem);
            font-weight: 300;
            line-height: 1.1;
            margin-bottom: 0.5rem;
            color: #ffffff;
        }
        .hotel-tag {
            font-family: var(--font-body), sans-serif;
            font-size: 0.8rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--accent, #c8a96e);
            margin-bottom: 2rem;
            display: block;
            font-weight: 500;
        }
        .hotel-desc {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #a09e9a;
            margin-bottom: 3rem;
            font-weight: 300;
        }
        
        .btn-bd {
            display: inline-flex;
            align-items: center;
            gap: 1.2rem;
            color: #ffffff;
            text-decoration: none;
            font-family: var(--font-condensed), sans-serif;
            font-size: 0.85rem;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            font-weight: 600;
            transition: color 0.3s;
            border-bottom: 2px solid var(--accent, #c8a96e);
            padding-bottom: 0.6rem;
            width: fit-content;
        }
        .btn-bd:hover {
            color: var(--accent, #c8a96e);
        }
        .btn-bd i {
            font-size: 0.8rem;
            transition: transform 0.3s;
        }
        .btn-bd:hover i {
            transform: translateX(6px);
        }
        
        @media (max-width: 992px) {
            .bd-intro {
                grid-template-columns: 1fr;
                gap: 3rem;
                margin-bottom: 6rem;
            }
            .hotel-row {
                flex-direction: column !important;
                gap: 3.5rem;
                margin-bottom: 8rem;
            }
            .hotel-image-col {
                width: 100%;
                aspect-ratio: 16/10;
                flex: none;
            }
            .hotel-info-col {
                width: 100%;
                flex: none;
            }
            .bd-container {
                padding: 6rem 2.5rem;
            }
            .bd-hero {
                padding-left: 5%;
            }
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

    <!-- Desktop Nav -->
    <nav id="mainNav">
        <div class="nav-logo-wrapper">
            <a href="{{ url('/') }}" class="nav-logo">
                <span class="logo-text">DIOREAL</span>
            </a>
        </div>
        <ul class="nav-links">
            <li><a href="{{ url('/hakkimizda') }}" data-i18n="nav_about">Hakkımızda</a></li>
            <li><a href="{{ url('/oteller') }}" class="active-page" data-i18n="nav_hotels">Oteller</a></li>
            <li><a href="{{ url('/yatlar') }}" data-i18n="nav_yachts">Yatlar</a></li>
            <li><a href="{{ url('/restoranlar') }}" data-i18n="nav_restaurants">Restoranlar</a></li>
            <li><a href="{{ url('/destinasyonlar') }}" data-i18n="nav_guide">Destinasyonlar</a></li>
            <li><a href="{{ url('/etkinlikler') }}" data-i18n="nav_events">Etkinlikler</a></li>
            <li><a href="{{ url('/journal') }}" data-i18n="nav_journal">Journal</a></li>
        </ul>
        <div class="nav-right">
            <div class="lang-switch desk-lang">
                <span id="lang-tr" class="lang-btn">TR</span>
                <span>|</span>
                <span id="lang-en" class="lang-btn">EN</span>
            </div>
            <div class="hamburger" id="hamb">
                <span></span><span></span><span></span>
            </div>
        </div>
    </nav>

    <!-- Fullscreen Menu -->
    <div class="fs-menu" id="fsMenu">
        <ul class="fs-links">
            <li><a href="{{ url('/hakkimizda') }}" data-i18n="nav_about">Hakkımızda</a></li>
            <li><a href="{{ url('/oteller') }}" data-i18n="nav_hotels">Oteller</a></li>
            <li><a href="{{ url('/yatlar') }}" data-i18n="nav_yachts">Yatlar</a></li>
            <li><a href="{{ url('/restoranlar') }}" data-i18n="nav_restaurants">Restoranlar</a></li>
            <div class="fs-divider"></div>
            <li><a href="{{ url('/destinasyonlar') }}" data-i18n="nav_guide">Destinasyonlar</a></li>
            <li><a href="{{ url('/etkinlikler') }}" data-i18n="nav_events">Etkinlikler</a></li>
            <li><a href="{{ url('/journal') }}" data-i18n="nav_journal">Journal</a></li>
            <li class="lang-switch" style="font-size: 1.5rem; font-family: var(--font-display); justify-content: center; margin-top:3rem;">
                <span id="lang-tr-fs" class="lang-btn">TR</span> | <span id="lang-en-fs" class="lang-btn">EN</span>
            </li>
        </ul>
    </div>

    <!-- Page Hero -->
    <div class="bd-hero">
        <div class="bd-hero-bg"></div>
        <div class="bd-hero-content">
            <span class="bd-eyebrow" data-i18n="otel_hero_eye">Premium Konaklama</span>
            <h1 class="bd-title lang-text-tr">Seçkin <br><em>Oteller</em></h1>
            <h1 class="bd-title lang-text-en">EXCLUSIVE <br><em>Hotels</em></h1>
        </div>
    </div>

    <!-- Main Container -->
    <div class="bd-container">
        
        <!-- Intro Section -->
        <section class="bd-intro">
            <h2 class="bd-intro-title lang-text-tr">Her konaklamanın <br>bir <em>hikayesi</em> vardır.</h2>
            <h2 class="bd-intro-title lang-text-en">Every luxury stay <br>has a <em>story</em> to tell.</h2>
            
            <p class="bd-intro-text lang-text-tr">Dünyaca ünlü butik oteller, tarihi yapılar ve ultra-lüks resort'lardan oluşan koleksiyonumuz, seyahatinizin her anını unutulmaz kılmak için özenle seçilmiştir. Sadece konaklama değil; bir vizyon, bir tutku sunuyoruz.</p>
            <p class="bd-intro-text lang-text-en">Our curated collection of world-renowned boutique hotels, historic estates, and ultra-luxury resorts is selected to make every moment unforgettable. We don't just offer lodging; we share a lifestyle and a vision.</p>
        </section>

        <!-- Hotels Alternate Rows -->
        <section id="hotelsList">
            @foreach($oteller as $index => $otel)
                <div class="hotel-row">
                    <div class="hotel-image-col">
                        @if($otel->show_video_on_cover && (!empty($otel->video_file) || !empty($otel->video_url)))
                            @if(!empty($otel->video_file))
                                <video autoplay muted loop playsinline class="hotel-row-image" style="object-fit: cover; width:100%; height:100%;">
                                    <source src="{{ asset($otel->video_file) }}" type="video/mp4">
                                </video>
                            @elseif(!empty($otel->video_url))
                                @php
                                    $embedUrl = $otel->video_url;
                                    if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $otel->video_url, $matches)) {
                                        $embedUrl = 'https://www.youtube.com/embed/' . $matches[1] . '?autoplay=1&mute=1&loop=1&playlist=' . $matches[1] . '&controls=0&showinfo=0&rel=0&modestbranding=1&iv_load_policy=3';
                                    }
                                @endphp
                                <iframe src="{{ $embedUrl }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" style="width: 100%; height: 100%; object-fit: cover; pointer-events: none; transform: scale(1.35); position: absolute; inset: 0; border: none;"></iframe>
                            @endif
                        @else
                            <div class="hotel-row-image" style="background-image: url('{{ asset($otel->img) }}');"></div>
                        @endif
                    </div>
                    <div class="hotel-info-col">
                        <span class="hotel-num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        
                        <h3 class="hotel-name lang-text-tr">{{ $otel->name["tr"] ?? "" }}</h3>
                        <h3 class="hotel-name lang-text-en">{{ $otel->name["en"] ?? "" }}</h3>
                        
                        <span class="hotel-tag lang-text-tr">{{ $otel->tag["tr"] ?? "" }}</span>
                        <span class="hotel-tag lang-text-en">{{ $otel->tag["en"] ?? "" }}</span>
                        
                        <p class="hotel-desc lang-text-tr">{{ $otel->desc["tr"] ?? "" }}</p>
                        <p class="hotel-desc lang-text-en">{{ $otel->desc["en"] ?? "" }}</p>
                        
                        <a href="{{ url("/otel/" . $otel->id) }}" class="btn-bd">
                            <span class="lang-text-tr">Detayları İncele</span>
                            <span class="lang-text-en">Explore Destination</span>
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </section>

    </div>

    @include('partials.footer')

    <script src="{{ asset('js/i18n.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/common.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/nav.js') }}?v={{ time() }}"></script>
</body>
</html>
