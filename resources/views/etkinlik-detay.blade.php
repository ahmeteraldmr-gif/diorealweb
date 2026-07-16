@php
    $seo_title = $event->seo_title_tr ?: ($event->title['tr'] ?? 'Detay') . ' - Dioreal';
    $seo_desc = $event->seo_description_tr ?: \Illuminate\Support\Str::limit(strip_tags($event->desc['tr'] ?? ''), 155);
    $og_image = $event->og_image ? asset($event->og_image) : asset($event->img);
    $canonical = route('etkinlik.detay', $event->slug_tr ?: $event->id);
    $noindex = $event->seo_noindex;
    
    $hreflang_tr = route('etkinlik.detay', $event->slug_tr ?: $event->id);
    $hreflang_en = $event->slug_en ? route('etkinlik.detay', $event->slug_en) : null;
    $og_type = 'Event' == 'Article' ? 'article' : 'website';

    $schema_json = '<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Event",
      "name": "'.addslashes($event->title['tr'] ?? '').'",
      "description": "'.addslashes($seo_desc).'",
      "image": "'.$og_image.'",
      "url": "'.$canonical.'"
    }
    </script>';
@endphp
<!DOCTYPE html>
<html lang="tr">
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/nav-footer.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/about.css') }}?v={{ time() }}">
    <style>
        body {
            background-color: var(--off-white);
            color: var(--dark-gray);
        }
        .page-hero {
            position: relative;
            height: 60vh;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: var(--white);
            overflow: hidden;
        }
        .page-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.3));
            z-index: 1;
        }
        .page-hero-content {
            position: relative;
            z-index: 2;
            padding: 2rem;
            max-width: 900px;
        }
        .page-eyebrow {
            font-family: var(--font-condensed);
            font-size: 0.9rem;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 1.5rem;
            display: block;
        }
        .page-title {
            font-family: var(--font-display);
            font-size: clamp(3rem, 6vw, 4.5rem);
            line-height: 1.1;
            font-weight: 300;
            text-shadow: 0 4px 20px rgba(0,0,0,0.3);
        }
        
        .detail-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 5rem 2rem;
        }
        
        .detail-grid {
            display: grid;
            grid-template-columns: 2.2fr 1fr;
            gap: 5rem;
            align-items: start;
        }
        
        .detail-story {
            font-size: 1.15rem;
            line-height: 2;
            color: #4a4745;
        }
        
        .detail-story p {
            margin-bottom: 2rem;
        }
        
        .detail-section-title {
            font-family: var(--font-display);
            font-size: 2.5rem;
            color: var(--near-black);
            margin-bottom: 1.8rem;
            font-weight: 400;
            border-bottom: 1px solid rgba(200, 169, 110, 0.15);
            padding-bottom: 1rem;
        }
        
        .detail-section-title em {
            font-style: italic;
            font-weight: 300;
            color: var(--accent);
        }
        
        .detail-sidebar-card {
            background: var(--white);
            border: 1px solid rgba(200, 169, 110, 0.15);
            border-radius: 16px;
            padding: 2.5rem;
            position: sticky;
            top: 120px;
            box-shadow: 0 15px 40px rgba(29, 27, 26, 0.04);
        }
        
        .sidebar-title {
            font-family: var(--font-condensed);
            font-size: 1rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--near-black);
            margin-bottom: 1.5rem;
            border-bottom: 1px solid rgba(200, 169, 110, 0.1);
            padding-bottom: 1rem;
        }
        
        .sidebar-info-item {
            margin-bottom: 1.5rem;
            display: flex;
            align-items: flex-start;
            gap: 1.2rem;
            font-size: 1.05rem;
        }
        
        .sidebar-info-item i {
            color: var(--accent);
            font-size: 1.2rem;
            margin-top: 0.2rem;
        }
        
        .sidebar-info-label {
            font-size: 0.8rem;
            color: var(--mid-gray);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 0.3rem;
            font-weight: 500;
        }
        
        .sidebar-info-value {
            color: var(--near-black);
            font-weight: 400;
        }
        
        .btn-booking {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            width: 100%;
            background: var(--accent);
            color: var(--white);
            padding: 1.2rem;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            font-size: 0.9rem;
            transition: all 0.4s cubic-bezier(0.19, 1, 0.22, 1);
            box-shadow: 0 10px 25px rgba(200, 169, 110, 0.15);
            margin-top: 2rem;
            border: none;
            cursor: pointer;
        }
        
        .btn-booking:hover {
            background: var(--near-black);
            color: var(--white);
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(26, 24, 22, 0.2);
        }
        
        @media (max-width: 992px) {
            .detail-grid {
                grid-template-columns: 1fr;
                gap: 3rem;
            }
            .detail-sidebar-card {
                position: static;
                margin-top: 2rem;
            }
        }
        
        @media (max-width: 768px) {
            .story-content-wrapper {
                flex-direction: column !important;
            }
            .story-photo {
                width: 100% !important;
                min-width: 100% !important;
                max-width: 100% !important;
                margin-bottom: 1.5rem;
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
            <li><a href="{{ url('/oteller') }}" data-i18n="nav_hotels">Oteller</a></li>
            <li><a href="{{ url('/yatlar') }}" data-i18n="nav_yachts">Yatlar</a></li>
            <li><a href="{{ url('/restoranlar') }}" data-i18n="nav_restaurants">Restoranlar</a></li>
            <li><a href="{{ route('gezi-rehberi') }}" data-i18n="nav_guide">Destinasyonlar</a></li>
            <li><a href="{{ url('/etkinlikler') }}" class="active-page" data-i18n="nav_events">Etkinlikler</a></li>
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
            <li><a href="{{ route('gezi-rehberi') }}" data-i18n="nav_guide">Destinasyonlar</a></li>
            <li><a href="{{ url('/etkinlikler') }}" data-i18n="nav_events">Etkinlikler</a></li>
            <li><a href="{{ url('/journal') }}" data-i18n="nav_journal">Journal</a></li>
            <li class="lang-switch" style="font-size: 1.5rem; font-family: var(--font-display); justify-content: center; margin-top:3rem;">
                <span id="lang-tr-fs" class="lang-btn">TR</span> | <span id="lang-en-fs" class="lang-btn">EN</span>
            </li>
        </ul>
    </div>

    <!-- Page Hero -->
    @php
        $showVideoCover = !empty($etkinlik->show_video_on_cover) && (!empty($etkinlik->video_file) || !empty($etkinlik->video_url));
        $eventImg = !empty($etkinlik->img) ? $etkinlik->img : 'foto.img/etkinlik_hero.jpg';
        $eventImgUrl = str_starts_with($eventImg, 'data:') || str_starts_with($eventImg, 'http') ? $eventImg : asset($eventImg);
    @endphp
    <div class="page-hero" style="@if(!$showVideoCover) background-image: url('{{ $eventImgUrl }}'); @endif">
        @if($showVideoCover)
            <div class="hero-video-container" style="position: absolute; inset: 0; width: 100%; height: 100%; overflow: hidden; z-index: 0;">
                @if(!empty($etkinlik->video_file))
                    <video src="{{ asset($etkinlik->video_file) }}" autoplay loop muted playsinline style="width: 100%; height: 100%; object-fit: cover;"></video>
                @elseif(!empty($etkinlik->video_url))
                    @php
                        $embedUrl = $etkinlik->video_url;
                        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $etkinlik->video_url, $matches)) {
                            $embedUrl = 'https://www.youtube.com/embed/' . $matches[1] . '?autoplay=1&mute=1&loop=1&playlist=' . $matches[1] . '&controls=0&showinfo=0&rel=0&iv_load_policy=3&playsinline=1';
                        }
                    @endphp
                    <iframe src="{{ $embedUrl }}" frameborder="0" allow="autoplay; encrypted-media" style="position: absolute; top: 50%; left: 50%; width: 100vw; height: 56.25vw; min-width: 100%; min-height: 100%; transform: translate(-50%, -50%); pointer-events: none; object-fit: cover;"></iframe>
                @endif
                <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.5); z-index: 1;"></div>
            </div>
        @endif
        <div class="page-hero-content" style="position: relative; z-index: 2;">
            <span class="page-eyebrow lang-text-tr">{{ $etkinlik->tag['tr'] ?? '' }}</span>
            <span class="page-eyebrow lang-text-en">{{ $etkinlik->tag['en'] ?? '' }}</span>
            <h1 class="page-title lang-text-tr">{{ $etkinlik->title['tr'] ?? '' }}</h1>
            <h1 class="page-title lang-text-en">{{ $etkinlik->title['en'] ?? '' }}</h1>
        </div>
    </div>

    <!-- Content Layout -->
    <section class="detail-container">
        <div class="detail-grid">
            
            <!-- Left story -->
            <div class="detail-story reveal">
                <h2 class="detail-section-title" data-i18n="detail_about_event">Etkinlik <em>Detayı</em></h2>
                
                <div class="story-content-wrapper" style="display: flex; gap: 2.5rem; flex-direction: row; align-items: flex-start;">
                    <div class="story-photo" style="flex: 1; min-width: 280px; max-width: 45%;">
                        <img src="{{ $eventImgUrl }}" alt="{{ $etkinlik->title['tr'] ?? '' }}" style="width: 100%; border-radius: 12px; object-fit: cover; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
                    </div>
                    <div class="story-text" style="flex: 1.5;">
                        <div class="lang-text-tr">
                            {!! nl2br(e(!empty($etkinlik->long_desc['tr']) ? $etkinlik->long_desc['tr'] : ($etkinlik->desc['tr'] ?? ''))) !!}
                        </div>
                        <div class="lang-text-en">
                            {!! nl2br(e(!empty($etkinlik->long_desc['en']) ? $etkinlik->long_desc['en'] : ($etkinlik->desc['en'] ?? ''))) !!}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right info box -->
            <div class="detail-sidebar-card reveal" style="transition-delay: 0.2s">
                <h3 class="sidebar-title" data-i18n="detail_event_info">Tarih & Lokasyon</h3>
                
                <div class="sidebar-info-item">
                    <i class="fas fa-calendar-alt"></i>
                    <div>
                        <div class="sidebar-info-label">Tarih</div>
                        <div class="sidebar-info-value">
                            {{ $etkinlik->day }} 
                            <span class="lang-text-tr">{{ $etkinlik->month['tr'] ?? '' }}</span>
                            <span class="lang-text-en">{{ $etkinlik->month['en'] ?? '' }}</span>
                        </div>
                    </div>
                </div>

                <div class="sidebar-info-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <div>
                        <div class="sidebar-info-label">Mekan / Lokasyon</div>
                        <div class="sidebar-info-value lang-text-tr">{{ $etkinlik->loc['tr'] ?? '' }}</div>
                        <div class="sidebar-info-value lang-text-en">{{ $etkinlik->loc['en'] ?? '' }}</div>
                    </div>
                </div>

                <div class="sidebar-info-item">
                    <i class="fas fa-tags"></i>
                    <div>
                        <div class="sidebar-info-label">Kategori</div>
                        <div class="sidebar-info-value lang-text-tr">{{ $etkinlik->tag['tr'] ?? '' }}</div>
                        <div class="sidebar-info-value lang-text-en">{{ $etkinlik->tag['en'] ?? '' }}</div>
                    </div>
                </div>

                <a href="https://wa.me/{{ $settings['whatsapp'] ?? '905320000000' }}?text=Merhaba,%20{{ urlencode($etkinlik->title['tr'] ?? $etkinlik->title['en'] ?? 'Etkinlik') }}%20hakkında%20bilgi%20ve%20rezervasyon%20istiyorum." 
                   target="_blank" 
                   class="btn-booking">
                    <i class="fab fa-whatsapp"></i>
                    <span data-i18n="detail_event_contact">WhatsApp'tan Sorun</span>
                </a>
            </div>

        </div>
    </section>

    @include('partials.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/i18n.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/common.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/nav.js') }}?v={{ time() }}"></script>
</body>
</html>
