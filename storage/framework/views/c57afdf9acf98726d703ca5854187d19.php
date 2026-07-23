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
            <li><a href="<?php echo e(route('gezi-rehberi')); ?>" class="active-page" data-i18n="nav_guide">Gezi Rehberi</a></li>
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

    <div class="page-hero" style="background-image:url('foto.img/kapadokya.jpg');">
        <div class="page-hero-content">
            <span class="page-eyebrow" data-i18n="guide_hero_eye">Keşfet & Öğren</span>
            <h1 class="page-title" data-i18n="nav_guide">Destinasyon<em>lar</em></h1>
        </div>
    </div>

    <style>
        .card-desc-container {
            max-height: 4.8em; /* Roughly 3 lines of text */
            overflow: hidden;
            transition: max-height 0.4s ease;
            position: relative;
        }
        .card-desc-container.expanded {
            max-height: 1000px;
        }
        .read-more-btn {
            background: none;
            border: none;
            color: var(--accent, #c8a96e);
            font-family: var(--font-body, 'Jost', sans-serif);
            font-size: 0.8rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            margin-top: 0.5rem;
            padding: 0;
            text-decoration: underline;
            transition: color 0.2s;
        }
        .read-more-btn:hover {
            color: var(--near-black, #1a1816);
        }
    </style>
    <section class="content-section">
        <div style="text-align:center;max-width:700px;margin:0 auto 5rem;" class="reveal">
            <span class="content-eyebrow" style="display:block;" data-i18n="guide_exp_eye">Uzman Tavsiyeleri</span>
            <h2 class="content-title" data-i18n="guide_exp_title">Doğru kararları <em>kolayca</em> verin</h2>
            <p class="content-body" data-i18n="guide_exp_p1">Deneyimli seyahat editörlerimizin hazırladığı destinasyon rehberleri, pratik ipuçları ve sezonluk önerilerle seyahat planlamanızı kolaylaştırıyoruz.</p>
        </div>
        <div class="card-grid">
            <?php $__currentLoopData = $rehberler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card reveal visible">
                    <div class="card-img" style="background-image:url('<?php echo e(asset($g->img)); ?>');"></div>
                    <div class="card-body">
                        <span class="card-tag lang-text-tr"><?php echo e($g->tag["tr"] ?? ""); ?></span>
                        <span class="card-tag lang-text-en"><?php echo e($g->tag["en"] ?? ""); ?></span>
                        
                        <h3 class="card-title lang-text-tr"><?php echo e($g->title["tr"] ?? ""); ?></h3>
                        <h3 class="card-title lang-text-en"><?php echo e($g->title["en"] ?? ""); ?></h3>
                        
                        <div class="card-desc-container">
                            <p class="card-desc lang-text-tr"><?php echo e($g->desc["tr"] ?? ""); ?></p>
                            <p class="card-desc lang-text-en"><?php echo e($g->desc["en"] ?? ""); ?></p>
                        </div>
                        <div class="card-btn-wrapper" style="margin-top: 1.25rem;">
                            <a href="<?php echo e(route('rehber.detay', $g->slug_tr ?: ($g->slug_en ?: $g->id))); ?>" class="read-more-btn" style="text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
                                <span class="lang-text-tr">Detayları İncele</span>
                                <span class="lang-text-en">View Details</span>
                                <i class="fas fa-chevron-right" style="font-size: 0.75rem;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>

    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <script>
        function toggleReadMore(button) {
            const container = button.previousElementSibling;
            if (container.classList.contains('expanded')) {
                container.classList.remove('expanded');
                button.querySelector('.lang-text-tr').textContent = 'Devamını Oku';
                button.querySelector('.lang-text-en').textContent = 'Read More';
            } else {
                container.classList.add('expanded');
                button.querySelector('.lang-text-tr').textContent = 'Kapat';
                button.querySelector('.lang-text-en').textContent = 'Read Less';
            }
        }
    </script>
    <script src="<?php echo e(asset('js/i18n.js')); ?>?v=<?php echo e(time()); ?>"></script>
    <script src="<?php echo e(asset('js/common.js')); ?>?v=<?php echo e(time()); ?>"></script>
    <script src="<?php echo e(asset('js/nav.js')); ?>?v=<?php echo e(time()); ?>"></script>
</body>
</html>
<?php /**PATH C:\Users\ahmet\Desktop\dioreal web\resources\views\destinasyonlar.blade.php ENDPATH**/ ?>