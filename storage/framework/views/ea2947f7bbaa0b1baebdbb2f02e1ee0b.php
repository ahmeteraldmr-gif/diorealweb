<?php $__env->startSection('title', 'Destinasyonları Yönet'); ?>

<?php $__env->startSection('page_title', 'Destinasyonlar'); ?>
<?php $__env->startSection('page_subtitle', 'Web sitesindeki anasayfa destinasyon kartlarını (Türkiye\'nin Ruhu & Yurtdışı alanları) yönetin.'); ?>

<?php $__env->startSection('content'); ?>
    <div class="panel-card">
        <div class="panel-card-header">
            <h3 class="panel-card-title"><i class="fas fa-map-signs"></i> Tüm Destinasyonlar</h3>
            <a href="<?php echo e(route('admin.destinations.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Yeni Destinasyon Ekle
            </a>
        </div>
        
        <div class="table-responsive">
            <table class="premium-table">
                <thead>
                    <tr>
                        <th>Görsel</th>
                        <th>Destinasyon Adı (TR / EN)</th>
                        <th>Bölge / Tag (TR / EN)</th>
                        <th>Kategori Grubu</th>
                        <th style="text-align: center;">Sıra No</th>
                        <th style="width: 200px; text-align: center;">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $destinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $destination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <img src="<?php echo e(asset($destination->img)); ?>" alt="" class="table-img" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                            </td>
                            <td>
                                <div><strong>TR:</strong> <?php echo e($destination->name['tr'] ?? ''); ?></div>
                                <div style="color: var(--text-muted);"><strong>EN:</strong> <?php echo e($destination->name['en'] ?? ''); ?></div>
                            </td>
                            <td>
                                <div><strong>TR:</strong> <?php echo e($destination->region['tr'] ?? ''); ?></div>
                                <div style="color: var(--text-muted);"><strong>EN:</strong> <?php echo e($destination->region['en'] ?? ''); ?></div>
                            </td>
                            <td>
                                <span class="badge badge-primary">
                                    <?php switch($destination->type):
                                        case ('turkiye'): ?>
                                            Türkiye'nin Ruhu
                                            <?php break; ?>
                                        <?php case ('yurtdisi_popular'): ?>
                                            Yurtdışı - En Popüler
                                            <?php break; ?>
                                        <?php case ('yurtdisi_traveller'): ?>
                                            Yurtdışı - Gezgine Göre
                                            <?php break; ?>
                                        <?php case ('yurtdisi_month'): ?>
                                            Yurtdışı - Aya Göre
                                            <?php break; ?>
                                        <?php case ('yurtdisi_spotlight'): ?>
                                            Yurtdışı - Vitrindekiler
                                            <?php break; ?>
                                        <?php default: ?>
                                            <?php echo e($destination->type); ?>

                                    <?php endswitch; ?>
                                </span>
                            </td>
                            <td style="text-align: center;">
                                <?php echo e($destination->order); ?>

                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                    <a href="<?php echo e(route('admin.destinations.edit', $destination->id)); ?>" class="btn btn-outline btn-sm">
                                        <i class="fas fa-edit"></i> Düzenle
                                    </a>
                                    <form action="<?php echo e(route('admin.destinations.destroy', $destination->id)); ?>" method="POST" onsubmit="return confirm('Bu destinasyonu silmek istediğinize emin misiniz?');" style="display: inline-block;">
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
                            <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 3rem;">
                                <i class="fas fa-map-signs" style="font-size: 2rem; margin-bottom: 1rem; display: block; color: rgba(255,255,255,0.1);"></i>
                                Listelenecek destinasyon kaydı bulunamadı.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ahmet\Desktop\dioreal web\resources\views\admin\destinations\index.blade.php ENDPATH**/ ?>