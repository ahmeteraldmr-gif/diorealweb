<!DOCTYPE html>
<html lang="tr">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="base-url" content="{{ url('/') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dioreal Dijital — Global Deneyim & Medya Platformu</title>
    <meta name="description"
        content="Türkiye ve dünyada seçkin deneyimlerin kapısını aralıyoruz. Lüks oteller, yatlar ve yaşam tarzı markaları için yeni nesil medya platformu.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Jost:wght@200;300;400;500;600&family=Oswald:wght@500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/nav-footer.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}?v={{ time() }}">
</head>

<body>

    <!-- Desktop Nav -->
    <nav id="mainNav">
        <div class="nav-logo-wrapper">
            <a href="index.html" class="nav-logo">
                <span class="logo-text">DIOREAL</span>
            </a>
        </div>
        <ul class="nav-links">
            <li><a href="hakkimizda.html" data-i18n="nav_about">Hakkımızda</a></li>
            <li><a href="oteller.html" data-i18n="nav_hotels">Oteller</a></li>
            <li><a href="yatlar.html" data-i18n="nav_yachts">Yatlar</a></li>
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

    <!-- Fullscreen Nav -->
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
            <li class="lang-switch" style="font-size: 1.5rem; font-family: var(--font-display); justify-content: center; margin-top:3rem;">
                <span id="lang-tr-fs" class="lang-btn active">TR</span> | <span id="lang-en-fs" class="lang-btn">EN</span>
            </li>
        </ul>
    </div>

    <!-- NEW: Dynamic Hero Area -->
    <section class="hero">
        <div class="hero-slider">
            <div class="hero-slide active"
                style="background-image:url('{{ asset($settings['hero_slide_1'] ?? 'foto.img/hero_4k.jpg') }}')">
            </div>
            <div class="hero-slide"
                style="background-image:url('{{ asset($settings['hero_slide_2'] ?? 'foto.img/hero_slide_2.jpg') }}')">
            </div>
            <div class="hero-slide"
                style="background-image:url('{{ asset($settings['hero_slide_3'] ?? 'foto.img/hero_slide_3.jpg') }}')">
            </div>
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="hero-title reveal">
                <span class="lang-text-tr">{!! nl2br(e($settings['hero_title_tr'] ?? 'Türkiye ve dünyada seçkin deneyimlerin kapısını aralıyoruz.')) !!}</span>
                <span class="lang-text-en">{!! nl2br(e($settings['hero_title_en'] ?? 'Opening doors to exclusive experiences globally.')) !!}</span>
            </h1>
            <div class="hero-cta-group reveal" style="transition-delay: 0.2s;">
                <a href="https://wa.me/{{ $settings['whatsapp'] ?? '905320000000' }}" class="btn btn-outline whatsapp-cta" data-i18n="btn_contact">İletişime Geç</a>
            </div>
        </div>
    </section>

    <!-- OLD: Marquee -->
    <div class="marquee">
        <div class="marquee-track">
            <!-- SET A -->
            <div class="marquee-item"><span data-i18n="dest_istanbul">İstanbul</span> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><span data-i18n="dest_bodrum">Bodrum</span> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><span data-i18n="dest_fethiye">Fethiye</span> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><span data-i18n="dest_kapadokya">Kapadokya</span> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><span data-i18n="dest_cesme">Çeşme</span> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><span data-i18n="dest_kas">Kaş</span> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><span data-i18n="dest_datca">Datça</span> <span class="marquee-dot">◆</span></div>
            <!-- SET B -->
            <div class="marquee-item"><span data-i18n="dest_istanbul">İstanbul</span> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><span data-i18n="dest_bodrum">Bodrum</span> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><span data-i18n="dest_fethiye">Fethiye</span> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><span data-i18n="dest_kapadokya">Kapadokya</span> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><span data-i18n="dest_cesme">Çeşme</span> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><span data-i18n="dest_kas">Kaş</span> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><span data-i18n="dest_datca">Datça</span> <span class="marquee-dot">◆</span></div>
            <!-- SET C -->
            <div class="marquee-item"><span data-i18n="dest_istanbul">İstanbul</span> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><span data-i18n="dest_bodrum">Bodrum</span> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><span data-i18n="dest_fethiye">Fethiye</span> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><span data-i18n="dest_kapadokya">Kapadokya</span> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><span data-i18n="dest_cesme">Çeşme</span> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><span data-i18n="dest_kas">Kaş</span> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><span data-i18n="dest_datca">Datça</span> <span class="marquee-dot">◆</span></div>
            <!-- SET D -->
            <div class="marquee-item"><span data-i18n="dest_istanbul">İstanbul</span> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><span data-i18n="dest_bodrum">Bodrum</span> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><span data-i18n="dest_fethiye">Fethiye</span> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><span data-i18n="dest_kapadokya">Kapadokya</span> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><span data-i18n="dest_cesme">Çeşme</span> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><span data-i18n="dest_kas">Kaş</span> <span class="marquee-dot">◆</span></div>
            <div class="marquee-item"><span data-i18n="dest_datca">Datça</span> <span class="marquee-dot">◆</span></div>
        </div>
    </div>

    <!-- NEW ABOUT SECTION (BLACK TOMATO STYLE) -->
    <section class="bt-about-section" id="hakkimizda" style="padding: 7rem 5rem; text-align: center; background: var(--white);">
        <div style="max-width: 800px; margin: 0 auto 5rem;">
            <h2 style="font-family: var(--font-condensed); font-size: 2.5rem; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 2rem; color: var(--near-black);">
                <span class="lang-text-tr">{{ $settings['man_eyebrow_tr'] ?? 'BU AYIN SEÇKİNLERİ' }}</span>
                <span class="lang-text-en">{{ $settings['man_eyebrow_en'] ?? "THIS MONTH'S SELECTION" }}</span>
            </h2>
            <p style="font-size: 1.1rem; line-height: 1.8; color: var(--dark-gray);">
                <span class="lang-text-tr">{{ $settings['man_p1_tr'] ?? 'Sizler için özenle seçtiğimiz bu ayın en trend otel, restoran, yat ve plaj lokasyonlarının ardındaki eşsiz hikayeleri keşfedin. Sıradanlığın ötesinde anılar biriktirmeniz için tasarlanmış özel deneyimler.' }}</span>
                <span class="lang-text-en">{{ $settings['man_p1_en'] ?? "Explore the unique stories behind this month's trending hotels, restaurants, yachts, and beach spots carefully selected for you. Bespoke experiences designed for you to gather memories beyond the ordinary." }}</span>
            </p>
        </div>
        <div class="bt-about-grid" style="display: grid; gap: 2rem; text-align: left;">
            <!-- Trend Otel -->
            <div class="bt-about-card" style="aspect-ratio: 3/4; position: relative; overflow: hidden; background: var(--near-black); cursor: pointer; transition: transform 0.4s;">
                <img src="{{ asset($settings['trend_otel_img'] ?? 'foto.img/about_safari.jpg') }}" alt="Trend Otel" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 2rem; background: linear-gradient(transparent, rgba(0,0,0,0.85)); color: white; pointer-events: none;">
                    <div style="font-size: 0.75rem; letter-spacing: 0.2em; text-transform: uppercase; margin-bottom: 0.5rem; color: rgba(255,255,255,0.8);">
                        <span class="lang-text-tr">Trend Otel</span>
                        <span class="lang-text-en">Trending Hotel</span>
                    </div>
                    <h3 style="font-family: var(--font-display); font-size: 1.8rem; margin-bottom: 1rem; font-weight: 400;">
                        <span class="lang-text-tr">{{ $settings['trend_otel_title_tr'] ?? 'Kassandra Villa' }}</span>
                        <span class="lang-text-en">{{ $settings['trend_otel_title_en'] ?? 'Kassandra Villa' }}</span>
                    </h3>
                    <p style="font-size: 0.85rem; line-height: 1.6; opacity: 0.9; margin: 0;">
                        <span class="lang-text-tr">{{ $settings['trend_otel_desc_tr'] ?? 'Ege\'nin gizli kalmış koylarında uyanmanın eşsiz hissi.' }}</span>
                        <span class="lang-text-en">{{ $settings['trend_otel_desc_en'] ?? 'The unique feeling of waking up in the hidden bays of the Aegean.' }}</span>
                    </p>
                </div>
            </div>
            <!-- Trend Restoran -->
            <div class="bt-about-card" style="aspect-ratio: 3/4; position: relative; overflow: hidden; background: var(--near-black); cursor: pointer; transition: transform 0.4s;">
                <img src="{{ asset($settings['trend_rest_img'] ?? 'foto.img/rest_mikla.jpg') }}" alt="Trend Restoran" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 2rem; background: linear-gradient(transparent, rgba(0,0,0,0.85)); color: white; pointer-events: none;">
                    <div style="font-size: 0.75rem; letter-spacing: 0.2em; text-transform: uppercase; margin-bottom: 0.5rem; color: rgba(255,255,255,0.8);">
                        <span class="lang-text-tr">Trend Restoran</span>
                        <span class="lang-text-en">Trending Restaurant</span>
                    </div>
                    <h3 style="font-family: var(--font-display); font-size: 1.8rem; margin-bottom: 1rem; font-weight: 400;">
                        <span class="lang-text-tr">{{ $settings['trend_rest_title_tr'] ?? 'Melengeç' }}</span>
                        <span class="lang-text-en">{{ $settings['trend_rest_title_en'] ?? 'Melengeç' }}</span>
                    </h3>
                    <p style="font-size: 0.85rem; line-height: 1.6; opacity: 0.9; margin: 0;">
                        <span class="lang-text-tr">{{ $settings['trend_rest_desc_tr'] ?? 'Taze deniz ürünleri ile unutulmaz bir gastronomi yolculuğu.' }}</span>
                        <span class="lang-text-en">{{ $settings['trend_rest_desc_en'] ?? 'An unforgettable gastronomic journey with fresh seafood.' }}</span>
                    </p>
                </div>
            </div>
            <!-- Trend Yat -->
            <div class="bt-about-card" style="aspect-ratio: 3/4; position: relative; overflow: hidden; background: var(--near-black); cursor: pointer; transition: transform 0.4s;">
                <img src="{{ asset($settings['trend_yat_img'] ?? 'foto.img/about_yacht.jpg') }}" alt="Trend Yat" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 2rem; background: linear-gradient(transparent, rgba(0,0,0,0.85)); color: white; pointer-events: none;">
                    <div style="font-size: 0.75rem; letter-spacing: 0.2em; text-transform: uppercase; margin-bottom: 0.5rem; color: rgba(255,255,255,0.8);">
                        <span class="lang-text-tr">Trend Yat</span>
                        <span class="lang-text-en">Trending Yacht</span>
                    </div>
                    <h3 style="font-family: var(--font-display); font-size: 1.8rem; margin-bottom: 1rem; font-weight: 400;">
                        <span class="lang-text-tr">{{ $settings['trend_yat_title_tr'] ?? 'Blue Voyage' }}</span>
                        <span class="lang-text-en">{{ $settings['trend_yat_title_en'] ?? 'Blue Voyage' }}</span>
                    </h3>
                    <p style="font-size: 0.85rem; line-height: 1.6; opacity: 0.9; margin: 0;">
                        <span class="lang-text-tr">{{ $settings['trend_yat_desc_tr'] ?? 'Sonsuz mavilikte rotalar. Rüzgarın sesinden başka hiçbir şey yok.' }}</span>
                        <span class="lang-text-en">{{ $settings['trend_yat_desc_en'] ?? 'Routes in infinite blue. Nothing but the sound of the wind.' }}</span>
                    </p>
                </div>
            </div>
            <!-- Trend Beach -->
            <div class="bt-about-card" style="aspect-ratio: 3/4; position: relative; overflow: hidden; background: var(--near-black); cursor: pointer; transition: transform 0.4s;">
                <img src="{{ asset($settings['trend_beach_img'] ?? 'foto.img/bodrum.jpg') }}" alt="Trend Beach" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 2rem; background: linear-gradient(transparent, rgba(0,0,0,0.85)); color: white; pointer-events: none;">
                    <div style="font-size: 0.75rem; letter-spacing: 0.2em; text-transform: uppercase; margin-bottom: 0.5rem; color: rgba(255,255,255,0.8);">
                        <span class="lang-text-tr">Trend Beach</span>
                        <span class="lang-text-en">Trending Beach</span>
                    </div>
                    <h3 style="font-family: var(--font-display); font-size: 1.8rem; margin-bottom: 1rem; font-weight: 400;">
                        <span class="lang-text-tr">{{ $settings['trend_beach_title_tr'] ?? 'Rups Beach' }}</span>
                        <span class="lang-text-en">{{ $settings['trend_beach_title_en'] ?? 'Rups Beach' }}</span>
                    </h3>
                    <p style="font-size: 0.85rem; line-height: 1.6; opacity: 0.9; margin: 0;">
                        <span class="lang-text-tr">{{ $settings['trend_beach_desc_tr'] ?? 'Altın kumlar ve kristal sular. Müziğin ritmine eşlik eden anlar.' }}</span>
                        <span class="lang-text-en">{{ $settings['trend_beach_desc_en'] ?? 'Golden sands and crystal waters. Moments accompanying the rhythm of the music.' }}</span>
                    </p>
                </div>
            </div>
        </div>
    </section>
    

    
    <!-- NEW: Destinations (Türkiye) - BLACK TOMATO PHOTO 1 LAYOUT -->
    <section class="dest-section bt-horizontal-scroll" id="turkiye" style="background: var(--white); padding: 4rem 0 5rem 0; text-align: center; overflow: hidden; display: flex; flex-direction: column; align-items: center;">
        <div style="width: 100%; display: flex; justify-content: space-between; align-items: flex-end; padding: 0 5rem; margin-bottom: 3rem;">
            <div style="text-align: left;">
                <span style="font-size: 0.75rem; letter-spacing: 0.2em; text-transform: uppercase; color: var(--mid-gray);" data-i18n="dest_tr_eyebrow">SEYAHATLERİMİZİ KEŞFEDİN</span>
                <h2 style="font-family: var(--font-display); font-size: 3rem; color: var(--near-black); margin-top: 0.5rem; font-weight: 400;"><span data-i18n="dest_tr_title">Türkiye'nin</span> <em style="font-style: italic; font-weight: 300;" data-i18n="dest_tr_it">Ruhu</em></h2>
            </div>
            <p style="color: var(--dark-gray); max-width: 300px; text-align: right; font-size: 0.95rem; margin-bottom: 1rem;" data-i18n="dest_tr_desc">Benzersiz deneyimlerin ilham veren hikayesi</p>
        </div>

        @if(isset($destinations['turkiye']) && count($destinations['turkiye']) > 0)
            <div class="marquee-container">
                <div class="marquee-track">
                    <div class="marquee-content">
                        @foreach($destinations['turkiye'] as $dest)
                            <a href="{{ route('destinasyon.detay', $dest->id) }}" class="dest-card-h" style="display: block; text-decoration: none; color: inherit;">
                                <div class="dest-img-container">
                                    <div class="dest-img" style="background-image:url('{{ asset($dest->img) }}'); position: absolute; inset: 0; background-size: cover; background-position: center; transition: transform 0.9s cubic-bezier(0.25, 0.46, 0.45, 0.94);"></div>
                                </div>
                                <div class="dest-info-ext">
                                    <div class="dest-region">
                                        <span class="lang-tr-text">{{ $dest->region['tr'] ?? '' }}</span>
                                        <span class="lang-en-text" style="display:none;">{{ $dest->region['en'] ?? '' }}</span>
                                    </div>
                                    <div class="dest-name-grid">
                                        <span class="lang-tr-text">{{ $dest->name['tr'] ?? '' }}</span>
                                        <span class="lang-en-text" style="display:none;">{{ $dest->name['en'] ?? '' }}</span>
                                    </div>
                                    <div class="dest-btn-wrapper" style="margin-top: 0.8rem;">
                                        <span class="btn-dest-explore">
                                            <span class="lang-tr-text">İncele</span>
                                            <span class="lang-en-text" style="display:none;">View</span>
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="transition: transform 0.3s ease;"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="marquee-content" aria-hidden="true">
                        @foreach($destinations['turkiye'] as $dest)
                            <a href="{{ route('destinasyon.detay', $dest->id) }}" class="dest-card-h" style="display: block; text-decoration: none; color: inherit;">
                                <div class="dest-img-container">
                                    <div class="dest-img" style="background-image:url('{{ asset($dest->img) }}'); position: absolute; inset: 0; background-size: cover; background-position: center; transition: transform 0.9s cubic-bezier(0.25, 0.46, 0.45, 0.94);"></div>
                                </div>
                                <div class="dest-info-ext">
                                    <div class="dest-region">
                                        <span class="lang-tr-text">{{ $dest->region['tr'] ?? '' }}</span>
                                        <span class="lang-en-text" style="display:none;">{{ $dest->region['en'] ?? '' }}</span>
                                    </div>
                                    <div class="dest-name-grid">
                                        <span class="lang-tr-text">{{ $dest->name['tr'] ?? '' }}</span>
                                        <span class="lang-en-text" style="display:none;">{{ $dest->name['en'] ?? '' }}</span>
                                    </div>
                                    <div class="dest-btn-wrapper" style="margin-top: 0.8rem;">
                                        <span class="btn-dest-explore">
                                            <span class="lang-tr-text">İncele</span>
                                            <span class="lang-en-text" style="display:none;">View</span>
                                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="transition: transform 0.3s ease;"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <div style="color: var(--mid-gray); padding: 2rem;">
                <span class="lang-tr-text">Henüz destinasyon eklenmedi.</span>
                <span class="lang-en-text" style="display:none;">No destinations added yet.</span>
            </div>
        @endif
    </section>

    <!-- NEW: Destinations (Yurtdışı) - BLACK TOMATO PHOTO 1 LAYOUT (START YOUR JOURNEY) -->
    <section class="dest-section bt-horizontal-scroll" id="yurtdisi" style="background: var(--white); padding: 7rem 0 7rem 0; text-align: center; overflow: hidden; display: flex; flex-direction: column; align-items: center;">
        <h2 style="font-family: var(--font-condensed); font-size: 3.5rem; text-transform: uppercase; font-weight: 500; letter-spacing: 0.05em; margin-bottom: 2rem; color: var(--near-black);" data-i18n="dest_en_main">YOLCULUĞUNUZA BAŞLAYIN</h2>
        
        <ul class="bt-tabs-nav" style="display: flex; justify-content: center; gap: 3rem; list-style: none; margin-bottom: 4rem; font-size: 0.8rem; font-family: var(--font-body); letter-spacing: 0.15em; text-transform: uppercase; border-bottom: 1px solid rgba(0,0,0,0.1); padding-bottom: 1rem; width: 90%; margin-left: auto; margin-right: auto;">
            <li class="active" data-type="yurtdisi_popular" data-i18n="tab_popular">EN POPÜLER</li>
            <li data-type="yurtdisi_traveller" data-i18n="tab_traveller">GEZGİNE GÖRE</li>
            <li data-type="yurtdisi_month" data-i18n="tab_month">AYA GÖRE</li>
            <li data-type="yurtdisi_spotlight" data-i18n="tab_spotlight">VİTRİNDEKİLER</li>
        </ul>

        @php
            $types = [
                'yurtdisi_popular',
                'yurtdisi_traveller',
                'yurtdisi_month',
                'yurtdisi_spotlight'
            ];
        @endphp

        @foreach($types as $type)
            <div id="panel-{{ $type }}" class="yurtdisi-pane" style="{{ $type === 'yurtdisi_popular' ? '' : 'display: none;' }}">
                @if(isset($destinations[$type]) && count($destinations[$type]) > 0)
                    <div class="marquee-container">
                        <div class="marquee-track">
                            <div class="marquee-content">
                                @foreach($destinations[$type] as $dest)
                                    <a href="{{ route('destinasyon.detay', $dest->id) }}" class="dest-card-h" style="display: block; text-decoration: none; color: inherit;">
                                        <div class="dest-img-container">
                                            <div class="dest-img" style="background-image:url('{{ asset($dest->img) }}'); position: absolute; inset: 0; background-size: cover; background-position: center; transition: transform 0.9s cubic-bezier(0.25, 0.46, 0.45, 0.94);"></div>
                                        </div>
                                        <div class="dest-info-ext">
                                            <div class="dest-region">
                                                <span class="lang-tr-text">{{ $dest->region['tr'] ?? '' }}</span>
                                                <span class="lang-en-text" style="display:none;">{{ $dest->region['en'] ?? '' }}</span>
                                            </div>
                                            <div class="dest-name-grid">
                                                <span class="lang-tr-text">{{ $dest->name['tr'] ?? '' }}</span>
                                                <span class="lang-en-text" style="display:none;">{{ $dest->name['en'] ?? '' }}</span>
                                            </div>
                                            <div class="dest-btn-wrapper" style="margin-top: 0.8rem;">
                                                <span class="btn-dest-explore">
                                                    <span class="lang-tr-text">İncele</span>
                                                    <span class="lang-en-text" style="display:none;">View</span>
                                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="transition: transform 0.3s ease;"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="marquee-content" aria-hidden="true">
                                @foreach($destinations[$type] as $dest)
                                    <a href="{{ route('destinasyon.detay', $dest->id) }}" class="dest-card-h" style="display: block; text-decoration: none; color: inherit;">
                                        <div class="dest-img-container">
                                            <div class="dest-img" style="background-image:url('{{ asset($dest->img) }}'); position: absolute; inset: 0; background-size: cover; background-position: center; transition: transform 0.9s cubic-bezier(0.25, 0.46, 0.45, 0.94);"></div>
                                        </div>
                                        <div class="dest-info-ext">
                                            <div class="dest-region">
                                                <span class="lang-tr-text">{{ $dest->region['tr'] ?? '' }}</span>
                                                <span class="lang-en-text" style="display:none;">{{ $dest->region['en'] ?? '' }}</span>
                                            </div>
                                            <div class="dest-name-grid">
                                                <span class="lang-tr-text">{{ $dest->name['tr'] ?? '' }}</span>
                                                <span class="lang-en-text" style="display:none;">{{ $dest->name['en'] ?? '' }}</span>
                                            </div>
                                            <div class="dest-btn-wrapper" style="margin-top: 0.8rem;">
                                                <span class="btn-dest-explore">
                                                    <span class="lang-tr-text">İncele</span>
                                                    <span class="lang-en-text" style="display:none;">View</span>
                                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="transition: transform 0.3s ease;"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @else
                    <div style="color: var(--mid-gray); padding: 2rem;">
                        <span class="lang-tr-text">Henüz destinasyon eklenmedi.</span>
                        <span class="lang-en-text" style="display:none;">No destinations added yet.</span>
                    </div>
                @endif
            </div>
        @endforeach
    </section>

    <!-- NEW: Collaborations Grid -->
    <!-- NEW: Collaborations Grid (Black Tomato Style) -->
    <style>
        .bt-logos-wrapper {
            margin-top: 4rem;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 5rem;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }
        .bt-logo-img {
            max-width: 140px;
            height: auto;
            opacity: 0.3;
            filter: grayscale(100%);
            transition: all 0.4s ease;
            cursor: pointer;
        }
        .bt-logo-img:hover {
            opacity: 1;
            filter: grayscale(0%);
            transform: scale(1.05);
        }
        /* Mobile adjustment */
        @media (max-width: 768px) {
            .bt-logos-wrapper { gap: 2.5rem; }
            .bt-logo-img { max-width: 100px; }
        }
    </style>
    <section class="collabs" id="referanslar" style="text-align: center; padding: 7rem 5rem; background: var(--white); border-top: 1px solid rgba(0,0,0,0.05);">
        <div class="section-header reveal" style="justify-content: center; margin-bottom: 2rem;">
            <div>
                <h2 class="section-title" data-i18n="collab_title" style="font-family: var(--font-condensed); font-size: 2.5rem; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 1rem; color: var(--near-black); text-align: center;">MARKA & İŞ BİRLİKLERİ</h2>
                <p style="color: var(--mid-gray); font-size: 0.8rem; letter-spacing: 0.15em; text-transform: uppercase;">Güvenilir Partnerlerimiz</p>
            </div>
        </div>
        <div class="bt-logos-wrapper reveal" id="refsGrid" style="transition-delay: 0.2s;">
            @if(isset($settings['brands']) && is_array($settings['brands']))
                @foreach($settings['brands'] as $brand)
                    <img class="bt-logo-img" src="{{ asset($brand['img']) }}" alt="{{ $brand['name'] }}" title="{{ $brand['name'] }}">
                @endforeach
            @endif
        </div>
    </section>

    <!-- OLD: Process (Süreç) -->
    <section class="process">
        <div class="section-header reveal">
            <div>
                <span class="section-label" data-i18n="proc_eyebrow">Metodoloji</span>
                <h2 class="section-title"><span data-i18n="proc_title">Nasıl</span> <em data-i18n="proc_it">Çalışıyoruz?</em></h2>
            </div>
        </div>
        <div class="process-steps">
            <div class="process-step reveal">
                <div class="step-dot"></div>
                <div class="step-n">01</div>
                <h3 class="step-h" data-i18n="proc_h1">Hayal Kurun</h3>
                <p class="step-p" data-i18n="proc_p1">Bize rüya seyahatinizi anlatın. Hayallerinizi özgürce paylaşın.</p>
            </div>
            <div class="process-step reveal" style="transition-delay: 0.1s;">
                <div class="step-dot"></div>
                <div class="step-n">02</div>
                <h3 class="step-h" data-i18n="proc_h2">Tasarlayalım</h3>
                <p class="step-p" data-i18n="proc_p2">Uzman ekibimiz size özel, detaylı bir program hazırlar.</p>
            </div>
            <div class="process-step reveal" style="transition-delay: 0.2s;">
                <div class="step-dot"></div>
                <div class="step-n">03</div>
                <h3 class="step-h" data-i18n="proc_h3">Mükemmelleştirin</h3>
                <p class="step-p" data-i18n="proc_p3">Her detayı birlikte gözden geçiririz. Tamamı ince ayrıntısına kadar planlanır.</p>
            </div>
            <div class="process-step reveal" style="transition-delay: 0.3s;">
                <div class="step-dot"></div>
                <div class="step-n">04</div>
                <h3 class="step-h" data-i18n="proc_h4">Yola Çıkın</h3>
                <p class="step-p" data-i18n="proc_p4">Tüm organizasyon hazır. Geri kalanı tamamen bizde.</p>
            </div>
        </div>
    </section>

    <!-- OLD: Testimonial -->
    <section class="testi">
        <div class="reveal">
            <blockquote class="testi-quote" data-i18n="testi_quote">
                "Dioreal Dijital ile yaptığımız iş birliği, markamızın global vizyonunu tam olarak yansıtan benzersiz
                bir deneyimdi. Detaylara gösterilen özen büyüleyiciydi."
            </blockquote>
            <p class="testi-author" data-i18n="testi_author">— Seçkin İş Ortakları</p>
        </div>
    </section>

    @include('partials.footer')
    <script src="{{ asset('js/i18n.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/common.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/nav.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/home.js') }}?v={{ time() }}"></script>
</body>

</html>
