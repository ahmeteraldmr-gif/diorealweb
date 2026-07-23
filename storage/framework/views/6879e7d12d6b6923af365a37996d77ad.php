<?php $__env->startSection('title', 'Gezi Rehberini Düzenle'); ?>

<?php $__env->startSection('page_title', 'Gezi Rehberini Düzenle'); ?>
<?php $__env->startSection('page_subtitle', 'Mevcut gezi rehberi bilgilerini ve görsellerini güncelleyin.'); ?>

<?php $__env->startSection('content'); ?>
    <div class="panel-card">
        <div class="panel-card-header">
            <h3 class="panel-card-title"><i class="fas fa-edit"></i> Rehber Düzenleme Formu</h3>
            <a href="<?php echo e(route('admin.guides.index')); ?>" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i> Geri Dön
            </a>
        </div>
        
        <form action="<?php echo e(route('admin.guides.update', $guide->id)); ?>" method="POST" enctype="multipart/form-data">
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
                    <label class="form-label" for="title_tr">Rehber Başlığı (TR)</label>
                    <input type="text" name="title[tr]" id="title_tr" class="form-control" value="<?php echo e(old('title.tr', $guide->title['tr'] ?? '')); ?>" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="tag_tr">Kategori / Etiket (TR)</label>
                    <input type="text" name="tag[tr]" id="tag_tr" class="form-control" value="<?php echo e(old('tag.tr', $guide->tag['tr'] ?? '')); ?>">
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="desc_tr">Açıklama (TR)</label>
                    <textarea name="desc[tr]" id="desc_tr" class="form-control" required style="min-height: 180px;"><?php echo e(old('desc.tr', $guide->desc['tr'] ?? '')); ?></textarea>
                </div>
            </div>

            <!-- English Translation Pane -->
            <div class="lang-pane" data-lang="en">
                <div class="form-group">
                    <label class="form-label" for="title_en">Guide Title (EN)</label>
                    <input type="text" name="title[en]" id="title_en" class="form-control" value="<?php echo e(old('title.en', $guide->title['en'] ?? '')); ?>" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="tag_en">Category / Tag (EN)</label>
                    <input type="text" name="tag[en]" id="tag_en" class="form-control" value="<?php echo e(old('tag.en', $guide->tag['en'] ?? '')); ?>">
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="desc_en">Description (EN)</label>
                    <textarea name="desc[en]" id="desc_en" class="form-control" required style="min-height: 180px;"><?php echo e(old('desc.en', $guide->desc['en'] ?? '')); ?></textarea>
                </div>
            </div>

            <!-- Shared General Content -->
            <hr style="border: 0; border-top: 1px solid var(--border-color); margin: 2rem 0;">

            <div style="max-width: 600px; margin-bottom: 2rem;">
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
                                    <img src="<?php echo e(asset($guide->img)); ?>" alt="">
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
                            <input type="text" name="img_url" id="img_url" class="form-control" value="<?php echo e(old('img_url', $guide->img)); ?>">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Video Upload -->
            <hr style="border: 0; border-top: 1px solid var(--border-color); margin: 2rem 0;">

            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem;">
                <input type="checkbox" name="show_video_on_cover" id="show_video_on_cover" value="1" <?php echo e(old('show_video_on_cover', $guide->show_video_on_cover) ? 'checked' : ''); ?>>
                <label class="form-label" for="show_video_on_cover" style="margin-bottom:0; cursor:pointer;">Kapakta Video Göster (Kapak resmi yerine video oynatır)</label>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                <div>
                    <label class="form-label">Video Yükle / Değiştir (MP4 / MOV)</label>
                    <input type="file" name="video_file" id="video_file" accept="video/*" class="form-control">
                    <?php if($guide->video_file): ?>
                        <span style="font-size: 0.8rem; color: var(--text-muted); display: block; margin-top: 0.25rem;">Mevcut: <?php echo e($guide->video_file); ?></span>
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
                    <input type="text" name="video_url" id="video_url" class="form-control" placeholder="Örn: https://www.youtube.com/watch?v=..." value="<?php echo e(old('video_url', $guide->video_url)); ?>">
                </div>
            </div>

                        <!-- SEO Settings -->
            <hr style="border: 0; border-top: 1px solid var(--border-color); margin: 2rem 0;">
            <h4 class="form-section-title" style="margin-bottom: 1rem;"><i class="fas fa-search"></i> SEO ve Meta Ayarları</h4>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 1.5rem;">
                <div>
                    <label class="form-label" for="slug_tr">Özel URL Yapısı / Slug (TR)</label>
                    <input type="text" name="slug_tr" id="slug_tr" class="form-control" placeholder="Örn: mukemmel-deniz-manzarali-otel (Boş bırakılırsa isimden otomatik üretilir)" value="<?php echo e(old('slug_tr', $guide->slug_tr)); ?>">
                </div>
                <div>
                    <label class="form-label" for="slug_en">Özel URL Yapısı / Slug (EN)</label>
                    <input type="text" name="slug_en" id="slug_en" class="form-control" placeholder="e.g. perfect-sea-view-hotel" value="<?php echo e(old('slug_en', $guide->slug_en)); ?>">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 1.5rem;">
                <div>
                    <label class="form-label" for="seo_title_tr">SEO Başlığı (TR)</label>
                    <input type="text" name="seo_title_tr" id="seo_title_tr" class="form-control" placeholder="Google'da görünecek başlık..." value="<?php echo e(old('seo_title_tr', $guide->seo_title_tr)); ?>">
                </div>
                <div>
                    <label class="form-label" for="seo_title_en">SEO Başlığı (EN)</label>
                    <input type="text" name="seo_title_en" id="seo_title_en" class="form-control" placeholder="SEO Title for Google..." value="<?php echo e(old('seo_title_en', $guide->seo_title_en)); ?>">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 1.5rem;">
                <div>
                    <label class="form-label" for="seo_description_tr">SEO Açıklaması (TR)</label>
                    <textarea name="seo_description_tr" id="seo_description_tr" class="form-control" placeholder="Google'da görünecek açıklama metni..."><?php echo e(old('seo_description_tr', $guide->seo_description_tr)); ?></textarea>
                </div>
                <div>
                    <label class="form-label" for="seo_description_en">SEO Açıklaması (EN)</label>
                    <textarea name="seo_description_en" id="seo_description_en" class="form-control" placeholder="SEO Description for Google..."><?php echo e(old('seo_description_en', $guide->seo_description_en)); ?></textarea>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                <div>
                    <label class="form-label">Sosyal Medya Paylaşım Görseli (Open Graph)</label>
                    <input type="file" name="og_image_file" accept="image/*" class="form-control">
                    <?php if($guide->og_image): ?>
                        <div style="margin-top:0.5rem;">
                            <img src="<?php echo e(asset($guide->og_image)); ?>" style="height:50px; border-radius:4px; object-fit:cover;">
                        </div>
                    <?php endif; ?>
                    <small style="color: var(--text-muted);">Whatsapp, Instagram veya Twitter'da link paylaşıldığında çıkacak görsel.</small>
                </div>
                <div style="display: flex; align-items: center; gap: 0.5rem; padding-top: 1.5rem;">
                    <input type="checkbox" name="seo_noindex" id="seo_noindex" value="1" <?php echo e(old('seo_noindex', $guide->seo_noindex) ? 'checked' : ''); ?>>
                    <label class="form-label" for="seo_noindex" style="margin-bottom:0; cursor:pointer; color: #f87171;">Arama Motorlarına Kapat (Noindex)</label>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                <a href="<?php echo e(route('admin.guides.index')); ?>" class="btn btn-outline">İptal Et</a>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ahmet\Desktop\dioreal web\resources\views\admin\guides\edit.blade.php ENDPATH**/ ?>