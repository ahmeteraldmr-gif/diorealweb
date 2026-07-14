@extends('admin.layouts.app')

@section('title', 'Oteli Düzenle')

@section('page_title', 'Oteli Düzenle')
@section('page_subtitle', 'Mevcut otel bilgilerini ve görsellerini güncelleyin.')

@section('content')
    <div class="panel-card">
        <div class="panel-card-header">
            <h3 class="panel-card-title"><i class="fas fa-edit"></i> Otel Düzenleme Formu</h3>
            <a href="{{ route('admin.hotels.index') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Geri Dön
            </a>
        </div>
        
        <form action="{{ route('admin.hotels.update', $hotel->id) }}" method="POST" enctype="multipart/form-data">
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
                    <label class="form-label" for="name_tr">Otel Adı (TR)</label>
                    <input type="text" name="name[tr]" id="name_tr" class="form-control" value="{{ old('name.tr', $hotel->name['tr'] ?? '') }}" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="tag_tr">Kategori / Etiket (TR)</label>
                    <input type="text" name="tag[tr]" id="tag_tr" class="form-control" value="{{ old('tag.tr', $hotel->tag['tr'] ?? '') }}">
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="desc_tr">Kısa Açıklama (TR)</label>
                    <textarea name="desc[tr]" id="desc_tr" class="form-control" required>{{ old('desc.tr', $hotel->desc['tr'] ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label" for="long_desc_tr">Detaylı Açıklama (TR)</label>
                    <textarea name="long_desc[tr]" id="long_desc_tr" class="form-control">{{ old('long_desc.tr', $hotel->long_desc['tr'] ?? '') }}</textarea>
                </div>
            </div>

            <!-- English Translation Pane -->
            <div class="lang-pane" data-lang="en">
                <div class="form-group">
                    <label class="form-label" for="name_en">Hotel Name (EN)</label>
                    <input type="text" name="name[en]" id="name_en" class="form-control" value="{{ old('name.en', $hotel->name['en'] ?? '') }}" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="tag_en">Category / Tag (EN)</label>
                    <input type="text" name="tag[en]" id="tag_en" class="form-control" value="{{ old('tag.en', $hotel->tag['en'] ?? '') }}">
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="desc_en">Short Description (EN)</label>
                    <textarea name="desc[en]" id="desc_en" class="form-control">{{ old('desc.en', $hotel->desc['en'] ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label" for="long_desc_en">Detailed Description (EN)</label>
                    <textarea name="long_desc[en]" id="long_desc_en" class="form-control">{{ old('long_desc.en', $hotel->long_desc['en'] ?? '') }}</textarea>
                </div>
            </div>

            <!-- Shared General Content -->
            <hr style="border: 0; border-top: 1px solid var(--border-color); margin: 2rem 0;">

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                <!-- Cover Image -->
                <div>
                    <label class="form-label">Ana Görsel (Kapak)</label>
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <input type="file" name="img_file" id="img_file" accept="image/*" style="display:none;" onchange="previewImage(this, 'img_preview')">
                        <button type="button" class="btn btn-outline" onclick="document.getElementById('img_file').click()">
                            <i class="fas fa-sync-alt"></i> Farklı Bir Görsel Seç
                        </button>
                        
                        <div style="display: flex; gap: 1rem; align-items: center; margin-top: 0.5rem;">
                            <div>
                                <span style="font-size: 0.8rem; color: var(--text-muted); display: block; margin-bottom: 0.25rem;">Mevcut Görsel:</span>
                                <div class="image-preview-box">
                                    <img src="{{ asset($hotel->img) }}" alt="">
                                </div>
                            </div>
                            <i class="fas fa-arrow-right" style="color: var(--text-muted);"></i>
                            <div>
                                <span style="font-size: 0.8rem; color: var(--text-muted); display: block; margin-bottom: 0.25rem;">Yeni Görsel Önizleme:</span>
                                <div class="image-preview-box" id="img_preview">
                                    <span class="image-preview-text">Değişiklik Yok</span>
                                </div>
                            </div>
                        </div>

                        <div style="margin-top: 1rem;">
                            <label class="form-label" for="img_url">Veya Görsel Yolu (Manuel)</label>
                            <input type="text" name="img_url" id="img_url" class="form-control" value="{{ old('img_url', $hotel->img) }}">
                        </div>
                    </div>
                </div>

                <!-- Gallery Upload & Editing -->
                <div>
                    <label class="form-label">Galeri Görselleri (Çoklu)</label>
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <input type="file" name="gallery_files[]" id="gallery_files" accept="image/*" multiple style="display:none;" onchange="previewMultipleImages(this, 'gallery_preview')">
                        <button type="button" class="btn btn-outline" onclick="document.getElementById('gallery_files').click()">
                            <i class="fas fa-plus"></i> Galeriye Görsel Ekle
                        </button>
                        
                        <div id="gallery_preview" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(70px, 1fr)); gap: 0.5rem; margin-top: 0.5rem; min-height: 50px; border: 1px dashed var(--border-color); padding: 0.5rem; border-radius: var(--radius-sm); background: rgba(15,23,42,0.3);">
                            <div style="grid-column: 1/-1; display:flex; align-items:center; justify-content:center; color: var(--text-muted); font-size: 0.8rem;" id="gallery_preview_text">
                                Yeni Eklenen Görsel Yok
                            </div>
                        </div>

                        <!-- Existing Gallery Management -->
                        <div style="margin-top: 1.5rem;">
                            <label class="form-label">Mevcut Galeri Görselleri (Sürükleyip sıralayabilir, kapak seçebilir ve silebilirsiniz)</label>
                            <div id="gallery-sortable-container">
                                @if($hotel->gallery && count($hotel->gallery) > 0)
                                    @foreach($hotel->gallery as $g)
                                        <div class="gallery-item {{ $g == $hotel->img ? 'is-cover' : '' }}" data-path="{{ $g }}">
                                            <img src="{{ str_starts_with($g, 'data:') ? $g : asset($g) }}" alt="">
                                            <span class="cover-badge {{ $g == $hotel->img ? '' : 'd-none' }}">KAPAK</span>
                                            <div class="item-controls">
                                                <button type="button" class="control-btn make-cover-btn" title="Kapak Yap"><i class="fas fa-image"></i> Kapak Yap</button>
                                                <button type="button" class="control-btn remove-gallery-item-btn" title="Kaldır"><i class="fas fa-trash-alt"></i></button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <input type="hidden" name="cover_image" id="cover_image" value="{{ $hotel->img }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings, Association & Videos -->
            <hr style="border: 0; border-top: 1px solid var(--border-color); margin: 2rem 0;">

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                <div>
                    <label class="form-label" for="destination_id">Ülke / Destinasyon</label>
                    <select name="destination_id" id="destination_id" class="form-control">
                        <option value="">-- Ülke Seçin --</option>
                        @foreach($destinations as $dest)
                            <option value="{{ $dest->id }}" {{ old('destination_id', $hotel->destination_id) == $dest->id ? 'selected' : '' }}>
                                {{ $dest->name['tr'] ?? '' }} ({{ $dest->region['tr'] ?? '' }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label" for="order">Sıralama (Öncelik)</label>
                    <input type="number" name="order" id="order" class="form-control" placeholder="0" value="{{ old('order', $hotel->order) }}">
                </div>
                <div style="display: flex; flex-direction: column; gap: 0.75rem; margin-top: 1.5rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <input type="checkbox" name="is_archived" id="is_archived" value="1" {{ old('is_archived', $hotel->is_archived) ? 'checked' : '' }}>
                        <label class="form-label" for="is_archived" style="margin-bottom:0; cursor:pointer;">Bu Oteli Arşivle (Yayından Kaldır)</label>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <input type="checkbox" name="show_video_on_cover" id="show_video_on_cover" value="1" {{ old('show_video_on_cover', $hotel->show_video_on_cover) ? 'checked' : '' }}>
                        <label class="form-label" for="show_video_on_cover" style="margin-bottom:0; cursor:pointer;">Kapakta Video Göster (Kapak resmi yerine video oynatır)</label>
                    </div>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                <div>
                    <label class="form-label">Video Yükle / Değiştir (MP4 / MOV)</label>
                    <input type="file" name="video_file" id="video_file" accept="video/*" class="form-control">
                    @if($hotel->video_file)
                        <span style="font-size: 0.8rem; color: var(--text-muted); display: block; margin-top: 0.25rem;">Mevcut: {{ $hotel->video_file }}</span>
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-top: 0.5rem;">
                            <input type="checkbox" name="delete_video_file" id="delete_video_file" value="1">
                            <label class="form-label" for="delete_video_file" style="margin-bottom: 0; color: #ef4444; cursor: pointer; font-weight: 500;">
                                <i class="fas fa-trash-alt"></i> Mevcut Videoyu Sil
                            </label>
                        </div>
                    @endif
                </div>
                <div>
                    <label class="form-label" for="video_url">YouTube Video Linki</label>
                    <input type="text" name="video_url" id="video_url" class="form-control" placeholder="Örn: https://www.youtube.com/watch?v=..." value="{{ old('video_url', $hotel->video_url) }}">
                </div>
            </div>

            <!-- Submit Buttons -->
            <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                <a href="{{ route('admin.hotels.index') }}" class="btn btn-outline">İptal Et</a>
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

        function previewMultipleImages(input, previewGridId) {
            const previewGrid = document.getElementById(previewGridId);
            previewGrid.innerHTML = '';
            
            if (input.files && input.files.length > 0) {
                for (let i = 0; i < input.files.length; i++) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const div = document.createElement('div');
                        div.style.width = '100%';
                        div.style.aspectRatio = '1';
                        div.style.borderRadius = '4px';
                        div.style.overflow = 'hidden';
                        div.style.border = '1px solid var(--border-color)';
                        
                        const img = document.createElement('img');
                        img.setAttribute('src', e.target.result);
                        img.style.width = '100%';
                        img.style.height = '100%';
                        img.style.objectFit = 'cover';
                        
                        div.appendChild(img);
                        previewGrid.appendChild(div);
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            } else {
                previewGrid.innerHTML = '<div style="grid-column: 1/-1; display:flex; align-items:center; justify-content:center; color: var(--text-muted); font-size: 0.8rem;">Yeni Eklenen Görsel Yok</div>';
            }
        }
    </script>
    <script src="{{ asset('js/admin-drag-drop.js') }}"></script>
@endsection
