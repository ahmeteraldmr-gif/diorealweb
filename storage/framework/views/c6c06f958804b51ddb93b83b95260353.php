<!DOCTYPE html>
<html lang="<?php echo e(get_active_locale()); ?>">
<head>
    <!-- Favicon & Touch Icons for Google Search & Browsers -->
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('favicon.ico')); ?>">
    <link rel="icon" type="image/png" sizes="48x48" href="<?php echo e(asset('favicon-48x48.png')); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('favicon-32x32.png')); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('favicon-16x16.png')); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(asset('apple-touch-icon.png')); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="base-url" content="<?php echo e(url('/')); ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Jost:wght@200;300;400;500;600&family=Oswald:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/base.css')); ?>?v=2.5.0">
    <link rel="stylesheet" href="<?php echo e(asset('css/nav-footer.css')); ?>?v=2.5.0">
    <link rel="stylesheet" href="<?php echo e(asset('css/components.css')); ?>?v=2.5.0">
    <link rel="stylesheet" href="<?php echo e(asset('css/about.css')); ?>?v=2.5.0">
    <?php
        $locale = get_active_locale();
        $seoData = get_page_seo('gezi-rehberi');
        $seo_title = $seo_title ?? ($locale === 'en' ? $seoData['title_en'] : $seoData['title_tr']);
        $seo_desc = $seo_desc ?? ($locale === 'en' ? $seoData['desc_en'] : $seoData['desc_tr']);
        $og_image = $og_image ?? asset('foto.img/kapadokya.jpg');
        $canonical = $canonical ?? route('gezi-rehberi');
        $hreflang_tr = $hreflang_tr ?? route('gezi-rehberi');
        $hreflang_en = $hreflang_en ?? route('gezi-rehberi');
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
    <link rel="stylesheet" href="<?php echo e(asset('css/responsive.css')); ?>?v=2.5.0">
</head>
<body>
    <nav id="mainNav">
        <div class="nav-logo-wrapper">
            <a href="<?php echo e(route('home')); ?>" class="nav-logo">
                <span class="logo-text">DIOREAL</span>
            </a>
        </div>
        <ul class="nav-links">
            <li><a href="<?php echo e(route('hakkimizda')); ?>" data-i18n="nav_about"><span class="lang-text-tr">Hakkımızda</span><span class="lang-text-en">About</span></a></li>
            <li><a href="<?php echo e(route('oteller')); ?>" data-i18n="nav_hotels"><span class="lang-text-tr">Oteller</span><span class="lang-text-en">Hotels</span></a></li>
            <li><a href="<?php echo e(route('yatlar')); ?>" data-i18n="nav_yachts"><span class="lang-text-tr">Yatlar</span><span class="lang-text-en">Yachts</span></a></li>
            <li><a href="<?php echo e(route('restoranlar')); ?>" data-i18n="nav_restaurants"><span class="lang-text-tr">Restoranlar</span><span class="lang-text-en">Restaurants</span></a></li>
            <li><a href="<?php echo e(route('gezi-rehberi')); ?>" class="active-page" data-i18n="nav_guide"><span class="lang-text-tr">Gezi Rehberi</span><span class="lang-text-en">Travel Guide</span></a></li>
            <li><a href="<?php echo e(route('etkinlikler')); ?>" data-i18n="nav_events"><span class="lang-text-tr">Etkinlikler</span><span class="lang-text-en">Events</span></a></li>
            <li><a href="<?php echo e(route('journal')); ?>" data-i18n="nav_journal"><span class="lang-text-tr">Journal</span><span class="lang-text-en">Journal</span></a></li>
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
            <li><a href="<?php echo e(route('hakkimizda')); ?>" data-i18n="nav_about"><span class="lang-text-tr">Hakkımızda</span><span class="lang-text-en">About</span></a></li>
            <li><a href="<?php echo e(route('oteller')); ?>" data-i18n="nav_hotels"><span class="lang-text-tr">Oteller</span><span class="lang-text-en">Hotels</span></a></li>
            <li><a href="<?php echo e(route('yatlar')); ?>" data-i18n="nav_yachts"><span class="lang-text-tr">Yatlar</span><span class="lang-text-en">Yachts</span></a></li>
            <li><a href="<?php echo e(route('restoranlar')); ?>" data-i18n="nav_restaurants"><span class="lang-text-tr">Restoranlar</span><span class="lang-text-en">Restaurants</span></a></li>
            <div class="fs-divider"></div>
            <li><a href="<?php echo e(route('gezi-rehberi')); ?>" data-i18n="nav_guide"><span class="lang-text-tr">Gezi Rehberi</span><span class="lang-text-en">Travel Guide</span></a></li>
            <li><a href="<?php echo e(route('etkinlikler')); ?>" data-i18n="nav_events"><span class="lang-text-tr">Etkinlikler</span><span class="lang-text-en">Events</span></a></li>
            <li><a href="<?php echo e(route('journal')); ?>" data-i18n="nav_journal"><span class="lang-text-tr">Journal</span><span class="lang-text-en">Journal</span></a></li>
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
            <?php $__currentLoopData = $rehberler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $detailUrl = route('rehber.detay', $g->slug_tr ?: ($g->slug_en ?: $g->id));
                    $tagTr = !empty($g->tag["tr"]) ? $g->tag["tr"] : ($g->tag["en"] ?? "");
                    $tagEn = !empty($g->tag["en"]) ? $g->tag["en"] : ($g->tag["tr"] ?? "");
                    $titleTr = !empty($g->title["tr"]) ? $g->title["tr"] : ($g->title["en"] ?? "");
                    $titleEn = !empty($g->title["en"]) ? $g->title["en"] : ($g->title["tr"] ?? "");
                    $descRawTr = !empty($g->desc["tr"]) ? $g->desc["tr"] : ($g->desc["en"] ?? "");
                    $descRawEn = !empty($g->desc["en"]) ? $g->desc["en"] : ($g->desc["tr"] ?? "");
                    $shortTr = \Illuminate\Support\Str::words(strip_tags($descRawTr), 35, '...');
                    $shortEn = \Illuminate\Support\Str::words(strip_tags($descRawEn), 35, '...');
                ?>
                <div class="card reveal visible" style="display: flex; flex-direction: column;">
                    <a href="<?php echo e($detailUrl); ?>" style="display: block; overflow: hidden; text-decoration: none;">
                        <div class="card-img" style="background-image:url('<?php echo e(asset($g->img)); ?>');"></div>
                    </a>
                    <div class="card-body" style="display: flex; flex-direction: column; flex-grow: 1; padding: 2rem 1.5rem;">
                        <?php if($tagTr || $tagEn): ?>
                            <span class="card-tag lang-text-tr" style="margin-bottom: 0.5rem;"><?php echo e($tagTr); ?></span>
                            <span class="card-tag lang-text-en" style="margin-bottom: 0.5rem;"><?php echo e($tagEn); ?></span>
                        <?php endif; ?>
                        
                        <a href="<?php echo e($detailUrl); ?>" style="text-decoration: none; color: inherit;">
                            <h3 class="card-title lang-text-tr" style="font-size: 1.5rem; line-height: 1.3; margin-bottom: 0.75rem;"><?php echo e($titleTr); ?></h3>
                            <h3 class="card-title lang-text-en" style="font-size: 1.5rem; line-height: 1.3; margin-bottom: 0.75rem;"><?php echo e($titleEn); ?></h3>
                        </a>
                        
                        <div style="margin-bottom: 1.5rem; flex-grow: 1;">
                            <p class="card-desc lang-text-tr" style="color: var(--dark-gray); font-size: 0.9rem; line-height: 1.6; max-height: none; display: block;"><?php echo e($shortTr); ?></p>
                            <p class="card-desc lang-text-en" style="color: var(--dark-gray); font-size: 0.9rem; line-height: 1.6; max-height: none; display: block;"><?php echo e($shortEn); ?></p>
                        </div>
                        
                        <div class="card-btn-wrapper" style="margin-top: auto; padding-top: 0.5rem;">
                            <a href="<?php echo e($detailUrl); ?>" class="btn-guide-explore">
                                <span class="lang-text-tr">Rehberi İncele</span>
                                <span class="lang-text-en">View Guide</span>
                                <i class="fas fa-arrow-right" style="font-size: 0.75rem;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <?php if(method_exists($rehberler, 'hasPages') && $rehberler->hasPages()): ?>
            <div class="custom-pagination">
                
                <?php if($rehberler->onFirstPage()): ?>
                    <span class="pagination-btn disabled">&laquo; <span class="lang-text-tr">Önceki</span><span class="lang-text-en">Previous</span></span>
                <?php else: ?>
                    <a href="<?php echo e($rehberler->previousPageUrl()); ?>" class="pagination-btn">&laquo; <span class="lang-text-tr">Önceki</span><span class="lang-text-en">Previous</span></a>
                <?php endif; ?>

                
                <div class="pagination-numbers">
                    <?php $__currentLoopData = $rehberler->getUrlRange(1, $rehberler->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($page == $rehberler->currentPage()): ?>
                            <span class="pagination-number active"><?php echo e($page); ?></span>
                        <?php else: ?>
                            <a href="<?php echo e($url); ?>" class="pagination-number"><?php echo e($page); ?></a>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                
                <?php if($rehberler->hasMorePages()): ?>
                    <a href="<?php echo e($rehberler->nextPageUrl()); ?>" class="pagination-btn"><span class="lang-text-tr">Sonraki</span><span class="lang-text-en">Next</span> &raquo;</a>
                <?php else: ?>
                    <span class="pagination-btn disabled"><span class="lang-text-tr">Sonraki</span><span class="lang-text-en">Next</span> &raquo;</span>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </section>

    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <script src="<?php echo e(asset('js/i18n.js')); ?>?v=2.5.0"></script>
    <script src="<?php echo e(asset('js/common.js')); ?>?v=2.5.0"></script>
    <script src="<?php echo e(asset('js/nav.js')); ?>?v=2.5.0"></script>
</body>
</html>
<?php /**PATH C:\Users\ahmet\Desktop\dioreal web\resources\views/destinasyonlar.blade.php ENDPATH**/ ?>