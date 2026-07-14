@extends('admin.layouts.app')

@section('title', 'Gezi Rehberlerini Yönet')

@section('page_title', 'Gezi Rehberi')
@section('page_subtitle', 'Web sitesindeki seyahat ve gezi rehberlerini buradan ekleyebilir, düzenleyebilir veya silebilirsiniz.')

@section('content')
    <div class="panel-card">
        <div class="panel-card-header">
            <h3 class="panel-card-title"><i class="fas fa-list"></i> Tüm Gezi Rehberleri</h3>
            <a href="{{ route('admin.guides.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Yeni Rehber Ekle
            </a>
        </div>
        
        <div class="table-responsive">
            <table class="premium-table">
                <thead>
                    <tr>
                        <th>Görsel</th>
                        <th>Başlık (TR / EN)</th>
                        <th>Kategori / Bölge (TR / EN)</th>
                        <th style="width: 200px; text-align: center;">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($guides as $guide)
                        <tr>
                            <td>
                                <img src="{{ asset($guide->img) }}" alt="" class="table-img">
                            </td>
                            <td>
                                <div><strong>TR:</strong> {{ $guide->title['tr'] ?? '' }}</div>
                                <div style="color: var(--text-muted);"><strong>EN:</strong> {{ $guide->title['en'] ?? '' }}</div>
                            </td>
                            <td>
                                <div><span class="badge badge-primary">TR</span> {{ $guide->tag['tr'] ?? '' }}</div>
                                <div style="margin-top: 4px;"><span class="badge badge-primary" style="opacity:0.7;">EN</span> {{ $guide->tag['en'] ?? '' }}</div>
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                    <a href="{{ route('admin.guides.edit', $guide->id) }}" class="btn btn-outline btn-sm">
                                        <i class="fas fa-edit"></i> Düzenle
                                    </a>
                                    <form action="{{ route('admin.guides.destroy', $guide->id) }}" method="POST" onsubmit="return confirm('Bu rehberi silmek istediğinize emin misiniz?');" style="display: inline-block;">
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
                                <i class="fas fa-map-marked-alt" style="font-size: 2rem; margin-bottom: 1rem; display: block; color: rgba(255,255,255,0.1);"></i>
                                Listelenecek gezi rehberi bulunamadı.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
