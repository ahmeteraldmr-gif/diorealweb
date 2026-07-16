@extends('admin.layouts.app')

@section('title', 'Kullanıcı Düzenle')

@section('page_title', 'Kullanıcı Düzenle')
@section('page_subtitle', 'Kullanıcı rolünü, şifresini ve erişim izinlerini buradan güncelleyebilirsiniz.')

@section('content')
<div class="panel-card" style="max-width: 800px; margin: 0 auto;">
    <div class="panel-card-header">
        <h3 class="panel-card-title">
            <i class="fas fa-user-edit" style="color: var(--primary); margin-right: 0.5rem;"></i> Kullanıcı Düzenle: {{ $user->name }}
        </h3>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline" style="border-color: rgba(255,255,255,0.1); color: var(--text-muted); padding: 0.5rem 1rem; border-radius: var(--radius-sm);">
            <i class="fas fa-arrow-left"></i> Geri Dön
        </a>
    </div>

    @if ($errors->any())
        <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); padding: 1rem; border-radius: var(--radius-sm); margin-bottom: 1.5rem; color: #ef4444;">
            <ul style="margin: 0; padding-left: 1.25rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label class="form-label" for="name">Ad Soyad</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name', $user->name) }}" placeholder="Örn: Ahmet Yılmaz" required style="width: 100%; padding: 0.8rem; background: rgba(15, 23, 42, 0.6); border: 1px solid var(--border-color); border-radius: var(--radius-sm); color: var(--text-main); outline: none;">
        </div>

        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label class="form-label" for="email">E-posta veya Kullanc Ad</label>
            <input type="text" class="form-control" name="email" id="email" value="{{ old('email', $user->email) }}" placeholder="Kullanc Ad veya E-posta" required style="width: 100%; padding: 0.8rem; background: rgba(15, 23, 42, 0.6); border: 1px solid var(--border-color); border-radius: var(--radius-sm); color: var(--text-main); outline: none;">
        </div>

        <div class="form-group" style="margin-bottom: 1.5rem;">
            <label class="form-label" for="password">Yeni Şifre (Değiştirmek istemiyorsanız boş bırakın)</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="En az 6 karakter" style="width: 100%; padding: 0.8rem; background: rgba(15, 23, 42, 0.6); border: 1px solid var(--border-color); border-radius: var(--radius-sm); color: var(--text-main); outline: none;">
        </div>

        <div class="form-group" style="margin-bottom: 2rem;">
            <label class="form-label" for="role">Kullanıcı Rolü</label>
            <select class="form-control" name="role" id="role" required style="width: 100%; padding: 0.8rem; background: rgba(15, 23, 42, 0.8); border: 1px solid var(--border-color); border-radius: var(--radius-sm); color: var(--text-main); outline: none;">
                <option value="editor" {{ old('role', $user->role) === 'editor' ? 'selected' : '' }}>İçerik Editörü (Belirli yetkilerle kısıtlı)</option>
                <option value="super_admin" {{ old('role', $user->role) === 'super_admin' ? 'selected' : '' }}>Süper Yönetici (Tüm yetkiler açık)</option>
            </select>
        </div>

        <!-- Permissions Checkboxes -->
        <div id="permissions-section" style="margin-bottom: 2rem; border-top: 1px solid var(--border-color); padding-top: 1.5rem;">
            <h4 style="color: var(--primary); margin-bottom: 1rem; font-size: 1.05rem;">Bölüm İzinleri</h4>
            <p style="color: var(--text-muted); font-size: 0.85rem; margin-bottom: 1.25rem;">Bu kullanıcının yönetim panelinde hangi bölümlere erişebileceğini seçin.</p>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem;" id="checkboxes-container">
                @foreach($permissionsList as $key => $label)
                    @php
                        $hasPerm = is_array(old('permissions', $user->permissions)) && in_array($key, old('permissions', $user->permissions));
                    @endphp
                    <div style="display: flex; align-items: center; gap: 0.5rem; background: rgba(255,255,255,0.02); padding: 0.8rem 1rem; border-radius: var(--radius-sm); border: 1px solid var(--border-color);">
                        <input type="checkbox" name="permissions[]" value="{{ $key }}" id="perm_{{ $key }}" {{ $hasPerm ? 'checked' : '' }} style="width: 17px; height: 17px; accent-color: var(--primary); cursor: pointer;">
                        <label for="perm_{{ $key }}" style="color: var(--text-main); font-size: 0.9rem; cursor: pointer; user-select: none;">{{ $label }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <div style="display: flex; gap: 1rem; justify-content: flex-end;">
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline" style="border-color: rgba(255,255,255,0.1); color: var(--text-muted); border-radius: var(--radius-sm);">İptal</a>
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
@endsection
