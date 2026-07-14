@extends('admin.layouts.app')

@section('title', 'Etkinliği Düzenle')

@section('page_title', 'Etkinliği Düzenle')
@section('page_subtitle', 'Mevcut etkinlik bilgilerini ve görsellerini güncelleyin.')

@section('content')
    <div class="panel-card">
        <div class="panel-card-header">
            <h3 class="panel-card-title"><i class="fas fa-edit"></i> Etkinlik Düzenleme Formu</h3>
            <a href="{{ route('admin.events.index') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Geri Dön
            </a>
        </div>
        
        <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Language Switcher Tabs -->
            <div class="lang-tabs-container">
                <button type="button" class="lang-tab active" data-lang="tr" onclick="switchLanguageTab('tr')">
                    Türkçe (TR)
                </button>
                <button type="button" class="lang-tab" data-lang="en" onclick="switchLanguageTab('en')">
                    English (EN)
                </button>
            </div>

            <!-- Turkish Translation Pane -->
            <div class="lang-pane active" data-lang="tr">
                <div class="form-group">
                    <label class="form-label" for="title_tr">Etkinlik Başlığı (TR)</label>
                    <input type="text" name="title[tr]" id="title_tr" class="form-control" value="{{ old('title.tr', $event->title['tr'] ?? '') }}" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="tag_tr">Kategori / Etiket (TR)</label>
                    <input type="text" name="tag[tr]" id="tag_tr" class="form-control" value="{{ old('tag.tr', $event->tag['tr'] ?? '') }}">
                </div>

                <div class="form-group">
                    <label class="form-label" for="month_tr">Ay Bilgisi (TR)</label>
                    <input type="text" name="month[tr]" id="month_tr" class="form-control" value="{{ old('month.tr', $event->month['tr'] ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="loc_tr">Mekan / Lokasyon (TR)</label>
                    <input type="text" name="loc[tr]" id="loc_tr" class="form-control" value="{{ old('loc.tr', $event->loc['tr'] ?? '') }}" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="desc_tr">Açıklama (TR)</label>
                    <textarea name="desc[tr]" id="desc_tr" class="form-control" required style="min-height: 120px;">{{ old('desc.tr', $event->desc['tr'] ?? '') }}</textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="long_desc_tr">Detaylı Açıklama (TR)</label>
                    <textarea name="long_desc[tr]" id="long_desc_tr" class="form-control" style="min-height: 200px;">{{ old('long_desc.tr', $event->long_desc['tr'] ?? '') }}</textarea>
                </div>
            </div>

            <!-- English Translation Pane -->
            <div class="lang-pane" data-lang="en">
                <div class="form-group">
                    <label class="form-label" for="title_en">Event Title (EN)</label>
                    <input type="text" name="title[en]" id="title_en" class="form-control" value="{{ old('title.en', $event->title['en'] ?? '') }}" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="tag_en">Category / Tag (EN)</label>
                    <input type="text" name="tag[en]" id="tag_en" class="form-control" value="{{ old('tag.en', $event->tag['en'] ?? '') }}">
                </div>

                <div class="form-group">
                    <label class="form-label" for="month_en">Month Info (EN)</label>
                    <input type="text" name="month[en]" id="month_en" class="form-control" value="{{ old('month.en', $event->month['en'] ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="loc_en">Venue / Location (EN)</label>
                    <input type="text" name="loc[en]" id="loc_en" class="form-control" value="{{ old('loc.en', $event->loc['en'] ?? '') }}" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="desc_en">Description (EN)</label>
                    <textarea name="desc[en]" id="desc_en" class="form-control" required style="min-height: 120px;">{{ old('desc.en', $event->desc['en'] ?? '') }}</textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="long_desc_en">Detailed Description (EN)</label>
                    <textarea name="long_desc[en]" id="long_desc_en" class="form-control" style="min-height: 200px;">{{ old('long_desc.en', $event->long_desc['en'] ?? '') }}</textarea>
                </div>
            </div>

            <!-- Shared General Content -->
            <hr style="border: 0; border-top: 1px solid var(--border-color); margin: 2rem 0;">

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                <!-- Day Info & Video fields -->
                <div>
                    <div class="form-group" style="margin-bottom: 1.5rem;">
                        <label class="form-label" for="day">Gün Bilgisi (Sayısal veya Aralık)</label>
                        <input type="text" name="day" id="day" class="form-control" value="{{ old('day', $event->day) }}" required>
                    </div>

                    <div style="margin-top: 2rem;">
                        <label class="form-label" for="video_file">Video Yükle / Değiştir (MP4 / MOV)</label>
                        <input type="file" name="video_file" id="video_file" accept="video/*" class="form-control" style="margin-bottom: 1rem;">
                        @if($event->video_file)
                            <span style="font-size: 0.8rem; color: var(--text-muted); display: block; margin-top: 0.25rem;">Mevcut: {{ $event->video_file }}</span>
                            <div style="display: flex; align-items: center; gap: 0.5rem; margin-top: 0.5rem; margin-bottom: 1rem;">
                                <input type="checkbox" name="delete_video_file" id="delete_video_file" value="1">
                                <label class="form-label" for="delete_video_file" style="margin-bottom: 0; color: #ef4444; cursor: pointer; font-weight: 500;">
                                    <i class="fas fa-trash-alt"></i> Mevcut Videoyu Sil
                                </label>
                            </div>
                        @endif
                        
                        <label class="form-label" for="video_url">YouTube Video Linki</label>
                        <input type="text" name="video_url" id="video_url" class="form-control" placeholder="Örn: https://www.youtube.com/watch?v=..." value="{{ old('video_url', $event->video_url) }}" style="margin-bottom: 1rem;">
                        
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-top: 1rem;">
                            <input type="checkbox" name="show_video_on_cover" id="show_video_on_cover" value="1" {{ old('show_video_on_cover', $event->show_video_on_cover) ? 'checked' : '' }}>
                            <label class="form-label" for="show_video_on_cover" style="margin-bottom:0; cursor:pointer;">Kapakta Video Göster</label>
                        </div>
                    </div>
                </div>

                <!-- Cover Image -->
                <div>
                    <label class="form-label">Görsel (Kapak)</label>
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <input type="file" name="img_file" id="img_file" accept="image/*" style="display:none;" onchange="previewImage(this, 'img_preview')">
                        <button type="button" class="btn btn-outline" onclick="document.getElementById('img_file').click()">
                            <i class="fas fa-sync-alt"></i> Farklı Bir Görsel Seç
                        </button>
                        
                        <div style="display: flex; gap: 1rem; align-items: center; margin-top: 0.5rem;">
                            <div>
                                <span style="font-size: 0.8rem; color: var(--text-muted); display: block; margin-bottom: 0.25rem;">Mevcut Görsel:</span>
                                <div class="image-preview-box" style="width: 150px; height: 100px;">
                                    <img src="{{ asset($event->img) }}" alt="">
                                </div>
                            </div>
                            <i class="fas fa-arrow-right" style="color: var(--text-muted);"></i>
                            <div>
                                <span style="font-size: 0.8rem; color: var(--text-muted); display: block; margin-bottom: 0.25rem;">Yeni Görsel Önizleme:</span>
                                <div class="image-preview-box" id="img_preview" style="width: 150px; height: 100px;">
                                    <span class="image-preview-text">Değişiklik Yok</span>
                                </div>
                            </div>
                        </div>

                        <div style="margin-top: 1rem;">
                            <label class="form-label" for="img_url">Veya Görsel Yolu (Manuel)</label>
                            <input type="text" name="img_url" id="img_url" class="form-control" value="{{ old('img_url', $event->img) }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                <a href="{{ route('admin.events.index') }}" class="btn btn-outline">İptal Et</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Güncelle ve Yayınla
                </button>
            </div>
        </form>
    </div>

    <!-- Image Previews Handler -->
    <script>
        function previewImage(input, previewId) {
            const previewBox = document.getElementById(previewId);
            previewBox.innerHTML = '';
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.setAttribute('src', e.target.result);
                    previewBox.appendChild(img);
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                previewBox.innerHTML = '<span class="image-preview-text">Değişiklik Yok</span>';
            }
        }
    </script>
@endsection
