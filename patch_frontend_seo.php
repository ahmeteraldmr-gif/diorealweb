<?php

$dir = __DIR__ . '/resources/views';

$seoBlock = <<<HTML
    @php
        \$seo_title = \$seo_title ?? 'Dioreal Dijital - Global Deneyim & Medya Platformu';
        \$seo_desc = \$seo_desc ?? 'Türkiye ve dünyada seçkin deneyimlerin kapısını aralıyoruz. Lüks oteller, yatlar ve yaşam tarzı markaları için yeni nesil medya platformu.';
        \$og_image = \$og_image ?? asset('foto.img/hero_4k.jpg');
        \$canonical = \$canonical ?? url()->current();
        \$noindex = \$noindex ?? false;
    @endphp

    <title>{{ \$seo_title }}</title>
    <meta name="description" content="{{ \$seo_desc }}">
    
    <link rel="canonical" href="{{ \$canonical }}">
    @if(isset(\$hreflang_tr)) <link rel="alternate" hreflang="tr" href="{{ \$hreflang_tr }}" /> @endif
    @if(isset(\$hreflang_en)) <link rel="alternate" hreflang="en" href="{{ \$hreflang_en }}" /> @endif
    <link rel="alternate" hreflang="x-default" href="{{ \$canonical }}" />

    @if(\$noindex)
    <meta name="robots" content="noindex, nofollow">
    @else
    <meta name="robots" content="index, follow">
    @endif

    <meta property="og:title" content="{{ \$seo_title }}">
    <meta property="og:description" content="{{ \$seo_desc }}">
    <meta property="og:image" content="{{ \$og_image }}">
    <meta property="og:url" content="{{ \$canonical }}">
    <meta property="og:type" content="{{ \$og_type ?? 'website' }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ \$seo_title }}">
    <meta name="twitter:description" content="{{ \$seo_desc }}">
    <meta name="twitter:image" content="{{ \$og_image }}">

    @if(isset(\$schema_json))
    {!! \$schema_json !!}
    @endif
HTML;

$files = [
    'otel-detay.blade.php' => [
        'var' => 'otel',
        'type' => 'Hotel',
        'name_field' => 'name[\'tr\']',
        'route' => 'otel.detay'
    ],
    'restoran-detay.blade.php' => [
        'var' => 'restoran',
        'type' => 'Restaurant',
        'name_field' => 'name[\'tr\']',
        'route' => 'restoran.detay'
    ],
    'yat-detay.blade.php' => [
        'var' => 'yacht', // wait, is it yacht or yat? let's check yacht-detay or yat-detay. it's yat.
        'type' => 'Product', // or maybe just Product for Yacht
        'name_field' => 'name[\'tr\']',
        'route' => 'yat.detay'
    ],
    'etkinlik-detay.blade.php' => [
        'var' => 'event',
        'type' => 'Event',
        'name_field' => 'title[\'tr\']',
        'route' => 'etkinlik.detay'
    ],
    'journal-detay.blade.php' => [
        'var' => 'journal',
        'type' => 'Article',
        'name_field' => 'title[\'tr\']',
        'route' => 'journal.detay'
    ],
    'destinasyon-detay.blade.php' => [
        'var' => 'destination',
        'type' => 'Place',
        'name_field' => 'name[\'tr\']',
        'route' => 'destinasyon.detay'
    ],
    'rehber-detay.blade.php' => [
        'var' => 'rehber',
        'type' => 'Article',
        'name_field' => 'title[\'tr\']',
        'route' => 'rehber.detay'
    ],
];

// 1. Process detail pages
foreach ($files as $file => $config) {
    $path = $dir . '/' . $file;
    if (!file_exists($path)) continue;

    $content = file_get_contents($path);
    if (strpos($content, '$seo_title =') !== false) continue; // already patched

    $var = $config['var'];
    $type = $config['type'];
    $name_field = $config['name_field'];
    $route = $config['route'];
    
    // Yat var name fix
    if ($file === 'yat-detay.blade.php') {
        // check if it's $yat or $yacht
        if (strpos($content, '$yat->') !== false) $var = 'yat';
        if (strpos($content, '$yacht->') !== false) $var = 'yacht';
    }

    $setupBlock = <<<PHP
@php
    \$seo_title = \${$var}->seo_title_tr ?: (\${$var}->{$name_field} ?? 'Detay') . ' - Dioreal';
    \$seo_desc = \${$var}->seo_description_tr ?: \Illuminate\Support\Str::limit(strip_tags(\${$var}->desc['tr'] ?? ''), 155);
    \$og_image = \${$var}->og_image ? asset(\${$var}->og_image) : asset(\${$var}->img);
    \$canonical = route('{$route}', \${$var}->slug_tr ?: \${$var}->id);
    \$noindex = \${$var}->seo_noindex;
    
    \$hreflang_tr = route('{$route}', \${$var}->slug_tr ?: \${$var}->id);
    \$hreflang_en = \${$var}->slug_en ? route('{$route}', \${$var}->slug_en) : null;
    \$og_type = '{$type}' == 'Article' ? 'article' : 'website';

    \$schema_json = '<script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "{$type}",
      "name": "'.addslashes(\${$var}->{$name_field} ?? '').'",
      "description": "'.addslashes(\$seo_desc).'",
      "image": "'.\$og_image.'",
      "url": "'.\$canonical.'"
    }
    </script>';
@endphp

PHP;

    // Inject setup block at the very beginning
    $content = $setupBlock . $content;
    
    // Remove old <title> and <meta name="description">
    $content = preg_replace('/<title>.*?<\/title>/s', '', $content);
    $content = preg_replace('/<meta name="description".*?>/s', '', $content);
    
    // Inject seoBlock right before </head>
    $content = preg_replace('/<\/head>/', $seoBlock . "\n</head>", $content);

    file_put_contents($path, $content);
    echo "Patched $file\n";
}

// 2. Process index.blade.php to add Organization schema
$indexPath = $dir . '/index.blade.php';
if (file_exists($indexPath)) {
    $content = file_get_contents($indexPath);
    if (strpos($content, 'Organization') === false) {
        $orgSchema = <<<HTML
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
HTML;
        
        $content = preg_replace('/<title>.*?<\/title>/s', '', $content);
        $content = preg_replace('/<meta name="description".*?>/s', '', $content);
        $content = preg_replace('/<\/head>/', $seoBlock . "\n" . $orgSchema . "\n</head>", $content);
        file_put_contents($indexPath, $content);
        echo "Patched index.blade.php\n";
    }
}

// 3. Process generic list pages (oteller, restoranlar, vs.)
$genericFiles = ['oteller.blade.php', 'restoranlar.blade.php', 'yatlar.blade.php', 'destinasyonlar.blade.php', 'etkinlikler.blade.php', 'journal.blade.php', 'hakkimizda.blade.php'];

foreach ($genericFiles as $file) {
    $path = $dir . '/' . $file;
    if (!file_exists($path)) continue;

    $content = file_get_contents($path);
    if (strpos($content, '$seo_title =') !== false) continue; // already patched

    // Remove old <title> and <meta name="description">
    $content = preg_replace('/<title>.*?<\/title>/s', '', $content);
    $content = preg_replace('/<meta name="description".*?>/s', '', $content);
    
    // Inject seoBlock right before </head>
    $content = preg_replace('/<\/head>/', $seoBlock . "\n</head>", $content);

    file_put_contents($path, $content);
    echo "Patched $file\n";
}

echo "Done.\n";
