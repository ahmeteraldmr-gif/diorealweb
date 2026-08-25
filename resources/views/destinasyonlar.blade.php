<!DOCTYPE html>
<html lang="{{ get_active_locale() }}">
<head>
    <!-- Favicon & Touch Icons for Google Search & Browsers -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('favicon-48x48.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url('/') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Jost:wght@200;300;400;500;600&family=Oswald:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}?v=2.5.0">
    <link rel="stylesheet" href="{{ asset('css/nav-footer.css') }}?v=2.5.0">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}?v=2.5.0">
    <link rel="stylesheet" href="{{ asset('css/about.css') }}?v=2.5.0">
    @php
        $locale = get_active_locale();
        $seoData = get_page_seo('gezi-rehberi');
        $seo_title = $seo_title ?? ($locale === 'en' ? $seoData['title_en'] : $seoData['title_tr']);
        $seo_desc = $seo_desc ?? ($locale === 'en' ? $seoData['desc_en'] : $seoData['desc_tr']);
        $og_image = $og_image ?? asset('foto.img/kapadokya.jpg');
        $canonical = $canonical ?? route('gezi-rehberi');
        $hreflang_tr = $hreflang_tr ?? route('gezi-rehberi');
        $hreflang_en = $hreflang_en ?? route('gezi-rehberi');
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
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}?v=2.5.0">
</head>
<body>
    <nav id="mainNav">
        <div class="nav-logo-wrapper">
            <a href="{{ route('home') }}" class="nav-logo">
                <span class="logo-text">DIOREAL</span>
            </a>
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('hakkimizda') }}" data-i18n="nav_about"><span class="lang-text-tr">Hakkımızda</span><span class="lang-text-en">About</span></a></li>
            <li><a href="{{ route('oteller') }}" data-i18n="nav_hotels"><span class="lang-text-tr">Oteller</span><span class="lang-text-en">Hotels</span></a></li>
            <li><a href="{{ route('yatlar') }}" data-i18n="nav_yachts"><span class="lang-text-tr">Yatlar</span><span class="lang-text-en">Yachts</span></a></li>
            <li><a href="{{ route('restoranlar') }}" data-i18n="nav_restaurants"><span class="lang-text-tr">Restoranlar</span><span class="lang-text-en">Restaurants</span></a></li>
            <li><a href="{{ route('gezi-rehberi') }}" class="active-page" data-i18n="nav_guide"><span class="lang-text-tr">Gezi Rehberi</span><span class="lang-text-en">Travel Guide</span></a></li>
            <li><a href="{{ route('etkinlikler') }}" data-i18n="nav_events"><span class="lang-text-tr">Etkinlikler</span><span class="lang-text-en">Events</span></a></li>
            <li><a href="{{ route('journal') }}" data-i18n="nav_journal"><span class="lang-text-tr">Journal</span><span class="lang-text-en">Journal</span></a></li>
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
            <li><a href="{{ route('hakkimizda') }}" data-i18n="nav_about"><span class="lang-text-tr">Hakkımızda</span><span class="lang-text-en">About</span></a></li>
            <li><a href="{{ route('oteller') }}" data-i18n="nav_hotels"><span class="lang-text-tr">Oteller</span><span class="lang-text-en">Hotels</span></a></li>
            <li><a href="{{ route('yatlar') }}" data-i18n="nav_yachts"><span class="lang-text-tr">Yatlar</span><span class="lang-text-en">Yachts</span></a></li>
            <li><a href="{{ route('restoranlar') }}" data-i18n="nav_restaurants"><span class="lang-text-tr">Restoranlar</span><span class="lang-text-en">Restaurants</span></a></li>
            <div class="fs-divider"></div>
            <li><a href="{{ route('gezi-rehberi') }}" data-i18n="nav_guide"><span class="lang-text-tr">Gezi Rehberi</span><span class="lang-text-en">Travel Guide</span></a></li>
            <li><a href="{{ route('etkinlikler') }}" data-i18n="nav_events"><span class="lang-text-tr">Etkinlikler</span><span class="lang-text-en">Events</span></a></li>
            <li><a href="{{ route('journal') }}" data-i18n="nav_journal"><span class="lang-text-tr">Journal</span><span class="lang-text-en">Journal</span></a></li>
            <li style="font-size:1.5rem;font-family:var(--font-display);margin-top:2rem;"><span id="lang-tr-fs" class="lang-btn active">TR</span> | <span id="lang-en-fs" class="lang-btn">EN</span></li>
        </ul>
    </div>

    <div class="page-hero" style="background-image:url('foto.img/kapadokya.jpg');">
        <div class="page-hero-content">
            <span class="page-eyebrow" data-i18n="guide_hero_eye">
                <span class="lang-text-tr">Keşfet & Öğren</span>
                <span class="lang-text-en">Discover & Learn</span>
            </span>
            <h1 class="page-title" data-i18n="guide_hero_title">
                <span class="lang-text-tr">Destinasyon<em>lar</em></span>
                <span class="lang-text-en">Destina<em>tions</em></span>
            </h1>
        </div>
    </div>

    <section class="content-section">
        <div style="text-align:center;max-width:700px;margin:0 auto 5rem;" class="reveal">
            <span class="content-eyebrow" style="display:block;" data-i18n="guide_exp_eye">
                <span class="lang-text-tr">Uzman Tavsiyeleri</span>
                <span class="lang-text-en">Expert Insights</span>
            </span>
            <h2 class="content-title" data-i18n="guide_exp_title">
                <span class="lang-text-tr">Doğru kararları <em>kolayca</em> verin</span>
                <span class="lang-text-en">Make the Right Travel Decisions with <em>Ease</em></span>
            </h2>
            <p class="content-body" data-i18n="guide_exp_p1">
                <span class="lang-text-tr">Deneyimli seyahat editörlerimizin hazırladığı destinasyon rehberleri, pratik ipuçları ve sezonluk önerilerle seyahat planlamanızı kolaylaştırıyoruz.</span>
                <span class="lang-text-en">Plan your journey with confidence through destination guides, practical insights and seasonal recommendations prepared by our experienced travel editors.</span>
            </p>
        </div>
        <div class="card-grid">
            @foreach($rehberler as $g)
                @php
                    $detailUrl = route('rehber.detay', $g->slug_tr ?: ($g->slug_en ?: $g->id));
                    $tagTr = !empty($g->tag["tr"]) ? $g->tag["tr"] : ($g->tag["en"] ?? "");
                    $tagEn = !empty($g->tag["en"]) ? $g->tag["en"] : ($g->tag["tr"] ?? "");
                    $titleTr = !empty($g->title["tr"]) ? $g->title["tr"] : ($g->title["en"] ?? "");
                    $titleEn = !empty($g->title["en"]) ? $g->title["en"] : ($g->title["tr"] ?? "");
                    $descRawTr = !empty($g->desc["tr"]) ? $g->desc["tr"] : ($g->desc["en"] ?? "");
                    $descRawEn = !empty($g->desc["en"]) ? $g->desc["en"] : ($g->desc["tr"] ?? "");
                    $shortTr = \Illuminate\Support\Str::words(strip_tags($descRawTr), 35, '...');
                    $shortEn = \Illuminate\Support\Str::words(strip_tags($descRawEn), 35, '...');
                @endphp
                <div class="card reveal visible" style="display: flex; flex-direction: column;">
                    <a href="{{ $detailUrl }}" style="display: block; overflow: hidden; text-decoration: none;">
                        <div class="card-img" style="background-image:url('{{ asset($g->img) }}');"></div>
                    </a>
                    <div class="card-body" style="display: flex; flex-direction: column; flex-grow: 1; padding: 2rem 1.5rem;">
                        @if($tagTr || $tagEn)
                            <span class="card-tag lang-text-tr" style="margin-bottom: 0.5rem;">{{ $tagTr }}</span>
                            <span class="card-tag lang-text-en" style="margin-bottom: 0.5rem;">{{ $tagEn }}</span>
                        @endif
                        
                        <a href="{{ $detailUrl }}" style="text-decoration: none; color: inherit;">
                            <h3 class="card-title lang-text-tr" style="font-size: 1.5rem; line-height: 1.3; margin-bottom: 0.75rem;">{{ $titleTr }}</h3>
                            <h3 class="card-title lang-text-en" style="font-size: 1.5rem; line-height: 1.3; margin-bottom: 0.75rem;">{{ $titleEn }}</h3>
                        </a>
                        
                        <div style="margin-bottom: 1.5rem; flex-grow: 1;">
                            <p class="card-desc lang-text-tr" style="color: var(--dark-gray); font-size: 0.9rem; line-height: 1.6; max-height: none; display: block;">{{ $shortTr }}</p>
                            <p class="card-desc lang-text-en" style="color: var(--dark-gray); font-size: 0.9rem; line-height: 1.6; max-height: none; display: block;">{{ $shortEn }}</p>
                        </div>
                        
                        <div class="card-btn-wrapper" style="margin-top: auto; padding-top: 0.5rem;">
                            <a href="{{ $detailUrl }}" class="btn-guide-explore">
                                <span class="lang-text-tr">Rehberi İncele</span>
                                <span class="lang-text-en">View Guide</span>
                                <i class="fas fa-arrow-right" style="font-size: 0.75rem;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if(method_exists($rehberler, 'hasPages') && $rehberler->hasPages())
            <div class="custom-pagination">
                {{-- Previous Page Link --}}
                @if ($rehberler->onFirstPage())
                    <span class="pagination-btn disabled">&laquo; <span class="lang-text-tr">Önceki</span><span class="lang-text-en">Previous</span></span>
                @else
                    <a href="{{ $rehberler->previousPageUrl() }}" class="pagination-btn">&laquo; <span class="lang-text-tr">Önceki</span><span class="lang-text-en">Previous</span></a>
                @endif

                {{-- Pagination Elements --}}
                <div class="pagination-numbers">
                    @foreach ($rehberler->getUrlRange(1, $rehberler->lastPage()) as $page => $url)
                        @if ($page == $rehberler->currentPage())
                            <span class="pagination-number active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="pagination-number">{{ $page }}</a>
                        @endif
                    @endforeach
                </div>

                {{-- Next Page Link --}}
                @if ($rehberler->hasMorePages())
                    <a href="{{ $rehberler->nextPageUrl() }}" class="pagination-btn"><span class="lang-text-tr">Sonraki</span><span class="lang-text-en">Next</span> &raquo;</a>
                @else
                    <span class="pagination-btn disabled"><span class="lang-text-tr">Sonraki</span><span class="lang-text-en">Next</span> &raquo;</span>
                @endif
            </div>
        @endif
    </section>

    @include('partials.footer')
    <script src="{{ asset('js/i18n.js') }}?v=2.5.0"></script>
    <script src="{{ asset('js/common.js') }}?v=2.5.0"></script>
    <script src="{{ asset('js/nav.js') }}?v=2.5.0"></script>
</body>
</html>
