<?php
    $locale = get_active_locale();
    $seo_title = ($locale === 'en')
        ? ($destination->seo_title_en ?: ($destination->name['en'] ?? 'Detay') . ' - Dioreal')
        : ($destination->seo_title_tr ?: ($destination->name['tr'] ?? 'Detay') . ' - Dioreal');
    $seo_desc = ($locale === 'en')
        ? ($destination->seo_description_en ?: \Illuminate\Support\Str::limit(strip_tags($destination->desc['en'] ?? ''), 155))
        : ($destination->seo_description_tr ?: \Illuminate\Support\Str::limit(strip_tags($destination->desc['tr'] ?? ''), 155));
    $og_image = $destination->og_image ? asset($destination->og_image) : asset($destination->img);
    $canonical = $canonical ?? route('destinasyon.detay', $destination->slug_tr ?: $destination->id);
    $noindex = $destination->seo_noindex;
    
    $hreflang_tr = $hreflang_tr ?? route('destinasyon.detay', $destination->slug_tr ?: $destination->id);
    $hreflang_en = $hreflang_en ?? ($destination->slug_en ? route('destinasyon.detay', $destination->slug_en) : null);
    $og_type = 'Place' == 'Article' ? 'article' : 'website';

    $schema_json = '<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Place",
      "name": "'.addslashes($destination->name['tr'] ?? '').'",
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/base.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/nav-footer.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/components.css')); ?>?v=<?php echo e(time()); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/about.css')); ?>?v=<?php echo e(time()); ?>">
    <style>
        body {
            background-color: var(--off-white);
            color: var(--dark-gray);
        }
        .page-hero {
            position: relative;
            height: 70vh;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: var(--white);
            overflow: hidden;
        }
        .page-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.3));
            z-index: 1;
        }
        .page-hero-content {
            position: relative;
            z-index: 2;
            padding: 2rem;
            max-width: 900px;
        }
        .page-eyebrow {
            font-family: var(--font-condensed);
            font-size: 0.9rem;
            letter-spacing: 0.3em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 1.5rem;
            display: block;
        }
        .page-title {
            font-family: var(--font-display);
            font-size: clamp(3.2rem, 7vw, 5rem);
            line-height: 1.1;
            font-weight: 300;
            text-shadow: 0 4px 20px rgba(0,0,0,0.3);
        }
        .dest-intro {
            max-width: 900px;
            margin: 6rem auto 4rem;
            text-align: center;
            padding: 0 2rem;
        }
        .dest-intro-desc {
            font-family: var(--font-display);
            font-size: 2rem;
            line-height: 1.6;
            color: var(--near-black);
            font-weight: 300;
        }
        .dest-section-title {
            font-family: var(--font-display);
            font-size: 2.8rem;
            color: var(--near-black);
            margin-bottom: 2.5rem;
            text-align: center;
            font-weight: 400;
        }
        .dest-section-title em {
            font-style: italic;
            font-weight: 300;
            color: var(--accent);
        }
        .dest-section {
            padding: 5rem 0;
        }
        .dest-section.alt {
            background-color: var(--light-gray);
        }
        /* Square grid layout for country gallery */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr);
            gap: 1.5rem;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        .gallery-img-wrapper {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            aspect-ratio: 1/1;
            box-shadow: 0 15px 35px rgba(29, 27, 26, 0.06);
            transition: transform 0.4s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.4s ease;
            cursor: pointer;
        }
        .gallery-img-wrapper:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(29, 27, 26, 0.12);
        }
        .gallery-img-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        .gallery-img-wrapper:hover img {
            transform: scale(1.05);
        }
        .inner-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
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

    <!-- Desktop Nav -->
    <nav id="mainNav">
        <div class="nav-logo-wrapper">
            <a href="<?php echo e(url('/')); ?>" class="nav-logo">
                <span class="logo-text">DIOREAL</span>
            </a>
        </div>
        <ul class="nav-links">
            <li><a href="<?php echo e(url('/hakkimizda')); ?>" data-i18n="nav_about">Hakkımızda</a></li>
            <li><a href="<?php echo e(url('/oteller')); ?>" data-i18n="nav_hotels">Oteller</a></li>
            <li><a href="<?php echo e(url('/yatlar')); ?>" data-i18n="nav_yachts">Yatlar</a></li>
            <li><a href="<?php echo e(url('/restoranlar')); ?>" data-i18n="nav_restaurants">Restoranlar</a></li>
            <li><a href="<?php echo e(url('/destinasyonlar')); ?>" data-i18n="nav_guide">Destinasyonlar</a></li>
            <li><a href="<?php echo e(url('/etkinlikler')); ?>" data-i18n="nav_events">Etkinlikler</a></li>
            <li><a href="<?php echo e(url('/journal')); ?>" data-i18n="nav_journal">Journal</a></li>
        </ul>
        <div class="nav-right">
            <div class="lang-switch desk-lang">
                <span id="lang-tr" class="lang-btn">TR</span>
                <span>|</span>
                <span id="lang-en" class="lang-btn">EN</span>
            </div>
            <div class="hamburger" id="hamb">
                <span></span><span></span><span></span>
            </div>
        </div>
    </nav>

    <!-- Fullscreen Menu -->
    <div class="fs-menu" id="fsMenu">
        <ul class="fs-links">
            <li><a href="<?php echo e(url('/hakkimizda')); ?>" data-i18n="nav_about">Hakkımızda</a></li>
            <li><a href="<?php echo e(url('/oteller')); ?>" data-i18n="nav_hotels">Oteller</a></li>
            <li><a href="<?php echo e(url('/yatlar')); ?>" data-i18n="nav_yachts">Yatlar</a></li>
            <li><a href="<?php echo e(url('/restoranlar')); ?>" data-i18n="nav_restaurants">Restoranlar</a></li>
            <div class="fs-divider"></div>
            <li><a href="<?php echo e(url('/destinasyonlar')); ?>" data-i18n="nav_guide">Destinasyonlar</a></li>
            <li><a href="<?php echo e(url('/etkinlikler')); ?>" data-i18n="nav_events">Etkinlikler</a></li>
            <li><a href="<?php echo e(url('/journal')); ?>" data-i18n="nav_journal">Journal</a></li>
            <li class="lang-switch" style="font-size: 1.5rem; font-family: var(--font-display); justify-content: center; margin-top:3rem;">
                <span id="lang-tr-fs" class="lang-btn">TR</span> | <span id="lang-en-fs" class="lang-btn">EN</span>
            </li>
        </ul>
    </div>

    <!-- Page Hero -->
    <?php
        $showVideoCover = !empty($destination->show_video_on_cover) && (!empty($destination->video_file) || !empty($destination->video_url));
        $destImg = !empty($destination->img) ? $destination->img : 'foto.img/etkinlik_hero.jpg';
        $destImgUrl = str_starts_with($destImg, 'data:') || str_starts_with($destImg, 'http') ? $destImg : asset($destImg);
    ?>
    <div class="page-hero" style="<?php if(!$showVideoCover): ?> background-image: url('<?php echo e($destImgUrl); ?>'); <?php endif; ?>">
        <?php if($showVideoCover): ?>
            <div class="hero-video-container" style="position: absolute; inset: 0; width: 100%; height: 100%; overflow: hidden; z-index: 0;">
                <?php if(!empty($destination->video_file)): ?>
                    <video src="<?php echo e(asset($destination->video_file)); ?>" autoplay loop muted playsinline style="width: 100%; height: 100%; object-fit: cover;"></video>
                <?php elseif(!empty($destination->video_url)): ?>
                    <?php
                        $embedUrl = $destination->video_url;
                        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $destination->video_url, $matches)) {
                            $embedUrl = 'https://www.youtube.com/embed/' . $matches[1] . '?autoplay=1&mute=1&loop=1&playlist=' . $matches[1] . '&controls=0&showinfo=0&rel=0&iv_load_policy=3&playsinline=1';
                        }
                    ?>
                    <iframe src="<?php echo e($embedUrl); ?>" frameborder="0" allow="autoplay; encrypted-media" style="position: absolute; top: 50%; left: 50%; width: 100vw; height: 56.25vw; min-width: 100%; min-height: 100%; transform: translate(-50%, -50%); pointer-events: none; object-fit: cover;"></iframe>
                <?php endif; ?>
                <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.5); z-index: 1;"></div>
            </div>
        <?php endif; ?>
        <div class="page-hero-content" style="position: relative; z-index: 2;">
            <span class="page-eyebrow lang-text-tr"><?php echo e($destination->region['tr'] ?? ''); ?></span>
            <span class="page-eyebrow lang-text-en"><?php echo e($destination->region['en'] ?? ''); ?></span>
            <h1 class="page-title lang-text-tr"><?php echo e($destination->name['tr'] ?? ''); ?></h1>
            <h1 class="page-title lang-text-en"><?php echo e($destination->name['en'] ?? ''); ?></h1>
        </div>
    </div>

    <!-- Description Introduction -->
    <?php if(!empty($destination->desc['tr']) || !empty($destination->desc['en'])): ?>
        <section class="dest-intro">
            <div class="dest-intro-desc lang-text-tr">
                <?php echo nl2br(e($destination->desc['tr'] ?? '')); ?>

            </div>
            <div class="dest-intro-desc lang-text-en">
                <?php echo nl2br(e($destination->desc['en'] ?? '')); ?>

            </div>
        </section>
    <?php endif; ?>

    <!-- Videos Section -->
    <?php if(!empty($destination->video_file) || !empty($destination->video_url)): ?>
        <section class="dest-section reveal">
            <h2 class="dest-section-title">Tanıtım <em>Videosu</em></h2>
            <div class="inner-container">
                <div class="video-container" style="position: relative; border-radius: 16px; overflow: hidden; box-shadow: 0 20px 50px rgba(0,0,0,0.15); background: #000; aspect-ratio: 16/9; max-width: 900px; margin: 0 auto;">
                    <?php if(!empty($destination->video_file)): ?>
                        <video src="<?php echo e(asset($destination->video_file)); ?>" controls style="width: 100%; height: 100%; object-fit: cover;"></video>
                    <?php elseif(!empty($destination->video_url)): ?>
                        <?php
                            $embedUrl = $destination->video_url;
                            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $destination->video_url, $matches)) {
                                $embedUrl = 'https://www.youtube.com/embed/' . $matches[1];
                            }
                        ?>
                        <iframe src="<?php echo e($embedUrl); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="position: absolute; top:0; left:0; width:100%; height:100%; border:none;"></iframe>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Hotels Section -->
    <?php if(count($hotels) > 0): ?>
        <section class="dest-section alt">
            <h2 class="dest-section-title">Lüks <em>Oteller</em></h2>
            <div class="inner-container">
                <div class="card-grid">
                    <?php $__currentLoopData = $hotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $otel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="card reveal visible">
                            <div class="card-img" style="position: relative; overflow: hidden; background-image: none;">
                                <?php if($otel->show_video_on_cover && (!empty($otel->video_file) || !empty($otel->video_url))): ?>
                                    <?php if(!empty($otel->video_file)): ?>
                                        <video autoplay muted loop playsinline style="width: 100%; height: 100%; object-fit: cover; position: absolute; inset: 0;">
                                            <source src="<?php echo e(asset($otel->video_file)); ?>" type="video/mp4">
                                        </video>
                                    <?php elseif(!empty($otel->video_url)): ?>
                                        <?php
                                            $embedUrl = $otel->video_url;
                                            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $otel->video_url, $matches)) {
                                                $embedUrl = 'https://www.youtube.com/embed/' . $matches[1] . '?autoplay=1&mute=1&loop=1&playlist=' . $matches[1] . '&controls=0&showinfo=0&rel=0&modestbranding=1&iv_load_policy=3';
                                            }
                                        ?>
                                        <iframe src="<?php echo e($embedUrl); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" style="width: 100%; height: 100%; object-fit: cover; pointer-events: none; transform: scale(1.35); position: absolute; inset: 0; border: none;"></iframe>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <div style="background-image:url('<?php echo e(asset($otel->img)); ?>'); width: 100%; height: 100%; background-size: cover; background-position: center; position: absolute; inset: 0;"></div>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <span class="card-tag lang-text-tr"><?php echo e($otel->tag["tr"] ?? ""); ?></span>
                                <span class="card-tag lang-text-en"><?php echo e($otel->tag["en"] ?? ""); ?></span>
                                
                                <h3 class="card-title lang-text-tr"><?php echo e($otel->name["tr"] ?? ""); ?></h3>
                                <h3 class="card-title lang-text-en"><?php echo e($otel->name["en"] ?? ""); ?></h3>
                                
                                <p class="card-desc lang-text-tr"><?php echo e($otel->desc["tr"] ?? ""); ?></p>
                                <p class="card-desc lang-text-en"><?php echo e($otel->desc["en"] ?? ""); ?></p>
                                
                                <a href="<?php echo e(route('otel.detay', $otel->slug_tr ?? $otel->slug_en ?? $otel->id)); ?>" class="btn btn-primary" style="margin-top:1rem; padding: 0.5rem 1rem;">
                                    <span class="lang-text-tr">Detayları İncele</span>
                                    <span class="lang-text-en">View Details</span>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Restaurants Section -->
    <?php if(count($restaurants) > 0): ?>
        <section class="dest-section">
            <h2 class="dest-section-title">Seçkin <em>Restoranlar</em></h2>
            <div class="inner-container">
                <div class="card-grid">
                    <?php $__currentLoopData = $restaurants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $restoran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="card reveal visible">
                            <div class="card-img" style="position: relative; overflow: hidden; background-image: none;">
                                <?php if($restoran->show_video_on_cover && (!empty($restoran->video_file) || !empty($restoran->video_url))): ?>
                                    <?php if(!empty($restoran->video_file)): ?>
                                        <video autoplay muted loop playsinline style="width: 100%; height: 100%; object-fit: cover; position: absolute; inset: 0;">
                                            <source src="<?php echo e(asset($restoran->video_file)); ?>" type="video/mp4">
                                        </video>
                                    <?php elseif(!empty($restoran->video_url)): ?>
                                        <?php
                                            $embedUrl = $restoran->video_url;
                                            if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $restoran->video_url, $matches)) {
                                                $embedUrl = 'https://www.youtube.com/embed/' . $matches[1] . '?autoplay=1&mute=1&loop=1&playlist=' . $matches[1] . '&controls=0&showinfo=0&rel=0&modestbranding=1&iv_load_policy=3';
                                            }
                                        ?>
                                        <iframe src="<?php echo e($embedUrl); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" style="width: 100%; height: 100%; object-fit: cover; pointer-events: none; transform: scale(1.35); position: absolute; inset: 0; border: none;"></iframe>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <div style="background-image:url('<?php echo e(asset($restoran->img)); ?>'); width: 100%; height: 100%; background-size: cover; background-position: center; position: absolute; inset: 0;"></div>
                                <?php endif; ?>
                            </div>
                            <div class="card-body">
                                <span class="card-tag lang-text-tr"><?php echo e($restoran->tag["tr"] ?? ""); ?></span>
                                <span class="card-tag lang-text-en"><?php echo e($restoran->tag["en"] ?? ""); ?></span>
                                
                                <h3 class="card-title lang-text-tr"><?php echo e($restoran->name["tr"] ?? ""); ?></h3>
                                <h3 class="card-title lang-text-en"><?php echo e($restoran->name["en"] ?? ""); ?></h3>
                                
                                <p class="card-desc lang-text-tr"><?php echo e($restoran->desc["tr"] ?? ""); ?></p>
                                <p class="card-desc lang-text-en"><?php echo e($restoran->desc["en"] ?? ""); ?></p>
                                
                                <a href="<?php echo e(route('restoran.detay', $restoran->slug_tr ?? $restoran->slug_en ?? $restoran->id)); ?>" class="btn btn-primary" style="margin-top:1rem; padding: 0.5rem 1rem;">
                                    <span class="lang-text-tr">Detayları İncele</span>
                                    <span class="lang-text-en">View Details</span>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Journal Section -->
    <?php if(count($journals) > 0): ?>
        <section class="dest-section alt">
            <h2 class="dest-section-title">İlgili <em>Yazılar & Blog</em></h2>
            <div class="inner-container">
                <div class="card-grid">
                    <?php $__currentLoopData = $journals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $journal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="card reveal visible">
                            <div class="card-img" style="background-image:url('<?php echo e(asset($journal->img)); ?>')"></div>
                            <div class="card-body">
                                <span class="card-tag"><?php echo e($journal->tag["tr"] ?? ""); ?></span>
                                
                                <h3 class="card-title lang-text-tr"><?php echo e($journal->title["tr"] ?? ""); ?></h3>
                                <h3 class="card-title lang-text-en"><?php echo e($journal->title["en"] ?? ""); ?></h3>
                                
                                <p class="card-desc lang-text-tr"><?php echo e($journal->desc["tr"] ?? ""); ?></p>
                                <p class="card-desc lang-text-en"><?php echo e($journal->desc["en"] ?? ""); ?></p>
                                
                                <a href="<?php echo e(route('journal.detay', $journal->slug_tr ?? $journal->slug_en ?? $journal->id)); ?>" class="btn btn-primary" style="margin-top:1rem; padding: 0.5rem 1rem;">
                                    <span class="lang-text-tr">Okumaya Başla</span>
                                    <span class="lang-text-en">Read More</span>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <!-- Gallery Section -->
    <?php if(!empty($destination->gallery) && is_array($destination->gallery)): ?>
        <section class="dest-section reveal">
            <h2 class="dest-section-title">Fotoğraf <em>Galerisi</em></h2>
            <div class="gallery-grid">
                <?php $__currentLoopData = $destination->gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="gallery-img-wrapper">
                        <img src="<?php echo e(str_starts_with($g, 'data:') || str_starts_with($g, 'http') ? $g : asset($g)); ?>" alt="Galeri Görseli">
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>
    <?php endif; ?>

    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/i18n.js')); ?>?v=<?php echo e(time()); ?>"></script>
    <script src="<?php echo e(asset('js/common.js')); ?>?v=<?php echo e(time()); ?>"></script>
    <script src="<?php echo e(asset('js/nav.js')); ?>?v=<?php echo e(time()); ?>"></script>
</body>
</html>

<?php /**PATH C:\Users\ahmet\Desktop\dioreal web\resources\views\destinasyon-detay.blade.php ENDPATH**/ ?>