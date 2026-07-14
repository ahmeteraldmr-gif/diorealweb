@extends('admin.layouts.app')

@section('title', 'Otelleri Yönet')

@section('page_title', 'Oteller')
@section('page_subtitle', 'Web sitesindeki otel koleksiyonunu buradan ekleyebilir, düzenleyebilir veya silebilirsiniz.')

@section('content')
    <div class="panel-card">
        <div class="panel-card-header">
            <h3 class="panel-card-title"><i class="fas fa-list"></i> Tüm Oteller</h3>
            <a href="{{ route('admin.hotels.create') }}" class="btn btn-primary">
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
                    @forelse($hotels as $hotel)
                        <tr>
                            <td>
                                <img src="{{ asset($hotel->img) }}" alt="" class="table-img">
                            </td>
                            <td>
                                <div><strong>TR:</strong> {{ $hotel->name['tr'] ?? '' }}</div>
                                <div style="color: var(--text-muted);"><strong>EN:</strong> {{ $hotel->name['en'] ?? '' }}</div>
                            </td>
                            <td>
                                <div><span class="badge badge-primary">TR</span> {{ $hotel->tag['tr'] ?? '' }}</div>
                                <div style="margin-top: 4px;"><span class="badge badge-primary" style="opacity:0.7;">EN</span> {{ $hotel->tag['en'] ?? '' }}</div>
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                    <a href="{{ route('admin.hotels.edit', $hotel->id) }}" class="btn btn-outline btn-sm">
                                        <i class="fas fa-edit"></i> Düzenle
                                    </a>
                                    <form action="{{ route('admin.hotels.destroy', $hotel->id) }}" method="POST" onsubmit="return confirm('Bu oteli silmek istediğinize emin misiniz?');" style="display: inline-block;">
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
                                <i class="fas fa-hotel" style="font-size: 2rem; margin-bottom: 1rem; display: block; color: rgba(255,255,255,0.1);"></i>
                                Listelenecek otel kaydı bulunamadı.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
