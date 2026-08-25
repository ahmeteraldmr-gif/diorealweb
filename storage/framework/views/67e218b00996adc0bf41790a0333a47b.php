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
        $seo_title = ($locale === 'en') ? ($seo['title_en'] ?? 'KVKK & GDPR Privacy Notice - Dioreal Digital') : ($seo['title_tr'] ?? 'KVKK & GDPR Aydınlatma Metni - Dioreal Dijital');
        $seo_desc = ($locale === 'en') ? ($seo['desc_en'] ?? 'Dioreal Digital KVKK & GDPR Privacy Notice.') : ($seo['desc_tr'] ?? 'Dioreal Dijital KVKK & GDPR Aydınlatma Metni.');
        $og_image = asset('foto.img/logo_dioreal.png');
        $canonical = $canonical ?? route('kvkk');
        $hreflang_tr = $hreflang_tr ?? route('kvkk', ['lang' => 'tr']);
        $hreflang_en = $hreflang_en ?? route('kvkk', ['lang' => 'en']);
    ?>

    <title><?php echo e($seo_title); ?></title>
    <meta name="description" content="<?php echo e($seo_desc); ?>">
    
    <link rel="canonical" href="<?php echo e($canonical); ?>">
    <link rel="alternate" hreflang="tr" href="<?php echo e($hreflang_tr); ?>" />
    <link rel="alternate" hreflang="en" href="<?php echo e($hreflang_en); ?>" />
    <link rel="alternate" hreflang="x-default" href="<?php echo e($canonical); ?>" />

    <meta name="robots" content="index, follow">
    <meta property="og:title" content="<?php echo e($seo_title); ?>">
    <meta property="og:description" content="<?php echo e($seo_desc); ?>">
    <meta property="og:image" content="<?php echo e($og_image); ?>">
    <meta property="og:url" content="<?php echo e($canonical); ?>">
    <meta property="og:type" content="website">

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
            <li><a href="<?php echo e(route('gezi-rehberi')); ?>" data-i18n="nav_guide"><span class="lang-text-tr">Gezi Rehberi</span><span class="lang-text-en">Travel Guide</span></a></li>
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

    <div class="page-hero" style="background-image:url('<?php echo e(asset('foto.img/about_safari.jpg')); ?>');">
        <div class="page-hero-content">
            <span class="page-eyebrow">
                <span class="lang-text-tr">Yasal Bilgilendirme</span>
                <span class="lang-text-en">Legal Notice</span>
            </span>
            <h1 class="page-title">
                <span class="lang-text-tr">KVKK & GDPR <em>Aydınlatma Metni</em></span>
                <span class="lang-text-en">KVKK & GDPR <em>Privacy Notice</em></span>
            </h1>
        </div>
    </div>

    <section class="content-section" style="max-width: 950px; margin: 0 auto; padding: 6rem 2rem;">
        <div class="legal-article" style="font-family: var(--font-body); line-height: 1.8; color: var(--near-black); font-size: 1rem;">
            
            <div class="lang-text-tr">
                <h2 style="font-family: var(--font-display); font-size: 2.2rem; margin-bottom: 1.5rem; font-weight: 400; color: var(--near-black);">Dioreal Dijital Kişisel Verilerin Korunması ve İşlenmesi Aydınlatma Metni</h2>
                
                <p style="margin-bottom: 1.5rem;">6698 sayılı Kişisel Verilerin Korunması Kanunu (“KVKK”) ve Avrupa Birliği Genel Veri Koruma Tüzüğü (“GDPR”) uyarınca, Dioreal Dijital (“Şirket” veya “Platform”) olarak, kişisel verilerinizin güvenliğine ve gizliliğine büyük önem vermekteyiz.</p>

                <h3 style="font-family: var(--font-display); font-size: 1.5rem; margin-top: 2rem; margin-bottom: 1rem; color: var(--accent);">1. Veri Sorumlusu</h3>
                <p style="margin-bottom: 1.5rem;">KVKK uyarınca kişisel verileriniz; veri sorumlusu sıfatıyla Dioreal Dijital tarafından aşağıda açıklanan kapsamda işlenmektedir.</p>

                <h3 style="font-family: var(--font-display); font-size: 1.5rem; margin-top: 2rem; margin-bottom: 1rem; color: var(--accent);">2. İşlenen Kişisel Verileriniz</h3>
                <p style="margin-bottom: 1rem;">Dioreal Dijital platformunu ziyaretiniz ve hizmetlerimizi kullanımınız sırasında aşağıdaki kişisel verileriniz işlenebilir:</p>
                <ul style="padding-left: 1.5rem; margin-bottom: 1.5rem;">
                    <li><strong>Kimlik ve İletişim Bilgileri:</strong> Ad, soyad, e-posta adresi, telefon numarası (iletişim formu veya bülten üyeliği durumunda).</li>
                    <li><strong>İşlem Güvenliği ve Trafik Bilgileri:</strong> IP adresi, erişim logları, tarayıcı bilgileri, çerez (cookie) verileri.</li>
                    <li><strong>Kullanıcı Tercihleri:</strong> Dil seçeneği, favori destinasyonlar ve iletişim izinleri.</li>
                </ul>

                <h3 style="font-family: var(--font-display); font-size: 1.5rem; margin-top: 2rem; margin-bottom: 1rem; color: var(--accent);">3. Kişisel Verilerin İşlenme Amaçları</h3>
                <p style="margin-bottom: 1rem;">Toplanan kişisel verileriniz aşağıdaki amaçlarla işlenmektedir:</p>
                <ul style="padding-left: 1.5rem; margin-bottom: 1.5rem;">
                    <li>Platform hizmetlerinin sunulması ve içeriklerin kişiselleştirilmesi,</li>
                    <li>İletişim ve talep süreçlerinin yürütülmesi,</li>
                    <li>Bilgi güvenliği ve sistem altyapısının korunması,</li>
                    <li>Yasal yükümlülüklerin yerine getirilmesi.</li>
                </ul>

                <h3 style="font-family: var(--font-display); font-size: 1.5rem; margin-top: 2rem; margin-bottom: 1rem; color: var(--accent);">4. Verilerin Aktarımı ve Saklanması</h3>
                <p style="margin-bottom: 1.5rem;">Kişisel verileriniz, açık rızanız olmaksızın üçüncü şahıslarla satılmaz veya paylaşılmaz. Yalnızca yasal zorunluluklar halinde yetkili kamu kurum ve kuruluşları ile paylaşılabilecektir.</p>

                <h3 style="font-family: var(--font-display); font-size: 1.5rem; margin-top: 2rem; margin-bottom: 1rem; color: var(--accent);">5. KVKK Madde 11 Kapsamındaki Haklarınız</h3>
                <p style="margin-bottom: 1rem;">KVKK'nın 11. maddesi uyarınca veri sahipleri;</p>
                <ul style="padding-left: 1.5rem; margin-bottom: 1.5rem;">
                    <li>Kişisel verilerinin işlenip işlenmediğini öğrenme,</li>
                    <li>İşlenmişse buna ilişkin bilgi talep etme,</li>
                    <li>Eksik veya yanlış işlenmişse düzeltilmesini isteme,</li>
                    <li>Verilerin silinmesini veya yok edilmesini talep etme haklarına sahiptir.</li>
                </ul>
                <p style="margin-top: 2rem;">Tüm talepleriniz için <a href="mailto:info@dioreal.com" style="color: var(--accent); text-decoration: underline;">info@dioreal.com</a> adresi üzerinden bizimle iletişime geçebilirsiniz.</p>
            </div>

            <div class="lang-text-en">
                <h2 style="font-family: var(--font-display); font-size: 2.2rem; margin-bottom: 1.5rem; font-weight: 400; color: var(--near-black);">Dioreal Digital Personal Data Protection and Processing Privacy Notice (KVKK & GDPR)</h2>
                
                <p style="margin-bottom: 1.5rem;">In accordance with the Turkish Personal Data Protection Law No. 6698 (“KVKK”) and the EU General Data Protection Regulation (“GDPR”), Dioreal Digital (“Company” or “Platform”) attaches utmost importance to the security and confidentiality of your personal data.</p>

                <h3 style="font-family: var(--font-display); font-size: 1.5rem; margin-top: 2rem; margin-bottom: 1rem; color: var(--accent);">1. Data Controller</h3>
                <p style="margin-bottom: 1.5rem;">Your personal data is processed by Dioreal Digital as data controller within the scope described below.</p>

                <h3 style="font-family: var(--font-display); font-size: 1.5rem; margin-top: 2rem; margin-bottom: 1rem; color: var(--accent);">2. Personal Data Processed</h3>
                <p style="margin-bottom: 1rem;">During your visit and use of the Dioreal Digital platform, the following personal data may be processed:</p>
                <ul style="padding-left: 1.5rem; margin-bottom: 1.5rem;">
                    <li><strong>Identity and Contact Info:</strong> Name, surname, email address, phone number (if contact forms or newsletter subscriptions are filled).</li>
                    <li><strong>Security and Traffic Data:</strong> IP address, access logs, browser details, cookie data.</li>
                    <li><strong>User Preferences:</strong> Language settings, favorite destinations, and communication consent.</li>
                </ul>

                <h3 style="font-family: var(--font-display); font-size: 1.5rem; margin-top: 2rem; margin-bottom: 1rem; color: var(--accent);">3. Purposes of Processing</h3>
                <p style="margin-bottom: 1rem;">Your personal data is processed for the following purposes:</p>
                <ul style="padding-left: 1.5rem; margin-bottom: 1.5rem;">
                    <li>Providing platform services and personalizing editorial content,</li>
                    <li>Managing inquiries and communication requests,</li>
                    <li>Ensuring system security and infrastructure protection,</li>
                    <li>Fulfilling legal and regulatory obligations.</li>
                </ul>

                <h3 style="font-family: var(--font-display); font-size: 1.5rem; margin-top: 2rem; margin-bottom: 1rem; color: var(--accent);">4. Data Transfer and Storage</h3>
                <p style="margin-bottom: 1.5rem;">Your personal data is never sold or shared with third parties without your explicit consent. Data will only be disclosed to authorized official bodies when legally mandatory.</p>

                <h3 style="font-family: var(--font-display); font-size: 1.5rem; margin-top: 2rem; margin-bottom: 1rem; color: var(--accent);">5. Your Legal Rights</h3>
                <p style="margin-bottom: 1rem;">As a data subject under GDPR and KVKK, you have the right to:</p>
                <ul style="padding-left: 1.5rem; margin-bottom: 1.5rem;">
                    <li>Request access to your personal data,</li>
                    <li>Request correction of inaccurate or incomplete data,</li>
                    <li>Request erasure or deletion of your personal data,</li>
                    <li>Object to processing or request restriction of data processing.</li>
                </ul>
                <p style="margin-top: 2rem;">For any requests or inquiries, please contact us at <a href="mailto:info@dioreal.com" style="color: var(--accent); text-decoration: underline;">info@dioreal.com</a>.</p>
            </div>

        </div>
    </section>

    <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <script src="<?php echo e(asset('js/i18n.js')); ?>?v=2.5.0"></script>
    <script src="<?php echo e(asset('js/common.js')); ?>?v=2.5.0"></script>
    <script src="<?php echo e(asset('js/nav.js')); ?>?v=2.5.0"></script>
</body>
</html>
<?php /**PATH C:\Users\ahmet\Desktop\dioreal web\resources\views/kvkk.blade.php ENDPATH**/ ?>