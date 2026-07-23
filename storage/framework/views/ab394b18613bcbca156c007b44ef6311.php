<?php $__env->startSection('title', 'Kullanıcılar & Yetkiler'); ?>

<?php $__env->startSection('page_title', 'Kullanıcılar & Yetkiler'); ?>
<?php $__env->startSection('page_subtitle', 'Sisteme erişebilen yöneticilerin ve içerik editörlerinin yönetimi.'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel-card">
    <div class="panel-card-header">
        <h3 class="panel-card-title">
            <i class="fas fa-users" style="color: var(--primary); margin-right: 0.5rem;"></i> Kayıtlı Kullanıcılar
        </h3>
        <a href="<?php echo e(route('admin.users.create')); ?>" class="btn btn-primary" style="background: var(--primary); color: var(--bg-dark); border-radius: var(--radius-sm);">
            <i class="fas fa-user-plus"></i> Yeni Kullanıcı Ekle
        </a>
    </div>

    <?php if($errors->has('delete_error')): ?>
        <div class="alert alert-error" style="margin-bottom: 1.5rem; background: rgba(248, 113, 113, 0.1); color: var(--error); border: 1px solid rgba(248, 113, 113, 0.2); padding: 1rem; border-radius: var(--radius-md); display: flex; align-items: center; gap: 0.5rem;">
            <i class="fas fa-exclamation-circle"></i>
            <span><?php echo e($errors->first('delete_error')); ?></span>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="premium-table">
            <thead>
                <tr>
                    <th>Ad Soyad</th>
                    <th>E-posta</th>
                    <th>Rol</th>
                    <th>İzin Verilen Bölümler</th>
                    <th style="text-align: right;">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td style="font-weight: 600; color: var(--white);"><?php echo e($user->name); ?></td>
                        <td><?php echo e($user->email); ?></td>
                        <td>
                            <?php if($user->role === 'super_admin'): ?>
                                <span class="badge badge-primary">Süper Yönetici</span>
                            <?php else: ?>
                                <span class="badge" style="background: rgba(148, 163, 184, 0.12); color: var(--text-muted); border: 1px solid rgba(148, 163, 184, 0.25);">İçerik Editörü</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if($user->role === 'super_admin'): ?>
                                <span class="badge badge-primary" style="font-size: 0.7rem;">Tüm Yetkiler</span>
                            <?php elseif(empty($user->permissions) || count($user->permissions) === 0): ?>
                                <span style="color: var(--text-muted); font-size: 0.85rem; font-style: italic;">Yetki tanımlanmamış</span>
                            <?php else: ?>
                                <div style="display: flex; flex-wrap: wrap; gap: 0.3rem;">
                                    <?php $__currentLoopData = $user->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="badge" style="background: rgba(255, 255, 255, 0.05); color: var(--text-muted); border: 1px solid rgba(255, 255, 255, 0.1); font-size: 0.7rem;">
                                            <?php switch($perm):
                                                case ('hotels'): ?> Oteller <?php break; ?>
                                                <?php case ('restaurants'): ?> Restoranlar <?php break; ?>
                                                <?php case ('yachts'): ?> Yatlar <?php break; ?>
                                                <?php case ('guides'): ?> Gezi Rehberi <?php break; ?>
                                                <?php case ('events'): ?> Etkinlikler <?php break; ?>
                                                <?php case ('journals'): ?> Journal <?php break; ?>
                                                <?php case ('settings'): ?> Genel Ayarlar <?php break; ?>
                                                <?php case ('users'): ?> Kullanıcılar <?php break; ?>
                                                <?php default: ?> <?php echo e($perm); ?>

                                            <?php endswitch; ?>
                                        </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td style="text-align: right;">
                            <div style="display: inline-flex; gap: 0.5rem; justify-content: flex-end;">
                                <a href="<?php echo e(route('admin.users.edit', $user->id)); ?>" class="btn btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.8rem; border-color: rgba(255,255,255,0.1); color: var(--text-muted); border-radius: var(--radius-sm);">
                                    <i class="fas fa-edit"></i> Düzenle
                                </a>
                                
                                <?php if($user->email !== 'admin@dioreal.com' && (!auth()->check() || auth()->id() !== $user->id)): ?>
                                    <form action="<?php echo e(route('admin.users.destroy', $user->id)); ?>" method="POST" onsubmit="return confirm('Bu kullanıcıyı silmek istediğinize emin misiniz?');" style="display: inline;">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn" style="padding: 0.4rem 0.8rem; font-size: 0.8rem; background: rgba(248, 113, 113, 0.1); color: var(--error); border: 1px solid rgba(248, 113, 113, 0.2); border-radius: var(--radius-sm);">
                                            <i class="fas fa-trash-alt"></i> Sil
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ahmet\Desktop\dioreal web\resources\views\admin\users\index.blade.php ENDPATH**/ ?>