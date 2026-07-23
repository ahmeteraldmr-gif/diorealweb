// ── CENTRAL TRANSLATION DATA ──
const DEFAULT_CONTENT = {
    // Nav
    "nav_home": { "tr": "Ana Sayfa", "en": "Home" },
    "nav_about": { "tr": "Hakkımızda", "en": "About" },
    "nav_hotels": { "tr": "Oteller", "en": "Hotels" },
    "nav_yachts": { "tr": "Yatlar", "en": "Yachts" },
    "nav_restaurants": { "tr": "Restoranlar", "en": "Restaurants" },
    "nav_guide": { "tr": "Destinasyonlar", "en": "Destinations" },
    "nav_events": { "tr": "Etkinlikler", "en": "Events" },
    "nav_journal": { "tr": "Journal", "en": "Journal" },
    "nav_turkey": { "tr": "Türkiye", "en": "Turkey" },
    "nav_intl": { "tr": "Yurtdışı", "en": "International" },
    "nav_collabs": { "tr": "İş Birlikleri", "en": "Partners" },
    
    // Common Buttons
    "btn_explore": { "tr": "Keşfet", "en": "Explore" },
    "btn_explore_trip": { "tr": "Turu İncele", "en": "Explore Trip" },
    "btn_apply": { "tr": "Başvuru Yap", "en": "Join Us" },
    "btn_contact": { "tr": "İletişime Geç", "en": "Contact" },
    "btn_cont": { "tr": "OKUMAYA DEVAM ET", "en": "CONTINUE READING" },
    "btn_contact_wa": { "tr": "WhatsApp İletişim", "en": "WhatsApp Contact" },
    "btn_review": { "tr": "İncele", "en": "Review" },
    "btn_plan_route": { "tr": "Rota Planlat", "en": "Plan Itinerary" },
    "btn_discover_tables": { "tr": "Masaları Keşfet", "en": "Discover Tables" },
    "btn_discover_col": { "tr": "Koleksiyonu Keşfet", "en": "Discover Collection" },
    "btn_continue_reading": { "tr": "Okumaya Devam Et", "en": "Continue Reading" },

    // Footer
    "footer_pages": { "tr": "Sayfalar", "en": "Pages" },
    "footer_serv": { "tr": "Hizmetler", "en": "Services" },
    "footer_contact": { "tr": "İletişim", "en": "Contact" },
    "footer_p": { "tr": "Seçkin destinasyonları ve premium markaları doğru kitleyle buluşturan medya platformu.", "en": "Media platform connecting exclusive destinations and premium brands with the right audience." },
    "cont_ist": { "tr": "İstanbul, Türkiye", "en": "Istanbul, Turkey" },
    "cont_ig": { "tr": "Instagram", "en": "Instagram" },
    "cont_li": { "tr": "LinkedIn", "en": "LinkedIn" },

    // Home Page
    "hero_line1": { "tr": "Türkiye ve dünyada seçkin", "en": "Opening doors to exclusive" },
    "hero_line2": { "tr": "deneyimlerin kapısını aralıyoruz.", "en": "experiences globally." },
    "man_eyebrow": { "tr": "BU AYIN SEÇKİNLERİ", "en": "THIS MONTH'S SELECTION" },
    "man_p1": { "tr": "Sizler için özenle seçtiğimiz bu ayın en trend otel, restoran, yat ve plaj lokasyonlarının ardındaki eşsiz hikayeleri keşfedin. Sıradanlığın ötesinde anılar biriktirmeniz için tasarlanmış özel deneyimler.", "en": "Explore the unique stories behind this month's trending hotels, restaurants, yachts, and beach spots carefully selected for you. Bespoke experiences designed for you to gather memories beyond the ordinary." },
    "dest_tr_eyebrow": { "tr": "SEYAHATLERİMİZİ KEŞFEDİN", "en": "EXPLORE OUR TRIPS" },
    "dest_tr_title": { "tr": "Türkiye'nin", "en": "Soul of" },
    "dest_tr_it": { "tr": "Ruhu", "en": "Turkey" },
    "dest_tr_desc": { "tr": "Benzersiz deneyimlerin ilham veren hikayesi", "en": "The inspiring story of unique experiences" },
    "dest_en_main": { "tr": "YOLCULUĞUNUZA BAŞLAYIN", "en": "START YOUR JOURNEY" },
    "collab_eyebrow": { "tr": "Referanslar", "en": "References" },
    "collab_title": { "tr": "Marka & İş Birlikleri", "en": "Brands & Collaborations" },
    "proc_eyebrow": { "tr": "Metodoloji", "en": "Methodology" },
    "proc_title": { "tr": "Nasıl", "en": "How" },
    "proc_it": { "tr": "Çalışıyoruz?", "en": "We Work?" },
    "proc_h1": { "tr": "Hayal Kurun", "en": "Dream" },
    "proc_p1": { "tr": "Bize rüya seyahatinizi anlatın. Hayallerinizi özgürce paylaşın.", "en": "Tell us about your dream trip. Share your dreams freely." },
    "proc_h2": { "tr": "Tasarlayalım", "en": "Design" },
    "proc_p2": { "tr": "Uzman ekibimiz size özel, detaylı bir program hazırlar.", "en": "Our expert team prepares a detailed, personalized program for you." },
    "proc_h3": { "tr": "Mükemmelleştirin", "en": "Perfect" },
    "proc_p3": { "tr": "Her detayı birlikte gözden geçiririz. Tamamı ince ayrıntısına kadar planlanır.", "en": "We review every detail together. Everything is planned down to the fine points." },
    "proc_h4": { "tr": "Yola Çıkın", "en": "Set Off" },
    "proc_p4": { "tr": "Tüm organizasyon hazır. Geri kalanı tamamen bizde.", "en": "All organization is ready. The rest is entirely up to us." },
    "testi_quote": { "tr": "Dioreal Dijital ile yaptığımız iş birliği, markamızın global vizyonunu tam olarak yansıtan benzersiz bir deneyimdi.", "en": "Our collaboration with Dioreal Digital was a unique experience that fully reflected our global vision." },
    "testi_author": { "tr": "— Seçkin İş Ortakları", "en": "— Exclusive Business Partners" },
    "mq_mald": { "tr": "Maldivler", "en": "Maldives" },
    "mq_jap": { "tr": "Japonya", "en": "Japan" },
    "mq_pat": { "tr": "Patagonya", "en": "Patagonia" },
    "mq_ama": { "tr": "Amalfi Kıyısı", "en": "Amalfi Coast" },
    "mq_nor": { "tr": "Norveç Fiyortları", "en": "Norway Fjords" },
    "mq_sah": { "tr": "Sahra Çölü", "en": "Sahara Desert" },

    // Hakkımızda Page
    "about_eyebrow": { "tr": "Biz Kimiz", "en": "Who We Are" },
    "about_title": { "tr": "<em>Dioreal</em> Dijital", "en": "<em>Dioreal</em> Digital" },
    "story_eyebrow": { "tr": "Hikayemiz", "en": "Our Story" },
    "story_title": { "tr": "15 yıldır lüks <em>seyahatin</em> sesi", "en": "Voice of luxury <em>travel</em> for 15 years" },
    "about_p1": { "tr": "2010 yılında İstanbul'da kurulan Dioreal Dijital, Türkiye'nin öncü lüks seyahat ve yaşam tarzı medya platformuna dönüşmüştür.", "en": "Founded in Istanbul in 2010, Dioreal Digital has evolved into Turkey's leading luxury travel and lifestyle media platform." },
    "about_p2": { "tr": "Her destinasyonda bizzat bulunarak, her oteli bizatihi deneyimleyerek ve her markayı özenle seçerek güvenilir bir referans noktası haline geldik.", "en": "By personally visiting every destination and experiencing every hotel firsthand, we've become a trusted reference." },
    "stats_eyebrow": { "tr": "Rakamlarla", "en": "By Numbers" },
    "stats_title": { "tr": "15 Yılın <em>Mirası</em>", "en": "Legacy of <em>15 Years</em>" },
    "stat_dest": { "tr": "Destinasyon", "en": "Destinations" },
    "stat_readers": { "tr": "Aylık Okuyucu", "en": "Monthly Readers" },
    "stat_brands": { "tr": "Marka Ortağı", "en": "Brand Partners" },
    "stat_exp": { "tr": "Yıllık Deneyim", "en": "Years of Experience" },
    "mission_eyebrow": { "tr": "Misyonumuz", "en": "Our Mission" },
    "mission_title": { "tr": "Anlamlı <em>deneyimler</em> için", "en": "For meaningful <em>experiences</em>" },
    "mission_p1": { "tr": "Sadece güzel yerler göstermiyoruz. Seyahatin ruhunu, bir destinasyonun gerçek özünü aktarıyoruz.", "en": "We don't just show beautiful places. We convey the true essence of a destination." },

    // Oteller
    "otel_hero_eye": { "tr": "Premium Konaklama", "en": "Premium Accommodation" },
    "otel_exp_eye": { "tr": "Deneyim Tasarımı", "en": "Experience Design" },
    "otel_exp_title": { "tr": "Her konaklamanın bir <em>hikayesi</em> vardır", "en": "Every stay has a <em>story</em>" },
    "otel_maxx_desc": { "tr": "Eşsiz Ege manzarası ve ultra-lüks tesisleriyle benzersiz bir deneyim sunan 5 yıldızlı resort.", "en": "A 5-star resort offering a unique experience with stunning Aegean views." },
    "otel_museum_desc": { "tr": "Antik kaya oymaları içinde, tarihin derinliklerinde unutulmaz bir konaklama deneyimi.", "en": "An unforgettable stay deep in history, inside ancient rock carvings." },

    // Yatlar
    "yacht_hero_eye": { "tr": "Akdeniz'de Özgürlük", "en": "Freedom in the Mediterranean" },
    "yacht_hol_eye": { "tr": "Yat Tatili", "en": "Yacht Holiday" },
    "yacht_hol_title": { "tr": "Koydan koya, <em>özgürce</em>", "en": "From bay to bay, <em>freely</em>" },

    // Restoranlar
    "rest_hero_eye": { "tr": "Gastronomi Deneyimi", "en": "Gastronomy Experience" },
    "rest_intro_eye": { "tr": "Lezzet & Atmosfer", "en": "Flavor & Atmosphere" },
    "rest_intro_title": { "tr": "Yemek bir <em>sanat</em>tır", "en": "Dining is an <em>art</em>" },

    // Gezi Rehberi
    "guide_hero_eye": { "tr": "Keşfet & Öğren", "en": "Discover & Learn" },
    "guide_exp_eye": { "tr": "Uzman Tavsiyeleri", "en": "Expert Advice" },

    // Etkinlikler
    "event_hero_eye": { "tr": "Takvim 2026", "en": "Calendar 2026" },
    "event_intro_eye": { "tr": "Bu Sezon", "en": "This Season" },

    // Journal
    "journal_hero_eye": { "tr": "Hikayeler & İçgörüler", "en": "Stories & Insights" },
    "journal_latest_title": { "tr": "Son <em>Yazılar</em>", "en": "Latest <em>Articles</em>" },

    // Index Trends & Tabs
    "trend_otel": { "tr": "Trend Otel", "en": "Trending Hotel" },
    "kassandra_p": { "tr": "Ege'nin gizli kalmış koylarında uyanmanın eşsiz hissi.", "en": "The unique feeling of waking up in the hidden bays of the Aegean." },
    "trend_rest": { "tr": "Trend Restoran", "en": "Trending Restaurant" },
    "melengec_p": { "tr": "Taze deniz ürünleri ile unutulmaz bir gastronomi yolculuğu.", "en": "An unforgettable gastronomic journey with fresh seafood." },
    "trend_yat": { "tr": "Trend Yat", "en": "Trending Yacht" },
    "blue_p": { "tr": "Sonsuz mavilikte rotalar. Rüzgarın sesinden başka hiçbir şey yok.", "en": "Routes in infinite blue. Nothing but the sound of the wind." },
    "trend_beach": { "tr": "Trend Beach", "en": "Trending Beach" },
    "rups_p": { "tr": "Altın kumlar ve kristal sular. Müziğin ritmine eşlik eden anlar.", "en": "Golden sands and crystal waters. Moments accompanying the rhythm of the music." },
    "tab_popular": { "tr": "EN POPÜLER", "en": "MOST POPULAR" },
    "tab_traveller": { "tr": "GEZGİNE GÖRE", "en": "BY TRAVELER" },
    "tab_month": { "tr": "AYA GÖRE", "en": "BY MONTH" },
    "tab_spotlight": { "tr": "VİTRİNDEKİLER", "en": "SPOTLIGHT" },
    "trend_otel_title": { "tr": "Kassandra Villa", "en": "Kassandra Villa" },
    "trend_rest_title": { "tr": "Melengeç", "en": "Melengeç" },
    "trend_yat_title": { "tr": "Blue Voyage", "en": "Blue Voyage" },
    "trend_beach_title": { "tr": "Rups Beach", "en": "Rups Beach" },
    
    // Details Pages
    "detail_about_hotel": { "tr": "Otel <em>Hakkında</em>", "en": "About <em>Hotel</em>" },
    "detail_about_rest": { "tr": "Mekan <em>Hakkında</em>", "en": "About <em>Venue</em>" },
    "detail_gallery": { "tr": "Fotoğraf <em>Galerisi</em>", "en": "Photo <em>Gallery</em>" },
    "detail_booking_hotel": { "tr": "Rezervasyon Yap", "en": "Book a Room" },
    "detail_booking_rest": { "tr": "Masa Ayırt", "en": "Book a Table" },
    "detail_contact_info": { "tr": "İletişim & Konum", "en": "Contact & Location" },
    "detail_no_gallery": { "tr": "Galeri bulunmamaktadır.", "en": "No gallery photos found." }
};

const updateLang = (lang) => {
    document.documentElement.setAttribute('lang', lang);
    document.querySelectorAll('[data-i18n]').forEach(el => {
        const key = el.getAttribute('data-i18n');
        if (DEFAULT_CONTENT[key]) {
            el.innerHTML = DEFAULT_CONTENT[key][lang];
        }
    });
    // Active class for buttons
    document.querySelectorAll('.lang-btn').forEach(btn => btn.classList.remove('active'));
    const selector = lang === 'tr' ? '#lang-tr, #lang-tr-fs' : '#lang-en, #lang-en-fs';
    document.querySelectorAll(selector).forEach(btn => btn.classList.add('active'));
    
    localStorage.setItem('dioreal_lang', lang);
    document.dispatchEvent(new CustomEvent('langChanged', { detail: lang }));
};

document.addEventListener("DOMContentLoaded", () => {
    // Check URL query parameter first for search crawler / state persistence support
    const urlParams = new URLSearchParams(window.location.search);
    let lang = urlParams.get('lang');
    
    if (!lang) {
        lang = localStorage.getItem('dioreal_lang');
    }
    
    if (!lang) {
        lang = document.documentElement.getAttribute('lang') || 'tr';
    }
    
    updateLang(lang);

    // Setup click handlers for TR/EN switches to follow alternate localized links if present
    document.querySelectorAll('#lang-en, #lang-en-fs').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const altLink = document.querySelector('link[rel="alternate"][hreflang="en"]');
            if (altLink && altLink.href) {
                localStorage.setItem('dioreal_lang', 'en');
                window.location.href = altLink.href;
            } else {
                updateLang('en');
            }
        });
    });

    document.querySelectorAll('#lang-tr, #lang-tr-fs').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const altLink = document.querySelector('link[rel="alternate"][hreflang="tr"]');
            if (altLink && altLink.href) {
                localStorage.setItem('dioreal_lang', 'tr');
                window.location.href = altLink.href;
            } else {
                updateLang('tr');
            }
        });
    });
});
