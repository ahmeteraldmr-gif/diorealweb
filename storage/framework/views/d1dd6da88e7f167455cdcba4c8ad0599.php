<!DOCTYPE html>
<html lang="<?php echo e(get_active_locale()); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Yönetim Paneli'); ?> — Dioreal Dijital</title>
    
    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,700;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Premium Stylesheet -->
    <link rel="stylesheet" href="<?php echo e(asset('css/admin-new.css')); ?>?v=<?php echo e(time()); ?>">
</head>
<body>

    <!-- Sidebar -->
    <aside class="admin-sidebar" id="sidebar">
        <div class="sidebar-brand">
            DIOREAL<span>.</span>
        </div>
        
        <ul class="sidebar-menu">
            <li class="sidebar-item <?php echo e(Request::routeIs('admin.dashboard') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('admin.dashboard')); ?>">
                    <i class="fas fa-chart-pie"></i> Kontrol Paneli
                </a>
            </li>
            <?php if (\Illuminate\Support\Facades\Blade::check('adminCan', 'hotels')): ?>
            <li class="sidebar-item <?php echo e(Request::routeIs('admin.hotels.*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('admin.hotels.index')); ?>">
                    <i class="fas fa-hotel"></i> Oteller
                </a>
            </li>
            <?php endif; ?>
            <?php if (\Illuminate\Support\Facades\Blade::check('adminCan', 'restaurants')): ?>
            <li class="sidebar-item <?php echo e(Request::routeIs('admin.restaurants.*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('admin.restaurants.index')); ?>">
                    <i class="fas fa-utensils"></i> Restoranlar
                </a>
            </li>
            <?php endif; ?>
            <?php if (\Illuminate\Support\Facades\Blade::check('adminCan', 'yachts')): ?>
            <li class="sidebar-item <?php echo e(Request::routeIs('admin.yachts.*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('admin.yachts.index')); ?>">
                    <i class="fas fa-ship"></i> Yatlar
                </a>
            </li>
            <?php endif; ?>
            <?php if (\Illuminate\Support\Facades\Blade::check('adminCan', 'guides')): ?>
            <li class="sidebar-item <?php echo e(Request::routeIs('admin.guides.*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('admin.guides.index')); ?>">
                    <i class="fas fa-map-marked-alt"></i> Destinasyon Rehberleri
                </a>
            </li>
            <?php endif; ?>
            <?php if (\Illuminate\Support\Facades\Blade::check('adminCan', 'events')): ?>
            <li class="sidebar-item <?php echo e(Request::routeIs('admin.events.*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('admin.events.index')); ?>">
                    <i class="fas fa-calendar-alt"></i> Etkinlikler
                </a>
            </li>
            <?php endif; ?>
            <?php if (\Illuminate\Support\Facades\Blade::check('adminCan', 'journals')): ?>
            <li class="sidebar-item <?php echo e(Request::routeIs('admin.journals.*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('admin.journals.index')); ?>">
                    <i class="fas fa-newspaper"></i> Journal
                </a>
            </li>
            <?php endif; ?>
            <?php if (\Illuminate\Support\Facades\Blade::check('adminCan', 'destinations')): ?>
            <li class="sidebar-item <?php echo e(Request::routeIs('admin.destinations.*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('admin.destinations.index')); ?>">
                    <i class="fas fa-map-signs"></i> Destinasyonlar
                </a>
            </li>
            <?php endif; ?>
            <?php if (\Illuminate\Support\Facades\Blade::check('adminCan', 'users')): ?>
            <li class="sidebar-item <?php echo e(Request::routeIs('admin.users.*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('admin.users.index')); ?>">
                    <i class="fas fa-users-cog"></i> Kullanıcılar & Yetkiler
                </a>
            </li>
            <?php endif; ?>
            <?php if (\Illuminate\Support\Facades\Blade::check('adminCan', 'settings')): ?>
            <li class="sidebar-item <?php echo e(Request::routeIs('admin.settings.*') ? 'active' : ''); ?>">
                <a href="<?php echo e(route('admin.settings.index')); ?>">
                    <i class="fas fa-sliders-h"></i> Hakkımızda & Genel Ayarlar
                </a>
            </li>
            <?php endif; ?>
        </ul>
        
        <div class="sidebar-footer">
            <form action="<?php echo e(route('logout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Güvenli Çıkış
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Container -->
    <main class="admin-main">
        
        <header class="admin-header">
            <div class="header-left">
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="header-title-wrapper">
                    <h1 class="admin-title"><?php echo $__env->yieldContent('page_title'); ?></h1>
                    <p class="admin-subtitle"><?php echo $__env->yieldContent('page_subtitle', 'Dioreal Dijital portal yönetimi'); ?></p>
                </div>
            </div>
            <div>
                <a href="<?php echo e(route('home')); ?>" class="btn btn-outline" target="_blank">
                    <i class="fas fa-external-link-alt"></i> Siteyi Görüntüle
                </a>
            </div>
        </header>

        <!-- Flash Notifications -->
        <?php if(session('success')): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <span><?php echo e(session('success')); ?></span>
            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i>
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Main Content -->
        <?php echo $__env->yieldContent('content'); ?>
        
    </main>

    <!-- Global Admin Scripts -->
    <script>
        // Sidebar toggle logic for mobile
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        
        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('open');
            });
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', (e) => {
                if (window.innerWidth <= 1024 && !sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                    sidebar.classList.remove('open');
                }
            });
        }

        // Language tab switching helper
        function switchLanguageTab(lang) {
            // Toggle active tabs
            document.querySelectorAll('.lang-tab').forEach(tab => {
                if (tab.dataset.lang === lang) {
                    tab.classList.add('active');
                } else {
                    tab.classList.remove('active');
                }
            });
            // Toggle active panes
            document.querySelectorAll('.lang-pane').forEach(pane => {
                if (pane.dataset.lang === lang) {
                    pane.classList.add('active');
                } else {
                    pane.classList.remove('active');
                }
            });
        }

        // ── Client-side file size guard (max 50 MB per file) ──
        const MAX_FILE_MB = 50;
        const MAX_FILE_BYTES = MAX_FILE_MB * 1024 * 1024;

        document.addEventListener('change', function (e) {
            if (e.target && e.target.type === 'file') {
                const files = Array.from(e.target.files);
                const oversized = files.filter(f => f.size > MAX_FILE_BYTES);
                if (oversized.length > 0) {
                    const names = oversized.map(f => `"${f.name}" (${(f.size / 1024 / 1024).toFixed(1)} MB)`).join(', ');
                    alert(`⚠️ Dosya boyutu sınırı aşıldı!\n\n${names}\n\nMaksimum dosya boyutu: ${MAX_FILE_MB} MB\nLütfen daha küçük bir görsel seçin veya görseli sıkıştırın.`);
                    e.target.value = '';
                }
            }
        });

        // Block form submit if any file input has oversized files
        document.addEventListener('submit', function (e) {
            const fileInputs = e.target.querySelectorAll('input[type="file"]');
            for (const input of fileInputs) {
                const files = Array.from(input.files || []);
                const oversized = files.filter(f => f.size > MAX_FILE_BYTES);
                if (oversized.length > 0) {
                    e.preventDefault();
                    alert(`⚠️ Yüklemek istediğiniz görsel ${MAX_FILE_MB} MB limitini aşıyor. Lütfen görseli sıkıştırın.`);
                    return false;
                }
            }
        });

        // ── Drag & Drop File Upload Zone Auto-Decorator ──
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll("input[type='file']").forEach(input => {
                // Ignore inputs inside sortable gallery items
                if (input.closest(".gallery-item")) return;
                
                // Create a dropzone wrapper
                const dropzone = document.createElement("div");
                dropzone.className = "file-dropzone";
                dropzone.style.marginBottom = "1rem";
                
                const isMultiple = input.multiple;
                const accept = input.accept || "*";
                let typeText = "resim veya video";
                let iconClass = "fa-cloud-upload-alt";
                
                if (accept.includes("image")) {
                    typeText = "görsel";
                    iconClass = "fa-image";
                } else if (accept.includes("video")) {
                    typeText = "video";
                    iconClass = "fa-video";
                }
                
                dropzone.innerHTML = `
                    <i class="fas ${iconClass} dropzone-icon"></i>
                    <div class="dropzone-text">
                        ${isMultiple ? 'Dosyaları' : 'Dosyayı'} buraya sürükleyin veya <span>seçin</span>
                    </div>
                `;
                
                // Insert dropzone before input, then move input inside it
                input.parentNode.insertBefore(dropzone, input);
                dropzone.appendChild(input);
                
                // Find and hide old buttons that trigger this input click
                const allButtons = document.querySelectorAll("button, a.btn");
                allButtons.forEach(btn => {
                    const onclickAttr = btn.getAttribute("onclick");
                    if (onclickAttr && onclickAttr.includes(input.id) && onclickAttr.includes(".click()")) {
                        btn.style.display = "none";
                    }
                });
                
                // Click events
                dropzone.addEventListener("click", function (e) {
                    if (e.target !== input) {
                        input.click();
                    }
                });
                
                // Drag & drop events
                dropzone.addEventListener("dragover", function (e) {
                    e.preventDefault();
                    dropzone.classList.add("dragover");
                });
                
                dropzone.addEventListener("dragleave", function () {
                    dropzone.classList.remove("dragover");
                });
                
                dropzone.addEventListener("drop", function (e) {
                    e.preventDefault();
                    dropzone.classList.remove("dragover");
                    
                    if (e.dataTransfer.files && e.dataTransfer.files.length > 0) {
                        input.files = e.dataTransfer.files;
                        input.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                });
            });
        });
    </script>
</body>
</html>
<?php /**PATH C:\Users\ahmet\Desktop\dioreal web\resources\views\admin\layouts\app.blade.php ENDPATH**/ ?>