@extends('admin.layouts.app')

@section('title', 'Journal Yazılarını Yönet')

@section('page_title', 'Journal')
@section('page_subtitle', 'Web sitesindeki journal (günlük/dergi) makalelerini buradan ekleyebilir, düzenleyebilir veya silebilirsiniz.')

@section('content')
    <div class="panel-card">
        <div class="panel-card-header">
            <h3 class="panel-card-title"><i class="fas fa-list"></i> Tüm Journal Yazıları</h3>
            <a href="{{ route('admin.journals.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Yeni Yazı Ekle
            </a>
        </div>
        
        <div class="table-responsive">
            <table class="premium-table">
                <thead>
                    <tr>
                        <th>Görsel</th>
                        <th>Yayın Tarihi</th>
                        <th>Yazı Başlığı (TR / EN)</th>
                        <th>Kategori / Etiket (TR / EN)</th>
                        <th style="width: 200px; text-align: center;">İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($journals as $journal)
                        <tr>
                            <td>
                                <img src="{{ asset($journal->img) }}" alt="" class="table-img">
                            </td>
                            <td>
                                <div style="font-weight: 500;">{{ $journal->date }}</div>
                            </td>
                            <td>
                                <div><strong>TR:</strong> {{ $journal->title['tr'] ?? '' }}</div>
                                <div style="color: var(--text-muted);"><strong>EN:</strong> {{ $journal->title['en'] ?? '' }}</div>
                            </td>
                            <td>
                                <div><span class="badge badge-primary">TR</span> {{ $journal->tag['tr'] ?? '' }}</div>
                                <div style="margin-top: 4px;"><span class="badge badge-primary" style="opacity:0.7;">EN</span> {{ $journal->tag['en'] ?? '' }}</div>
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem; justify-content: center; flex-wrap: wrap;">
                                    <a href="{{ route('journal.detay', $journal->slug_tr ?: ($journal->slug_en ?: $journal->id)) }}" class="btn btn-outline btn-sm" target="_blank" title="Sayfayı Görüntüle">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.journals.edit', $journal->id) }}" class="btn btn-outline btn-sm">
                                        <i class="fas fa-edit"></i> Düzenle
                                    </a>
                                    <form action="{{ route('admin.journals.destroy', $journal->id) }}" method="POST" onsubmit="return confirm('Bu journal yazısını silmek istediğinize emin misiniz?');" style="display: inline-block;">
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
                            <td colspan="5" style="text-align: center; color: var(--text-muted); padding: 3rem;">
                                <i class="fas fa-newspaper" style="font-size: 2rem; margin-bottom: 1rem; display: block; color: rgba(255,255,255,0.1);"></i>
                                Listelenecek journal yazısı bulunamadı.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
