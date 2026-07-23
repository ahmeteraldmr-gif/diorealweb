<?php $__env->startSection('title', 'Yeni Kullanıcı Ekle'); ?>

<?php $__env->startSection('page_title', 'Yeni Kullanıcı Ekle'); ?>
<?php $__env->startSection('page_subtitle', 'Sistem yönetimi veya içerik güncellemesi için yeni bir kullanıcı profili oluşturun.'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel-card" style="max-width: 800px; margin: 0 auto;">
    <div class="panel-card-header">
        <h3 class="panel-card-title">
            <i class="fas fa-user-plus" style="color: var(--primary); margin-right: 0.5rem;"></i> Kullanıcı Detayları
        </h3>
        <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-outline" style="border-color: rgba(255,255,255,0.1); color: var(--text-muted); padding: 0.5rem 1rem; border-radius: var(--radius-sm);">
            <i class="fas fa-arrow-left"></i> Geri Dön
        </a>
    </div>

    <form action="<?php echo e(route('admin.users.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>

        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label class="form-label" for="name">Ad Soyad</label>
            <input type="text" class="form-control" name="name" id="name" value="<?php echo e(old('name')); ?>" placeholder="Örn: Ahmet Yılmaz" required style="width: 100%; padding: 0.8rem; background: rgba(15, 23, 42, 0.6); border: 1px solid var(--border-color); border-radius: var(--radius-sm); color: var(--text-main); outline: none;">
        </div>

        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label class="form-label" for="email">E-posta veya Kullanc Ad</label>
            <input type="text" class="form-control" name="email" id="email" value="<?php echo e(old('email')); ?>" placeholder="Kullanc Ad veya E-posta" required style="width: 100%; padding: 0.8rem; background: rgba(15, 23, 42, 0.6); border: 1px solid var(--border-color); border-radius: var(--radius-sm); color: var(--text-main); outline: none;">
        </div>

        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label class="form-label" for="password">Şifre</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="En az 6 karakter" required style="width: 100%; padding: 0.8rem; background: rgba(15, 23, 42, 0.6); border: 1px solid var(--border-color); border-radius: var(--radius-sm); color: var(--text-main); outline: none;">
        </div>

        <div class="form-group" style="margin-bottom: 2rem;">
            <label class="form-label" for="role">Kullanıcı Rolü</label>
            <select class="form-control" name="role" id="role" required style="width: 100%; padding: 0.8rem; background: rgba(15, 23, 42, 0.8); border: 1px solid var(--border-color); border-radius: var(--radius-sm); color: var(--text-main); outline: none;">
                <option value="editor" <?php echo e(old('role') === 'editor' ? 'selected' : ''); ?>>İçerik Editörü (Belirli yetkilerle kısıtlı)</option>
                <option value="super_admin" <?php echo e(old('role') === 'super_admin' ? 'selected' : ''); ?>>Süper Yönetici (Tüm yetkiler açık)</option>
            </select>
        </div>

        <!-- Permissions Checkboxes -->
        <div id="permissions-section" style="margin-bottom: 2rem; border-top: 1px solid var(--border-color); padding-top: 1.5rem;">
            <h4 style="color: var(--primary); margin-bottom: 1rem; font-size: 1.05rem;">Bölüm İzinleri</h4>
            <p style="color: var(--text-muted); font-size: 0.85rem; margin-bottom: 1.25rem;">Bu kullanıcının yönetim panelinde hangi bölümlere erişebileceğini seçin.</p>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem;" id="checkboxes-container">
                <?php $__currentLoopData = $permissionsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div style="display: flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.02); padding: 0.8rem 1rem; border-radius: var(--radius-sm); border: 1px solid var(--border-color);">
                        <input type="checkbox" name="permissions[]" value="<?php echo e($key); ?>" id="perm_<?php echo e($key); ?>" <?php echo e(is_array(old('permissions')) && in_array($key, old('permissions')) ? 'checked' : ''); ?> style="width: 17px; height: 17px; accent-color: var(--primary); cursor: pointer;">
                        <label for="perm_<?php echo e($key); ?>" style="color: var(--text-main); font-size: 0.9rem; cursor: pointer; user-select: none;"><?php echo e($label); ?></label>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <div style="display: flex; gap: 1rem; justify-content: flex-end;">
            <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-outline" style="border-color: rgba(255,255,255,0.1); color: var(--text-muted); border-radius: var(--radius-sm);">İptal</a>
            <button type="submit" class="btn btn-primary" style="background: var(--primary); color: var(--bg-dark); border-radius: var(--radius-sm);">
                <i class="fas fa-save"></i> Kullanıcıyı Kaydet
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.getElementById('role');
        const checkboxes = document.querySelectorAll('#checkboxes-container input[type="checkbox"]');
        
        function handleRoleChange() {
            if (roleSelect.value === 'super_admin') {
                checkboxes.forEach(cb => {
                    cb.checked = true;
                    cb.disabled = true;
                });
            } else {
                checkboxes.forEach(cb => {
                    cb.disabled = false;
                });
            }
        }

        roleSelect.addEventListener('change', handleRoleChange);
        handleRoleChange(); // Run on load
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ahmet\Desktop\dioreal web\resources\views\admin\users\create.blade.php ENDPATH**/ ?>