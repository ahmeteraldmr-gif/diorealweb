<footer id="iletisim">
    <div class="footer-top">
        <div class="footer-brand">
            <div class="footer-logo">DIOREAL</div>
            <p class="footer-p" data-i18n="footer_p">Seçkin destinasyonları ve premium markaları doğru kitleyle buluşturan medya platformu.</p>
            <a href="https://wa.me/{{ format_whatsapp($settings['whatsapp'] ?? '') }}" class="whatsapp-cta" target="_blank">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
                </svg>
                <span data-i18n="btn_contact_wa">WhatsApp İletişim</span>
            </a>
        </div>
        <div class="footer-col">
            <h4 data-i18n="footer_pages">Sayfalar</h4>
            <ul class="footer-links">
                <li><a href="{{ route('hakkimizda') }}" data-i18n="nav_about">Hakkımızda</a></li>
                <li><a href="{{ route('oteller') }}" data-i18n="nav_hotels">Oteller</a></li>
                <li><a href="{{ route('yatlar') }}" data-i18n="nav_yachts">Yatlar</a></li>
                <li><a href="{{ route('restoranlar') }}" data-i18n="nav_restaurants">Restoranlar</a></li>
                <li><a href="{{ route('gezi-rehberi') }}" data-i18n="nav_guide">Gezi Rehberi</a></li>
                <li><a href="{{ route('etkinlikler') }}" data-i18n="nav_events">Etkinlikler</a></li>
                <li><a href="{{ route('journal') }}" data-i18n="nav_journal">Journal</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4 data-i18n="footer_serv">Hizmetler</h4>
            <ul class="footer-links">
                <li><a href="{{ route('oteller') }}">Balayı Paketleri</a></li>
                <li><a href="{{ route('gezi-rehberi') }}">Aile Tatilleri</a></li>
                <li><a href="{{ route('etkinlikler') }}">Macera Turları</a></li>
                <li><a href="{{ route('gezi-rehberi') }}">Kültür Gezileri</a></li>
                <li><a href="{{ route('yatlar') }}">Özel Yat Hizmetleri</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4 data-i18n="footer_contact">İletişim</h4>
            <ul class="footer-links">
                @if(!empty($settings['contact_email']))
                    <li><a href="mailto:{{ $settings['contact_email'] }}">{{ $settings['contact_email'] }}</a></li>
                @endif
                @if(!empty($settings['contact_phone']))
                    <li><a href="tel:{{ str_replace(' ', '', $settings['contact_phone']) }}">{{ $settings['contact_phone'] }}</a></li>
                @endif
                <li>
                    <span class="lang-text-tr">{{ $settings['contact_address_tr'] ?? 'İstanbul, Türkiye' }}</span>
                    <span class="lang-text-en">{{ $settings['contact_address_en'] ?? 'Istanbul, Turkey' }}</span>
                </li>
                @if(!empty($settings['instagram']))
                    <li><a href="{{ $settings['instagram'] }}" target="_blank">Instagram</a></li>
                @endif
                @if(!empty($settings['linkedin']))
                    <li><a href="{{ $settings['linkedin'] }}" target="_blank">LinkedIn</a></li>
                @endif
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <span>{{ $settings['footer_copy'] ?? '© 2026 Dioreal Dijital. All Rights Reserved.' }}</span>
        <span>Est. 15 Years of Experience</span>
    </div>
</footer>
