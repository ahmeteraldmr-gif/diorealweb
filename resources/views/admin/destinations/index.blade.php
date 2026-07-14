@extends('admin.layouts.app')

@section('title', 'Destinasyonları Yönet')

@section('page_title', 'Destinasyonlar')
@section('page_subtitle', 'Web sitesindeki anasayfa destinasyon kartlarını (Türkiye\'nin Ruhu & Yurtdışı alanları) yönetin.')

@section('content')
    <div class="panel-card">
        <div class="panel-card-header">
            <h3 class="panel-card-title"><i class="fas fa-map-signs"></i> Tüm Destinasyonlar</h3>
            <a href="{{ route('admin.destinations.create') }}" class="btn btn-primary">
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
                    @forelse($destinations as $destination)
                        <tr>
                            <td>
                                <img src="{{ asset($destination->img) }}" alt="" class="table-img" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                            </td>
                            <td>
                                <div><strong>TR:</strong> {{ $destination->name['tr'] ?? '' }}</div>
                                <div style="color: var(--text-muted);"><strong>EN:</strong> {{ $destination->name['en'] ?? '' }}</div>
                            </td>
                            <td>
                                <div><strong>TR:</strong> {{ $destination->region['tr'] ?? '' }}</div>
                                <div style="color: var(--text-muted);"><strong>EN:</strong> {{ $destination->region['en'] ?? '' }}</div>
                            </td>
                            <td>
                                <span class="badge badge-primary">
                                    @switch($destination->type)
                                        @case('turkiye')
                                            Türkiye'nin Ruhu
                                            @break
                                        @case('yurtdisi_popular')
                                            Yurtdışı - En Popüler
                                            @break
                                        @case('yurtdisi_traveller')
                                            Yurtdışı - Gezgine Göre
                                            @break
                                        @case('yurtdisi_month')
                                            Yurtdışı - Aya Göre
                                            @break
                                        @case('yurtdisi_spotlight')
                                            Yurtdışı - Vitrindekiler
                                            @break
                                        @default
                                            {{ $destination->type }}
                                    @endswitch
                                </span>
                            </td>
                            <td style="text-align: center;">
                                {{ $destination->order }}
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                    <a href="{{ route('admin.destinations.edit', $destination->id) }}" class="btn btn-outline btn-sm">
                                        <i class="fas fa-edit"></i> Düzenle
                                    </a>
                                    <form action="{{ route('admin.destinations.destroy', $destination->id) }}" method="POST" onsubmit="return confirm('Bu destinasyonu silmek istediğinize emin misiniz?');" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Sil
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; color: var(--text-muted); padding: 3rem;">
                                <i class="fas fa-map-signs" style="font-size: 2rem; margin-bottom: 1rem; display: block; color: rgba(255,255,255,0.1);"></i>
                                Listelenecek destinasyon kaydı bulunamadı.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
