@extends('admin.layouts.app')

@section('title', 'Etkinlikleri Yönet')

@section('page_title', 'Etkinlikler')
@section('page_subtitle', 'Web sitesindeki etkinlik ve organizasyon takvimini buradan ekleyebilir, düzenleyebilir veya silebilirsiniz.')

@section('content')
    <div class="panel-card">
        <div class="panel-card-header">
            <h3 class="panel-card-title"><i class="fas fa-list"></i> Tüm Etkinlikler</h3>
            <a href="{{ route('admin.events.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Yeni Etkinlik Ekle
            </a>
        </div>
        
        <div class="table-responsive">
            <table class="premium-table">
                <thead>
                    <tr>
                        <th>Görsel</th>
                        <th>Tarih (Gün / Ay)</th>
                        <th>Etkinlik Adı (TR / EN)</th>
                        <th>Lokasyon (TR / EN)</th>
                        <th>Kategori (TR / EN)</th>
                        <th style="width: 200px; text-align: center;">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events as $event)
                        <tr>
                            <td>
                                <img src="{{ asset($event->img) }}" alt="" class="table-img">
                            </td>
                            <td>
                                <div style="font-size: 1.2rem; font-weight: 700; color: var(--primary);">{{ $event->day }}</div>
                                <div style="font-size: 0.8rem; text-transform: uppercase;">
                                    TR: {{ $event->month['tr'] ?? '' }}<br>
                                    EN: {{ $event->month['en'] ?? '' }}
                                </div>
                            </td>
                            <td>
                                <div><strong>TR:</strong> {{ $event->title['tr'] ?? '' }}</div>
                                <div style="color: var(--text-muted);"><strong>EN:</strong> {{ $event->title['en'] ?? '' }}</div>
                            </td>
                            <td>
                                <div><strong>TR:</strong> {{ $event->loc['tr'] ?? '' }}</div>
                                <div style="color: var(--text-muted);"><strong>EN:</strong> {{ $event->loc['en'] ?? '' }}</div>
                            </td>
                            <td>
                                <div><span class="badge badge-primary">TR</span> {{ $event->tag['tr'] ?? '' }}</div>
                                <div style="margin-top: 4px;"><span class="badge badge-primary" style="opacity:0.7;">EN</span> {{ $event->tag['en'] ?? '' }}</div>
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                    <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-outline btn-sm">
                                        <i class="fas fa-edit"></i> Düzenle
                                    </a>
                                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Bu etkinliği silmek istediğinize emin misiniz?');" style="display: inline-block;">
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
                                <i class="fas fa-calendar-alt" style="font-size: 2rem; margin-bottom: 1rem; display: block; color: rgba(255,255,255,0.1);"></i>
                                Listelenecek etkinlik bulunamadı.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
