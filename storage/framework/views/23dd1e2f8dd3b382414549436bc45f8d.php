<footer id="iletisim">
    <div class="footer-top">
        <div class="footer-brand">
            <div class="footer-logo">DIOREAL</div>
            <p class="footer-p" data-i18n="footer_p">Seçkin destinasyonları ve premium markaları doğru kitleyle buluşturan medya platformu.</p>
            <a href="https://wa.me/<?php echo e(format_whatsapp($settings['whatsapp'] ?? '')); ?>" class="whatsapp-cta" target="_blank">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                </svg>
                <span data-i18n="btn_contact_wa">WhatsApp İletişim</span>
            </a>
        </div>
        <div class="footer-col">
            <h4 data-i18n="footer_pages">Sayfalar</h4>
            <ul class="footer-links">
                <li><a href="<?php echo e(route('hakkimizda')); ?>" data-i18n="nav_about">Hakkımızda</a></li>
                <li><a href="<?php echo e(route('oteller')); ?>" data-i18n="nav_hotels">Oteller</a></li>
                <li><a href="<?php echo e(route('yatlar')); ?>" data-i18n="nav_yachts">Yatlar</a></li>
                <li><a href="<?php echo e(route('restoranlar')); ?>" data-i18n="nav_restaurants">Restoranlar</a></li>
                <li><a href="<?php echo e(route('gezi-rehberi')); ?>" data-i18n="nav_guide">Gezi Rehberi</a></li>
                <li><a href="<?php echo e(route('etkinlikler')); ?>" data-i18n="nav_events">Etkinlikler</a></li>
                <li><a href="<?php echo e(route('journal')); ?>" data-i18n="nav_journal">Journal</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4 data-i18n="footer_serv">Hizmetler</h4>
            <ul class="footer-links">
                <li><a href="<?php echo e(route('oteller')); ?>">Balayı Paketleri</a></li>
                <li><a href="<?php echo e(route('gezi-rehberi')); ?>">Aile Tatilleri</a></li>
                <li><a href="<?php echo e(route('etkinlikler')); ?>">Macera Turları</a></li>
                <li><a href="<?php echo e(route('gezi-rehberi')); ?>">Kültür Gezileri</a></li>
                <li><a href="<?php echo e(route('yatlar')); ?>">Özel Yat Hizmetleri</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4 data-i18n="footer_contact">İletişim</h4>
            <ul class="footer-links">
                <?php if(!empty($settings['contact_email'])): ?>
                    <li><a href="mailto:<?php echo e($settings['contact_email']); ?>"><?php echo e($settings['contact_email']); ?></a></li>
                <?php endif; ?>
                <?php if(!empty($settings['contact_phone'])): ?>
                    <li><a href="tel:<?php echo e(str_replace(' ', '', $settings['contact_phone'])); ?>"><?php echo e($settings['contact_phone']); ?></a></li>
                <?php endif; ?>
                <li>
                    <span class="lang-text-tr"><?php echo e($settings['contact_address_tr'] ?? 'İstanbul, Türkiye'); ?></span>
                    <span class="lang-text-en"><?php echo e($settings['contact_address_en'] ?? 'Istanbul, Turkey'); ?></span>
                </li>
                <?php if(!empty($settings['instagram'])): ?>
                    <li><a href="<?php echo e($settings['instagram']); ?>" target="_blank">Instagram</a></li>
                <?php endif; ?>
                <?php if(!empty($settings['linkedin'])): ?>
                    <li><a href="<?php echo e($settings['linkedin']); ?>" target="_blank">LinkedIn</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <div class="footer-bottom" style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1rem;">
        <span><?php echo e($settings['footer_copy'] ?? '© 2026 Dioreal Dijital. All Rights Reserved.'); ?></span>
        <div class="footer-legal-links" style="display: flex; gap: 1.25rem; font-size: 0.82rem; opacity: 0.85; flex-wrap: wrap;">
            <a href="javascript:void(0)" onclick="openLegalModal('kvkk')" style="color: inherit; text-decoration: underline;">KVKK / GDPR Aydınlatma Metni</a>
            <a href="javascript:void(0)" onclick="openLegalModal('privacy')" style="color: inherit; text-decoration: underline;">Gizlilik & Çerez Politikası</a>
            <a href="javascript:void(0)" onclick="openLegalModal('terms')" style="color: inherit; text-decoration: underline;">Kullanım Koşulları</a>
        </div>
    </div>
</footer>

<!-- Legal Text Modal Popup -->
<div id="legalModal" style="display:none; position:fixed; inset:0; z-index:999999; background:rgba(0,0,0,0.85); backdrop-filter:blur(8px); padding:2rem 1rem; overflow-y:auto; align-items:center; justify-content:center;">
    <div style="background:#141414; border:1px solid rgba(255,255,255,0.12); border-radius:20px; max-width:750px; width:100%; margin:auto; padding:2.5rem; color:#e2e8f0; position:relative; box-shadow:0 25px 50px rgba(0,0,0,0.7);">
        <button type="button" onclick="closeLegalModal()" style="position:absolute; top:1.5rem; right:1.5rem; background:none; border:none; color:#94a3b8; font-size:1.5rem; cursor:pointer;">&times;</button>
        <h3 id="legalModalTitle" style="font-family:var(--font-display); font-size:1.8rem; margin-bottom:1.5rem; color:var(--accent, #c4a47c);"></h3>
        <div id="legalModalBody" style="font-size:0.95rem; line-height:1.8; color:#cbd5e1; max-height:60vh; overflow-y:auto; padding-right:0.5rem;"></div>
    </div>
</div>

<script>
    const legalTexts = {
        kvkk: {
            title: "KVKK & GDPR Aydınlatma Metni",
            body: "<p><strong>Dioreal Dijital Platformu KVKK Aydınlatma Metni</strong></p><p>6698 sayılı Kişisel Verilerin Korunması Kanunu (KVKK) uyarınca, kişisel verileriniz veri sorumlusu sıfatıyla Dioreal Dijital tarafından hukuka ve dürüstlük kurallarına uygun olarak işlenmektedir.</p><p>Toplanan kişisel verileriniz, platform hizmetlerinin sunulması, iletişim taleplerinin karşılanması ve kullanıcı deneyiminin iyileştirilmesi amaçlarıyla sınırlı olarak işlenir ve 3. şahıslarla rızanız olmaksızın paylaşılmaz.</p>"
        },
        privacy: {
            title: "Gizlilik & Çerez Politikası",
            body: "<p><strong>Dioreal Dijital Gizlilik ve Çerez Politikası</strong></p><p>Sitemizde kullanıcı deneyimini ve sayfa performansını artırmak amacıyla zorunlu ve analitik çerezler kullanılmaktadır. Web sitemizi ziyaret ederek çerez kullanımını kabul etmiş sayılırsınız.</p><p>Toplanan trafik verileri kesinlikle ticari amaca yönelik 3. taraflara satılmaz veya devredilmez.</p>"
        },
        terms: {
            title: "Kullanım Koşulları",
            body: "<p><strong>Dioreal Dijital Kullanım Koşulları</strong></p><p>Dioreal Dijital web sitesinde yer alan tüm görsel, metin, marka ve özgün içeriklerin telif hakları saklıdır. Yazılı izin alınmaksızın kopyalanamaz veya ticari amaçla kullanılamaz.</p><p>Platformda sunulan otel, restoran ve yat içerikleri bilgilendirme amaçlıdır.</p>"
        }
    };

    function openLegalModal(key) {
        const item = legalTexts[key];
        if (!item) return;
        document.getElementById('legalModalTitle').innerHTML = item.title;
        document.getElementById('legalModalBody').innerHTML = item.body;
        document.getElementById('legalModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeLegalModal() {
        document.getElementById('legalModal').style.display = 'none';
        document.body.style.overflow = '';
    }

    document.getElementById('legalModal').addEventListener('click', function(e) {
        if (e.target === this) closeLegalModal();
    });
</script>
<?php /**PATH C:\Users\ahmet\Desktop\dioreal web\resources\views/partials/footer.blade.php ENDPATH**/ ?>