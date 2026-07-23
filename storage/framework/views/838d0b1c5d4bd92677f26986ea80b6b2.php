<?php $__env->startSection('title', 'Yeni Journal Yazısı Ekle'); ?>

<?php $__env->startSection('page_title', 'Yeni Journal Yazısı Ekle'); ?>
<?php $__env->startSection('page_subtitle', 'Koleksiyona eklenecek yeni journal makalesinin detaylarını girin.'); ?>

<?php $__env->startSection('content'); ?>
    <div class="panel-card">
        <div class="panel-card-header">
            <h3 class="panel-card-title"><i class="fas fa-plus-circle"></i> Journal Formu</h3>
            <a href="<?php echo e(route('admin.journals.index')); ?>" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Geri Dön
            </a>
        </div>
        
        <form action="<?php echo e(route('admin.journals.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

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
                    <input type="text" name="title[tr]" id="title_tr" class="form-control" placeholder="Örn: Bodrum'da Gizli Kalmış Koylar" value="<?php echo e(old('title.tr')); ?>" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="tag_tr">Kategori / Etiket (TR)</label>
                    <input type="text" name="tag[tr]" id="tag_tr" class="form-control" placeholder="Örn: Seyahat & Yaşam" value="<?php echo e(old('tag.tr')); ?>">
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="desc_tr">Kısa Özet (TR) <small style="color: var(--text-muted);">— Liste sayfasında ve hero altında görünür</small></label>
                    <textarea name="desc[tr]" id="desc_tr" class="form-control" placeholder="Makale özetini buraya girin (1–3 cümle)..." required style="min-height: 120px;"><?php echo e(old('desc.tr')); ?></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label" for="content_tr">Tam Makale İçeriği (TR) <small style="color: var(--text-muted);">— Detay sayfasında gösterilir</small></label>
                    <textarea name="content[tr]" id="content_tr" class="form-control" placeholder="Makalenin tam içeriğini buraya girin. Paragraflar arası boş satır bırakabilirsiniz..." style="min-height: 350px;"><?php echo e(old('content.tr')); ?></textarea>
                </div>
            </div>

            <!-- English Translation Pane -->
            <div class="lang-pane" data-lang="en">
                <div class="form-group">
                    <label class="form-label" for="title_en">Article Title (EN)</label>
                    <input type="text" name="title[en]" id="title_en" class="form-control" placeholder="e.g. Hidden Coves of Bodrum" value="<?php echo e(old('title.en')); ?>">
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="tag_en">Category / Tag (EN)</label>
                    <input type="text" name="tag[en]" id="tag_en" class="form-control" placeholder="e.g. Travel & Lifestyle" value="<?php echo e(old('tag.en')); ?>">
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="desc_en">Short Summary (EN) <small style="color: var(--text-muted);">— Shown in listings and hero</small></label>
                    <textarea name="desc[en]" id="desc_en" class="form-control" placeholder="Write a brief summary (1–3 sentences)..." style="min-height: 120px;"><?php echo e(old('desc.en')); ?></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label" for="content_en">Full Article Content (EN) <small style="color: var(--text-muted);">— Shown on the detail page</small></label>
                    <textarea name="content[en]" id="content_en" class="form-control" placeholder="Write the full article content here. You can use blank lines between paragraphs..." style="min-height: 350px;"><?php echo e(old('content.en')); ?></textarea>
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
                            <?php $__currentLoopData = $destinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($dest->id); ?>" <?php echo e(old('destination_id') == $dest->id ? 'selected' : ''); ?>>
                                    <?php echo e($dest->name['tr'] ?? ''); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="date">Yayın Tarihi Metni</label>
                        <input type="text" name="date" id="date" class="form-control" placeholder="Örn: MAYIS 2024 veya 24.05.2026" value="<?php echo e(old('date')); ?>" required>
                        <small style="color: var(--text-muted); display:block; margin-top:0.25rem;">Sitede görünecek tarih etiketini manuel girin.</small>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="read_time">Tahmini Okuma Süresi (Dakika)</label>
                        <input type="number" name="read_time" id="read_time" class="form-control" placeholder="Örn: 5" value="<?php echo e(old('read_time')); ?>" min="1" max="120">
                    </div>

                    <div class="form-group">
                        <label class="form-label" style="display:flex; align-items:center; gap:0.75rem; cursor:pointer;">
                            <input type="hidden" name="is_featured" value="0">
                            <input type="checkbox" name="is_featured" value="1" <?php echo e(old('is_featured') ? 'checked' : ''); ?>

                                style="width: 18px; height: 18px; accent-color: var(--accent); cursor: pointer;">
                            Öne Çıkarılmış Yazı (Featured)
                        </label>
                        <small style="color: var(--text-muted); display:block; margin-top:0.25rem;">İşaretlenirse anasayfa veya özel alanda gösterilebilir.</small>
                    </div>

                    <div class="form-group" style="margin-top: 1.5rem; border-top: 1px solid var(--border-color); padding-top: 1.5rem;">
                        <label class="form-label" for="video_file">Video Yükle (MP4 / MOV)</label>
                        <input type="file" name="video_file" id="video_file" accept="video/*" class="form-control" style="margin-bottom: 1rem;">
                        
                        <label class="form-label" for="video_url">YouTube Video Linki</label>
                        <input type="text" name="video_url" id="video_url" class="form-control" placeholder="Örn: https://www.youtube.com/watch?v=..." value="<?php echo e(old('video_url')); ?>" style="margin-bottom: 1rem;">
                        
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-top: 1rem;">
                            <input type="checkbox" name="show_video_on_cover" id="show_video_on_cover" value="1" <?php echo e(old('show_video_on_cover') ? 'checked' : ''); ?>>
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
                        
                        <div class="image-preview-box" id="img_preview" style="max-width: 300px; height: 180px; border: 1px dashed var(--border-color); display:flex; align-items:center; justify-content:center; overflow:hidden; border-radius:4px; background: rgba(15,23,42,0.3);">
                            <span class="image-preview-text" style="color: var(--text-muted);">Önizleme Yok</span>
                        </div>

                        <div style="margin-top: 1rem;">
                            <label class="form-label" for="img_url">Veya Görsel Yolu (Manuel)</label>
                            <input type="text" name="img_url" id="img_url" class="form-control" placeholder="Örn: foto.img/bodrum.jpg" value="<?php echo e(old('img_url')); ?>">
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
                    <input type="text" name="slug_tr" id="slug_tr" class="form-control" placeholder="Örn: mukemmel-deniz-manzarali-otel (Boş bırakılırsa isimden otomatik üretilir)" value="<?php echo e(old('slug_tr')); ?>">
                </div>
                <div>
                    <label class="form-label" for="slug_en">Özel URL Yapısı / Slug (EN)</label>
                    <input type="text" name="slug_en" id="slug_en" class="form-control" placeholder="e.g. perfect-sea-view-hotel" value="<?php echo e(old('slug_en')); ?>">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 1.5rem;">
                <div>
                    <label class="form-label" for="seo_title_tr">SEO Başlığı (TR)</label>
                    <input type="text" name="seo_title_tr" id="seo_title_tr" class="form-control" placeholder="Google'da görünecek başlık..." value="<?php echo e(old('seo_title_tr')); ?>">
                </div>
                <div>
                    <label class="form-label" for="seo_title_en">SEO Başlığı (EN)</label>
                    <input type="text" name="seo_title_en" id="seo_title_en" class="form-control" placeholder="SEO Title for Google..." value="<?php echo e(old('seo_title_en')); ?>">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 1.5rem;">
                <div>
                    <label class="form-label" for="seo_description_tr">SEO Açıklaması (TR)</label>
                    <textarea name="seo_description_tr" id="seo_description_tr" class="form-control" placeholder="Google'da görünecek açıklama metni..."><?php echo e(old('seo_description_tr')); ?></textarea>
                </div>
                <div>
                    <label class="form-label" for="seo_description_en">SEO Açıklaması (EN)</label>
                    <textarea name="seo_description_en" id="seo_description_en" class="form-control" placeholder="SEO Description for Google..."><?php echo e(old('seo_description_en')); ?></textarea>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                <div>
                    <label class="form-label">Sosyal Medya Paylaşım Görseli (Open Graph)</label>
                    <input type="file" name="og_image_file" accept="image/*" class="form-control">
                    <small style="color: var(--text-muted);">Whatsapp, Instagram veya Twitter'da link paylaşıldığında çıkacak görsel.</small>
                </div>
                <div style="display: flex; align-items: center; gap: 0.5rem; padding-top: 1.5rem;">
                    <input type="checkbox" name="seo_noindex" id="seo_noindex" value="1" <?php echo e(old('seo_noindex') ? 'checked' : ''); ?>>
                    <label class="form-label" for="seo_noindex" style="margin-bottom:0; cursor:pointer; color: #f87171;">Arama Motorlarına Kapat (Noindex)</label>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                <a href="<?php echo e(route('admin.journals.index')); ?>" class="btn btn-outline">İptal Et</a>
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
                    img.style.maxWidth = '100%';
                    img.style.maxHeight = '100%';
                    img.style.objectFit = 'contain';
                    previewBox.appendChild(img);
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                previewBox.innerHTML = '<span class="image-preview-text" style="color: var(--text-muted);">Önizleme Yok</span>';
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ahmet\Desktop\dioreal web\resources\views\admin\journals\create.blade.php ENDPATH**/ ?>