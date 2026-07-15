@extends('admin.layouts.app')

@section('title', 'Yeni Etkinlik Ekle')

@section('page_title', 'Yeni Etkinlik Ekle')
@section('page_subtitle', 'Koleksiyona eklenecek yeni etkinliğin detaylarını girin.')

@section('content')
    <div class="panel-card">
        <div class="panel-card-header">
            <h3 class="panel-card-title"><i class="fas fa-plus-circle"></i> Etkinlik Formu</h3>
            <a href="{{ route('admin.events.index') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Geri Dön
            </a>
        </div>
        
        <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

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
                    <input type="text" name="title[tr]" id="title_tr" class="form-control" placeholder="Örn: Bodrum Caz Festivali" value="{{ old('title.tr') }}" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="tag_tr">Kategori / Etiket (TR)</label>
                    <input type="text" name="tag[tr]" id="tag_tr" class="form-control" placeholder="Örn: Müzik & Festival" value="{{ old('tag.tr') }}">
                </div>

                <div class="form-group">
                    <label class="form-label" for="month_tr">Ay Bilgisi (TR)</label>
                    <input type="text" name="month[tr]" id="month_tr" class="form-control" placeholder="Örn: HAZİRAN" value="{{ old('month.tr') }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="loc_tr">Mekan / Lokasyon (TR)</label>
                    <input type="text" name="loc[tr]" id="loc_tr" class="form-control" placeholder="Örn: Antik Tiyatro, Bodrum" value="{{ old('loc.tr') }}" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="desc_tr">Açıklama (TR)</label>
                    <textarea name="desc[tr]" id="desc_tr" class="form-control" placeholder="Etkinlik açıklaması..." required style="min-height: 120px;">{{ old('desc.tr') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label" for="long_desc_tr">Detaylı Açıklama (TR)</label>
                    <textarea name="long_desc[tr]" id="long_desc_tr" class="form-control" placeholder="Etkinlik detaylı açıklaması..." style="min-height: 200px;">{{ old('long_desc.tr') }}</textarea>
                </div>
            </div>

            <!-- English Translation Pane -->
            <div class="lang-pane" data-lang="en">
                <div class="form-group">
                    <label class="form-label" for="title_en">Event Title (EN)</label>
                    <input type="text" name="title[en]" id="title_en" class="form-control" placeholder="e.g. Bodrum Jazz Festival" value="{{ old('title.en') }}" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="tag_en">Category / Tag (EN)</label>
                    <input type="text" name="tag[en]" id="tag_en" class="form-control" placeholder="e.g. Music & Festival" value="{{ old('tag.en') }}">
                </div>

                <div class="form-group">
                    <label class="form-label" for="month_en">Month Info (EN)</label>
                    <input type="text" name="month[en]" id="month_en" class="form-control" placeholder="e.g. JUNE" value="{{ old('month.en') }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="loc_en">Venue / Location (EN)</label>
                    <input type="text" name="loc[en]" id="loc_en" class="form-control" placeholder="e.g. Antique Theatre, Bodrum" value="{{ old('loc.en') }}" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="desc_en">Description (EN)</label>
                    <textarea name="desc[en]" id="desc_en" class="form-control" placeholder="Event description..." required style="min-height: 120px;">{{ old('desc.en') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label" for="long_desc_en">Detailed Description (EN)</label>
                    <textarea name="long_desc[en]" id="long_desc_en" class="form-control" placeholder="Event detailed description..." style="min-height: 200px;">{{ old('long_desc.en') }}</textarea>
                </div>
            </div>

            <!-- Shared General Content -->
            <hr style="border: 0; border-top: 1px solid var(--border-color); margin: 2rem 0;">

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                <!-- Day Info & Video fields -->
                <div>
                    <div class="form-group" style="margin-bottom: 1.5rem;">
                        <label class="form-label" for="day">Gün Bilgisi (Sayısal veya Aralık)</label>
                        <input type="text" name="day" id="day" class="form-control" placeholder="Örn: 15 veya 15-18" value="{{ old('day') }}" required>
                        <small style="color: var(--text-muted); display:block; margin-top:0.25rem;">Etkinliğin yapılacağı günleri sayısal olarak girin.</small>
                    </div>

                    <div style="margin-top: 2rem;">
                        <label class="form-label" for="video_file">Video Yükle (MP4 / MOV)</label>
                        <input type="file" name="video_file" id="video_file" accept="video/*" class="form-control" style="margin-bottom: 1rem;">
                        
                        <label class="form-label" for="video_url">YouTube Video Linki</label>
                        <input type="text" name="video_url" id="video_url" class="form-control" placeholder="Örn: https://www.youtube.com/watch?v=..." value="{{ old('video_url') }}" style="margin-bottom: 1rem;">
                        
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-top: 1rem;">
                            <input type="checkbox" name="show_video_on_cover" id="show_video_on_cover" value="1" {{ old('show_video_on_cover') ? 'checked' : '' }}>
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
                            <i class="fas fa-image"></i> Görsel Dosyası Seç
                        </button>
                        
                        <div class="image-preview-box" id="img_preview" style="max-width: 300px; height: 180px;">
                            <span class="image-preview-text">Önizleme Yok</span>
                        </div>

                        <div style="margin-top: 1rem;">
                            <label class="form-label" for="img_url">Veya Görsel Yolu (Manuel)</label>
                            <input type="text" name="img_url" id="img_url" class="form-control" placeholder="Örn: foto.img/bodrum_event.jpg" value="{{ old('img_url') }}">
                        </div>
                    </div>
                </div>
            </div>

                        <!-- SEO Settings -->
            <hr style="border: 0; border-top: 1px solid var(--border-color); margin: 2rem 0;">
            <h4 class="form-section-title" style="margin-bottom: 1rem;"><i class="fas fa-search"></i> SEO ve Meta Ayarları</h4>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 1.5rem;">
                <div>
                    <label class="form-label" for="slug_tr">Özel URL Yapısı / Slug (TR)</label>
                    <input type="text" name="slug_tr" id="slug_tr" class="form-control" placeholder="Örn: mukemmel-deniz-manzarali-otel (Boş bırakılırsa isimden otomatik üretilir)" value="{{ old('slug_tr') }}">
                </div>
                <div>
                    <label class="form-label" for="slug_en">Özel URL Yapısı / Slug (EN)</label>
                    <input type="text" name="slug_en" id="slug_en" class="form-control" placeholder="e.g. perfect-sea-view-hotel" value="{{ old('slug_en') }}">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 1.5rem;">
                <div>
                    <label class="form-label" for="seo_title_tr">SEO Başlığı (TR)</label>
                    <input type="text" name="seo_title_tr" id="seo_title_tr" class="form-control" placeholder="Google'da görünecek başlık..." value="{{ old('seo_title_tr') }}">
                </div>
                <div>
                    <label class="form-label" for="seo_title_en">SEO Başlığı (EN)</label>
                    <input type="text" name="seo_title_en" id="seo_title_en" class="form-control" placeholder="SEO Title for Google..." value="{{ old('seo_title_en') }}">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 1.5rem;">
                <div>
                    <label class="form-label" for="seo_description_tr">SEO Açıklaması (TR)</label>
                    <textarea name="seo_description_tr" id="seo_description_tr" class="form-control" placeholder="Google'da görünecek açıklama metni...">{{ old('seo_description_tr') }}</textarea>
                </div>
                <div>
                    <label class="form-label" for="seo_description_en">SEO Açıklaması (EN)</label>
                    <textarea name="seo_description_en" id="seo_description_en" class="form-control" placeholder="SEO Description for Google...">{{ old('seo_description_en') }}</textarea>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                <div>
                    <label class="form-label">Sosyal Medya Paylaşım Görseli (Open Graph)</label>
                    <input type="file" name="og_image_file" accept="image/*" class="form-control">
                    <small style="color: var(--text-muted);">Whatsapp, Instagram veya Twitter'da link paylaşıldığında çıkacak görsel.</small>
                </div>
                <div style="display: flex; align-items: center; gap: 0.5rem; padding-top: 1.5rem;">
                    <input type="checkbox" name="seo_noindex" id="seo_noindex" value="1" {{ old('seo_noindex') ? 'checked' : '' }}>
                    <label class="form-label" for="seo_noindex" style="margin-bottom:0; cursor:pointer; color: #f87171;">Arama Motorlarına Kapat (Noindex)</label>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                <a href="{{ route('admin.events.index') }}" class="btn btn-outline">İptal Et</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Kaydet ve Yayınla
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
                previewBox.innerHTML = '<span class="image-preview-text">Önizleme Yok</span>';
            }
        }
    </script>
@endsection
