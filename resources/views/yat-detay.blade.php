@php
    $locale = get_active_locale();
    $seo_title = ($locale === 'en')
        ? ($yat->seo_title_en ?: ($yat->name['en'] ?? 'Detay') . ' - Dioreal')
        : ($yat->seo_title_tr ?: ($yat->name['tr'] ?? 'Detay') . ' - Dioreal');
    $seo_desc = ($locale === 'en')
        ? ($yat->seo_description_en ?: \Illuminate\Support\Str::limit(strip_tags($yat->desc['en'] ?? ''), 155))
        : ($yat->seo_description_tr ?: \Illuminate\Support\Str::limit(strip_tags($yat->desc['tr'] ?? ''), 155));
    $og_image = $yat->og_image ? asset($yat->og_image) : asset($yat->img);
    $canonical = $canonical ?? route('yat.detay', $yat->slug_tr ?: $yat->id);
    $noindex = $yat->seo_noindex;
    
    $hreflang_tr = $hreflang_tr ?? route('yat.detay', $yat->slug_tr ?: $yat->id);
    $hreflang_en = $hreflang_en ?? ($yat->slug_en ? route('yat.detay', $yat->slug_en) : null);
    $og_type = 'Product' == 'Article' ? 'article' : 'website';

    $schema_json = '<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Product",
      "name": "'.addslashes($yat->name['tr'] ?? '').'",
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
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.3);
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
        
        .gallery-section {
            max-width: 1200px;
            margin: 0 auto 5rem auto;
            padding: 0 2rem;
        }
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 1.5rem;
        }
        .gallery-img-wrapper {
            grid-column: span 4;
            height: 280px;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.03);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            cursor: pointer;
        }
        .gallery-img-wrapper:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(29, 27, 26, 0.12);
        }
        .gallery-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        .gallery-img-wrapper:hover img {
            transform: scale(1.05);
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
            .detail-container {
                padding: 3rem 1rem;
            }
            .detail-sidebar-card {
                padding: 1.5rem;
            }
            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 0.8rem;
            }
            .gallery-img-wrapper {
                grid-column: span 2;
                height: 180px;
            }
            .gallery-section {
                padding: 3rem 1rem;
            }
            .video-section {
                padding: 0 1rem !important;
                margin: 2rem auto !important;
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
            <li><a href="{{ url('/yatlar') }}" class="active-page" data-i18n="nav_yachts">Yatlar</a></li>
            <li><a href="{{ url('/restoranlar') }}" data-i18n="nav_restaurants">Restoranlar</a></li>
            <li><a href="{{ route('gezi-rehberi') }}" data-i18n="nav_guide">Destinasyonlar</a></li>
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
        $showVideoCover = !empty($yat->show_video_on_cover) && (!empty($yat->video_file) || !empty($yat->video_url);
        $yatImg = !empty($yat->img) ? $yat->img : 'foto.img/yat_hero.jpg';
        $yatImgUrl = str_starts_with($yatImg, 'data:') || str_starts_with($yatImg, 'http') ? $yatImg : asset($yatImg);
    @endphp
    <div class="page-hero" style="@if(!$showVideoCover) background-image: url('{{ $yatImgUrl }}'); @endif">
        @if($showVideoCover)
            <div class="hero-video-container" style="position: absolute; inset: 0; width: 100%; height: 100%; overflow: hidden; z-index: 0;">
                @if(!empty($yat->video_file))
                    <video src="{{ asset($yat->video_file) }}" autoplay loop muted playsinline style="width: 100%; height: 100%; object-fit: cover;"></video>
                @elseif(!empty($yat->video_url))
                    @php
                        $embedUrl = $yat->video_url;
                        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $yat->video_url, $matches)) {
                            $embedUrl = 'https://www.youtube.com/embed/' . $matches[1] . '?autoplay=1&mute=1&loop=1&playlist=' . $matches[1] . '&controls=0&showinfo=0&rel=0&iv_load_policy=3&playsinline=1';
                        }
                    @endphp
                    <iframe src="{{ $embedUrl }}" frameborder="0" allow="autoplay; encrypted-media" style="position: absolute; top: 50%; left: 50%; width: 100vw; height: 56.25vw; min-width: 100%; min-height: 100%; transform: translate(-50%, -50%); pointer-events: none; object-fit: cover;"></iframe>
                @endif
                <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.5); z-index: 1;"></div>
            </div>
        @endif
        <div class="page-hero-content" style="position: relative; z-index: 2;">
            <span class="page-eyebrow lang-text-tr">{{ $yat->tag['tr'] ?? 'Lüks Yat Kiralama' }}</span>
            <span class="page-eyebrow lang-text-en">{{ $yat->tag['en'] ?? 'Luxury Yacht Charter' }}</span>
            <h1 class="page-title lang-text-tr">{{ $yat->name['tr'] ?? '' }}</h1>
            <h1 class="page-title lang-text-en">{{ $yat->name['en'] ?? '' }}</h1>
        </div>
    </div>

    <!-- Content Layout -->
    <section class="detail-container">
        <div class="detail-grid">
            
            <!-- Left story -->
            <div class="detail-story reveal">
                <h2 class="detail-section-title" data-i18n="detail_about_yacht">Yat <em>Hakkında</em></h2>
                
                <div class="lang-text-tr">
                    {!! nl2br($yat->long_desc['tr'] ?? ($yat->desc['tr'] ?? '')) !!}
                </div>
                <div class="lang-text-en">
                    {!! nl2br($yat->long_desc['en'] ?? ($yat->desc['en'] ?? '')) !!}
                </div>
            </div>

            <!-- Right info box -->
            <div class="detail-sidebar-card reveal" style="transition-delay: 0.2s">
                <h3 class="sidebar-title" data-i18n="detail_booking">Rezervasyon & Bilgi</h3>
                
                <div class="sidebar-info-item">
                    <i class="fas fa-ship"></i>
                    <div>
                        <div class="sidebar-info-label">Kategori / Sınıf</div>
                        <div class="sidebar-info-value lang-text-tr">{{ $yat->tag['tr'] ?? 'Lüks Gulet & Yat' }}</div>
                        <div class="sidebar-info-value lang-text-en">{{ $yat->tag['en'] ?? 'Luxury Gulet & Yacht' }}</div>
                    </div>
                </div>

                <div class="sidebar-info-item">
                    <i class="fas fa-envelope"></i>
                    <div>
                        <div class="sidebar-info-label" data-i18n="label_email">E-posta</div>
                        <div class="sidebar-info-value">{{ $settings['contact_email'] ?? 'info@dioreal.com' }}</div>
                    </div>
                </div>

                <div class="sidebar-info-item">
                    <i class="fas fa-phone"></i>
                    <div>
                        <div class="sidebar-info-label" data-i18n="label_phone_short">Telefon</div>
                        <div class="sidebar-info-value">{{ $settings['contact_phone'] ?? '+90 532 000 0000' }}</div>
                    </div>
                </div>

                <a href="https://wa.me/{{ format_whatsapp($settings['whatsapp'] ?? '') }}?text=Merhaba,%20{{ urlencode($yat->name['tr'] ?? $yat->name['en'] ?? 'Yat') }}%20hakkında%20detaylı%20bilgi%20ve%20kiralama%20koşullarını%20öğrenmek%20istiyorum." 
                   target="_blank" 
                   class="btn-booking">
                    <i class="fab fa-whatsapp"></i>
                    <span data-i18n="detail_booking_yacht">WhatsApp'tan Sorun</span>
                </a>
            </div>

        </div>
    </section>

    <!-- Tanıtım Videosu Section -->
    @if(!empty($yat->video_file) || !empty($yat->video_url))
        <section class="video-section reveal" style="max-width: 1200px; margin: 0 auto 5rem auto; padding: 0 2rem;">
            <div class="gallery-header" style="text-align: center; margin-bottom: 3.5rem;">
                <h2 class="detail-section-title" data-i18n="detail_video">Tanıtım <em>Videosu</em></h2>
            </div>
            <div class="video-container" style="position: relative; border-radius: 16px; overflow: hidden; box-shadow: 0 20px 50px rgba(0,0,0,0.15); background: #000; aspect-ratio: 16/9; max-width: 900px; margin: 0 auto;">
                @if(!empty($yat->video_file))
                    <video src="{{ asset($yat->video_file) }}" controls style="width: 100%; height: 100%; object-fit: cover;"></video>
                @elseif(!empty($yat->video_url))
                    @php
                        $embedUrl = $yat->video_url;
                        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $yat->video_url, $matches)) {
                            $embedUrl = 'https://www.youtube.com/embed/' . $matches[1];
                        }
                    @endphp
                    <iframe src="{{ $embedUrl }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="position: absolute; top:0; left:0; width:100%; height:100%; border:none;"></iframe>
                @endif
            </div>
        </section>
    @endif

    <!-- Asymmetrical Gallery Grid -->
    <section class="gallery-section reveal">
        <div class="gallery-header" style="text-align: center; margin-bottom: 3.5rem;">
            <h2 class="detail-section-title" data-i18n="detail_gallery">Fotoğraf <em>Galerisi</em></h2>
        </div>
        
        <div class="gallery-grid">
            @if(!empty($yat->gallery) && is_array($yat->gallery))
                @foreach($yat->gallery as $g)
                    <div class="gallery-img-wrapper">
                        <img src="{{ str_starts_with($g, 'data:') ? $g : asset($g) }}" alt="Yat Görseli">
                    </div>
                @endforeach
            @else
                <div style="grid-column: span 12; text-align: center; color: var(--mid-gray); padding: 3rem 0;" data-i18n="detail_no_gallery">
                    Galeri bulunmamaktadır.
                </div>
            @endif
        </div>
    </section>

    @include('partials.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/i18n.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/common.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/nav.js') }}?v={{ time() }}"></script>
</body>
</html>
