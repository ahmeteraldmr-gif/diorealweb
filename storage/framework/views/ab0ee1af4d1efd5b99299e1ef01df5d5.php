<?php $__env->startSection('title', 'Otelleri Yönet'); ?>

<?php $__env->startSection('page_title', 'Oteller'); ?>
<?php $__env->startSection('page_subtitle', 'Web sitesindeki otel koleksiyonunu buradan ekleyebilir, düzenleyebilir veya silebilirsiniz.'); ?>

<?php $__env->startSection('content'); ?>
    <div class="panel-card">
        <div class="panel-card-header">
            <h3 class="panel-card-title"><i class="fas fa-list"></i> Tüm Oteller</h3>
            <a href="<?php echo e(route('admin.hotels.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Yeni Otel Ekle
            </a>
        </div>
        
        <div class="table-responsive">
            <table class="premium-table">
                <thead>
                    <tr>
                        <th>Görsel</th>
                        <th>Otel Adı (TR / EN)</th>
                        <th>Kategori / Etiket (TR / EN)</th>
                        <th style="width: 200px; text-align: center;">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $hotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <img src="<?php echo e(asset($hotel->img)); ?>" alt="" class="table-img">
                            </td>
                            <td>
                                <div><strong>TR:</strong> <?php echo e($hotel->name['tr'] ?? ''); ?></div>
                                <div style="color: var(--text-muted);"><strong>EN:</strong> <?php echo e($hotel->name['en'] ?? ''); ?></div>
                            </td>
                            <td>
                                <div><span class="badge badge-primary">TR</span> <?php echo e($hotel->tag['tr'] ?? ''); ?></div>
                                <div style="margin-top: 4px;"><span class="badge badge-primary" style="opacity:0.7;">EN</span> <?php echo e($hotel->tag['en'] ?? ''); ?></div>
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                    <a href="<?php echo e(route('admin.hotels.edit', $hotel->id)); ?>" class="btn btn-outline btn-sm">
                                        <i class="fas fa-edit"></i> Düzenle
                                    </a>
                                    <form action="<?php echo e(route('admin.hotels.destroy', $hotel->id)); ?>" method="POST" onsubmit="return confirm('Bu oteli silmek istediğinize emin misiniz?');" style="display: inline-block;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Sil
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" style="text-align: center; color: var(--text-muted); padding: 3rem;">
                                <i class="fas fa-hotel" style="font-size: 2rem; margin-bottom: 1rem; display: block; color: rgba(255,255,255,0.1);"></i>
                                Listelenecek otel kaydı bulunamadı.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ahmet\Desktop\dioreal web\resources\views\admin\hotels\index.blade.php ENDPATH**/ ?>