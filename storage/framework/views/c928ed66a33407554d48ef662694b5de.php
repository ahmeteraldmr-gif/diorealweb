<!DOCTYPE html>
<html lang="<?php echo e(get_active_locale()); ?>">
<head>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="base-url" content="<?php echo e(url('/')); ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Jost:wght@200;300;400;500;600&family=Oswald:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/base.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/nav-footer.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/components.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/about.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/events.css')); ?>?v=<?php echo e(time()); ?>">
    <?php
        $locale = get_active_locale();
        $seoData = get_page_seo('etkinlikler');
        $seo_title = $seo_title ?? ($locale === 'en' ? $seoData['title_en'] : $seoData['title_tr']);
        $seo_desc = $seo_desc ?? ($locale === 'en' ? $seoData['desc_en'] : $seoData['desc_tr']);
        $og_image = $og_image ?? asset('foto.img/etkinlik_hero.jpg');
        $canonical = $canonical ?? route('etkinlikler');
        $hreflang_tr = $hreflang_tr ?? route('etkinlikler');
        $hreflang_en = $hreflang_en ?? route('etkinlikler');
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
</head>
<body>
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
            <li><a href="<?php echo e(route('etkinlikler')); ?>" class="active-page" data-i18n="nav_events">Etkinlikler</a></li>
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
            <li style="font-size:1.5rem;font-family:var(--font-display);margin-top:2rem;"><span id="lang-tr-fs" class="lang-btn active">TR</span> | <span id="lang-en-fs" class="lang-btn">EN</span></li>
        </ul>
    </div>

    <div class="page-hero" style="background-image:url('foto.img/etkinlik_hero.jpg');">
        <div class="page-hero-content">
            <span class="page-eyebrow" data-i18n="event_hero_eye">Takvim 2026</span>
            <h1 class="page-title" data-i18n="nav_events">Seçkin <em>Etkinlikler</em></h1>
        </div>
    </div>

    <style>
        .event-card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
            gap: 3rem;
            margin-top: 2rem;
        }
        .event-card {
            background: var(--white);
            border: 1px solid var(--light-gray);
            border-radius: 4px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            position: relative;
        }
        .event-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            border-color: rgba(200, 169, 110, 0.3);
        }
        .event-card-image-box {
            position: relative;
            height: 240px;
            overflow: hidden;
            background: var(--near-black);
        }
        .event-card-image-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 1.5s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .event-card:hover .event-card-image-box img {
            transform: scale(1.05);
        }
        .event-card-date-badge {
            position: absolute;
            top: 1.5rem;
            left: 1.5rem;
            background: rgba(17, 16, 15, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
            color: var(--white);
            padding: 0.8rem 1.2rem;
            border-radius: 2px;
            text-align: center;
            z-index: 2;
            min-width: 60px;
        }
        .event-card-day {
            font-family: var(--font-display);
            font-size: 1.8rem;
            display: block;
            line-height: 1;
            font-weight: 300;
        }
        .event-card-month {
            font-family: var(--font-condensed);
            font-size: 0.75rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--accent);
        }
        .event-card-content {
            padding: 2.5rem 2rem 2rem 2rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        .event-card-tag {
            font-family: var(--font-condensed);
            font-size: 0.75rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 0.8rem;
            display: block;
        }
        .event-card-title {
            font-family: var(--font-display);
            font-size: 1.6rem;
            font-weight: 400;
            line-height: 1.3;
            margin-bottom: 0.8rem;
            color: var(--near-black);
        }
        .event-card-location {
            font-size: 0.85rem;
            color: var(--mid-gray);
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .event-card-desc {
            font-size: 0.95rem;
            line-height: 1.7;
            color: var(--mid-gray);
            margin-bottom: 2rem;
            flex-grow: 1;
        }
        .event-card-btn-wrapper {
            margin-top: auto;
            border-top: 1px solid var(--light-gray);
            padding-top: 1.5rem;
        }
        
        @media(max-width: 768px) {
            .event-card-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
        }
    </style>

    <section class="content-section">
        <div style="max-width:1200px;margin:0 auto;padding:0 2rem;">
            <div style="text-align:center;margin-bottom:4rem;" class="reveal">
                <span class="content-eyebrow" style="display:block;" data-i18n="event_intro_eye">Bu Sezon</span>
                <h2 class="content-title" data-i18n="event_intro_title">Kaçırılmayacak <em>Anlar</em></h2>
            </div>
            <div class="event-card-grid">
                <?php $__currentLoopData = $etkinlikler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $eventImg = !empty($e->img) ? $e->img : 'foto.img/etkinlik_hero.jpg';
                        $eventImgUrl = str_starts_with($eventImg, 'data:') || str_starts_with($eventImg, 'http') ? $eventImg : asset($eventImg);
                    ?>
                    <div class="event-card reveal visible">
                        <div class="event-card-image-box">
                            <img src="<?php echo e($eventImgUrl); ?>" alt="<?php echo e($e->title['tr'] ?? ''); ?>">
                            
                            <div class="event-card-date-badge">
                                <span class="event-card-day"><?php echo e($e->day); ?></span>
                                <span class="event-card-month lang-text-tr"><?php echo e($e->month["tr"] ?? ""); ?></span>
                                <span class="event-card-month lang-text-en"><?php echo e($e->month["en"] ?? ""); ?></span>
                            </div>
                        </div>

                        <div class="event-card-content">
                            <span class="event-card-tag lang-text-tr"><?php echo e($e->tag["tr"] ?? ""); ?></span>
                            <span class="event-card-tag lang-text-en"><?php echo e($e->tag["en"] ?? ""); ?></span>
                            
                            <h3 class="event-card-title lang-text-tr"><?php echo e($e->title["tr"] ?? ""); ?></h3>
                            <h3 class="event-card-title lang-text-en"><?php echo e($e->title["en"] ?? ""); ?></h3>
                            
                            <div class="event-card-location">
                                <i class="fas fa-map-marker-alt"></i>
                                <span class="lang-text-tr"><?php echo e($e->loc["tr"] ?? ""); ?></span>
                                <span class="lang-text-en"><?php echo e($e->loc["en"] ?? ""); ?></span>
                            </div>

                            <p class="event-card-desc lang-text-tr"><?php echo e($e->desc["tr"] ?? ""); ?></p>
                            <p class="event-card-desc lang-text-en"><?php echo e($e->desc["en"] ?? ""); ?></p>

                            <div class="event-card-btn-wrapper">
                                <a href="<?php echo e(route('etkinlik.detay', $e->slug_tr ?? $e->slug_en ?? $e->id)); ?>" class="btn btn-outline" style="display: block; text-align: center; text-decoration: none;">
                                    <span class="lang-text-tr">Etkinliği İncele</span>
                                    <span class="lang-text-en">Review Event</span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <script src="<?php echo e(asset('js/i18n.js')); ?>?v=<?php echo e(time()); ?>"></script>
    <script src="<?php echo e(asset('js/common.js')); ?>?v=<?php echo e(time()); ?>"></script>
    <script src="<?php echo e(asset('js/nav.js')); ?>?v=<?php echo e(time()); ?>"></script>
</body>
</html>

<?php /**PATH C:\Users\ahmet\Desktop\dioreal web\resources\views\etkinlikler.blade.php ENDPATH**/ ?>