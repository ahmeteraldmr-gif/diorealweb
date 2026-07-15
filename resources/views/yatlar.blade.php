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
    <link rel="stylesheet" href="{{ asset('css/base.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/nav-footer.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/about.css') }}?v={{ time() }}">
    <style>
        .yacht-card {
            background: var(--white);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(200, 169, 110, 0.12);
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        .yacht-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px rgba(29, 27, 26, 0.08);
            border-color: rgba(200, 169, 110, 0.35);
        }
        .yacht-img-container {
            width: 100%;
            aspect-ratio: 16/10;
            overflow: hidden;
            position: relative;
        }
        .yacht-img-container .card-img {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: center;
            transition: transform 1.2s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        .yacht-card:hover .card-img {
            transform: scale(1.08);
        }
        .yacht-card-body {
            padding: 2.2rem 2rem 2rem 2rem !important;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        .yacht-card-body .card-tag {
            font-family: var(--font-condensed);
            font-size: 0.8rem;
            color: var(--accent);
            letter-spacing: 0.15em;
            margin-bottom: 0.8rem;
            text-transform: uppercase;
        }
        .yacht-card-body .card-title {
            font-family: var(--font-display);
            font-size: 1.8rem;
            color: var(--near-black);
            margin-bottom: 1rem;
            font-weight: 400;
            line-height: 1.3;
        }
        .yacht-card-body .card-desc {
            font-size: 0.95rem;
            color: var(--mid-gray);
            line-height: 1.7;
            margin-bottom: 2rem;
            flex-grow: 1;
        }
        .yacht-card-footer {
            margin-top: auto;
            border-top: 1px solid rgba(200, 169, 110, 0.1);
            padding-top: 1.5rem;
        }
        .btn-yacht-detail {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            width: 100%;
            background: transparent;
            color: var(--near-black);
            border: 1px solid rgba(26, 24, 22, 0.15);
            padding: 1rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            font-size: 0.8rem;
            transition: all 0.4s cubic-bezier(0.19, 1, 0.22, 1);
            cursor: pointer;
        }
        .btn-yacht-detail i {
            font-size: 0.75rem;
            transition: transform 0.4s cubic-bezier(0.19, 1, 0.22, 1);
        }
        .btn-yacht-detail:hover {
            background: var(--near-black);
            color: var(--white);
            border-color: var(--near-black);
        }
        .btn-yacht-detail:hover i {
            transform: translateX(5px);
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
            <a href="index.html" class="nav-logo">
                <span class="logo-text">DIOREAL</span>
            </a>
        </div>
        <ul class="nav-links">
            <li><a href="hakkimizda.html" data-i18n="nav_about">Hakkımızda</a></li>
            <li><a href="oteller.html" data-i18n="nav_hotels">Oteller</a></li>
            <li><a href="yatlar.html" class="active-page" data-i18n="nav_yachts">Yatlar</a></li>
            <li><a href="restoranlar.html" data-i18n="nav_restaurants">Restoranlar</a></li>
            <li><a href="destinasyonlar.html" data-i18n="nav_guide">Destinasyonlar</a></li>
            <li><a href="etkinlikler.html" data-i18n="nav_events">Etkinlikler</a></li>
            <li><a href="journal.html" data-i18n="nav_journal">Journal</a></li>
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
            <li><a href="hakkimizda.html" data-i18n="nav_about">Hakkımızda</a></li>
            <li><a href="oteller.html" data-i18n="nav_hotels">Oteller</a></li>
            <li><a href="yatlar.html" data-i18n="nav_yachts">Yatlar</a></li>
            <li><a href="restoranlar.html" data-i18n="nav_restaurants">Restoranlar</a></li>
            <div class="fs-divider"></div>
            <li><a href="destinasyonlar.html" data-i18n="nav_guide">Destinasyonlar</a></li>
            <li><a href="etkinlikler.html" data-i18n="nav_events">Etkinlikler</a></li>
            <li><a href="journal.html" data-i18n="nav_journal">Journal</a></li>
            <li style="font-size: 1.5rem; font-family: var(--font-display); margin-top: 2rem;">
                <span id="lang-tr-fs" class="lang-btn active">TR</span> | <span id="lang-en-fs" class="lang-btn">EN</span>
            </li>
        </ul>
    </div>

    <div class="page-hero" style="background-image: url('foto.img/yat_manzara.jpg');">
        <div class="page-hero-content">
            <span class="page-eyebrow" data-i18n="yacht_hero_eye">Akdeniz'de Özgürlük</span>
            <h1 class="page-title" data-i18n="yacht_title">Özel <em>Yatlar</em></h1>
        </div>
    </div>

    <section class="content-section">
        <div class="content-grid">
            <div class="reveal">
                <span class="content-eyebrow" data-i18n="yacht_hol_eye">Yat Tatili</span>
                <h2 class="content-title" data-i18n="yacht_hol_title">Koydan koya, <em>özgürce</em></h2>
                <p class="content-body" data-i18n="yacht_hol_p1">Kendi rotanızı belirleyin, kendi hızınızda ilerleyin. Türkiye'nin turquoise kıyılarından Yunan adalarına, İtalyan rivieralarından Hırvatistan koylarına uzanan yolculuklarda lüks ve özgürlüğü bir arada yaşayın.</p>
                <a href="#yatlar" class="btn btn-primary" data-i18n="btn_explore_yachts">Yatları İncele</a>
            </div>
            <div class="reveal" style="transition-delay: 0.2s;">
                <img src="foto.img/yat_ozgur.jpg" alt="Özel Yat" style="width:100%; aspect-ratio: 4/3; object-fit: cover;">
            </div>
        </div>
    </section>

    <section class="content-section alt" id="yatlar">
        <div style="text-align: center; margin-bottom: 4rem;">
            <span class="content-eyebrow" style="display: block;" data-i18n="yacht_fleet_eye">Filo</span>
            <h2 class="content-title" style="font-size: clamp(2rem, 4vw, 3rem);" data-i18n="yacht_fleet_title">Premium <em>Yat Filomuz</em></h2>
        </div>
        <div class="card-grid" style="grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 3rem;">
            @foreach($yatlar as $y)
                <div class="card yacht-card reveal visible">
                    <div class="yacht-img-container">
                        <div class="card-img" style="background-image: url('{{ asset($y->img) }}');"></div>
                    </div>
                    <div class="card-body yacht-card-body">
                        <span class="card-tag lang-text-tr">{{ $y->tag["tr"] ?? "" }}</span>
                        <span class="card-tag lang-text-en">{{ $y->tag["en"] ?? "" }}</span>
                        
                        <h3 class="card-title lang-text-tr">{{ $y->name["tr"] ?? "" }}</h3>
                        <h3 class="card-title lang-text-en">{{ $y->name["en"] ?? "" }}</h3>
                        
                        <p class="card-desc lang-text-tr">{{ $y->desc["tr"] ?? "" }}</p>
                        <p class="card-desc lang-text-en">{{ $y->desc["en"] ?? "" }}</p>
                        
                        <div class="yacht-card-footer">
                            <a href="{{ route('yat.detay', $y->id) }}" class="btn-yacht-detail">
                                <span class="lang-text-tr">Detayları İncele</span>
                                <span class="lang-text-en">View Details</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="content-section">
        <div class="content-grid reverse">
            <div class="reveal">
                <span class="content-eyebrow" data-i18n="yacht_route_eye">Güzergah Planlaması</span>
                <h2 class="content-title" data-i18n="yacht_route_title">Her yolculuk <em>size özel</em></h2>
                <p class="content-body" data-i18n="yacht_route_p1">Bodrum'dan Marmaris'e mavi yolculuk, Ege adaları turu ya da Akdeniz'den Adriyatik'e uzanan epik rotalar — siz hayal edin, biz planlayalım. Deneyimli kaptanlarımız ve özel aşçılarımızla konfor ve lüks güvencesinde.</p>
                <a href="#" class="btn btn-outline" data-i18n="btn_plan_route">Rota Planlat</a>
            </div>
            <div class="reveal" style="transition-delay: 0.2s;">
                <img src="foto.img/yat_rota.jpg" alt="Yat Rotası" style="width:100%; aspect-ratio: 4/3; object-fit: cover;">
            </div>
        </div>
    </section>

    @include('partials.footer')

    <script src="{{ asset('js/i18n.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/common.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/nav.js') }}?v={{ time() }}"></script>
</body>
</html>


