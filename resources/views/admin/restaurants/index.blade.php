@extends('admin.layouts.app')

@section('title', 'Restoranları Yönet')

@section('page_title', 'Restoranlar')
@section('page_subtitle', 'Web sitesindeki restoran koleksiyonunu buradan ekleyebilir, düzenleyebilir veya silebilirsiniz.')

@section('content')
    <div class="panel-card">
        <div class="panel-card-header">
            <h3 class="panel-card-title"><i class="fas fa-list"></i> Tüm Restoranlar</h3>
            <a href="{{ route('admin.restaurants.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Yeni Restoran Ekle
            </a>
        </div>
        
        <div class="table-responsive">
            <table class="premium-table">
                <thead>
                    <tr>
                        <th>Görsel</th>
                        <th>Restoran Adı (TR / EN)</th>
                        <th>Kategori / Etiket (TR / EN)</th>
                        <th style="width: 200px; text-align: center;">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($restaurants as $restaurant)
                        <tr>
                            <td>
                                <img src="{{ asset($restaurant->img) }}" alt="" class="table-img">
                            </td>
                            <td>
                                <div><strong>TR:</strong> {{ $restaurant->name['tr'] ?? '' }}</div>
                                <div style="color: var(--text-muted);"><strong>EN:</strong> {{ $restaurant->name['en'] ?? '' }}</div>
                            </td>
                            <td>
                                <div><span class="badge badge-primary">TR</span> {{ $restaurant->tag['tr'] ?? '' }}</div>
                                <div style="margin-top: 4px;"><span class="badge badge-primary" style="opacity:0.7;">EN</span> {{ $restaurant->tag['en'] ?? '' }}</div>
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                    <a href="{{ route('admin.restaurants.edit', $restaurant->id) }}" class="btn btn-outline btn-sm">
                                        <i class="fas fa-edit"></i> Düzenle
                                    </a>
                                    <form action="{{ route('admin.restaurants.destroy', $restaurant->id) }}" method="POST" onsubmit="return confirm('Bu restoranı silmek istediğinize emin misiniz?');" style="display: inline-block;">
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
                            <td colspan="4" style="text-align: center; color: var(--text-muted); padding: 3rem;">
                                <i class="fas fa-utensils" style="font-size: 2rem; margin-bottom: 1rem; display: block; color: rgba(255,255,255,0.1);"></i>
                                Listelenecek restoran kaydı bulunamadı.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
