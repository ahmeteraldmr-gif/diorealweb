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
        $seo_title = ($locale === 'en') ? ($seo['title_en'] ?? 'Terms of Use - Dioreal Digital') : ($seo['title_tr'] ?? 'Kullanım Koşulları - Dioreal Dijital');
        $seo_desc = ($locale === 'en') ? ($seo['desc_en'] ?? 'Dioreal Digital Terms of Use agreement.') : ($seo['desc_tr'] ?? 'Dioreal Dijital Kullanım Koşulları sözleşmesi.');
        $og_image = asset('foto.img/logo_dioreal.png');
        $canonical = $canonical ?? route('terms');
        $hreflang_tr = $hreflang_tr ?? route('terms', ['lang' => 'tr']);
        $hreflang_en = $hreflang_en ?? route('terms', ['lang' => 'en']);
    @endphp

    <title>{{ $seo_title }}</title>
    <meta name="description" content="{{ $seo_desc }}">
    
    <link rel="canonical" href="{{ $canonical }}">
    <link rel="alternate" hreflang="tr" href="{{ $hreflang_tr }}" />
    <link rel="alternate" hreflang="en" href="{{ $hreflang_en }}" />
    <link rel="alternate" hreflang="x-default" href="{{ $canonical }}" />

    <meta name="robots" content="index, follow">
    <meta property="og:title" content="{{ $seo_title }}">
    <meta property="og:description" content="{{ $seo_desc }}">
    <meta property="og:image" content="{{ $og_image }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:type" content="website">

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
            <li><a href="{{ route('gezi-rehberi') }}" data-i18n="nav_guide"><span class="lang-text-tr">Gezi Rehberi</span><span class="lang-text-en">Travel Guide</span></a></li>
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

    <div class="page-hero" style="background-image:url('{{ asset('foto.img/bodrum.jpg') }}');">
        <div class="page-hero-content">
            <span class="page-eyebrow">
                <span class="lang-text-tr">Yasal Bilgilendirme</span>
                <span class="lang-text-en">Legal Notice</span>
            </span>
            <h1 class="page-title">
                <span class="lang-text-tr">Kullanım <em>Koşulları</em></span>
                <span class="lang-text-en">Terms of <em>Use</em></span>
            </h1>
        </div>
    </div>

    <section class="content-section" style="max-width: 950px; margin: 0 auto; padding: 6rem 2rem;">
        <div class="legal-article" style="font-family: var(--font-body); line-height: 1.8; color: var(--near-black); font-size: 1rem;">
            
            <div class="lang-text-tr">
                <h2 style="font-family: var(--font-display); font-size: 2.2rem; margin-bottom: 1.5rem; font-weight: 400; color: var(--near-black);">Dioreal Dijital Kullanım Koşulları Sözleşmesi</h2>
                
                <p style="margin-bottom: 1.5rem;">Dioreal Dijital web sitesini (dioreal.com) ziyaret ederek ve platform servislerini kullanarak aşağıda belirtilen kullanım koşullarını kabul etmiş sayılırsınız.</p>

                <h3 style="font-family: var(--font-display); font-size: 1.5rem; margin-top: 2rem; margin-bottom: 1rem; color: var(--accent);">1. Fikri ve Sınai Mülkiyet Hakları</h3>
                <p style="margin-bottom: 1.5rem;">Dioreal Dijital platformunda yer alan tüm özgün metinler, editorial içerikler, fotoğraflar, tasarımlar, logo ve markalar Dioreal Dijital'e aittir. Yazılı izin olmaksızın kopyalanamaz, çoğaltılamaz veya ticari amaçla yayınlanamaz.</p>

                <h3 style="font-family: var(--font-display); font-size: 1.5rem; margin-top: 2rem; margin-bottom: 1rem; color: var(--accent);">2. Hizmet Kapsamı ve Bilgilendirme Sorumluluğu</h3>
                <p style="margin-bottom: 1.5rem;">Sitemizde yayınlanan otel, restoran, yat ve destinasyon bilgileri bağımsız seyahat editörlerimizin incelemelerine dayanmaktadır. İçerikler bilgilendirme amaçlı olup rezervasyon ve fiyat koşulları ilgili işletmeler tarafından güncellenebilir.</p>

                <h3 style="font-family: var(--font-display); font-size: 1.5rem; margin-top: 2rem; margin-bottom: 1rem; color: var(--accent);">3. Kullanıcı Yükümlülükleri</h3>
                <p style="margin-bottom: 1.5rem;">Kullanıcılar, platformu hukuka ve genel ahlak kurallarına uygun olarak kullanmayı, sitenin çalışmasını engelleyecek veya zarar verecek siber girişimlerde bulunmamayı kabul ve taahhüt eder.</p>

                <h3 style="font-family: var(--font-display); font-size: 1.5rem; margin-top: 2rem; margin-bottom: 1rem; color: var(--accent);">4. Değişiklik Hakkı</h3>
                <p style="margin-bottom: 1.5rem;">Dioreal Dijital, bu kullanım koşullarını önceden haber vermeksizin güncelleme veya değiştirme hakkını saklı tutar.</p>

                <p style="margin-top: 2rem;">Kullanım koşulları ile ilgili sorularınız için <a href="mailto:info@dioreal.com" style="color: var(--accent); text-decoration: underline;">info@dioreal.com</a> adresi üzerinden bizimle iletişime geçebilirsiniz.</p>
            </div>

            <div class="lang-text-en">
                <h2 style="font-family: var(--font-display); font-size: 2.2rem; margin-bottom: 1.5rem; font-weight: 400; color: var(--near-black);">Dioreal Digital Terms of Use Agreement</h2>
                
                <p style="margin-bottom: 1.5rem;">By visiting the Dioreal Digital website (dioreal.com) and utilizing our platform services, you agree to comply with the terms of use outlined below.</p>

                <h3 style="font-family: var(--font-display); font-size: 1.5rem; margin-top: 2rem; margin-bottom: 1rem; color: var(--accent);">1. Intellectual Property Rights</h3>
                <p style="margin-bottom: 1.5rem;">All original texts, editorial articles, photographs, designs, logos, and trademarks on the Dioreal Digital platform are owned by Dioreal Digital. They may not be copied, reproduced, or published for commercial use without prior written consent.</p>

                <h3 style="font-family: var(--font-display); font-size: 1.5rem; margin-top: 2rem; margin-bottom: 1rem; color: var(--accent);">2. Scope of Service & Informational Disclaimer</h3>
                <p style="margin-bottom: 1.5rem;">Hotel, restaurant, yacht, and destination contents published on our site are based on independent editorial reviews. Information is provided for promotional purposes; booking terms and prices remain subject to update by respective venues.</p>

                <h3 style="font-family: var(--font-display); font-size: 1.5rem; margin-top: 2rem; margin-bottom: 1rem; color: var(--accent);">3. User Obligations</h3>
                <p style="margin-bottom: 1.5rem;">Users agree to use the platform lawfully and in good faith, refraining from any malicious activities or cyber attacks that could harm or impair platform operations.</p>

                <h3 style="font-family: var(--font-display); font-size: 1.5rem; margin-top: 2rem; margin-bottom: 1rem; color: var(--accent);">4. Right to Amendments</h3>
                <p style="margin-bottom: 1.5rem;">Dioreal Digital reserves the right to modify or update these terms of use at any time without prior notice.</p>

                <p style="margin-top: 2rem;">For any questions regarding our terms of use, please contact <a href="mailto:info@dioreal.com" style="color: var(--accent); text-decoration: underline;">info@dioreal.com</a>.</p>
            </div>

        </div>
    </section>

    @include('partials.footer')
    <script src="{{ asset('js/i18n.js') }}?v=2.5.0"></script>
    <script src="{{ asset('js/common.js') }}?v=2.5.0"></script>
    <script src="{{ asset('js/nav.js') }}?v=2.5.0"></script>
</body>
</html>
