@extends('admin.layouts.app')

@yield('title', 'Kullanıcılar & Yetkiler')

@section('page_title', 'Kullanıcılar & Yetkiler')
@section('page_subtitle', 'Sisteme erişebilen yöneticilerin ve içerik editörlerinin yönetimi.')

@section('content')
<div class="panel-card">
    <div class="panel-card-header">
        <h3 class="panel-card-title">
            <i class="fas fa-users" style="color: var(--primary); margin-right: 0.5rem;"></i> Kayıtlı Kullanıcılar
        </h3>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary" style="background: var(--primary); color: var(--bg-dark); border-radius: var(--radius-sm);">
            <i class="fas fa-user-plus"></i> Yeni Kullanıcı Ekle
        </a>
    </div>

    @if ($errors->has('delete_error'))
        <div class="alert alert-error" style="margin-bottom: 1.5rem; background: rgba(248, 113, 113, 0.1); color: var(--error); border: 1px solid rgba(248, 113, 113, 0.2); padding: 1rem; border-radius: var(--radius-md); display: flex; align-items: center; gap: 0.5rem;">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ $errors->first('delete_error') }}</span>
        </div>
    @endif

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
                @foreach ($users as $user)
                    <tr>
                        <td style="font-weight: 600; color: var(--white);">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->role === 'super_admin')
                                <span class="badge badge-primary">Süper Yönetici</span>
                            @else
                                <span class="badge" style="background: rgba(148, 163, 184, 0.12); color: var(--text-muted); border: 1px solid rgba(148, 163, 184, 0.25);">İçerik Editörü</span>
                            @endif
                        </td>
                        <td>
                            @if ($user->role === 'super_admin')
                                <span class="badge badge-primary" style="font-size: 0.7rem;">Tüm Yetkiler</span>
                            @elseif (empty($user->permissions) || count($user->permissions) === 0)
                                <span style="color: var(--text-muted); font-size: 0.85rem; font-style: italic;">Yetki tanımlanmamış</span>
                            @else
                                <div style="display: flex; flex-wrap: wrap; gap: 0.3rem;">
                                    @foreach ($user->permissions as $perm)
                                        <span class="badge" style="background: rgba(255, 255, 255, 0.05); color: var(--text-muted); border: 1px solid rgba(255, 255, 255, 0.1); font-size: 0.7rem;">
                                            @switch($perm)
                                                @case('hotels') Oteller @break
                                                @case('restaurants') Restoranlar @break
                                                @case('yachts') Yatlar @break
                                                @case('guides') Gezi Rehberi @break
                                                @case('events') Etkinlikler @break
                                                @case('journals') Journal @break
                                                @case('settings') Genel Ayarlar @break
                                                @case('users') Kullanıcılar @break
                                                @default {{ $perm }}
                                            @endswitch
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </td>
                        <td style="text-align: right;">
                            <div style="display: inline-flex; gap: 0.5rem; justify-content: flex-end;">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-outline" style="padding: 0.4rem 0.8rem; font-size: 0.8rem; border-color: rgba(255,255,255,0.1); color: var(--text-muted); border-radius: var(--radius-sm);">
                                    <i class="fas fa-edit"></i> Düzenle
                                </a>
                                
                                @if($user->email !== 'admin@dioreal.com' && (!auth()->check() || auth()->id() !== $user->id))
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Bu kullanıcıyı silmek istediğinize emin misiniz?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn" style="padding: 0.4rem 0.8rem; font-size: 0.8rem; background: rgba(248, 113, 113, 0.1); color: var(--error); border: 1px solid rgba(248, 113, 113, 0.2); border-radius: var(--radius-sm);">
                                            <i class="fas fa-trash-alt"></i> Sil
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
