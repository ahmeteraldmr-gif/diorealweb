<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">
    
    <!-- Static Pages -->
    <?php
        $staticRoutes = [
            'home' => ['freq' => 'daily', 'prio' => '1.0'],
            'hakkimizda' => ['freq' => 'weekly', 'prio' => '0.8'],
            'oteller' => ['freq' => 'daily', 'prio' => '0.9'],
            'yatlar' => ['freq' => 'daily', 'prio' => '0.9'],
            'restoranlar' => ['freq' => 'daily', 'prio' => '0.9'],
            'gezi-rehberi' => ['freq' => 'daily', 'prio' => '0.9'],
            'etkinlikler' => ['freq' => 'daily', 'prio' => '0.9'],
            'journal' => ['freq' => 'daily', 'prio' => '0.9'],
        ];
    ?>

    <?php $__currentLoopData = $staticRoutes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $routeName => $meta): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <url>
        <loc><?php echo e(route($routeName)); ?></loc>
        <xhtml:link rel="alternate" hreflang="tr" href="<?php echo e(route($routeName, ['lang' => 'tr'])); ?>"/>
        <xhtml:link rel="alternate" hreflang="en" href="<?php echo e(route($routeName, ['lang' => 'en'])); ?>"/>
        <xhtml:link rel="alternate" hreflang="x-default" href="<?php echo e(route($routeName)); ?>"/>
        <changefreq><?php echo e($meta['freq']); ?></changefreq>
        <priority><?php echo e($meta['prio']); ?></priority>
    </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <!-- Dynamic Content -->
    <?php $__currentLoopData = $hotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $slugTr = $hotel->slug_tr ?: $hotel->id;
        $slugEn = $hotel->slug_en ?: $slugTr;
    ?>
    <url>
        <loc><?php echo e(route('otel.detay', $slugTr)); ?></loc>
        <xhtml:link rel="alternate" hreflang="tr" href="<?php echo e(route('otel.detay', ['slug_or_id' => $slugTr, 'lang' => 'tr'])); ?>"/>
        <xhtml:link rel="alternate" hreflang="en" href="<?php echo e(route('otel.detay', ['slug_or_id' => $slugEn, 'lang' => 'en'])); ?>"/>
        <xhtml:link rel="alternate" hreflang="x-default" href="<?php echo e(route('otel.detay', $slugTr)); ?>"/>
        <lastmod><?php echo e($hotel->updated_at ? $hotel->updated_at->tz('UTC')->toAtomString() : date('c')); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php $__currentLoopData = $restaurants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $restaurant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $slugTr = $restaurant->slug_tr ?: $restaurant->id;
        $slugEn = $restaurant->slug_en ?: $slugTr;
    ?>
    <url>
        <loc><?php echo e(route('restoran.detay', $slugTr)); ?></loc>
        <xhtml:link rel="alternate" hreflang="tr" href="<?php echo e(route('restoran.detay', ['slug_or_id' => $slugTr, 'lang' => 'tr'])); ?>"/>
        <xhtml:link rel="alternate" hreflang="en" href="<?php echo e(route('restoran.detay', ['slug_or_id' => $slugEn, 'lang' => 'en'])); ?>"/>
        <xhtml:link rel="alternate" hreflang="x-default" href="<?php echo e(route('restoran.detay', $slugTr)); ?>"/>
        <lastmod><?php echo e($restaurant->updated_at ? $restaurant->updated_at->tz('UTC')->toAtomString() : date('c')); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php $__currentLoopData = $yachts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $yacht): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $slugTr = $yacht->slug_tr ?: $yacht->id;
        $slugEn = $yacht->slug_en ?: $slugTr;
    ?>
    <url>
        <loc><?php echo e(route('yat.detay', $slugTr)); ?></loc>
        <xhtml:link rel="alternate" hreflang="tr" href="<?php echo e(route('yat.detay', ['slug_or_id' => $slugTr, 'lang' => 'tr'])); ?>"/>
        <xhtml:link rel="alternate" hreflang="en" href="<?php echo e(route('yat.detay', ['slug_or_id' => $slugEn, 'lang' => 'en'])); ?>"/>
        <xhtml:link rel="alternate" hreflang="x-default" href="<?php echo e(route('yat.detay', $slugTr)); ?>"/>
        <lastmod><?php echo e($yacht->updated_at ? $yacht->updated_at->tz('UTC')->toAtomString() : date('c')); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php $__currentLoopData = $destinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $destination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $slugTr = $destination->slug_tr ?: $destination->id;
        $slugEn = $destination->slug_en ?: $slugTr;
    ?>
    <url>
        <loc><?php echo e(route('destinasyon.detay', $slugTr)); ?></loc>
        <xhtml:link rel="alternate" hreflang="tr" href="<?php echo e(route('destinasyon.detay', ['slug_or_id' => $slugTr, 'lang' => 'tr'])); ?>"/>
        <xhtml:link rel="alternate" hreflang="en" href="<?php echo e(route('destinasyon.detay', ['slug_or_id' => $slugEn, 'lang' => 'en'])); ?>"/>
        <xhtml:link rel="alternate" hreflang="x-default" href="<?php echo e(route('destinasyon.detay', $slugTr)); ?>"/>
        <lastmod><?php echo e($destination->updated_at ? $destination->updated_at->tz('UTC')->toAtomString() : date('c')); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
    <?php $__currentLoopData = $guides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $slugTr = $guide->slug_tr ?: $guide->id;
        $slugEn = $guide->slug_en ?: $slugTr;
    ?>
    <url>
        <loc><?php echo e(route('rehber.detay', $slugTr)); ?></loc>
        <xhtml:link rel="alternate" hreflang="tr" href="<?php echo e(route('rehber.detay', ['slug_or_id' => $slugTr, 'lang' => 'tr'])); ?>"/>
        <xhtml:link rel="alternate" hreflang="en" href="<?php echo e(route('rehber.detay', ['slug_or_id' => $slugEn, 'lang' => 'en'])); ?>"/>
        <xhtml:link rel="alternate" hreflang="x-default" href="<?php echo e(route('rehber.detay', $slugTr)); ?>"/>
        <lastmod><?php echo e($guide->updated_at ? $guide->updated_at->tz('UTC')->toAtomString() : date('c')); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $slugTr = $event->slug_tr ?: $event->id;
        $slugEn = $event->slug_en ?: $slugTr;
    ?>
    <url>
        <loc><?php echo e(route('etkinlik.detay', $slugTr)); ?></loc>
        <xhtml:link rel="alternate" hreflang="tr" href="<?php echo e(route('etkinlik.detay', ['slug_or_id' => $slugTr, 'lang' => 'tr'])); ?>"/>
        <xhtml:link rel="alternate" hreflang="en" href="<?php echo e(route('etkinlik.detay', ['slug_or_id' => $slugEn, 'lang' => 'en'])); ?>"/>
        <xhtml:link rel="alternate" hreflang="x-default" href="<?php echo e(route('etkinlik.detay', $slugTr)); ?>"/>
        <lastmod><?php echo e($event->updated_at ? $event->updated_at->tz('UTC')->toAtomString() : date('c')); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php $__currentLoopData = $journals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $journal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $slugTr = $journal->slug_tr ?: $journal->id;
        $slugEn = $journal->slug_en ?: $slugTr;
    ?>
    <url>
        <loc><?php echo e(route('journal.detay', $slugTr)); ?></loc>
        <xhtml:link rel="alternate" hreflang="tr" href="<?php echo e(route('journal.detay', ['slug_or_id' => $slugTr, 'lang' => 'tr'])); ?>"/>
        <xhtml:link rel="alternate" hreflang="en" href="<?php echo e(route('journal.detay', ['slug_or_id' => $slugEn, 'lang' => 'en'])); ?>"/>
        <xhtml:link rel="alternate" hreflang="x-default" href="<?php echo e(route('journal.detay', $slugTr)); ?>"/>
        <lastmod><?php echo e($journal->updated_at ? $journal->updated_at->tz('UTC')->toAtomString() : date('c')); ?></lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</urlset>
<?php /**PATH C:\Users\ahmet\Desktop\dioreal web\resources\views\sitemap.blade.php ENDPATH**/ ?>