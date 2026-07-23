<?php $__env->startSection('title', 'Kontrol Paneli'); ?>

<?php $__env->startSection('page_title', 'Kontrol Paneli'); ?>
<?php $__env->startSection('page_subtitle', 'Dioreal portal içeriklerinin genel özeti ve istatistikleri.'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Stats Cards Grid -->
    <div class="stats-grid">
        <div class="stat-card">
            <div>
                <span class="stat-card-title">Oteller</span>
                <div class="stat-card-value"><?php echo e($stats['hotels']); ?></div>
            </div>
            <div class="stat-card-icon">
                <i class="fas fa-hotel"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <span class="stat-card-title">Restoranlar</span>
                <div class="stat-card-value"><?php echo e($stats['restaurants']); ?></div>
            </div>
            <div class="stat-card-icon">
                <i class="fas fa-utensils"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <span class="stat-card-title">Yatlar</span>
                <div class="stat-card-value"><?php echo e($stats['yachts']); ?></div>
            </div>
            <div class="stat-card-icon">
                <i class="fas fa-ship"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <span class="stat-card-title">Gezi Rehberleri</span>
                <div class="stat-card-value"><?php echo e($stats['guides']); ?></div>
            </div>
            <div class="stat-card-icon">
                <i class="fas fa-map-marked-alt"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <span class="stat-card-title">Etkinlikler</span>
                <div class="stat-card-value"><?php echo e($stats['events']); ?></div>
            </div>
            <div class="stat-card-icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
        </div>
        <div class="stat-card">
            <div>
                <span class="stat-card-title">Journal Yazıları</span>
                <div class="stat-card-value"><?php echo e($stats['journals']); ?></div>
            </div>
            <div class="stat-card-icon">
                <i class="fas fa-newspaper"></i>
            </div>
        </div>
    </div>

    <!-- Recent Items Sections -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 2rem;">
        
        <!-- Recent Hotels -->
        <div class="panel-card">
            <div class="panel-card-header">
                <h3 class="panel-card-title"><i class="fas fa-hotel" style="color: var(--primary); margin-right: 0.5rem;"></i> Son Eklenen Oteller</h3>
                <a href="<?php echo e(route('admin.hotels.index')); ?>" class="btn btn-outline btn-sm">Tümünü Gör</a>
            </div>
            <div class="table-responsive">
                <table class="premium-table">
                    <thead>
                        <tr>
                            <th>Görsel</th>
                            <th>Otel Adı</th>
                            <th>Kategori (Tag)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $recentHotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <img src="<?php echo e(asset($hotel->img)); ?>" alt="" class="table-img">
                                </td>
                                <td>
                                    <strong><?php echo e($hotel->name['tr'] ?? ''); ?></strong>
                                    <div style="font-size: 0.8rem; color: var(--text-muted);"><?php echo e($hotel->name['en'] ?? ''); ?></div>
                                </td>
                                <td>
                                    <span class="badge badge-primary"><?php echo e($hotel->tag['tr'] ?? ''); ?></span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="3" style="text-align: center; color: var(--text-muted);">Henüz otel eklenmemiş.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Recent Restaurants -->
        <div class="panel-card">
            <div class="panel-card-header">
                <h3 class="panel-card-title"><i class="fas fa-utensils" style="color: var(--primary); margin-right: 0.5rem;"></i> Son Eklenen Restoranlar</h3>
                <a href="<?php echo e(route('admin.restaurants.index')); ?>" class="btn btn-outline btn-sm">Tümünü Gör</a>
            </div>
            <div class="table-responsive">
                <table class="premium-table">
                    <thead>
                        <tr>
                            <th>Görsel</th>
                            <th>Restoran Adı</th>
                            <th>Kategori (Tag)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $recentRestaurants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $restaurant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td>
                                    <img src="<?php echo e(asset($restaurant->img)); ?>" alt="" class="table-img">
                                </td>
                                <td>
                                    <strong><?php echo e($restaurant->name['tr'] ?? ''); ?></strong>
                                    <div style="font-size: 0.8rem; color: var(--text-muted);"><?php echo e($restaurant->name['en'] ?? ''); ?></div>
                                </td>
                                <td>
                                    <span class="badge badge-primary"><?php echo e($restaurant->tag['tr'] ?? ''); ?></span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="3" style="text-align: center; color: var(--text-muted);">Henüz restoran eklenmemiş.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ahmet\Desktop\dioreal web\resources\views\admin\dashboard.blade.php ENDPATH**/ ?>