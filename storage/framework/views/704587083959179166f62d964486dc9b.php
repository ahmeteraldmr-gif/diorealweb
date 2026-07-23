<?php $__env->startSection('title', 'Destinasyonu Düzenle'); ?>

<?php $__env->startSection('page_title', 'Destinasyonu Düzenle'); ?>
<?php $__env->startSection('page_subtitle', 'Mevcut destinasyon kartının detaylarını ve görselini güncelleyin.'); ?>

<?php $__env->startSection('content'); ?>
    <div class="panel-card">
        <div class="panel-card-header">
            <h3 class="panel-card-title"><i class="fas fa-edit"></i> Destinasyon Düzenle</h3>
            <a href="<?php echo e(route('admin.destinations.index')); ?>" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Geri Dön
            </a>
        </div>
        
        <form action="<?php echo e(route('admin.destinations.update', $destination->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

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
                    <input type="text" name="name[tr]" id="name_tr" class="form-control" placeholder="Örn: Kapadokya" value="<?php echo e(old('name.tr', $destination->name['tr'] ?? '')); ?>" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="region_tr">Bölge / Alt Başlık (TR)</label>
                    <input type="text" name="region[tr]" id="region_tr" class="form-control" placeholder="Örn: Nevşehir" value="<?php echo e(old('region.tr', $destination->region['tr'] ?? '')); ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="desc_tr">Açıklama / Tanıtım Yazısı (TR)</label>
                    <textarea name="desc[tr]" id="desc_tr" class="form-control" placeholder="Ülke detay sayfasında görünecek açıklama..." style="min-height: 120px;"><?php echo e(old('desc.tr', $destination->desc['tr'] ?? '')); ?></textarea>
                </div>
            </div>

            <!-- English Translation Pane -->
            <div class="lang-pane" data-lang="en">
                <div class="form-group">
                    <label class="form-label" for="name_en">Destination Name (EN)</label>
                    <input type="text" name="name[en]" id="name_en" class="form-control" placeholder="e.g. Cappadocia" value="<?php echo e(old('name.en', $destination->name['en'] ?? '')); ?>" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="region_en">Region / Subtitle (EN)</label>
                    <input type="text" name="region[en]" id="region_en" class="form-control" placeholder="e.g. Nevsehir" value="<?php echo e(old('region.en', $destination->region['en'] ?? '')); ?>" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="desc_en">Description / Intro (EN)</label>
                    <textarea name="desc[en]" id="desc_en" class="form-control" placeholder="Description to be displayed on country details page..." style="min-height: 120px;"><?php echo e(old('desc.en', $destination->desc['en'] ?? '')); ?></textarea>
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
                                <option value="<?php echo e($value); ?>" <?php echo e(old('type', $destination->type) == $value ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="order">Sıra Numarası (Küçük olan önce görünür)</label>
                        <input type="number" name="order" id="order" class="form-control" placeholder="Örn: 0" value="<?php echo e(old('order', $destination->order)); ?>">
                    </div>

                    <div class="form-group" style="margin-top: 1.5rem;">
                        <label class="form-label">Galeriye Görsel Ekle (Çoklu)</label>
                        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                            <input type="file" name="gallery_files[]" id="gallery_files" accept="image/*" multiple style="display:none;" onchange="previewMultipleImages(this, 'gallery_preview')">
                            <button type="button" class="btn btn-outline" onclick="document.getElementById('gallery_files').click()">
                                <i class="fas fa-plus"></i> Galeriye Görsel Seç
                            </button>
                            
                            <div id="gallery_preview" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(70px, 1fr)); gap: 0.5rem; margin-top: 0.5rem; min-height: 50px; border: 1px dashed var(--border-color); padding: 0.5rem; border-radius: var(--radius-sm); background: rgba(15,23,42,0.3);">
                                <div style="grid-column: 1/-1; display:flex; align-items:center; justify-content:center; color: var(--text-muted); font-size: 0.8rem;" id="gallery_preview_text">
                                    Yeni Eklenen Görsel Yok
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Existing Gallery Management -->
                    <div style="margin-top: 1.5rem;">
                        <label class="form-label">Mevcut Galeri Görselleri (Sürükleyip sıralayabilir, kapak seçebilir ve silebilirsiniz)</label>
                        <div id="gallery-sortable-container">
                            <?php if($destination->gallery && count($destination->gallery) > 0): ?>
                                <?php $__currentLoopData = $destination->gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="gallery-item <?php echo e($g == $destination->img ? 'is-cover' : ''); ?>" data-path="<?php echo e($g); ?>">
                                        <img src="<?php echo e(str_starts_with($g, 'data:') ? $g : asset($g)); ?>" alt="">
                                        <span class="cover-badge <?php echo e($g == $destination->img ? '' : 'd-none'); ?>">KAPAK</span>
                                        <div class="item-controls">
                                            <button type="button" class="control-btn make-cover-btn" title="Kapak Yap"><i class="fas fa-image"></i> Kapak Yap</button>
                                            <button type="button" class="control-btn remove-gallery-item-btn" title="Kaldır"><i class="fas fa-trash-alt"></i></button>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                        <input type="hidden" name="cover_image" id="cover_image" value="<?php echo e($destination->img); ?>">
                    </div>
                </div>

                <!-- Cover Image & Videos -->
                <div>
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
                                    <div class="image-preview-box" style="height: 120px;">
                                        <?php if($destination->img): ?>
                                            <img src="<?php echo e(asset($destination->img)); ?>" alt="" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                        <?php else: ?>
                                            <span style="color: var(--text-muted);">Önizleme Yok</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <i class="fas fa-arrow-right" style="color: var(--text-muted);"></i>
                                <div>
                                    <span style="font-size: 0.8rem; color: var(--text-muted); display: block; margin-bottom: 0.25rem;">Yeni Görsel Önizleme:</span>
                                    <div class="image-preview-box" id="img_preview" style="height: 120px;">
                                        <span class="image-preview-text">Değişiklik Yok</span>
                                    </div>
                                </div>
                            </div>

                            <div style="margin-top: 1rem;">
                                <label class="form-label" for="img_url">Veya Hazır Görsel Yolu (Manuel)</label>
                                <input type="text" name="img_url" id="img_url" class="form-control" placeholder="Örn: foto.img/istanbul.jpg" value="<?php echo e(old('img_url', $destination->img)); ?>">
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 1.5rem; display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div>
                            <label class="form-label">Video Yükle / Değiştir (MP4 / MOV)</label>
                            <input type="file" name="video_file" id="video_file" accept="video/*" class="form-control">
                            <?php if($destination->video_file): ?>
                                <span style="font-size: 0.8rem; color: var(--text-muted); display: block; margin-top: 0.25rem;">Mevcut: <?php echo e($destination->video_file); ?></span>
                                <div style="display: flex; align-items: center; gap: 0.5rem; margin-top: 0.5rem;">
                                    <input type="checkbox" name="delete_video_file" id="delete_video_file" value="1">
                                    <label class="form-label" for="delete_video_file" style="margin-bottom: 0; color: #ef4444; cursor: pointer; font-weight: 500;">
                                        <i class="fas fa-trash-alt"></i> Mevcut Videoyu Sil
                                    </label>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div>
                            <label class="form-label" for="video_url">YouTube Video Linki</label>
                            <input type="text" name="video_url" id="video_url" class="form-control" placeholder="Örn: https://www.youtube.com/watch?v=..." value="<?php echo e(old('video_url', $destination->video_url)); ?>">
                        </div>
                    </div>

                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-top: 1rem;">
                        <input type="checkbox" name="show_video_on_cover" id="show_video_on_cover" value="1" <?php echo e(old('show_video_on_cover', $destination->show_video_on_cover) ? 'checked' : ''); ?>>
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
                    <input type="text" name="slug_tr" id="slug_tr" class="form-control" placeholder="Örn: mukemmel-deniz-manzarali-otel (Boş bırakılırsa isimden otomatik üretilir)" value="<?php echo e(old('slug_tr', $destination->slug_tr)); ?>">
                </div>
                <div>
                    <label class="form-label" for="slug_en">Özel URL Yapısı / Slug (EN)</label>
                    <input type="text" name="slug_en" id="slug_en" class="form-control" placeholder="e.g. perfect-sea-view-hotel" value="<?php echo e(old('slug_en', $destination->slug_en)); ?>">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 1.5rem;">
                <div>
                    <label class="form-label" for="seo_title_tr">SEO Başlığı (TR)</label>
                    <input type="text" name="seo_title_tr" id="seo_title_tr" class="form-control" placeholder="Google'da görünecek başlık..." value="<?php echo e(old('seo_title_tr', $destination->seo_title_tr)); ?>">
                </div>
                <div>
                    <label class="form-label" for="seo_title_en">SEO Başlığı (EN)</label>
                    <input type="text" name="seo_title_en" id="seo_title_en" class="form-control" placeholder="SEO Title for Google..." value="<?php echo e(old('seo_title_en', $destination->seo_title_en)); ?>">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 1.5rem;">
                <div>
                    <label class="form-label" for="seo_description_tr">SEO Açıklaması (TR)</label>
                    <textarea name="seo_description_tr" id="seo_description_tr" class="form-control" placeholder="Google'da görünecek açıklama metni..."><?php echo e(old('seo_description_tr', $destination->seo_description_tr)); ?></textarea>
                </div>
                <div>
                    <label class="form-label" for="seo_description_en">SEO Açıklaması (EN)</label>
                    <textarea name="seo_description_en" id="seo_description_en" class="form-control" placeholder="SEO Description for Google..."><?php echo e(old('seo_description_en', $destination->seo_description_en)); ?></textarea>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                <div>
                    <label class="form-label">Sosyal Medya Paylaşım Görseli (Open Graph)</label>
                    <input type="file" name="og_image_file" accept="image/*" class="form-control">
                    <?php if($destination->og_image): ?>
                        <div style="margin-top:0.5rem;">
                            <img src="<?php echo e(asset($destination->og_image)); ?>" style="height:50px; border-radius:4px; object-fit:cover;">
                        </div>
                    <?php endif; ?>
                    <small style="color: var(--text-muted);">Whatsapp, Instagram veya Twitter'da link paylaşıldığında çıkacak görsel.</small>
                </div>
                <div style="display: flex; align-items: center; gap: 0.5rem; padding-top: 1.5rem;">
                    <input type="checkbox" name="seo_noindex" id="seo_noindex" value="1" <?php echo e(old('seo_noindex', $destination->seo_noindex) ? 'checked' : ''); ?>>
                    <label class="form-label" for="seo_noindex" style="margin-bottom:0; cursor:pointer; color: #f87171;">Arama Motorlarına Kapat (Noindex)</label>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                <a href="<?php echo e(route('admin.destinations.index')); ?>" class="btn btn-outline">İptal Et</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Değişiklikleri Kaydet
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
                <?php if($destination->img): ?>
                    previewBox.innerHTML = '<img src="<?php echo e(asset($destination->img)); ?>" alt="" style="max-width: 100%; max-height: 100%; object-fit: contain;">';
                <?php else: ?>
                    previewBox.innerHTML = '<span class="image-preview-text" style="color: var(--text-muted);">Değişiklik Yok</span>';
                <?php endif; ?>
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
    <script src="<?php echo e(asset('js/admin-drag-drop.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ahmet\Desktop\dioreal web\resources\views\admin\destinations\edit.blade.php ENDPATH**/ ?>