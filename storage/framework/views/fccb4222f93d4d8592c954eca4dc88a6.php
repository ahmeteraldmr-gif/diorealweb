<?php
    $locale = get_active_locale();
    $seo_title = ($locale === 'en')
        ? ($journal->seo_title_en ?: ($journal->title['en'] ?? 'Detay') . ' - Dioreal')
        : ($journal->seo_title_tr ?: ($journal->title['tr'] ?? 'Detay') . ' - Dioreal');
    $seo_desc = ($locale === 'en')
        ? ($journal->seo_description_en ?: \Illuminate\Support\Str::limit(strip_tags($journal->desc['en'] ?? ''), 155))
        : ($journal->seo_description_tr ?: \Illuminate\Support\Str::limit(strip_tags($journal->desc['tr'] ?? ''), 155));
    $og_image = $journal->og_image ? asset($journal->og_image) : asset($journal->img);
    $canonical = $canonical ?? route('journal.detay', $journal->slug_tr ?: $journal->id);
    $noindex = $journal->seo_noindex;
    
    $hreflang_tr = $hreflang_tr ?? route('journal.detay', $journal->slug_tr ?: $journal->id);
    $hreflang_en = $hreflang_en ?? ($journal->slug_en ? route('journal.detay', $journal->slug_en) : null);
    $og_type = 'Article' == 'Article' ? 'article' : 'website';

    $schema_json = '<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Article",
      "name": "'.addslashes($journal->title['tr'] ?? '').'",
      "description": "'.addslashes($seo_desc).'",
      "image": "'.$og_image.'",
      "url": "'.$canonical.'"
    }
    </script>';
?>
<!DOCTYPE html>
<html lang="<?php echo e(get_active_locale()); ?>">
<head>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="base-url" content="<?php echo e(url('/')); ?>">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?php echo e($seo_title); ?></title>
    <meta name="description" content="<?php echo e($seo_desc); ?>">
    
    <link rel="canonical" href="<?php echo e($canonical); ?>">
    <?php if(isset($hreflang_tr)): ?> <link rel="alternate" hreflang="tr" href="<?php echo e($hreflang_tr); ?>" /> <?php endif; ?>
    <?php if(isset($hreflang_en)): ?> <link rel="alternate" hreflang="en" href="<?php echo e($hreflang_en); ?>" /> <?php endif; ?>
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
    <meta property="og:type" content="<?php echo e($og_type); ?>">
    <meta property="og:site_name" content="Dioreal">
    
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo e($seo_title); ?>">
    <meta name="twitter:description" content="<?php echo e($seo_desc); ?>">
    <meta name="twitter:image" content="<?php echo e($og_image); ?>">

    <?php if(isset($schema_json)): ?>
    <?php echo $schema_json; ?>

    <?php endif; ?>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Jost:wght@200;300;400;500;600&family=Oswald:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/base.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/nav-footer.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/components.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/about.css')); ?>?v=<?php echo e(time()); ?>">
    <style>
        /* ── JOURNAL DETAIL PAGE ── */
        .jd-hero {
            position: relative;
            height: 70vh;
            min-height: 480px;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: flex-end;
            overflow: hidden;
        }
        .jd-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(
                to bottom,
                rgba(13,12,11,0.1) 0%,
                rgba(13,12,11,0.6) 50%,
                rgba(13,12,11,0.95) 100%
            );
        }
        .jd-hero-content {
            position: relative;
            z-index: 2;
            padding: 4rem 8rem;
            color: var(--white);
            max-width: 900px;
        }
        .jd-eyebrow {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-family: var(--font-condensed);
            font-size: 0.75rem;
            letter-spacing: 0.25em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 1.5rem;
        }
        .jd-eyebrow span { color: rgba(255,255,255,0.4); }
        .jd-title {
            font-family: var(--font-display);
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 300;
            line-height: 1.15;
            color: var(--white);
            margin-bottom: 1.5rem;
        }
        .jd-meta {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            font-size: 0.8rem;
            letter-spacing: 0.1em;
            color: rgba(255,255,255,0.6);
        }
        .jd-meta i { margin-right: 0.4rem; color: var(--accent); }

        /* Article layout */
        .jd-body {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 5rem;
            max-width: 1200px;
            margin: 0 auto;
            padding: 6rem 4rem;
        }

        /* Article content */
        .jd-article {
            color: var(--dark-gray);
        }
        .jd-lead {
            font-family: var(--font-display);
            font-size: 1.4rem;
            font-weight: 300;
            line-height: 1.7;
            color: var(--near-black);
            margin-bottom: 3rem;
            padding-bottom: 3rem;
            border-bottom: 1px solid var(--light-gray);
        }
        .jd-content {
            font-size: 1.05rem;
            line-height: 2;
            color: var(--dark-gray);
        }
        .jd-content p {
            margin-bottom: 1.8rem;
        }
        .jd-content h2, .jd-content h3 {
            font-family: var(--font-display);
            color: var(--near-black);
            margin: 2.5rem 0 1rem;
            font-weight: 400;
        }
        .jd-content blockquote {
            border-left: 3px solid var(--accent);
            padding: 1rem 2rem;
            margin: 2rem 0;
            font-family: var(--font-display);
            font-size: 1.2rem;
            font-style: italic;
            color: var(--near-black);
            background: var(--off-white);
        }
        .jd-content img {
            width: 100%;
            height: auto;
            margin: 2rem 0;
        }

        /* Sidebar */
        .jd-sidebar { }

        .jd-back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 0.75rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--mid-gray);
            text-decoration: none;
            transition: color 0.3s;
            margin-bottom: 3rem;
        }
        .jd-back-btn:hover { color: var(--near-black); }

        .jd-sidebar-title {
            font-family: var(--font-condensed);
            font-size: 0.8rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--mid-gray);
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--light-gray);
        }

        .jd-related-item {
            display: grid;
            grid-template-columns: 90px 1fr;
            gap: 1.2rem;
            align-items: center;
            cursor: pointer;
            padding: 1.2rem 0;
            border-bottom: 1px solid var(--light-gray);
            text-decoration: none;
            transition: opacity 0.3s;
        }
        .jd-related-item:hover { opacity: 0.7; }
        .jd-related-item img {
            width: 100%;
            aspect-ratio: 4/3;
            object-fit: cover;
        }
        .jd-related-date {
            font-size: 0.65rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--mid-gray);
            display: block;
            margin-bottom: 0.4rem;
        }
        .jd-related-name {
            font-family: var(--font-display);
            font-size: 1rem;
            color: var(--near-black);
            line-height: 1.3;
        }

        .jd-share {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid var(--light-gray);
        }
        .jd-share-label {
            font-size: 0.75rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            color: var(--mid-gray);
            display: block;
            margin-bottom: 1rem;
        }
        .jd-share-btns {
            display: flex;
            gap: 0.8rem;
        }
        .jd-share-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            border: 1px solid var(--light-gray);
            font-size: 0.75rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s;
            background: none;
            color: var(--dark-gray);
            text-decoration: none;
        }
        .jd-share-btn:hover {
            background: var(--near-black);
            color: var(--white);
            border-color: var(--near-black);
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .jd-body { grid-template-columns: 1fr; gap: 3rem; padding: 4rem 2rem; }
            .jd-hero-content { padding: 3rem 2rem; }
            .jd-title { font-size: 2.2rem; }
        }
    </style>
    <?php
        $seo_title = $seo_title ?? 'Dioreal Dijital - Global Deneyim & Medya Platformu';
        $seo_desc = $seo_desc ?? 'Türkiye ve dünyada seçkin deneyimlerin kapısını aralıyoruz. Lüks oteller, yatlar ve yaşam tarzı markaları için yeni nesil medya platformu.';
        $og_image = $og_image ?? asset('foto.img/hero_4k.jpg');
        $canonical = $canonical ?? url()->current();
        $noindex = $noindex ?? false;
    ?>

    <title><?php echo e($seo_title); ?></title>
    <meta name="description" content="<?php echo e($seo_desc); ?>">
    
    <link rel="canonical" href="<?php echo e($canonical); ?>">
    <?php if(isset($hreflang_tr)): ?> <link rel="alternate" hreflang="tr" href="<?php echo e($hreflang_tr); ?>" /> <?php endif; ?>
    <?php if(isset($hreflang_en)): ?> <link rel="alternate" hreflang="en" href="<?php echo e($hreflang_en); ?>" /> <?php endif; ?>
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
            <li><a href="<?php echo e(route('gezi-rehberi')); ?>" data-i18n="nav_guide">Destinasyonlar</a></li>
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
            <li><a href="<?php echo e(route('gezi-rehberi')); ?>" data-i18n="nav_guide">Destinasyonlar</a></li>
            <li><a href="<?php echo e(route('etkinlikler')); ?>" data-i18n="nav_events">Etkinlikler</a></li>
            <li><a href="<?php echo e(route('journal')); ?>" data-i18n="nav_journal">Journal</a></li>
            <li style="font-size:1.5rem;font-family:var(--font-display);margin-top:2rem;"><span id="lang-tr-fs" class="lang-btn active">TR</span> | <span id="lang-en-fs" class="lang-btn">EN</span></li>
        </ul>
    </div>

    <!-- Hero Banner -->
    <?php
        $showVideoCover = !empty($journal->show_video_on_cover) && (!empty($journal->video_file) || !empty($journal->video_url));
        $journalImg = !empty($journal->img) ? $journal->img : 'foto.img/etkinlik_hero.jpg';
        $journalImgUrl = str_starts_with($journalImg, 'data:') || str_starts_with($journalImg, 'http') ? $journalImg : asset($journalImg);
    ?>
    <div class="jd-hero" style="<?php if(!$showVideoCover): ?> background-image: url('<?php echo e($journalImgUrl); ?>'); <?php endif; ?>">
        <?php if($showVideoCover): ?>
            <div class="hero-video-container" style="position: absolute; inset: 0; width: 100%; height: 100%; overflow: hidden; z-index: 0;">
                <?php if(!empty($journal->video_file)): ?>
                    <video src="<?php echo e(asset($journal->video_file)); ?>" autoplay loop muted playsinline style="width: 100%; height: 100%; object-fit: cover;"></video>
                <?php elseif(!empty($journal->video_url)): ?>
                    <?php
                        $embedUrl = $journal->video_url;
                        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $journal->video_url, $matches)) {
                            $embedUrl = 'https://www.youtube.com/embed/' . $matches[1] . '?autoplay=1&mute=1&loop=1&playlist=' . $matches[1] . '&controls=0&showinfo=0&rel=0&iv_load_policy=3&playsinline=1';
                        }
                    ?>
                    <iframe src="<?php echo e($embedUrl); ?>" frameborder="0" allow="autoplay; encrypted-media" style="position: absolute; top: 50%; left: 50%; width: 100vw; height: 56.25vw; min-width: 100%; min-height: 100%; transform: translate(-50%, -50%); pointer-events: none; object-fit: cover;"></iframe>
                <?php endif; ?>
                <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.5); z-index: 1;"></div>
            </div>
        <?php endif; ?>
        <div class="jd-hero-content" style="position: relative; z-index: 2;">
            <div class="jd-eyebrow">
                <span class="lang-text-tr"><?php echo e($journal->tag['tr'] ?? 'Journal'); ?></span>
                <span class="lang-text-en"><?php echo e($journal->tag['en'] ?? 'Journal'); ?></span>
                <span>|</span>
                <?php echo e($journal->date); ?>

                <?php if($journal->read_time): ?>
                    <span>|</span>
                    <span class="lang-text-tr"><?php echo e($journal->read_time); ?> dk okuma</span>
                    <span class="lang-text-en"><?php echo e($journal->read_time); ?> min read</span>
                <?php endif; ?>
            </div>
            <h1 class="jd-title">
                <span class="lang-text-tr"><?php echo e($journal->title['tr'] ?? ''); ?></span>
                <span class="lang-text-en"><?php echo e($journal->title['en'] ?? ''); ?></span>
            </h1>
        </div>
    </div>

    <!-- Article Body -->
    <div class="jd-body">
        <!-- Main Article Content -->
        <article class="jd-article">
            <!-- Lead / Summary -->
            <div class="jd-lead">
                <span class="lang-text-tr"><?php echo e($journal->desc['tr'] ?? ''); ?></span>
                <span class="lang-text-en"><?php echo e($journal->desc['en'] ?? ''); ?></span>
            </div>

            <!-- Full Content -->
            <?php if($journal->content && (($journal->content['tr'] ?? '') || ($journal->content['en'] ?? ''))): ?>
                <div class="jd-content">
                    <div class="lang-text-tr"><?php echo $journal->content['tr'] ?? ''; ?></div>
                    <div class="lang-text-en"><?php echo $journal->content['en'] ?? ''; ?></div>
                </div>
            <?php else: ?>
                <div class="jd-content" style="color: var(--mid-gray); text-align: center; padding: 4rem 0;">
                    <i class="fas fa-pen-nib" style="font-size: 2rem; display: block; margin-bottom: 1rem;"></i>
                    <span class="lang-text-tr">Bu yazının tam içeriği henüz eklenmemiş.</span>
                    <span class="lang-text-en">The full content for this article has not been added yet.</span>
                </div>
            <?php endif; ?>
        </article>

        <!-- Sidebar -->
        <aside class="jd-sidebar">
            <a href="<?php echo e(route('journal')); ?>" class="jd-back-btn">
                ← <span class="lang-text-tr">Journal'a Dön</span>
                <span class="lang-text-en">Back to Journal</span>
            </a>

            <?php if($related->count() > 0): ?>
                <div class="jd-sidebar-title">
                    <span class="lang-text-tr">Son Yazılar</span>
                    <span class="lang-text-en">Recent Articles</span>
                </div>

                <?php $__currentLoopData = $related; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('journal.detay', $item->slug_tr ?: ($item->slug_en ?: $item->id))); ?>" class="jd-related-item">
                        <img src="<?php echo e(asset($item->img)); ?>" alt="<?php echo e($item->title['tr'] ?? ''); ?>">
                        <div>
                            <span class="jd-related-date"><?php echo e($item->date); ?></span>
                            <div class="jd-related-name">
                                <span class="lang-text-tr"><?php echo e($item->title['tr'] ?? ''); ?></span>
                                <span class="lang-text-en"><?php echo e($item->title['en'] ?? ''); ?></span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>

            <!-- Share -->
            <div class="jd-share">
                <span class="jd-share-label">
                    <span class="lang-text-tr">Paylaş</span>
                    <span class="lang-text-en">Share</span>
                </span>
                <div class="jd-share-btns">
                    <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode(url()->current())); ?>&text=<?php echo e(urlencode($journal->title['tr'] ?? '')); ?>"
                       target="_blank" class="jd-share-btn">
                        <i class="fab fa-x-twitter"></i> X
                    </a>
                    <a href="https://wa.me/?text=<?php echo e(urlencode(($journal->title['tr'] ?? '') . ' ' . url()->current())); ?>"
                       target="_blank" class="jd-share-btn">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                </div>
            </div>
        </aside>
    </div>

    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="<?php echo e(asset('js/i18n.js')); ?>?v=<?php echo e(time()); ?>"></script>
    <script src="<?php echo e(asset('js/common.js')); ?>?v=<?php echo e(time()); ?>"></script>
    <script src="<?php echo e(asset('js/nav.js')); ?>?v=<?php echo e(time()); ?>"></script>
</body>
</html>
<?php /**PATH C:\Users\ahmet\Desktop\dioreal web\resources\views\journal-detay.blade.php ENDPATH**/ ?>