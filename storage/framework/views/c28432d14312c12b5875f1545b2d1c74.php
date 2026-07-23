<!DOCTYPE html>
<html lang="<?php echo e(get_active_locale()); ?>">

<head>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="base-url" content="<?php echo e(url('/')); ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Jost:wght@200;300;400;500;600&family=Oswald:wght@500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/base.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/nav-footer.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/components.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/home.css')); ?>?v=<?php echo e(time()); ?>">
    <?php
        $locale = get_active_locale();
        $seoData = get_page_seo('home');
        $seo_title = $seo_title ?? ($locale === 'en' ? $seoData['title_en'] : $seoData['title_tr']);
        $seo_desc = $seo_desc ?? ($locale === 'en' ? $seoData['desc_en'] : $seoData['desc_tr']);
        $og_image = $og_image ?? asset('foto.img/hero_4k.jpg');
        $canonical = $canonical ?? route('home');
        $hreflang_tr = $hreflang_tr ?? route('home');
        $hreflang_en = $hreflang_en ?? route('home');
        $noindex = $noindex ?? false;
    ?>

    <title><?php echo e($seo_title); ?></title>
    <meta name="description" content="<?php echo e($seo_desc); ?>">
    
    <link rel="canonical" href="<?php echo e($canonical); ?>">
    <link rel="alternate" hreflang="tr" href="<?php echo e($hreflang_tr); ?>" />
    <link rel="alternate" hreflang="en" href="<?php echo e($hreflang_en); ?>" />
    <link rel="alternate" hreflang="x-default" href="<?php echo e($canonical); ?>" />

    <?php if($noindex): ?>
    <meta name="robots" content="noindex, nofollow">
    <?php else: ?>
    <meta name="robots" content="index, follow">
    <?php endif; ?>

    <meta property="og:title" content="<?php echo e($seo_title); ?>">
    <meta property="og:description" content="<?php echo e($seo_desc); ?>">
    <meta property="og:image" content="<?php echo e($og_image); ?>">
    <meta property="og:url" content="<?php echo e($canonical); ?>">
    <meta property="og:type" content="<?php echo e($og_type ?? 'website'); ?>">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo e($seo_title); ?>">
    <meta name="twitter:description" content="<?php echo e($seo_desc); ?>">
    <meta name="twitter:image" content="<?php echo e($og_image); ?>">

    <?php if(isset($schema_json)): ?>
    <?php echo $schema_json; ?>

    <?php endif; ?>
    
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "Dioreal Dijital",
      "url": "https://dioreal.com",
      "logo": "https://dioreal.com/foto.img/dioreal_beyaz_logo.png",
      "sameAs": [
        "https://www.instagram.com/dioreal",
        "https://www.linkedin.com/company/dioreal"
      ]
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "url": "https://dioreal.com",
      "name": "Dioreal Dijital"
    }
    </script>
    
</head>

<body>

    <!-- Desktop Nav -->
    <nav id="mainNav">
        <div class="nav-logo-wrapper">
            <a href="<?php echo e(route('home')); ?>" class="nav-logo">
                <span class="logo-text">DIOREAL</span>
            </a>
        </div>
        <ul class="nav-links">
            <li><a href="<?php echo e(route('hakkimizda')); ?>" data-i18n="nav_about">Hakkımızda</a></li>
            <li><a href="<?php echo e(route('oteller')); ?>" data-i18n="nav_hotels">Oteller</a></li>
            <li><a href="<?php echo e(route('yatlar')); ?>" data-i18n="nav_yachts">Yatlar</a></li>
            <li><a href="<?php echo e(route('restoranlar')); ?>" data-i18n="nav_restaurants">Restoranlar</a></li>
            <li><a href="<?php echo e(route('gezi-rehberi')); ?>" data-i18n="nav_guide">Gezi Rehberi</a></li>
            <li><a href="<?php echo e(route('etkinlikler')); ?>" data-i18n="nav_events">Etkinlikler</a></li>
            <li><a href="<?php echo e(route('journal')); ?>" data-i18n="nav_journal">Journal</a></li>
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
            <li><a href="<?php echo e(route('hakkimizda')); ?>" data-i18n="nav_about">Hakkımızda</a></li>
            <li><a href="<?php echo e(route('oteller')); ?>" data-i18n="nav_hotels">Oteller</a></li>
            <li><a href="<?php echo e(route('yatlar')); ?>" data-i18n="nav_yachts">Yatlar</a></li>
            <li><a href="<?php echo e(route('restoranlar')); ?>" data-i18n="nav_restaurants">Restoranlar</a></li>
            <div class="fs-divider"></div>
            <li><a href="<?php echo e(route('gezi-rehberi')); ?>" data-i18n="nav_guide">Gezi Rehberi</a></li>
            <li><a href="<?php echo e(route('etkinlikler')); ?>" data-i18n="nav_events">Etkinlikler</a></li>
            <li><a href="<?php echo e(route('journal')); ?>" data-i18n="nav_journal">Journal</a></li>
            <li class="lang-switch" style="font-size: 1.5rem; font-family: var(--font-display); justify-content: center; margin-top:3rem;">
                <span id="lang-tr-fs" class="lang-btn active">TR</span> | <span id="lang-en-fs" class="lang-btn">EN</span>
            </li>
        </ul>
    </div>

    <!-- NEW: Dynamic Hero Area -->
    <section class="hero">
        <div class="hero-slider">
            <div class="hero-slide active"
                style="background-image:url('<?php echo e((!empty($settings['hero_slide_1']) && file_exists(public_path($settings['hero_slide_1']))) ? asset($settings['hero_slide_1']) : asset('foto.img/hero_4k.jpg')); ?>')">
            </div>
            <div class="hero-slide"
                style="background-image:url('<?php echo e((!empty($settings['hero_slide_2']) && file_exists(public_path($settings['hero_slide_2']))) ? asset($settings['hero_slide_2']) : asset('foto.img/hero_slide_2.jpg')); ?>')">
            </div>
            <div class="hero-slide"
                style="background-image:url('<?php echo e((!empty($settings['hero_slide_3']) && file_exists(public_path($settings['hero_slide_3']))) ? asset($settings['hero_slide_3']) : asset('foto.img/hero_slide_3.jpg')); ?>')">
            </div>
        </div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <span class="hero-eyebrow" data-i18n="hero_eyebrow">Bağımsız Medya & Lüks Yaşam Platformu</span>
            <h1 class="hero-title" data-i18n="hero_title">Keşfetmeye Değer <em>Dünyalar</em></h1>
            <p class="hero-desc" data-i18n="hero_desc">Seçkin destinasyonlar, küresel lüks markalar ve sıra dışı seyahat hikayeleri tek bir çatı altında.</p>
            <div class="hero-cta-group">
                <a href="<?php echo e(route('gezi-rehberi')); ?>" class="btn btn-hero-primary" data-i18n="btn_explore">Koleksiyonu Keşfet</a>
                <a href="https://wa.me/<?php echo e(format_whatsapp($settings['whatsapp'] ?? '')); ?>" target="_blank" class="btn btn-hero-secondary" data-i18n="btn_contact">İletişime Geç</a>
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
                <span class="lang-text-tr"><?php echo e($settings['man_eyebrow_tr'] ?? 'BU AYIN SEÇKİNLERİ'); ?></span>
                <span class="lang-text-en"><?php echo e($settings['man_eyebrow_en'] ?? "THIS MONTH'S SELECTION"); ?></span>
            </h2>
            <p style="font-size: 1.1rem; line-height: 1.8; color: var(--dark-gray);">
                <span class="lang-text-tr"><?php echo e($settings['man_p1_tr'] ?? 'Sizler için özenle seçtiğimiz bu ayın en trend otel, restoran, yat ve plaj lokasyonlarının ardındaki eşsiz hikayeleri keşfedin. Sıradanlığın ötesinde anılar biriktirmeniz için tasarlanmış özel deneyimler.'); ?></span>
                <span class="lang-text-en"><?php echo e($settings['man_p1_en'] ?? "Explore the unique stories behind this month's trending hotels, restaurants, yachts, and beach spots carefully selected for you. Bespoke experiences designed for you to gather memories beyond the ordinary."); ?></span>
            </p>
        </div>
        <div class="bt-about-grid" style="display: grid; gap: 2rem; text-align: left;">
            <!-- Trend Otel -->
            <div class="bt-about-card" style="aspect-ratio: 3/4; position: relative; overflow: hidden; background: var(--near-black); cursor: pointer; transition: transform 0.4s;">
                <img src="<?php echo e((!empty($settings['trend_otel_img']) && file_exists(public_path($settings['trend_otel_img']))) ? asset($settings['trend_otel_img']) : asset('foto.img/about_safari.jpg')); ?>" alt="Trend Otel" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s ease;">
                <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 2rem; background: linear-gradient(transparent, rgba(0,0,0,0.85)); color: white; pointer-events: none;">
                    <div style="font-size: 0.75rem; letter-spacing: 0.2em; text-transform: uppercase; margin-bottom: 0.5rem; color: rgba(255,255,255,0.8);">
                        <span class="lang-text-tr">Trend Otel</span>
                        <span class="lang-text-en">Trending Hotel</span>
                    </div>
                    <h3 style="font-family: var(--font-display); font-size: 1.8rem; margin-bottom: 1rem; font-weight: 400;">
                        <span class="lang-text-tr"><?php echo e($settings['trend_otel_title_tr'] ?? 'Kassandra Villa'); ?></span>
                        <span class="lang-text-en"><?php echo e($settings['trend_otel_title_en'] ?? 'Kassandra Villa'); ?></span>
                    </h3>
                    <p style="font-size: 0.85rem; line-height: 1.6; opacity: 0.9; margin: 0;">
                        <span class="lang-text-tr"><?php echo e($settings['trend_otel_desc_tr'] ?? 'Ege\'nin gizli kalmış koylarında uyanmanın eşsiz hissi.'); ?></span>
                        <span class="lang-text-en"><?php echo e($settings['trend_otel_desc_en'] ?? 'The unique feeling of waking up in the hidden bays of the Aegean.'); ?></span>
                    </p>
                </div>
            </div>
            <!-- Trend Restoran -->
            <div class="bt-about-card" style="aspect-ratio: 3/4; position: relative; overflow: hidden; background: var(--near-black); cursor: pointer; transition: transform 0.4s;">
                <img src="<?php echo e((!empty($settings['trend_rest_img']) && file_exists(public_path($settings['trend_rest_img']))) ? asset($settings['trend_rest_img']) : asset('foto.img/rest_mikla.jpg')); ?>" alt="Trend Restoran" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s ease;">
                <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 2rem; background: linear-gradient(transparent, rgba(0,0,0,0.85)); color: white; pointer-events: none;">
                    <div style="font-size: 0.75rem; letter-spacing: 0.2em; text-transform: uppercase; margin-bottom: 0.5rem; color: rgba(255,255,255,0.8);">
                        <span class="lang-text-tr">Trend Restoran</span>
                        <span class="lang-text-en">Trending Restaurant</span>
                    </div>
                    <h3 style="font-family: var(--font-display); font-size: 1.8rem; margin-bottom: 1rem; font-weight: 400;">
                        <span class="lang-text-tr"><?php echo e($settings['trend_rest_title_tr'] ?? 'Melengeç'); ?></span>
                        <span class="lang-text-en"><?php echo e($settings['trend_rest_title_en'] ?? 'Melengeç'); ?></span>
                    </h3>
                    <p style="font-size: 0.85rem; line-height: 1.6; opacity: 0.9; margin: 0;">
                        <span class="lang-text-tr"><?php echo e($settings['trend_rest_desc_tr'] ?? 'Taze deniz ürünleri ile unutulmaz bir gastronomi yolculuğu.'); ?></span>
                        <span class="lang-text-en"><?php echo e($settings['trend_rest_desc_en'] ?? 'An unforgettable gastronomic journey with fresh seafood.'); ?></span>
                    </p>
                </div>
            </div>
            <!-- Trend Yat -->
            <div class="bt-about-card" style="aspect-ratio: 3/4; position: relative; overflow: hidden; background: var(--near-black); cursor: pointer; transition: transform 0.4s;">
                <img src="<?php echo e((!empty($settings['trend_yat_img']) && file_exists(public_path($settings['trend_yat_img']))) ? asset($settings['trend_yat_img']) : asset('foto.img/about_yacht.jpg')); ?>" alt="Trend Yat" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s ease;">
                <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 2rem; background: linear-gradient(transparent, rgba(0,0,0,0.85)); color: white; pointer-events: none;">
                    <div style="font-size: 0.75rem; letter-spacing: 0.2em; text-transform: uppercase; margin-bottom: 0.5rem; color: rgba(255,255,255,0.8);">
                        <span class="lang-text-tr">Trend Yat</span>
                        <span class="lang-text-en">Trending Yacht</span>
                    </div>
                    <h3 style="font-family: var(--font-display); font-size: 1.8rem; margin-bottom: 1rem; font-weight: 400;">
                        <span class="lang-text-tr"><?php echo e($settings['trend_yat_title_tr'] ?? 'Blue Voyage'); ?></span>
                        <span class="lang-text-en"><?php echo e($settings['trend_yat_title_en'] ?? 'Blue Voyage'); ?></span>
                    </h3>
                    <p style="font-size: 0.85rem; line-height: 1.6; opacity: 0.9; margin: 0;">
                        <span class="lang-text-tr"><?php echo e($settings['trend_yat_desc_tr'] ?? 'Sonsuz mavilikte rotalar. Rüzgarın sesinden başka hiçbir şey yok.'); ?></span>
                        <span class="lang-text-en"><?php echo e($settings['trend_yat_desc_en'] ?? 'Routes in infinite blue. Nothing but the sound of the wind.'); ?></span>
                    </p>
                </div>
            </div>
            <!-- Trend Beach -->
            <div class="bt-about-card" style="aspect-ratio: 3/4; position: relative; overflow: hidden; background: var(--near-black); cursor: pointer; transition: transform 0.4s;">
                <img src="<?php echo e((!empty($settings['trend_beach_img']) && file_exists(public_path($settings['trend_beach_img']))) ? asset($settings['trend_beach_img']) : asset('foto.img/bodrum.jpg')); ?>" alt="Trend Beach" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.8s ease;">
                <div style="position: absolute; bottom: 0; left: 0; right: 0; padding: 2rem; background: linear-gradient(transparent, rgba(0,0,0,0.85)); color: white; pointer-events: none;">
                    <div style="font-size: 0.75rem; letter-spacing: 0.2em; text-transform: uppercase; margin-bottom: 0.5rem; color: rgba(255,255,255,0.8);">
                        <span class="lang-text-tr">Trend Beach</span>
                        <span class="lang-text-en">Trending Beach</span>
                    </div>
                    <h3 style="font-family: var(--font-display); font-size: 1.8rem; margin-bottom: 1rem; font-weight: 400;">
                        <span class="lang-text-tr"><?php echo e($settings['trend_beach_title_tr'] ?? 'Rups Beach'); ?></span>
                        <span class="lang-text-en"><?php echo e($settings['trend_beach_title_en'] ?? 'Rups Beach'); ?></span>
                    </h3>
                    <p style="font-size: 0.85rem; line-height: 1.6; opacity: 0.9; margin: 0;">
                        <span class="lang-text-tr"><?php echo e($settings['trend_beach_desc_tr'] ?? 'Altın kumlar ve kristal sular. Müziğin ritmine eşlik eden anlar.'); ?></span>
                        <span class="lang-text-en"><?php echo e($settings['trend_beach_desc_en'] ?? 'Golden sands and crystal waters. Moments accompanying the rhythm of the music.'); ?></span>
                    </p>
                </div>
            </div>
        </div>
    </section>
    

    
    <!-- NEW: Destinations (Türkiye) - BLACK TOMATO PHOTO 1 LAYOUT -->
    <section class="dest-section bt-horizontal-scroll" id="turkiye" style="background: var(--white); padding: 4rem 0 5rem 0; text-align: center; overflow: hidden; display: flex; flex-direction: column; align-items: center;">
        <div class="dest-section-header">
            <div style="text-align: left;">
                <span style="font-size: 0.75rem; letter-spacing: 0.2em; text-transform: uppercase; color: var(--mid-gray);" data-i18n="dest_tr_eyebrow">SEYAHATLERİMİZİ KEŞFEDİN</span>
                <h2 style="font-family: var(--font-display); font-size: 3rem; color: var(--near-black); margin-top: 0.5rem; font-weight: 400;"><span data-i18n="dest_tr_title">Türkiye'nin</span> <em style="font-style: italic; font-weight: 300;" data-i18n="dest_tr_it">Ruhu</em></h2>
            </div>
            <p class="dest-section-desc" data-i18n="dest_tr_desc">Benzersiz deneyimlerin ilham veren hikayesi</p>
        </div>

        <?php if(isset($destinations['turkiye']) && count($destinations['turkiye']) > 0): ?>
            <div class="marquee-container">
                <div class="marquee-track">
                    <div class="marquee-content">
                        <?php $__currentLoopData = $destinations['turkiye']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('destinasyon.detay', $dest->slug_tr ?: ($dest->slug_en ?: $dest->id))); ?>" class="dest-card-h" style="display: block; text-decoration: none; color: inherit;">
                                <div class="dest-img-container">
                                    <div class="dest-img" style="background-image:url('<?php echo e(asset($dest->img)); ?>'); position: absolute; inset: 0; background-size: cover; background-position: center; transition: transform 0.9s cubic-bezier(0.25, 0.46, 0.45, 0.94);"></div>
                                </div>
                                <div class="dest-info-ext">
                                    <div class="dest-region">
                                        <span class="lang-tr-text"><?php echo e($dest->region['tr'] ?? ''); ?></span>
                                        <span class="lang-en-text" style="display:none;"><?php echo e($dest->region['en'] ?? ''); ?></span>
                                    </div>
                                    <div class="dest-name-grid">
                                        <span class="lang-tr-text"><?php echo e($dest->name['tr'] ?? ''); ?></span>
                                        <span class="lang-en-text" style="display:none;"><?php echo e($dest->name['en'] ?? ''); ?></span>
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
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div class="marquee-content" aria-hidden="true">
                        <?php $__currentLoopData = $destinations['turkiye']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('destinasyon.detay', $dest->slug_tr ?: ($dest->slug_en ?: $dest->id))); ?>" class="dest-card-h" style="display: block; text-decoration: none; color: inherit;">
                                <div class="dest-img-container">
                                    <div class="dest-img" style="background-image:url('<?php echo e(asset($dest->img)); ?>'); position: absolute; inset: 0; background-size: cover; background-position: center; transition: transform 0.9s cubic-bezier(0.25, 0.46, 0.45, 0.94);"></div>
                                </div>
                                <div class="dest-info-ext">
                                    <div class="dest-region">
                                        <span class="lang-tr-text"><?php echo e($dest->region['tr'] ?? ''); ?></span>
                                        <span class="lang-en-text" style="display:none;"><?php echo e($dest->region['en'] ?? ''); ?></span>
                                    </div>
                                    <div class="dest-name-grid">
                                        <span class="lang-tr-text"><?php echo e($dest->name['tr'] ?? ''); ?></span>
                                        <span class="lang-en-text" style="display:none;"><?php echo e($dest->name['en'] ?? ''); ?></span>
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
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div style="color: var(--mid-gray); padding: 2rem;">
                <span class="lang-tr-text">Henüz destinasyon eklenmedi.</span>
                <span class="lang-en-text" style="display:none;">No destinations added yet.</span>
            </div>
        <?php endif; ?>
    </section>

    <!-- NEW: Destinations (Yurtdışı) - BLACK TOMATO PHOTO 1 LAYOUT (START YOUR JOURNEY) -->
    <section class="dest-section bt-horizontal-scroll" id="yurtdisi" style="background: var(--white); padding: 7rem 0 7rem 0; text-align: center; overflow: hidden; display: flex; flex-direction: column; align-items: center;">
        <h2 class="dest-main-title" data-i18n="dest_en_main">YOLCULUĞUNUZA BAŞLAYIN</h2>
        
        <ul class="bt-tabs-nav">
            <li class="active" data-type="yurtdisi_popular" data-i18n="tab_popular">EN POPÜLER</li>
            <li data-type="yurtdisi_traveller" data-i18n="tab_traveller">GEZGİNE GÖRE</li>
            <li data-type="yurtdisi_month" data-i18n="tab_month">AYA GÖRE</li>
            <li data-type="yurtdisi_spotlight" data-i18n="tab_spotlight">VİTRİNDEKİLER</li>
        </ul>

        <?php
            $types = [
                'yurtdisi_popular',
                'yurtdisi_traveller',
                'yurtdisi_month',
                'yurtdisi_spotlight'
            ];
        ?>

        <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div id="panel-<?php echo e($type); ?>" class="yurtdisi-pane" style="<?php echo e($type === 'yurtdisi_popular' ? '' : 'display: none;'); ?>">
                <?php if(isset($destinations[$type]) && count($destinations[$type]) > 0): ?>
                    <div class="marquee-container">
                        <div class="marquee-track">
                            <div class="marquee-content">
                                <?php $__currentLoopData = $destinations[$type]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('destinasyon.detay', $dest->slug_tr ?: ($dest->slug_en ?: $dest->id))); ?>" class="dest-card-h" style="display: block; text-decoration: none; color: inherit;">
                                        <div class="dest-img-container">
                                            <div class="dest-img" style="background-image:url('<?php echo e(asset($dest->img)); ?>'); position: absolute; inset: 0; background-size: cover; background-position: center; transition: transform 0.9s cubic-bezier(0.25, 0.46, 0.45, 0.94);"></div>
                                        </div>
                                        <div class="dest-info-ext">
                                            <div class="dest-region">
                                                <span class="lang-tr-text"><?php echo e($dest->region['tr'] ?? ''); ?></span>
                                                <span class="lang-en-text" style="display:none;"><?php echo e($dest->region['en'] ?? ''); ?></span>
                                            </div>
                                            <div class="dest-name-grid">
                                                <span class="lang-tr-text"><?php echo e($dest->name['tr'] ?? ''); ?></span>
                                                <span class="lang-en-text" style="display:none;"><?php echo e($dest->name['en'] ?? ''); ?></span>
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
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="marquee-content" aria-hidden="true">
                                <?php $__currentLoopData = $destinations[$type]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('destinasyon.detay', $dest->slug_tr ?: ($dest->slug_en ?: $dest->id))); ?>" class="dest-card-h" style="display: block; text-decoration: none; color: inherit;">
                                        <div class="dest-img-container">
                                            <div class="dest-img" style="background-image:url('<?php echo e(asset($dest->img)); ?>'); position: absolute; inset: 0; background-size: cover; background-position: center; transition: transform 0.9s cubic-bezier(0.25, 0.46, 0.45, 0.94);"></div>
                                        </div>
                                        <div class="dest-info-ext">
                                            <div class="dest-region">
                                                <span class="lang-tr-text"><?php echo e($dest->region['tr'] ?? ''); ?></span>
                                                <span class="lang-en-text" style="display:none;"><?php echo e($dest->region['en'] ?? ''); ?></span>
                                            </div>
                                            <div class="dest-name-grid">
                                                <span class="lang-tr-text"><?php echo e($dest->name['tr'] ?? ''); ?></span>
                                                <span class="lang-en-text" style="display:none;"><?php echo e($dest->name['en'] ?? ''); ?></span>
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
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div style="color: var(--mid-gray); padding: 2rem;">
                        <span class="lang-tr-text">Henüz destinasyon eklenmedi.</span>
                        <span class="lang-en-text" style="display:none;">No destinations added yet.</span>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
            opacity: 0.8;
            transition: all 0.4s ease;
            cursor: pointer;
        }
        .bt-logo-img:hover {
            opacity: 1;
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
            <?php if(isset($settings['brands']) && is_array($settings['brands'])): ?>
                <?php $__currentLoopData = $settings['brands']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <img class="bt-logo-img" src="<?php echo e(asset($brand['img'])); ?>" alt="<?php echo e($brand['name']); ?>" title="<?php echo e($brand['name']); ?>">
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
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

    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <script src="<?php echo e(asset('js/i18n.js')); ?>?v=<?php echo e(time()); ?>"></script>
    <script src="<?php echo e(asset('js/common.js')); ?>?v=<?php echo e(time()); ?>"></script>
    <script src="<?php echo e(asset('js/nav.js')); ?>?v=<?php echo e(time()); ?>"></script>
    <script src="<?php echo e(asset('js/home.js')); ?>?v=<?php echo e(time()); ?>"></script>
</body>

</html>
<?php /**PATH C:\Users\ahmet\Desktop\dioreal web\resources\views\index.blade.php ENDPATH**/ ?>