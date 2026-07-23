<?php $__env->startSection('title', 'Kullanıcı Düzenle'); ?>

<?php $__env->startSection('page_title', 'Kullanıcı Düzenle'); ?>
<?php $__env->startSection('page_subtitle', 'Kullanıcı rolünü, şifresini ve erişim izinlerini buradan güncelleyebilirsiniz.'); ?>

<?php $__env->startSection('content'); ?>
<div class="panel-card" style="max-width: 800px; margin: 0 auto;">
    <div class="panel-card-header">
        <h3 class="panel-card-title">
            <i class="fas fa-user-edit" style="color: var(--primary); margin-right: 0.5rem;"></i> Kullanıcı Düzenle: <?php echo e($user->name); ?>

        </h3>
        <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-outline" style="border-color: rgba(255,255,255,0.1); color: var(--text-muted); padding: 0.5rem 1rem; border-radius: var(--radius-sm);">
            <i class="fas fa-arrow-left"></i> Geri Dön
        </a>
    </div>

    <?php if($errors->any()): ?>
        <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); padding: 1rem; border-radius: var(--radius-sm); margin-bottom: 1.5rem; color: #ef4444;">
            <ul style="margin: 0; padding-left: 1.25rem;">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.users.update', $user->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label class="form-label" for="name">Ad Soyad</label>
            <input type="text" class="form-control" name="name" id="name" value="<?php echo e(old('name', $user->name)); ?>" placeholder="Örn: Ahmet Yılmaz" required style="width: 100%; padding: 0.8rem; background: rgba(15, 23, 42, 0.6); border: 1px solid var(--border-color); border-radius: var(--radius-sm); color: var(--text-main); outline: none;">
        </div>

        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label class="form-label" for="email">E-posta veya Kullanc Ad</label>
            <input type="text" class="form-control" name="email" id="email" value="<?php echo e(old('email', $user->email)); ?>" placeholder="Kullanc Ad veya E-posta" required style="width: 100%; padding: 0.8rem; background: rgba(15, 23, 42, 0.6); border: 1px solid var(--border-color); border-radius: var(--radius-sm); color: var(--text-main); outline: none;">
        </div>

        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label class="form-label" for="password">Yeni Şifre (Değiştirmek istemiyorsanız boş bırakın)</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="En az 6 karakter" style="width: 100%; padding: 0.8rem; background: rgba(15, 23, 42, 0.6); border: 1px solid var(--border-color); border-radius: var(--radius-sm); color: var(--text-main); outline: none;">
        </div>

        <div class="form-group" style="margin-bottom: 2rem;">
            <label class="form-label" for="role">Kullanıcı Rolü</label>
            <select class="form-control" name="role" id="role" required style="width: 100%; padding: 0.8rem; background: rgba(15, 23, 42, 0.8); border: 1px solid var(--border-color); border-radius: var(--radius-sm); color: var(--text-main); outline: none;">
                <option value="editor" <?php echo e(old('role', $user->role) === 'editor' ? 'selected' : ''); ?>>İçerik Editörü (Belirli yetkilerle kısıtlı)</option>
                <option value="super_admin" <?php echo e(old('role', $user->role) === 'super_admin' ? 'selected' : ''); ?>>Süper Yönetici (Tüm yetkiler açık)</option>
            </select>
        </div>

        <!-- Permissions Checkboxes -->
        <div id="permissions-section" style="margin-bottom: 2rem; border-top: 1px solid var(--border-color); padding-top: 1.5rem;">
            <h4 style="color: var(--primary); margin-bottom: 1rem; font-size: 1.05rem;">Bölüm İzinleri</h4>
            <p style="color: var(--text-muted); font-size: 0.85rem; margin-bottom: 1.25rem;">Bu kullanıcının yönetim panelinde hangi bölümlere erişebileceğini seçin.</p>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem;" id="checkboxes-container">
                <?php $__currentLoopData = $permissionsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $hasPerm = is_array(old('permissions', $user->permissions)) && in_array($key, old('permissions', $user->permissions));
                    ?>
                    <div style="display: flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.02); padding: 0.8rem 1rem; border-radius: var(--radius-sm); border: 1px solid var(--border-color);">
                        <input type="checkbox" name="permissions[]" value="<?php echo e($key); ?>" id="perm_<?php echo e($key); ?>" <?php echo e($hasPerm ? 'checked' : ''); ?> style="width: 17px; height: 17px; accent-color: var(--primary); cursor: pointer;">
                        <label for="perm_<?php echo e($key); ?>" style="color: var(--text-main); font-size: 0.9rem; cursor: pointer; user-select: none;"><?php echo e($label); ?></label>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <div style="display: flex; gap: 1rem; justify-content: flex-end;">
            <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-outline" style="border-color: rgba(255,255,255,0.1); color: var(--text-muted); border-radius: var(--radius-sm);">İptal</a>
            <button type="submit" class="btn btn-primary" style="background: var(--primary); color: var(--bg-dark); border-radius: var(--radius-sm);">
                <i class="fas fa-save"></i> Değişiklikleri Kaydet
            </button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.getElementById('role');
        const checkboxes = document.querySelectorAll('#checkboxes-container input[type="checkbox"]');
        
        function handleRoleChange() {
            if (roleSelect && roleSelect.value === 'super_admin') {
                checkboxes.forEach(cb => {
                    cb.checked = true;
                    cb.disabled = true;
                });
            } else {
                checkboxes.forEach(cb => {
                    if (roleSelect) {
                        cb.disabled = false;
                    } else {
                        // Admin email is super admin, we keep them disabled/checked
                        cb.checked = true;
                        cb.disabled = true;
                    }
                });
            }
        }

        if (roleSelect) {
            roleSelect.addEventListener('change', handleRoleChange);
        }
        handleRoleChange(); // Run on load
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ahmet\Desktop\dioreal web\resources\views\admin\users\edit.blade.php ENDPATH**/ ?>