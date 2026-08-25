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
        $seo_title = ($locale === 'en') ? ($seo['title_en'] ?? 'Privacy & Cookie Policy - Dioreal Digital') : ($seo['title_tr'] ?? 'Gizlilik & Çerez Politikası - Dioreal Dijital');
        $seo_desc = ($locale === 'en') ? ($seo['desc_en'] ?? 'Dioreal Digital Privacy and Cookie Policy.') : ($seo['desc_tr'] ?? 'Dioreal Dijital Gizlilik ve Çerez Politikası.');
        $og_image = asset('foto.img/logo_dioreal.png');
        $canonical = $canonical ?? route('privacy');
        $hreflang_tr = $hreflang_tr ?? route('privacy', ['lang' => 'tr']);
        $hreflang_en = $hreflang_en ?? route('privacy', ['lang' => 'en']);
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

    <div class="page-hero" style="background-image:url('{{ asset('foto.img/amalfi.jpg') }}');">
        <div class="page-hero-content">
            <span class="page-eyebrow">
                <span class="lang-text-tr">Yasal Bilgilendirme</span>
                <span class="lang-text-en">Legal Notice</span>
            </span>
            <h1 class="page-title">
                <span class="lang-text-tr">Gizlilik & <em>Çerez Politikası</em></span>
                <span class="lang-text-en">Privacy & <em>Cookie Policy</em></span>
            </h1>
        </div>
    </div>

    <section class="content-section" style="max-width: 950px; margin: 0 auto; padding: 6rem 2rem;">
        <div class="legal-article" style="font-family: var(--font-body); line-height: 1.8; color: var(--near-black); font-size: 1rem;">
            
            <div class="lang-text-tr">
                <h2 style="font-family: var(--font-display); font-size: 2.2rem; margin-bottom: 1.5rem; font-weight: 400; color: var(--near-black);">Gizlilik ve Çerez Politikası</h2>
                
                <p style="margin-bottom: 1.5rem;">Dioreal Dijital olarak ziyaretçilerimizin gizliliğini korumak ve şeffaf bir kullanıcı deneyimi sunmak önceliğimizdir. Bu politika, web sitemizi kullanırken çerezlerin ve kişisel verilerin nasıl işlendiğini açıklar.</p>

                <h3 style="font-family: var(--font-display); font-size: 1.5rem; margin-top: 2rem; margin-bottom: 1rem; color: var(--accent);">1. Çerez (Cookie) Nedir?</h3>
                <p style="margin-bottom: 1.5rem;">Çerezler, bir web sitesini ziyaret ettiğinizde cihazınıza (bilgisayar, tablet, akıllı telefon) kaydedilen küçük metin dosyalarıdır. Çerezler sitenin verimli çalışmasını sağlar ve tercihlerinizi hatırlamamıza yardımcı olur.</p>

                <h3 style="font-family: var(--font-display); font-size: 1.5rem; margin-top: 2rem; margin-bottom: 1rem; color: var(--accent);">2. Kullandığımız Çerez Türleri</h3>
                <ul style="padding-left: 1.5rem; margin-bottom: 1.5rem;">
                    <li><strong>Zorunlu Çerezler:</strong> Web sitesinin temel fonksiyonlarının (sayfa navigasyonu, dil tercihi, güvenlik) çalışması için kesinlikle gereklidir.</li>
                    <li><strong>Performans ve Analitik Çerezler:</strong> Ziyaretçilerin siteyi nasıl kullandığını (en çok ziyaret edilen sayfalar, oturum süreleri) anonim olarak analiz etmemizi sağlar.</li>
                    <li><strong>Fonksiyonel Çerezler:</strong> Seçtiğiniz dil veya bölge gibi tercihlerinizi hatırlayarak daha kişiselleştirilmiş bir deneyim sunar.</li>
                </ul>

                <h3 style="font-family: var(--font-display); font-size: 1.5rem; margin-top: 2rem; margin-bottom: 1rem; color: var(--accent);">3. Veri Güvenliği ve Üçüncü Taraflar</h3>
                <p style="margin-bottom: 1.5rem;">Toplanan analitik veriler kesinlikle ticari amaca yönelik olarak üçüncü taraflara satılmaz veya pazarlama şirketlerine devredilmez. Tüm veriler yüksek güvenlik standartları ile korunmaktadır.</p>

                <h3 style="font-family: var(--font-display); font-size: 1.5rem; margin-top: 2rem; margin-bottom: 1rem; color: var(--accent);">4. Çerez Tercihlerini Yönetme</h3>
                <p style="margin-bottom: 1.5rem;">Tarayıcınızın ayarlarını değiştirerek çerezleri dilediğiniz zaman engelleyebilir veya silebilirsiniz. Ancak zorunlu çerezlerin kapatılması sitenin bazı fonksiyonlarının çalışmamasına neden olabilir.</p>

                <p style="margin-top: 2rem;">Gizlilik ve çerez politikamızla ilgili sorularınız için <a href="mailto:info@dioreal.com" style="color: var(--accent); text-decoration: underline;">info@dioreal.com</a> adresinden bizimle iletişime geçebilirsiniz.</p>
            </div>

            <div class="lang-text-en">
                <h2 style="font-family: var(--font-display); font-size: 2.2rem; margin-bottom: 1.5rem; font-weight: 400; color: var(--near-black);">Privacy and Cookie Policy</h2>
                
                <p style="margin-bottom: 1.5rem;">At Dioreal Digital, protecting our visitors' privacy and offering a transparent user experience is our top priority. This policy outlines how cookies and personal data are processed when using our website.</p>

                <h3 style="font-family: var(--font-display); font-size: 1.5rem; margin-top: 2rem; margin-bottom: 1rem; color: var(--accent);">1. What is a Cookie?</h3>
                <p style="margin-bottom: 1.5rem;">Cookies are small text files saved to your device (computer, tablet, smartphone) when visiting a website. Cookies ensure the website runs efficiently and help us remember your preferences.</p>

                <h3 style="font-family: var(--font-display); font-size: 1.5rem; margin-top: 2rem; margin-bottom: 1rem; color: var(--accent);">2. Types of Cookies We Use</h3>
                <ul style="padding-left: 1.5rem; margin-bottom: 1.5rem;">
                    <li><strong>Essential Cookies:</strong> Strictly necessary for basic site functions (page navigation, language selection, security).</li>
                    <li><strong>Performance & Analytics Cookies:</strong> Allow us to anonymously analyze visitor behavior (most visited pages, session duration).</li>
                    <li><strong>Functional Cookies:</strong> Remember your settings such as preferred language or region for a customized experience.</li>
                </ul>

                <h3 style="font-family: var(--font-display); font-size: 1.5rem; margin-top: 2rem; margin-bottom: 1rem; color: var(--accent);">3. Data Security and Third Parties</h3>
                <p style="margin-bottom: 1.5rem;">Analytics data collected is never sold or transferred to third-party marketing companies for commercial gain. All traffic data is safeguarded under strict security standards.</p>

                <h3 style="font-family: var(--font-display); font-size: 1.5rem; margin-top: 2rem; margin-bottom: 1rem; color: var(--accent);">4. Managing Cookie Preferences</h3>
                <p style="margin-bottom: 1.5rem;">You can block or delete cookies at any time via your browser settings. However, disabling essential cookies may prevent certain site features from functioning properly.</p>

                <p style="margin-top: 2rem;">For any questions regarding our privacy and cookie policy, please contact <a href="mailto:info@dioreal.com" style="color: var(--accent); text-decoration: underline;">info@dioreal.com</a>.</p>
            </div>

        </div>
    </section>

    @include('partials.footer')
    <script src="{{ asset('js/i18n.js') }}?v=2.5.0"></script>
    <script src="{{ asset('js/common.js') }}?v=2.5.0"></script>
    <script src="{{ asset('js/nav.js') }}?v=2.5.0"></script>
</body>
</html>
