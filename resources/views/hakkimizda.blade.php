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
            <li><a href="hakkimizda.html" class="active-page" data-i18n="nav_about">Hakkımızda</a></li>
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
            <li style="font-size:1.5rem;font-family:var(--font-display);margin-top:2rem;"><span id="lang-tr-fs" class="lang-btn active">TR</span> | <span id="lang-en-fs" class="lang-btn">EN</span></li>
        </ul>
    </div>

    <div class="page-hero" style="background-image:url('{{ asset($settings['about_hero_img'] ?? 'foto.img/hero_4k.jpg') }}');">
        <div class="page-hero-content">
            <span class="page-eyebrow">
                <span class="lang-text-tr">{{ $settings['about_hero_eyebrow_tr'] ?? 'Biz Kimiz' }}</span>
                <span class="lang-text-en">{{ $settings['about_hero_eyebrow_en'] ?? 'Who We Are' }}</span>
            </span>
            <h1 class="page-title">
                <span class="lang-text-tr">{!! $settings['about_hero_title_tr'] ?? '<em>Dioreal</em> Dijital' !!}</span>
                <span class="lang-text-en">{!! $settings['about_hero_title_en'] ?? '<em>Dioreal</em> Digital' !!}</span>
            </h1>
        </div>
    </div>

    <section class="content-section">
        <div class="content-grid">
            <div class="reveal">
                <span class="content-eyebrow">
                    <span class="lang-text-tr">{{ $settings['about_story_eyebrow_tr'] ?? 'Hikayemiz' }}</span>
                    <span class="lang-text-en">{{ $settings['about_story_eyebrow_en'] ?? 'Our Story' }}</span>
                </span>
                <h2 class="content-title">
                    <span class="lang-text-tr">{!! $settings['about_story_title_tr'] ?? '15 yıldır lüks <em>seyahatin</em> sesi' !!}</span>
                    <span class="lang-text-en">{!! $settings['about_story_title_en'] ?? 'Voice of luxury <em>travel</em> for 15 years' !!}</span>
                </h2>
                <div class="lang-text-tr">
                    <p class="content-body">{!! nl2br(e($settings['about_story_p1_tr'] ?? '2010 yılında İstanbul\'da kurulan Dioreal Dijital, Türkiye\'nin öncü lüks seyahat ve yaşam tarzı medya platformuna dönüşmüştür. Seçkin destinasyonlar, premium markalar ve doğru kitleyi bir araya getiren köprü olmak misyonuyla kurulduk.')) !!}</p>
                    <p class="content-body">{!! nl2br(e($settings['about_story_p2_tr'] ?? 'Her destinasyonda bizzat bulunarak, her oteli bizatihi deneyimleyerek ve her markayı özenle seçerek güvenilir bir referans noktası haline geldik.')) !!}</p>
                </div>
                <div class="lang-text-en">
                    <p class="content-body">{!! nl2br(e($settings['about_story_p1_en'] ?? 'Founded in Istanbul in 2010, Dioreal Digital has evolved into Turkey\'s leading luxury travel and lifestyle media platform.')) !!}</p>
                    <p class="content-body">{!! nl2br(e($settings['about_story_p2_en'] ?? 'By personally visiting every destination and experiencing every hotel firsthand, we\'ve become a trusted reference.')) !!}</p>
                </div>
            </div>
            <div class="reveal" style="transition-delay:0.2s">
                <img src="{{ asset($settings['about_story_img'] ?? 'foto.img/about_yacht.jpg') }}" alt="Hakkımızda" style="width:100%;aspect-ratio:4/3;object-fit:cover;">
            </div>
        </div>
    </section>

    <section class="content-section alt">
        <div style="text-align:center;max-width:800px;margin:0 auto 4rem;" class="reveal">
            <span class="content-eyebrow" style="display:block;">
                <span class="lang-text-tr">Rakamlarla</span>
                <span class="lang-text-en">By Numbers</span>
            </span>
            <h2 class="content-title">
                <span class="lang-text-tr">{!! $settings['about_stats_title_tr'] ?? '15 Yılın <em>Mirası</em>' !!}</span>
                <span class="lang-text-en">{!! $settings['about_stats_title_en'] ?? 'Legacy of <em>15 Years</em>' !!}</span>
            </h2>
        </div>
        <div class="stat-row reveal" style="justify-content:center;">
            <div class="stat-item">
                <span class="stat-num">{{ $settings['about_stat1_num'] ?? '150+' }}</span>
                <span class="stat-label">
                    <span class="lang-text-tr">{{ $settings['about_stat1_label_tr'] ?? 'Destinasyon' }}</span>
                    <span class="lang-text-en">{{ $settings['about_stat1_label_en'] ?? 'Destinations' }}</span>
                </span>
            </div>
            <div class="stat-item">
                <span class="stat-num">{{ $settings['about_stat2_num'] ?? '2M+' }}</span>
                <span class="stat-label">
                    <span class="lang-text-tr">{{ $settings['about_stat2_label_tr'] ?? 'Aylık Okuyucu' }}</span>
                    <span class="lang-text-en">{{ $settings['about_stat2_label_en'] ?? 'Monthly Readers' }}</span>
                </span>
            </div>
            <div class="stat-item">
                <span class="stat-num">{{ $settings['about_stat3_num'] ?? '300+' }}</span>
                <span class="stat-label">
                    <span class="lang-text-tr">{{ $settings['about_stat3_label_tr'] ?? 'Marka Ortağı' }}</span>
                    <span class="lang-text-en">{{ $settings['about_stat3_label_en'] ?? 'Brand Partners' }}</span>
                </span>
            </div>
            <div class="stat-item">
                <span class="stat-num">{{ $settings['about_stat4_num'] ?? '15' }}</span>
                <span class="stat-label">
                    <span class="lang-text-tr">{{ $settings['about_stat4_label_tr'] ?? 'Yıllık Deneyim' }}</span>
                    <span class="lang-text-en">{{ $settings['about_stat4_label_en'] ?? 'Years of Experience' }}</span>
                </span>
            </div>
        </div>
    </section>

    <section class="content-section">
        <div class="content-grid reverse">
            <div class="reveal">
                <span class="content-eyebrow">
                    <span class="lang-text-tr">{{ $settings['about_mission_eyebrow_tr'] ?? 'Misyonumuz' }}</span>
                    <span class="lang-text-en">{{ $settings['about_mission_eyebrow_en'] ?? 'Our Mission' }}</span>
                </span>
                <h2 class="content-title">
                    <span class="lang-text-tr">{!! $settings['about_mission_title_tr'] ?? 'Anlamlı <em>deneyimler</em> için' !!}</span>
                    <span class="lang-text-en">{!! $settings['about_mission_title_en'] ?? 'For meaningful <em>experiences</em>' !!}</span>
                </h2>
                <div class="lang-text-tr">
                    <p class="content-body">{!! nl2br(e($settings['about_mission_p1_tr'] ?? 'Sadece güzel yerler göstermiyoruz. Seyahatin ruhunu, bir destinasyonun gerçek özünü, yerel kültürün derinliğini aktarıyoruz. Her içeriğimiz bizzat yaşadığımız deneyimlerin dürüst bir yansımasıdır.')) !!}</p>
                    <p class="content-body">{!! nl2br(e($settings['about_mission_p2_tr'] ?? 'Okuyucularımız bize güvenir, markalarımız bize inanır, destinasyonlar bizi ortaklık arar çünkü söylediğimiz her şey gerçek.')) !!}</p>
                </div>
                <div class="lang-text-en">
                    <p class="content-body">{!! nl2br(e($settings['about_mission_p1_en'] ?? 'We don\'t just show beautiful places. We convey the true essence of a destination.')) !!}</p>
                    <p class="content-body">{!! nl2br(e($settings['about_mission_p2_en'] ?? 'Our readers trust us, our readers believe in us, and destinations seek partnerships because everything we say is authentic.')) !!}</p>
                </div>
            </div>
            <div class="reveal" style="transition-delay:0.2s">
                <img src="{{ asset($settings['about_mission_img'] ?? 'foto.img/about_safari.jpg') }}" alt="Misyon" style="width:100%;aspect-ratio:4/3;object-fit:cover;">
            </div>
        </div>
    </section>

    @include('partials.footer')
    <script src="{{ asset('js/i18n.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/common.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/nav.js') }}?v={{ time() }}"></script>
</body>
</html>

