@extends('admin.layouts.app')

@section('title', 'Journal Yazısını Düzenle')

@section('page_title', 'Journal Yazısını Düzenle')
@section('page_subtitle', 'Mevcut journal yazısını güncelleyin.')

@section('content')
    <div class="panel-card">
        <div class="panel-card-header">
            <h3 class="panel-card-title"><i class="fas fa-edit"></i> Journal Düzenleme Formu</h3>
            <div style="display:flex; gap:0.75rem;">
                <a href="{{ route('journal.detay', $journal->id) }}" class="btn btn-outline" target="_blank">
                    <i class="fas fa-eye"></i> Görüntüle
                </a>
                <a href="{{ route('admin.journals.index') }}" class="btn btn-outline">
                    <i class="fas fa-arrow-left"></i> Geri Dön
                </a>
            </div>
        </div>
        
        <form action="{{ route('admin.journals.update', $journal->id) }}" method="POST" enctype="multipart/form-data">
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
                    <label class="form-label" for="title_tr">Makale Başlığı (TR)</label>
                    <input type="text" name="title[tr]" id="title_tr" class="form-control" value="{{ old('title.tr', $journal->title['tr'] ?? '') }}" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="tag_tr">Kategori / Etiket (TR)</label>
                    <input type="text" name="tag[tr]" id="tag_tr" class="form-control" value="{{ old('tag.tr', $journal->tag['tr'] ?? '') }}">
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="desc_tr">Kısa Özet (TR) <small style="color: var(--text-muted);">— Liste sayfasında ve hero altında görünür</small></label>
                    <textarea name="desc[tr]" id="desc_tr" class="form-control" required style="min-height: 120px;">{{ old('desc.tr', $journal->desc['tr'] ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label" for="content_tr">Tam Makale İçeriği (TR) <small style="color: var(--text-muted);">— Detay sayfasında gösterilir</small></label>
                    <textarea name="content[tr]" id="content_tr" class="form-control" style="min-height: 350px;">{{ old('content.tr', $journal->content['tr'] ?? '') }}</textarea>
                </div>
            </div>

            <!-- English Translation Pane -->
            <div class="lang-pane" data-lang="en">
                <div class="form-group">
                    <label class="form-label" for="title_en">Article Title (EN)</label>
                    <input type="text" name="title[en]" id="title_en" class="form-control" value="{{ old('title.en', $journal->title['en'] ?? '') }}" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="tag_en">Category / Tag (EN)</label>
                    <input type="text" name="tag[en]" id="tag_en" class="form-control" value="{{ old('tag.en', $journal->tag['en'] ?? '') }}">
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="desc_en">Short Summary (EN) <small style="color: var(--text-muted);">— Shown in listings and hero</small></label>
                    <textarea name="desc[en]" id="desc_en" class="form-control" style="min-height: 120px;">{{ old('desc.en', $journal->desc['en'] ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label" for="content_en">Full Article Content (EN) <small style="color: var(--text-muted);">— Shown on the detail page</small></label>
                    <textarea name="content[en]" id="content_en" class="form-control" style="min-height: 350px;">{{ old('content.en', $journal->content['en'] ?? '') }}</textarea>
                </div>
            </div>

            <!-- Shared General Content -->
            <hr style="border: 0; border-top: 1px solid var(--border-color); margin: 2rem 0;">

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                <!-- Date & Meta -->
                <div>
                    <div class="form-group">
                        <label class="form-label" for="destination_id">İlişkili Ülke / Destinasyon</label>
                        <select name="destination_id" id="destination_id" class="form-control">
                            <option value="">-- Ülke Seçin (İsteğe Bağlı) --</option>
                            @foreach($destinations as $dest)
                                <option value="{{ $dest->id }}" {{ old('destination_id', $journal->destination_id) == $dest->id ? 'selected' : '' }}>
                                    {{ $dest->name['tr'] ?? '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="date">Yayın Tarihi Metni</label>
                        <input type="text" name="date" id="date" class="form-control" value="{{ old('date', $journal->date) }}" required>
                        <small style="color: var(--text-muted); display:block; margin-top:0.25rem;">Sitede görünecek tarih etiketini manuel girin.</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="read_time">Tahmini Okuma Süresi (Dakika)</label>
                        <input type="number" name="read_time" id="read_time" class="form-control" value="{{ old('read_time', $journal->read_time) }}" min="1" max="120">
                    </div>

                    <div class="form-group">
                        <label class="form-label" style="display:flex; align-items:center; gap:0.75rem; cursor:pointer;">
                            <input type="hidden" name="is_featured" value="0">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $journal->is_featured) ? 'checked' : '' }}
                                style="width: 18px; height: 18px; accent-color: var(--accent); cursor: pointer;">
                            Öne Çıkarılmış Yazı (Featured)
                        </label>
                        <small style="color: var(--text-muted); display:block; margin-top:0.25rem;">İşaretlenirse anasayfa veya özel alanda gösterilebilir.</small>
                    </div>

                    <div class="form-group" style="margin-top: 1.5rem; border-top: 1px solid var(--border-color); padding-top: 1.5rem;">
                        <label class="form-label" for="video_file">Video Yükle / Değiştir (MP4 / MOV)</label>
                        <input type="file" name="video_file" id="video_file" accept="video/*" class="form-control" style="margin-bottom: 1rem;">
                        @if($journal->video_file)
                            <span style="font-size: 0.8rem; color: var(--text-muted); display: block; margin-top: 0.25rem;">Mevcut: {{ $journal->video_file }}</span>
                            <div style="display: flex; align-items: center; gap: 0.5rem; margin-top: 0.5rem; margin-bottom: 1rem;">
                                <input type="checkbox" name="delete_video_file" id="delete_video_file" value="1">
                                <label class="form-label" for="delete_video_file" style="margin-bottom: 0; color: #ef4444; cursor: pointer; font-weight: 500;">
                                    <i class="fas fa-trash-alt"></i> Mevcut Videoyu Sil
                                </label>
                            </div>
                        @endif
                        
                        <label class="form-label" for="video_url">YouTube Video Linki</label>
                        <input type="text" name="video_url" id="video_url" class="form-control" placeholder="Örn: https://www.youtube.com/watch?v=..." value="{{ old('video_url', $journal->video_url) }}" style="margin-bottom: 1rem;">
                        
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-top: 1rem;">
                            <input type="checkbox" name="show_video_on_cover" id="show_video_on_cover" value="1" {{ old('show_video_on_cover', $journal->show_video_on_cover) ? 'checked' : '' }}>
                            <label class="form-label" for="show_video_on_cover" style="margin-bottom:0; cursor:pointer;">Kapakta Video Göster</label>
                        </div>
                    </div>
                </div>

                <!-- Cover Image -->
                <div>
                    <label class="form-label">Görsel (Kapak)</label>
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <input type="file" name="img_file" id="img_file" accept="image/*" style="display:none;" onchange="previewImage(this, 'img_preview_new')">
                        <button type="button" class="btn btn-outline" onclick="document.getElementById('img_file').click()">
                            <i class="fas fa-sync-alt"></i> Farklı Bir Görsel Seç
                        </button>

                        <div style="display: flex; gap: 1rem; align-items: center; margin-top: 0.5rem;">
                            <div>
                                <span style="font-size: 0.8rem; color: var(--text-muted); display: block; margin-bottom: 0.25rem;">Mevcut Görsel:</span>
                                <div style="width: 120px; height: 80px; overflow:hidden; border-radius:4px; border:1px solid var(--border-color);">
                                    <img src="{{ asset($journal->img) }}" alt="" style="width:100%; height:100%; object-fit:cover;">
                                </div>
                            </div>
                            <i class="fas fa-arrow-right" style="color: var(--text-muted);"></i>
                            <div>
                                <span style="font-size: 0.8rem; color: var(--text-muted); display: block; margin-bottom: 0.25rem;">Yeni Görsel Önizleme:</span>
                                <div id="img_preview_new" style="width: 120px; height: 80px; overflow:hidden; border-radius:4px; border:1px dashed var(--border-color); display:flex; align-items:center; justify-content:center; background: rgba(15,23,42,0.3);">
                                    <span style="font-size:0.7rem; color: var(--text-muted);">Değişiklik Yok</span>
                                </div>
                            </div>
                        </div>

                        <div style="margin-top: 1rem;">
                            <label class="form-label" for="img_url">Veya Görsel Yolu (Manuel)</label>
                            <input type="text" name="img_url" id="img_url" class="form-control" value="{{ old('img_url', $journal->img) }}">
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
                    <input type="text" name="slug_tr" id="slug_tr" class="form-control" placeholder="Örn: mukemmel-deniz-manzarali-otel (Boş bırakılırsa isimden otomatik üretilir)" value="{{ old('slug_tr', $journal->slug_tr) }}">
                </div>
                <div>
                    <label class="form-label" for="slug_en">Özel URL Yapısı / Slug (EN)</label>
                    <input type="text" name="slug_en" id="slug_en" class="form-control" placeholder="e.g. perfect-sea-view-hotel" value="{{ old('slug_en', $journal->slug_en) }}">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 1.5rem;">
                <div>
                    <label class="form-label" for="seo_title_tr">SEO Başlığı (TR)</label>
                    <input type="text" name="seo_title_tr" id="seo_title_tr" class="form-control" placeholder="Google'da görünecek başlık..." value="{{ old('seo_title_tr', $journal->seo_title_tr) }}">
                </div>
                <div>
                    <label class="form-label" for="seo_title_en">SEO Başlığı (EN)</label>
                    <input type="text" name="seo_title_en" id="seo_title_en" class="form-control" placeholder="SEO Title for Google..." value="{{ old('seo_title_en', $journal->seo_title_en) }}">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 1.5rem;">
                <div>
                    <label class="form-label" for="seo_description_tr">SEO Açıklaması (TR)</label>
                    <textarea name="seo_description_tr" id="seo_description_tr" class="form-control" placeholder="Google'da görünecek açıklama metni...">{{ old('seo_description_tr', $journal->seo_description_tr) }}</textarea>
                </div>
                <div>
                    <label class="form-label" for="seo_description_en">SEO Açıklaması (EN)</label>
                    <textarea name="seo_description_en" id="seo_description_en" class="form-control" placeholder="SEO Description for Google...">{{ old('seo_description_en', $journal->seo_description_en) }}</textarea>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                <div>
                    <label class="form-label">Sosyal Medya Paylaşım Görseli (Open Graph)</label>
                    <input type="file" name="og_image_file" accept="image/*" class="form-control">
                    @if($journal->og_image)
                        <div style="margin-top:0.5rem;">
                            <img src="{{ asset($journal->og_image) }}" style="height:50px; border-radius:4px; object-fit:cover;">
                        </div>
                    @endif
                    <small style="color: var(--text-muted);">Whatsapp, Instagram veya Twitter'da link paylaşıldığında çıkacak görsel.</small>
                </div>
                <div style="display: flex; align-items: center; gap: 0.5rem; padding-top: 1.5rem;">
                    <input type="checkbox" name="seo_noindex" id="seo_noindex" value="1" {{ old('seo_noindex', $journal->seo_noindex) ? 'checked' : '' }}>
                    <label class="form-label" for="seo_noindex" style="margin-bottom:0; cursor:pointer; color: #f87171;">Arama Motorlarına Kapat (Noindex)</label>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                <a href="{{ route('admin.journals.index') }}" class="btn btn-outline">İptal Et</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Güncelle ve Yayınla
                </button>
            </div>
        </form>
    </div>

    <!-- Image Preview Handler -->
    <script>
        function previewImage(input, previewId) {
            const previewBox = document.getElementById(previewId);
            previewBox.innerHTML = '';
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.setAttribute('src', e.target.result);
                    img.style.width = '100%';
                    img.style.height = '100%';
                    img.style.objectFit = 'cover';
                    previewBox.appendChild(img);
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                previewBox.innerHTML = '<span style="font-size:0.7rem; color: var(--text-muted);">Değişiklik Yok</span>';
            }
        }
    </script>
@endsection
