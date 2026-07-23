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
    <link rel="stylesheet" href="<?php echo e(asset('css/journal.css')); ?>?v=<?php echo e(time()); ?>">
    <?php
        $locale = get_active_locale();
        $seoData = get_page_seo('journal');
        $seo_title = $seo_title ?? ($locale === 'en' ? $seoData['title_en'] : $seoData['title_tr']);
        $seo_desc = $seo_desc ?? ($locale === 'en' ? $seoData['desc_en'] : $seoData['desc_tr']);
        $og_image = $og_image ?? asset('foto.img/amalfi.jpg');
        $canonical = $canonical ?? route('journal');
        $hreflang_tr = $hreflang_tr ?? route('journal');
        $hreflang_en = $hreflang_en ?? route('journal');
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
            <li><a href="<?php echo e(route('etkinlikler')); ?>" data-i18n="nav_events">Etkinlikler</a></li>
            <li><a href="<?php echo e(route('journal')); ?>" class="active-page" data-i18n="nav_journal">Journal</a></li>
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

    <div class="page-hero" style="background-image:url('<?php echo e(asset('foto.img/amalfi.jpg')); ?>');">
        <div class="page-hero-content">
            <span class="page-eyebrow" data-i18n="journal_hero_eye">Hikayeler & İçgörüler</span>
            <h1 class="page-title" data-i18n="nav_journal">Dioreal <em>Journal</em></h1>
        </div>
    </div>

    <section class="content-section">
        <!-- Featured + Sidebar -->
        <div class="journal-grid reveal">
            <?php if($featured = $journals->first()): ?>
                <div class="journal-featured">
                    <a href="<?php echo e(route('journal.detay', $featured->slug_tr ?: ($featured->slug_en ?: $featured->id))); ?>">
                        <img src="<?php echo e(asset($featured->img)); ?>" alt="<?php echo e($featured->title['tr'] ?? ''); ?>" style="cursor: pointer;">
                    </a>
                    <div class="journal-featured-info">
                        <span class="card-tag">
                            <span class="lang-text-tr"><?php echo e($featured->tag['tr'] ?? ''); ?></span>
                            <span class="lang-text-en"><?php echo e($featured->tag['en'] ?? ''); ?></span>
                        </span>
                        <a href="<?php echo e(route('journal.detay', $featured->slug_tr ?: ($featured->slug_en ?: $featured->id))); ?>" style="text-decoration: none; color: inherit;">
                            <div class="journal-title" style="font-family: var(--font-display); font-size: 2rem; font-weight: 300; margin: 1rem 0;">
                                <span class="lang-text-tr"><?php echo e($featured->title['tr'] ?? ''); ?></span>
                                <span class="lang-text-en"><?php echo e($featured->title['en'] ?? ''); ?></span>
                            </div>
                        </a>
                        <p style="color:var(--dark-gray);font-size:.95rem;line-height:1.8;margin-bottom:1.5rem;">
                            <span class="lang-text-tr"><?php echo e($featured->desc['tr'] ?? ''); ?></span>
                            <span class="lang-text-en"><?php echo e($featured->desc['en'] ?? ''); ?></span>
                        </p>
                        <a href="<?php echo e(route('journal.detay', $featured->slug_tr ?: ($featured->slug_en ?: $featured->id))); ?>" class="btn btn-outline">
                            <span class="lang-text-tr">Okumaya Devam Et</span>
                            <span class="lang-text-en">Continue Reading</span>
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <div class="journal-side">
                <?php $__currentLoopData = $journals->slice(1, 4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sideItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="journal-side-item" onclick="window.location='<?php echo e(route('journal.detay', $sideItem->slug_tr ?: ($sideItem->slug_en ?: $sideItem->id))); ?>'" style="cursor:pointer;">
                        <img src="<?php echo e(asset($sideItem->img)); ?>" alt="<?php echo e($sideItem->title['tr'] ?? ''); ?>">
                        <div>
                            <span class="journal-date"><?php echo e($sideItem->date); ?></span>
                            <div class="journal-title">
                                <span class="lang-text-tr"><?php echo e($sideItem->title['tr'] ?? ''); ?></span>
                                <span class="lang-text-en"><?php echo e($sideItem->title['en'] ?? ''); ?></span>
                            </div>
                            <a href="<?php echo e(route('journal.detay', $sideItem->slug_tr ?: ($sideItem->slug_en ?: $sideItem->id))); ?>" class="journal-read-more">
                                <span class="lang-text-tr">Oku &rarr;</span>
                                <span class="lang-text-en">Read &rarr;</span>
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- More Articles -->
        <?php if($journals->count() > 5): ?>
            <h2 class="content-title reveal" style="margin-bottom:2.5rem;" data-i18n="journal_latest_title">Son <em>Yazılar</em></h2>
            <div class="card-grid">
                <?php $__currentLoopData = $journals->slice(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('journal.detay', $item->slug_tr ?: ($item->slug_en ?: $item->id))); ?>" class="card reveal" style="transition-delay:<?php echo e(($index % 3) * 0.1); ?>s; text-decoration: none; color: inherit; display: block;">
                        <div class="card-img" style="background-image:url('<?php echo e(asset($item->img)); ?>');"></div>
                        <div class="card-body">
                            <span class="card-tag">
                                <span class="lang-text-tr"><?php echo e($item->tag['tr'] ?? ''); ?> | <?php echo e($item->date); ?></span>
                                <span class="lang-text-en"><?php echo e($item->tag['en'] ?? ''); ?> | <?php echo e($item->date); ?></span>
                            </span>
                            <h3 class="card-title">
                                <span class="lang-text-tr"><?php echo e($item->title['tr'] ?? ''); ?></span>
                                <span class="lang-text-en"><?php echo e($item->title['en'] ?? ''); ?></span>
                            </h3>
                            <p class="card-desc">
                                <span class="lang-text-tr"><?php echo e($item->desc['tr'] ?? ''); ?></span>
                                <span class="lang-text-en"><?php echo e($item->desc['en'] ?? ''); ?></span>
                            </p>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </section>

    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <script src="<?php echo e(asset('js/i18n.js')); ?>?v=<?php echo e(time()); ?>"></script>
    <script src="<?php echo e(asset('js/common.js')); ?>?v=<?php echo e(time()); ?>"></script>
    <script src="<?php echo e(asset('js/nav.js')); ?>?v=<?php echo e(time()); ?>"></script>
</body>
</html>
<?php /**PATH C:\Users\ahmet\Desktop\dioreal web\resources\views\journal.blade.php ENDPATH**/ ?>