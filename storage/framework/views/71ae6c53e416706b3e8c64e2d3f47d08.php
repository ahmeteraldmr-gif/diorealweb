<?php $__env->startSection('title', 'Yeni Destinasyon Ekle'); ?>

<?php $__env->startSection('page_title', 'Yeni Destinasyon Ekle'); ?>
<?php $__env->startSection('page_subtitle', 'Ana sayfaya eklenecek yeni destinasyon kartının detaylarını girin.'); ?>

<?php $__env->startSection('content'); ?>
    <div class="panel-card">
        <div class="panel-card-header">
            <h3 class="panel-card-title"><i class="fas fa-plus-circle"></i> Destinasyon Formu</h3>
            <a href="<?php echo e(route('admin.destinations.index')); ?>" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Geri Dön
            </a>
        </div>
        
        <form action="<?php echo e(route('admin.destinations.store')); ?>" method="POST" enctype="multipart/form-data">
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
                    <label class="form-label" for="name_tr">Destinasyon Adı (TR)</label>
                    <input type="text" name="name[tr]" id="name_tr" class="form-control" placeholder="Örn: Kapadokya" value="<?php echo e(old('name.tr')); ?>" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="region_tr">Bölge / Alt Başlık (TR)</label>
                    <input type="text" name="region[tr]" id="region_tr" class="form-control" placeholder="Örn: Nevşehir" value="<?php echo e(old('region.tr')); ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="desc_tr">Açıklama / Tanıtım Yazısı (TR)</label>
                    <textarea name="desc[tr]" id="desc_tr" class="form-control" placeholder="Ülke detay sayfasında görünecek açıklama..." style="min-height: 120px;"><?php echo e(old('desc.tr')); ?></textarea>
                </div>
            </div>

            <!-- English Translation Pane -->
            <div class="lang-pane" data-lang="en">
                <div class="form-group">
                    <label class="form-label" for="name_en">Destination Name (EN)</label>
                    <input type="text" name="name[en]" id="name_en" class="form-control" placeholder="e.g. Cappadocia" value="<?php echo e(old('name.en')); ?>">
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="region_en">Region / Subtitle (EN)</label>
                    <input type="text" name="region[en]" id="region_en" class="form-control" placeholder="e.g. Nevsehir" value="<?php echo e(old('region.en')); ?>">
                </div>

                <div class="form-group">
                    <label class="form-label" for="desc_en">Description / Intro (EN)</label>
                    <textarea name="desc[en]" id="desc_en" class="form-control" placeholder="Description to be displayed on country details page..." style="min-height: 120px;"><?php echo e(old('desc.en')); ?></textarea>
                </div>
            </div>

            <!-- Shared General Content -->
            <hr style="border: 0; border-top: 1px solid var(--border-color); margin: 2rem 0;">

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                <!-- General details -->
                <div>
                    <div class="form-group">
                        <label class="form-label" for="type">Kategori Grubu</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="">Seçiniz</option>
                            <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($value); ?>" <?php echo e(old('type') == $value ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="order">Sıra Numarası (Küçük olan önce görünür)</label>
                        <input type="number" name="order" id="order" class="form-control" placeholder="Örn: 0" value="<?php echo e(old('order', 0)); ?>">
                    </div>

                    <div class="form-group" style="margin-top: 1.5rem;">
                        <label class="form-label">Galeri Görselleri (Çoklu)</label>
                        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                            <input type="file" name="gallery_files[]" id="gallery_files" accept="image/*" multiple style="display:none;" onchange="previewMultipleImages(this, 'gallery_preview')">
                            <button type="button" class="btn btn-outline" onclick="document.getElementById('gallery_files').click()">
                                <i class="fas fa-images"></i> Galeri Dosyaları Seç
                            </button>
                            
                            <div id="gallery_preview" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(70px, 1fr)); gap: 0.5rem; margin-top: 0.5rem; min-height: 90px; border: 1px dashed var(--border-color); padding: 0.5rem; border-radius: var(--radius-sm); background: rgba(15,23,42,0.3);">
                                <div style="grid-column: 1/-1; display:flex; align-items:center; justify-content:center; color: var(--text-muted); font-size: 0.8rem;" id="gallery_preview_text">
                                    Seçilen Görsel Yok
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cover Image & Videos -->
                <div>
                    <div>
                        <label class="form-label">Kapak Görseli</label>
                        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                            <input type="file" name="img_file" id="img_file" accept="image/*" style="display:none;" onchange="previewImage(this, 'img_preview')">
                            <button type="button" class="btn btn-outline" onclick="document.getElementById('img_file').click()">
                                <i class="fas fa-image"></i> Görsel Dosyası Seç
                            </button>
                            
                            <div class="image-preview-box" id="img_preview" style="height: 120px; border: 1px dashed var(--border-color); display: flex; align-items: center; justify-content: center; overflow: hidden; border-radius: var(--radius-sm); background: rgba(15,23,42,0.3);">
                                <span class="image-preview-text" style="color: var(--text-muted);">Önizleme Yok</span>
                            </div>

                            <div style="margin-top: 0.5rem;">
                                <label class="form-label" for="img_url">Veya Görsel Yolu (Manuel)</label>
                                <input type="text" name="img_url" id="img_url" class="form-control" placeholder="Örn: foto.img/istanbul.jpg" value="<?php echo e(old('img_url')); ?>">
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 1.5rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div>
                            <label class="form-label">Video Yükle (MP4 / MOV)</label>
                            <input type="file" name="video_file" id="video_file" accept="video/*" class="form-control">
                        </div>
                        <div>
                            <label class="form-label" for="video_url">YouTube Video Linki</label>
                            <input type="text" name="video_url" id="video_url" class="form-control" placeholder="Örn: https://www.youtube.com/watch?v=..." value="<?php echo e(old('video_url')); ?>">
                        </div>
                    </div>

                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-top: 1rem;">
                        <input type="checkbox" name="show_video_on_cover" id="show_video_on_cover" value="1" <?php echo e(old('show_video_on_cover') ? 'checked' : ''); ?>>
                        <label class="form-label" for="show_video_on_cover" style="margin-bottom:0; cursor:pointer;">Kapakta Video Göster (Kapak resmi yerine video oynatır)</label>
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
                <a href="<?php echo e(route('admin.destinations.index')); ?>" class="btn btn-outline">İptal Et</a>
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
                previewGrid.innerHTML = '<div style="grid-column: 1/-1; display:flex; align-items:center; justify-content:center; color: var(--text-muted); font-size: 0.8rem;">Seçilen Görsel Yok</div>';
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ahmet\Desktop\dioreal web\resources\views\admin\destinations\create.blade.php ENDPATH**/ ?>