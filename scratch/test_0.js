
        function toggleSidebar() {
            document.querySelector('aside').classList.toggle('mobile-open');
            document.getElementById('sidebarOverlay').classList.toggle('active');
        }

        /* ============================================================
           DEFAULT DATA — mevcut hardcoded içerikten türetilmiş
        ============================================================ */
        const DEFAULT_HOTELS = [
            { id:1, name:{tr:'Maxx Royal Bodrum', en:'Maxx Royal Bodrum'}, tag:{tr:'Bodrum, Türkiye', en:'Bodrum, Turkey'}, img:'foto.img/otel_maxx_royal.jpg', desc:{ tr:'Eşsiz Ege manzarası ve ultra-lüks tesisleriyle benzersiz bir deneyim sunan 5 yıldızlı resort.', en:'A 5-star resort offering a unique experience with stunning Aegean views and ultra-luxury facilities.' } },
            { id:2, name:{tr:'Museum Hotel', en:'Museum Hotel'}, tag:{tr:'Kapadokya, Türkiye', en:'Cappadocia, Turkey'}, img:'foto.img/otel_museum.jpg', desc:{ tr:'Antik kaya oymaları içinde, tarihin derinliklerinde unutulmaz bir konaklama deneyimi.', en:'An unforgettable stay deep in history, inside ancient rock carvings.' } },
            { id:3, name:{tr:'Hillside Beach Club', en:'Hillside Beach Club'}, tag:{tr:'Fethiye, Türkiye', en:'Fethiye, Turkey'}, img:'foto.img/otel_hillside.jpg', desc:{ tr:"Özel plajı, eşsiz koyu ve lüks hizmetleriyle Türkiye'nin en prestijli tatil köyü.", en:"Turkey's most prestigious resort with its private beach, unique bay and luxury services." } },
            { id:4, name:{tr:'Soneva Jani', en:'Soneva Jani'}, tag:{tr:'Maldivler', en:'Maldives'}, img:'foto.img/otel_soneva.jpg', desc:{ tr:'Su üstü villalar, kristal berraklığında lagün ve sonsuz gökyüzü altında rüya konaklama.', en:'Overwater villas, crystal-clear lagoon and dream accommodation under endless skies.' } },
            { id:5, name:{tr:'Aman Kyoto', en:'Aman Kyoto'}, tag:{tr:'Japonya', en:'Japan'}, img:'foto.img/otel_aman.jpg', desc:{ tr:'Japon wabi-sabi felsefesini modern lüksle harmanlayan, orman içinde saklı benzersiz bir sığınak.', en:"A unique retreat hidden in the forest, blending Japan's wabi-sabi philosophy with modern luxury." } },
            { id:6, name:{tr:'Le Sirenuse', en:'Le Sirenuse'}, tag:{tr:'Amalfi Kıyısı, İtalya', en:'Amalfi Coast, Italy'}, img:'foto.img/otel_sirenuse.jpg', desc:{ tr:"Positano'nun ikonik manzarası karşısında, denizi ve bougainvillea'ları izleyen efsanevi butik otel.", en:"Legendary boutique hotel overlooking the sea and bougainvilleas, facing Positano's iconic view." } }
        ];

        const DEFAULT_RESTAURANTS = [
            { id:1, name:{tr:'Mikla', en:'Mikla'}, tag:{tr:'İstanbul · Fine Dining', en:'Istanbul · Fine Dining'}, img:'foto.img/rest_mikla.jpg', desc:{ tr:"Boğaz manzarasına hâkim terası ve Türk-İskandinav mutfağı füzyonuyla İstanbul'un efsanevi adresi.", en:"Istanbul's legendary address with its Bosphorus terrace and Turkish-Scandinavian fusion cuisine." } },
            { id:2, name:{tr:'Zuma Bodrum', en:'Zuma Bodrum'}, tag:{tr:'Bodrum · Deniz Kenarı', en:'Bodrum · Seaside'}, img:'foto.img/rest_zuma.jpg', desc:{ tr:"Japon Izakaya geleneğini modern lüksle buluşturan, Bodrum Marina'nın en prestijli restoranı.", en:"Bodrum Marina's most prestigious restaurant, blending Japanese Izakaya tradition with modern luxury." } },
            { id:3, name:{tr:'Melengeç Restaurant', en:'Melengeç Restaurant'}, tag:{tr:'Çeşme · Meyhane', en:'Cesme · Tavern'}, img:'foto.img/rest_melengec.jpg', desc:{ tr:"Ege'nin en taze deniz ürünleri, nefis zeytinyağlılar ve muhteşem Alaçatı manzarasıyla unutulmaz bir sofra.", en:"An unforgettable table with Aegean's freshest seafood, delicious olive oil dishes and Alaçatı views." } },
            { id:4, name:{tr:'Hideaway', en:'Hideaway'}, tag:{tr:'Kaş · Teras', en:'Kas · Terrace'}, img:'foto.img/rest_hideaway.jpg', desc:{ tr:"Denize 10 metre yukarıdan bakan terası ve yaratıcı Akdeniz menüsüyle Kaş'ın en romantik adresi.", en:"Kas's most romantic address with its terrace overlooking the sea and creative Mediterranean menu." } },
            { id:5, name:{tr:'Seki Restaurant', en:'Seki Restaurant'}, tag:{tr:'Kapadokya · Şarap & Yemek', en:'Cappadocia · Wine & Dine'}, img:'foto.img/rest_seki.jpg', desc:{ tr:'Çardak altında Kapadokya üzüm bağlarından derlenmiş yerel şaraplar ve Anadolu mutfağının en güzel yorumu.', en:'Local wines from Cappadocia vineyards and the finest interpretation of Anatolian cuisine under a pergola.' } },
            { id:6, name:{tr:'Ölüdeniz Terrace', en:'Ölüdeniz Terrace'}, tag:{tr:'Fethiye · Beach Club', en:'Fethiye · Beach Club'}, img:'foto.img/rest_oludeniz.jpg', desc:{ tr:'Dünyaca ünlü Ölüdeniz lagünüyle iç içe geçmiş sahil restoranı, taze balık ve kokteyller.', en:'Beachfront restaurant intertwined with the world-famous Ölüdeniz lagoon, fresh fish and cocktails.' } }
        ];

        const _svgLogo = (text, font='sans-serif', style='', size=24) =>
            `data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 60'><text x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' font-family='${font}' font-size='${size}' font-style='${style}' fill='%23000'>${text}</text></svg>`;

        const DEFAULT_REFS = [
            { id:1,  name:'Nautical',      img:_svgLogo('Nautical','serif','',24) },
            { id:2,  name:'PERDUE',        img:_svgLogo('PERDUE','sans-serif','',28) },
            { id:3,  name:'Kassandra',     img:_svgLogo('Kassandra','serif','italic',22) },
            { id:4,  name:'ZAKROS',        img:_svgLogo('ZAKROS','sans-serif','',26) },
            { id:5,  name:'HUAWEI',        img:_svgLogo('HUAWEI','sans-serif','',26) },
            { id:6,  name:'SONY',          img:_svgLogo('SONY','sans-serif','',26) },
            { id:7,  name:'oppo',          img:_svgLogo('oppo','sans-serif','',26) },
            { id:8,  name:'CapCut',        img:_svgLogo('CapCut','sans-serif','',22) },
            { id:9,  name:'Hus Wines',     img:_svgLogo('Hus Wines','serif','italic',24) },
            { id:10, name:'RUPS',          img:_svgLogo('RUPS','sans-serif','',22) },
            { id:11, name:'Despot Evi',    img:_svgLogo('Despot Evi','serif','',20) },
            { id:12, name:'BLUE VOYAGE',   img:_svgLogo('BLUE VOYAGE','sans-serif','',20) }
        ];

        const DEFAULT_CONTACT = {
            email: 'info@diorealdijital.com',
            phone: '+90 212 555 0100',
            whatsapp: '905320000000',
            address_tr: 'İstanbul, Türkiye',
            address_en: 'Istanbul, Turkey',
            instagram: '#',
            linkedin: '#',
            footer_copy: '© 2026 Dioreal Dijital. All Rights Reserved.'
        };

        const DEFAULT_GUIDE = [
            { id:1, title:{tr:'Bodrum Komple Rehber', en:'Bodrum Complete Guide'}, tag:{tr:'Destinasyon Rehberi', en:'Destination Guide'}, img:'foto.img/bodrum.jpg', desc:{ tr:"Gidilecek plajlar, gece hayatı, en iyi restoranlar ve gizli koylar. Bodrum'da yapılacak her şey.", en:"Beaches to go, night life, best restaurants and hidden bays. Everything to do in Bodrum." } },
            { id:2, title:{tr:'Kapadokya Gizli Köşeleri', en:'Hidden Corners of Cappadocia'}, tag:{tr:'Destinasyon Rehberi', en:'Destination Guide'}, img:'foto.img/kapadokya.jpg', desc:{ tr:"Turistik yerler dışında, peri bacalarının arasında saklı kalmış otantik köyler.", en:"Authentic villages hidden among fairy chimneys, apart from tourist attractions." } },
            { id:3, title:{tr:'Çeşme & Alaçatı Mayıs', en:'Cesme & Alacati May'}, tag:{tr:'Sezon Rehberi', en:'Season Guide'}, img:'foto.img/cesme.jpg', desc:{ tr:"Kalabalık öncesi Çeşme'nin en keyifli hali. Rüzgar festivali ve sakin kafeler.", en:"The most pleasant state of Cesme before the crowd. Wind festival and quiet cafes." } }
        ];

        const DEFAULT_EVENTS = [
            { id:1, title:{tr:'İstanbul Yemek Festivali 2026', en:'Istanbul Food Festival 2026'}, tag:{tr:'Gastronomi', en:'Gastronomy'}, day:15, month:{tr:'Mayıs', en:'May'}, loc:{tr:'📍 Beşiktaş Meydanı, İstanbul', en:'📍 Besiktas Square, Istanbul'} },
            { id:2, title:{tr:'Bodrum Uluslararası Bale Festivali', en:'Bodrum International Ballet Festival'}, tag:{tr:'Kültür & Sanat', en:'Culture & Art'}, day:22, month:{tr:'Mayıs', en:'May'}, loc:{tr:'📍 Bodrum Kalesi Açık Hava Sahnesi', en:'📍 Bodrum Castle Open Air Stage'} },
            { id:3, title:{tr:'Alaçatı Rüzgar Sörfü Festivali', en:'Alacati Windsurfing Festival'}, tag:{tr:'Spor & Macera', en:'Sport & Adventure'}, day:8, month:{tr:'Haziran', en:'June'}, loc:{tr:'📍 Alaçatı Limanı, Çeşme', en:'📍 Alacati Port, Cesme'} }
        ];

        const DEFAULT_JOURNAL = [
            { id:1, title:{tr:"Japonya'da Çay Seremonisi", en:"Tea Ceremony in Japan"}, tag:{tr:'Yurtdışı · Asya', en:'Abroad · Asia'}, date:'22 Nisan 2026', img:'foto.img/japonya.jpg', desc:{ tr:"Kyoto'nun arka sokaklarında yaşadığımız benzersiz çay deneyimi.", en:"Unique tea experience we had in the back streets of Kyoto." } },
            { id:2, title:{tr:'Su Üstü Villada Bir Hafta', en:'A Week in an Overwater Villa'}, tag:{tr:'Konaklama', en:'Accommodation'}, date:'15 Nisan 2026', img:'foto.img/maldivler.jpg', desc:{ tr:"Maldivler'de su üstü villa deneyimi gerçekten değer mi?", en:"Is the overwater villa experience in the Maldives really worth it?" } },
            { id:3, title:{tr:'Bodrum\'da Bir Yaz: Sessizlik', en:'A Summer in Bodrum: Silence'}, tag:{tr:'Türkiye · Ege', en:'Turkey · Aegean'}, date:'10 Nisan 2026', img:'foto.img/bodrum.jpg', desc:{ tr:"Sezon öncesi Bodrum'un sakinliği ve huzuru.", en:"The peace and quiet of Bodrum before the season." } },
            { id:4, title:{tr:'Kapadokya\'da Balon Keyfi', en:'Hot Air Balloon in Cappadocia'}, tag:{tr:'Kültür · Macera', en:'Culture · Adventure'}, date:'05 Nisan 2026', img:'foto.img/kapadokya.jpg', desc:{ tr:"Peri bacaları üzerinde unutulmaz bir uçuş.", en:"An unforgettable flight over fairy chimneys." } },
            { id:5, title:{tr:'Patagonya Sessizliği', en:'Patagonia Silence'}, tag:{tr:'Yurtdışı · Doğa', en:'Abroad · Nature'}, date:'01 Nisan 2026', img:'foto.img/patagonya.jpg', desc:{ tr:"Dünyanın ucunda doğayla baş başa.", en:"Alone with nature at the end of the world." } }
        ];

        const DEFAULT_YACHTS = [
            { id:1, name:{tr:'Bodrum Blue', en:'Bodrum Blue'}, tag:{tr:'Gulet · 24m', en:'Gulet · 24m'}, img:'foto.img/yat_bodrum_blue.jpg', desc:{ tr:'8 misafir kapasiteli, teak güverteli, Türk el sanatlarıyla donatılmış geleneksel Bodrum gulet\'i.', en:'Traditional Bodrum gulet for 8 guests, with teak deck and Turkish handicrafts.' } },
            { id:2, name:{tr:'Azure Dream', en:'Azure Dream'}, tag:{tr:'Motor Yat · 35m', en:'Motor Yacht · 35m'}, img:'foto.img/yat_azure_dream.jpg', desc:{ tr:'12 misafir kapasiteli, helikopter pisti, jakuzi ve tam donanımlı modern süper yat deneyimi.', en:'Modern super yacht for 12 guests, featuring helipad, jacuzzi and full equipment.' } },
            { id:3, name:{tr:'Aegean Wind', en:'Aegean Wind'}, tag:{tr:'Yelkenli · 18m', en:'Sailing Yacht · 18m'}, img:'foto.img/yat_aegean_wind.jpg', desc:{ tr:'6 misafir için özel, rüzgarın gücüyle Ege\'yi keşfetmek isteyenler için premium yelkenli yat.', en:'Premium sailing yacht for 6 guests, for those who want to explore the Aegean with wind power.' } }
        ];

        /* ── DATA STATE ── */
        let hotelsData = [];
        let yachtsData = [];
        let restaurantsData = [];
        let refsData = [];
        let contactData = {};
        let guideData = [];
        let eventsData = [];
        let journalData = [];

        /* ── LOAD / SAVE ── */
        function loadGuides() {
            const s = DioAPI.loadSync('dioreal_guide_data');
            guideData = s ? JSON.parse(JSON.stringify(s)) : JSON.parse(JSON.stringify(DEFAULT_GUIDE));
        }
        function saveGuides() {
            DioAPI.save('dioreal_guide_data', guideData, function() {
                showToast('Rehberler kaydedildi!', 'check');
                updateDashboardStats();
            });
        }
        function loadEvents() {
            const s = DioAPI.loadSync('dioreal_events_data');
            eventsData = s ? JSON.parse(JSON.stringify(s)) : JSON.parse(JSON.stringify(DEFAULT_EVENTS));
        }
        function saveEvents() {
            DioAPI.save('dioreal_events_data', eventsData, function() {
                showToast('Etkinlikler kaydedildi!', 'check');
                updateDashboardStats();
            });
        }
        function loadJournal() {
            const s = DioAPI.loadSync('dioreal_journal_data');
            journalData = s ? JSON.parse(JSON.stringify(s)) : JSON.parse(JSON.stringify(DEFAULT_JOURNAL));
        }
        function saveJournal() {
            DioAPI.save('dioreal_journal_data', journalData, function() {
                showToast('Journal yazıları kaydedildi!', 'check');
                updateDashboardStats();
            });
        }
        function loadHotels() {
            const s = DioAPI.loadSync('dioreal_hotels_data');
            hotelsData = s ? JSON.parse(JSON.stringify(s)) : JSON.parse(JSON.stringify(DEFAULT_HOTELS));
        }
        function saveHotels() {
            DioAPI.save('dioreal_hotels_data', hotelsData, function() {
                showToast('Oteller kaydedildi!', 'check');
                updateDashboardStats();
            });
        }
        function loadYachts() {
            const s = DioAPI.loadSync('dioreal_yachts_data');
            yachtsData = s ? JSON.parse(JSON.stringify(s)) : JSON.parse(JSON.stringify(DEFAULT_YACHTS));
        }
        function saveYachts() {
            DioAPI.save('dioreal_yachts_data', yachtsData, function() {
                showToast('Yatlar kaydedildi!', 'check');
                updateDashboardStats();
            });
        }
        function loadRestaurants() {
            const s = DioAPI.loadSync('dioreal_restaurants_data');
            restaurantsData = s ? JSON.parse(JSON.stringify(s)) : JSON.parse(JSON.stringify(DEFAULT_RESTAURANTS));
        }
        function saveRestaurants() {
            DioAPI.save('dioreal_restaurants_data', restaurantsData, function() {
                showToast('Restoranlar kaydedildi!', 'check');
                updateDashboardStats();
            });
        }
        function loadRefs() {
            const s = DioAPI.loadSync('dioreal_refs_data');
            refsData = s ? JSON.parse(JSON.stringify(s)) : JSON.parse(JSON.stringify(DEFAULT_REFS));
        }
        function saveRefs() {
            DioAPI.save('dioreal_refs_data', refsData, function() {
                showToast('Referanslar kaydedildi!', 'check');
            });
        }
        function loadContact() {
            const s = DioAPI.loadSync('dioreal_contact_data');
            contactData = s ? JSON.parse(JSON.stringify(s)) : JSON.parse(JSON.stringify(DEFAULT_CONTACT));
        }
        function saveContact() {
            contactData.email       = document.getElementById('cont-email').value;
            contactData.phone       = document.getElementById('cont-phone').value;
            contactData.whatsapp    = document.getElementById('cont-whatsapp').value;
            contactData.address_tr  = document.getElementById('cont-address-tr').value;
            contactData.address_en  = document.getElementById('cont-address-en').value;
            contactData.instagram   = document.getElementById('cont-instagram').value;
            contactData.linkedin    = document.getElementById('cont-linkedin').value;
            contactData.footer_copy = document.getElementById('cont-footer-copy').value;
            DioAPI.save('dioreal_contact_data', contactData, function() {
                showToast('İletişim bilgileri kaydedildi!', 'check');
            });
        }

        /* ── HOTELS CRUD ── */
        function renderHotelsList() {
            const list = document.getElementById('hotelMgrList');
            if (!list) return;
            if (hotelsData.length === 0) {
                list.innerHTML = '<p style="padding:2rem;color:var(--text-muted);">Henüz otel eklenmemiş.</p>';
                return;
            }
            list.innerHTML = hotelsData.map(h => {
                const nameTr = (h.name && typeof h.name === 'object') ? h.name.tr : (h.name || '');
                const nameEn = (h.name && typeof h.name === 'object') ? h.name.en : '';
                const tagTr  = (h.tag && typeof h.tag === 'object') ? h.tag.tr : (h.tag || '');
                const tagEn  = (h.tag && typeof h.tag === 'object') ? h.tag.en : '';
                const descTr = (h.desc && typeof h.desc === 'object') ? h.desc.tr : (h.desc || '');

                const descEn = (h.desc && typeof h.desc === 'object') ? h.desc.en : '';
                const longDescTr = (h.long_desc && typeof h.long_desc === 'object') ? h.long_desc.tr : (h.long_desc || '');
                const longDescEn = (h.long_desc && typeof h.long_desc === 'object') ? h.long_desc.en : '';


                return `
                <div class="mgr-item" id="hotel-item-${h.id}">
                    <div class="mgr-item-row">
                        <img class="mgr-item-thumb" src="${h.img}" alt="${nameTr}">
                        <div class="mgr-item-info">
                            <div class="mgr-item-name">${nameTr}</div>
                            <div class="mgr-item-tag"><i class="fas fa-map-marker-alt" style="font-size:0.7rem;margin-right:3px;color:var(--primary);"></i>${tagTr}</div>
                        </div>
                        <div class="mgr-item-actions">
                            <button class="btn btn-outline" style="padding:0.5rem 1rem;font-size:0.8rem;" onclick="toggleEditHotel(${h.id})"><i class="fas fa-edit"></i> Düzenle</button>
                            <button class="btn" style="padding:0.5rem 1rem;font-size:0.8rem;background:#fee2e2;color:#ef4444;border:none;" onclick="deleteHotel(${h.id})"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                    <div class="mgr-item-edit-area" id="hotel-edit-${h.id}">
                        <div class="mgr-form-grid">
                            <div class="mgr-field"><label>Otel Adı (TR)</label><input type="text" value="${nameTr}" oninput="updateHotelSubField(${h.id},'name','tr',this.value)"></div>
                            <div class="mgr-field"><label>Otel Adı (EN)</label><input type="text" value="${nameEn}" oninput="updateHotelSubField(${h.id},'name','en',this.value)"></div>
                            <div class="mgr-field"><label>Konum Etiketi (TR)</label><input type="text" value="${tagTr}" oninput="updateHotelSubField(${h.id},'tag','tr',this.value)"></div>
                            <div class="mgr-field"><label>Konum Etiketi (EN)</label><input type="text" value="${tagEn}" oninput="updateHotelSubField(${h.id},'tag','en',this.value)"></div>
                            <div class="mgr-field"><label>Görsel Yolu</label><input type="text" value="${h.img}" oninput="updateHotelField(${h.id},'img',this.value)"></div>
                            <div class="mgr-field"><label>Görsel Değiştir</label><input type="file" accept="image/*" onchange="replaceHotelImg(${h.id},this)"></div>
                            <div class="mgr-field"><label>Açıklama (TR)</label><textarea oninput="updateHotelDesc(${h.id},'tr',this.value)">${descTr}</textarea></div>

                            <div class="mgr-field"><label>Açıklama (EN)</label><textarea oninput="updateHotelDesc(${h.id},'en',this.value)">${descEn}</textarea></div>
                            <div class="mgr-field" style="grid-column:1/-1;"><label>Detay Sayfası Uzun Açıklama (TR)</label><textarea style="height:120px;" oninput="updateHotelSubField(${h.id},'long_desc','tr',this.value)">${longDescTr}</textarea></div>
                            <div class="mgr-field" style="grid-column:1/-1;"><label>Detay Sayfası Uzun Açıklama (EN)</label><textarea style="height:120px;" oninput="updateHotelSubField(${h.id},'long_desc','en',this.value)">${longDescEn}</textarea></div>
                            <div class="mgr-field" style="grid-column:1/-1;"><label>Galeri (Yeni Resim Ekle)</label><input type="file" accept="image/*" onchange="addHotelGalleryImg(${h.id},this)"></div>
                            <div class="mgr-field" style="grid-column:1/-1;">
                                <div style="display:flex; gap:10px; flex-wrap:wrap;">
                                    ${(h.gallery || []).map((g, idx) => `<div style="position:relative;"><img src="${g}" style="width:80px;height:80px;object-fit:cover;border-radius:4px;"><button type="button" onclick="removeHotelGalleryImg(${h.id},${idx})" style="position:absolute;top:0;right:0;background:red;color:white;border:none;cursor:pointer;width:20px;height:20px;border-radius:50%;font-size:10px;">X</button></div>`).join('')}
                                </div>
                            </div>

                        </div>
                        <button class="btn btn-primary" style="margin-top:0.5rem;" onclick="saveHotels();toggleEditHotel(${h.id})"><i class="fas fa-save"></i> Kaydet</button>
                    </div>
                </div>
            `; }).join('');
        }
        function toggleEditHotel(id) { document.getElementById(`hotel-edit-${id}`).classList.toggle('open'); }
        function updateHotelField(id, field, val) {
            const h = hotelsData.find(x => x.id === id);
            if (h) h[field] = val;
        }
        function updateHotelSubField(id, parent, lang, val) {
            const h = hotelsData.find(x => x.id === id);
            if (h) {
                if (typeof h[parent] !== 'object') h[parent] = { tr: h[parent] || '', en: '' };
                h[parent][lang] = val;
            }
        }
        function updateHotelDesc(id, lang, val) {
            const h = hotelsData.find(x => x.id === id);
            if (h) {
                if (typeof h.desc !== 'object') h.desc = { tr: h.desc || '', en: '' };
                h.desc[lang] = val;
            }
        }
        function addHotelGalleryImg(id, input) {
            const file = input.files[0]; if (!file) return;
            const reader = new FileReader();
            reader.onload = e => {
                const h = hotelsData.find(x => x.id === id);
                if (h) {
                    if (!h.gallery) h.gallery = [];
                    h.gallery.push(e.target.result);
                    renderHotelsList(); toggleEditHotel(id); showToast('Galeri resmi eklendi!');
                }
            };
            reader.readAsDataURL(file);
        }
        function removeHotelGalleryImg(id, idx) {
            const h = hotelsData.find(x => x.id === id);
            if (h && h.gallery) {
                h.gallery.splice(idx, 1);
                renderHotelsList(); toggleEditHotel(id); showToast('Galeri resmi silindi!');
            }
        }
        function replaceHotelImg(id, input) {
            const file = input.files[0]; if (!file) return;
            const reader = new FileReader();
            reader.onload = e => {
                const h = hotelsData.find(x => x.id === id);
                if (h) { h.img = e.target.result; renderHotelsList(); toggleEditHotel(id); showToast('Görsel güncellendi!'); }
            };
            reader.readAsDataURL(file);
        }
        function deleteHotel(id) { if (!confirm('Silinsin mi?')) return; hotelsData = hotelsData.filter(x => x.id !== id); saveHotels(); renderHotelsList(); }
        function addHotel() {
            const nameTr = document.getElementById('new-hotel-name-tr').value.trim();
            const nameEn = document.getElementById('new-hotel-name-en').value.trim();
            const tagTr  = document.getElementById('new-hotel-tag-tr').value.trim();
            const tagEn  = document.getElementById('new-hotel-tag-en').value.trim();
            const img    = _pendingHotelImg || document.getElementById('new-hotel-img').value.trim() || 'foto.img/otel_hero.jpg';
            const tr     = document.getElementById('new-hotel-desc-tr').value.trim();
            const en     = document.getElementById('new-hotel-desc-en').value.trim();
            if (!nameTr) { showToast('Otel adı zorunludur!', 'exclamation'); return; }
            hotelsData.push({ id: Date.now(), name: {tr:nameTr, en:nameEn}, tag: {tr:tagTr, en:tagEn}, img, desc: { tr, en } });
            saveHotels(); renderHotelsList(); toggleAddForm('hotel-add-form');
            ['name-tr','name-en','tag-tr','tag-en','img','desc-tr','desc-en'].forEach(s => document.getElementById('new-hotel-'+s).value = '');
            _pendingHotelImg = null;
        }
        let _pendingHotelImg = null;
        function previewHotelImg(input) {
            const file = input.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = e => {
                _pendingHotelImg = e.target.result;
                document.getElementById('new-hotel-img').value = e.target.result.substring(0, 40) + '...';
            };
            reader.readAsDataURL(file);
        }

        /* ── RESTAURANTS CRUD ── */
        function renderRestaurantsList() {
            const list = document.getElementById('restMgrList');
            if (!list) return;
            if (restaurantsData.length === 0) {
                list.innerHTML = '<p style="padding:2rem;color:var(--text-muted);">Henüz restoran eklenmemiş.</p>';
                return;
            }
            list.innerHTML = restaurantsData.map(r => {
                const nameTr = (r.name && typeof r.name === 'object') ? r.name.tr : (r.name || '');
                const nameEn = (r.name && typeof r.name === 'object') ? r.name.en : '';
                const tagTr  = (r.tag && typeof r.tag === 'object') ? r.tag.tr : (r.tag || '');
                const tagEn  = (r.tag && typeof r.tag === 'object') ? r.tag.en : '';
                const descTr = (r.desc && typeof r.desc === 'object') ? r.desc.tr : (r.desc || '');

                const descEn = (r.desc && typeof r.desc === 'object') ? r.desc.en : '';
                const longDescTr = (r.long_desc && typeof r.long_desc === 'object') ? r.long_desc.tr : (r.long_desc || '');
                const longDescEn = (r.long_desc && typeof r.long_desc === 'object') ? r.long_desc.en : '';


                return `
                <div class="mgr-item" id="rest-item-${r.id}">
                    <div class="mgr-item-row">
                        <img class="mgr-item-thumb" src="${r.img}" alt="${nameTr}">
                        <div class="mgr-item-info">
                            <div class="mgr-item-name">${nameTr}</div>
                            <div class="mgr-item-tag"><i class="fas fa-map-marker-alt" style="font-size:0.7rem;margin-right:3px;color:var(--primary);"></i>${tagTr}</div>
                        </div>
                        <div class="mgr-item-actions">
                            <button class="btn btn-outline" style="padding:0.5rem 1rem;font-size:0.8rem;" onclick="toggleEditRest(${r.id})"><i class="fas fa-edit"></i> Düzenle</button>
                            <button class="btn" style="padding:0.5rem 1rem;font-size:0.8rem;background:#fee2e2;color:#ef4444;border:none;" onclick="deleteRestaurant(${r.id})"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                    <div class="mgr-item-edit-area" id="rest-edit-${r.id}">
                        <div class="mgr-form-grid">
                            <div class="mgr-field"><label>Restoran Adı (TR)</label><input type="text" value="${nameTr}" oninput="updateRestSubField(${r.id},'name','tr',this.value)"></div>
                            <div class="mgr-field"><label>Restoran Adı (EN)</label><input type="text" value="${nameEn}" oninput="updateRestSubField(${r.id},'name','en',this.value)"></div>
                            <div class="mgr-field"><label>Konum / Kategori (TR)</label><input type="text" value="${tagTr}" oninput="updateRestSubField(${r.id},'tag','tr',this.value)"></div>
                            <div class="mgr-field"><label>Konum / Kategori (EN)</label><input type="text" value="${tagEn}" oninput="updateRestSubField(${r.id},'tag','en',this.value)"></div>
                            <div class="mgr-field"><label>Görsel Yolu</label><input type="text" value="${r.img}" oninput="updateRestField(${r.id},'img',this.value)"></div>
                            <div class="mgr-field"><label>Görsel Değiştir</label><input type="file" accept="image/*" onchange="replaceRestImg(${r.id},this)"></div>
                            <div class="mgr-field"><label>Açıklama (TR)</label><textarea oninput="updateRestDesc(${r.id},'tr',this.value)">${descTr}</textarea></div>

                            <div class="mgr-field"><label>Açıklama (EN)</label><textarea oninput="updateRestDesc(${r.id},'en',this.value)">${descEn}</textarea></div>
                            <div class="mgr-field" style="grid-column:1/-1;"><label>Detay Sayfası Uzun Açıklama (TR)</label><textarea style="height:120px;" oninput="updateRestSubField(${r.id},'long_desc','tr',this.value)">${longDescTr}</textarea></div>
                            <div class="mgr-field" style="grid-column:1/-1;"><label>Detay Sayfası Uzun Açıklama (EN)</label><textarea style="height:120px;" oninput="updateRestSubField(${r.id},'long_desc','en',this.value)">${longDescEn}</textarea></div>
                            <div class="mgr-field" style="grid-column:1/-1;"><label>Galeri (Yeni Resim Ekle)</label><input type="file" accept="image/*" onchange="addRestGalleryImg(${r.id},this)"></div>
                            <div class="mgr-field" style="grid-column:1/-1;">
                                <div style="display:flex; gap:10px; flex-wrap:wrap;">
                                    ${(r.gallery || []).map((g, idx) => `<div style="position:relative;"><img src="${g}" style="width:80px;height:80px;object-fit:cover;border-radius:4px;"><button type="button" onclick="removeRestGalleryImg(${r.id},${idx})" style="position:absolute;top:0;right:0;background:red;color:white;border:none;cursor:pointer;width:20px;height:20px;border-radius:50%;font-size:10px;">X</button></div>`).join('')}
                                </div>
                            </div>

                        </div>
                        <button class="btn btn-primary" style="margin-top:0.5rem;" onclick="saveRestaurants();toggleEditRest(${r.id})"><i class="fas fa-save"></i> Kaydet</button>
                    </div>
                </div>
            `; }).join('');
        }
        function toggleEditRest(id) { document.getElementById(`rest-edit-${id}`).classList.toggle('open'); }
        function updateRestField(id, field, val) {
            const r = restaurantsData.find(x => x.id === id);
            if (r) r[field] = val;
        }
        function updateRestSubField(id, parent, lang, val) {
            const r = restaurantsData.find(x => x.id === id);
            if (r) {
                if (typeof r[parent] !== 'object') r[parent] = { tr: r[parent] || '', en: '' };
                r[parent][lang] = val;
            }
        }
        function updateRestDesc(id, lang, val) {
            const r = restaurantsData.find(x => x.id === id);
            if (r) {
                if (typeof r.desc !== 'object') r.desc = { tr: r.desc || '', en: '' };
                r.desc[lang] = val;
            }
        }
        function addRestGalleryImg(id, input) {
            const file = input.files[0]; if (!file) return;
            const reader = new FileReader();
            reader.onload = e => {
                const r = restaurantsData.find(x => x.id === id);
                if (r) {
                    if (!r.gallery) r.gallery = [];
                    r.gallery.push(e.target.result);
                    renderRestaurantsList(); toggleEditRest(id); showToast('Galeri resmi eklendi!');
                }
            };
            reader.readAsDataURL(file);
        }
        function removeRestGalleryImg(id, idx) {
            const r = restaurantsData.find(x => x.id === id);
            if (r && r.gallery) {
                r.gallery.splice(idx, 1);
                renderRestaurantsList(); toggleEditRest(id); showToast('Galeri resmi silindi!');
            }
        }
        function replaceRestImg(id, input) {
            const file = input.files[0]; if (!file) return;
            const reader = new FileReader();
            reader.onload = e => {
                const r = restaurantsData.find(x => x.id === id);
                if (r) { r.img = e.target.result; renderRestaurantsList(); toggleEditRest(id); showToast('Görsel güncellendi!'); }
            };
            reader.readAsDataURL(file);
        }
        function deleteRestaurant(id) { if (!confirm('Silinsin mi?')) return; restaurantsData = restaurantsData.filter(x => x.id !== id); saveRestaurants(); renderRestaurantsList(); }
        function addRestaurant() {
            const nameTr = document.getElementById('new-rest-name-tr').value.trim();
            const nameEn = document.getElementById('new-rest-name-en').value.trim();
            const tagTr  = document.getElementById('new-rest-tag-tr').value.trim();
            const tagEn  = document.getElementById('new-rest-tag-en').value.trim();
            const img    = _pendingRestImg || document.getElementById('new-rest-img').value.trim() || 'foto.img/rest_hero.jpg';
            const tr     = document.getElementById('new-rest-desc-tr').value.trim();
            const en     = document.getElementById('new-rest-desc-en').value.trim();
            if (!nameTr) { showToast('Restoran adı zorunludur!', 'exclamation'); return; }
            restaurantsData.push({ id: Date.now(), name: {tr:nameTr, en:nameEn}, tag: {tr:tagTr, en:tagEn}, img, desc: { tr, en } });
            saveRestaurants(); renderRestaurantsList(); toggleAddForm('rest-add-form');
            ['name-tr','name-en','tag-tr','tag-en','img','desc-tr','desc-en'].forEach(s => document.getElementById('new-rest-'+s).value = '');
            _pendingRestImg = null;
        }
        let _pendingRestImg = null;
        function previewRestImg(input) {
            const file = input.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = e => { _pendingRestImg = e.target.result; document.getElementById('new-rest-img').value = e.target.result.substring(0, 40) + '...'; };
            reader.readAsDataURL(file);
        }

        /* ── REFS CRUD ── */
        function renderRefsList() {
            const grid = document.getElementById('refsMgrGrid');
            if (!grid) return;
            if (refsData.length === 0) {
                grid.innerHTML = '<p style="padding:2rem;color:var(--text-muted);">Henüz referans eklenmemiş.</p>';
                return;
            }
            grid.innerHTML = refsData.map(r => `
                <div class="ref-item" id="ref-item-${r.id}">
                    <button class="ref-delete" onclick="deleteRef(${r.id})" title="Sil"><i class="fas fa-times"></i></button>
                    <img src="${r.img}" alt="${r.name}" onerror="this.style.display='none'">
                    <span>${r.name}</span>
                </div>
            `).join('');
        }
        function deleteRef(id) {
            if (!confirm('Bu referansı silmek istediğinize emin misiniz?')) return;
            refsData = refsData.filter(x => x.id !== id);
            saveRefs();
            renderRefsList();
        }
        let _pendingRefImg = null;
        function previewRefImg(input) {
            const file = input.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = e => { _pendingRefImg = e.target.result; document.getElementById('new-ref-img').value = '(yüklendi)'; };
            reader.readAsDataURL(file);
        }
        function addRef() {
            const name = document.getElementById('new-ref-name').value.trim();
            if (!name) { showToast('Marka adı zorunludur!', 'exclamation'); return; }
            let img = _pendingRefImg || document.getElementById('new-ref-img').value.trim();
            if (!img || img === '(yüklendi)') {
                img = `data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 200 60'><text x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' font-family='sans-serif' font-size='22' fill='%23000'>${name}</text></svg>`;
            }
            refsData.push({ id: Date.now(), name, img });
            _pendingRefImg = null;
            saveRefs();
            renderRefsList();
            document.getElementById('new-ref-name').value = '';
            document.getElementById('new-ref-img').value = '';
            toggleAddForm('ref-add-form');
        }

        /* ── CONTACT RENDER ── */
        function renderContactForm() {
            document.getElementById('cont-email').value       = contactData.email || '';
            document.getElementById('cont-phone').value       = contactData.phone || '';
            document.getElementById('cont-whatsapp').value    = contactData.whatsapp || '';
            document.getElementById('cont-address-tr').value  = contactData.address_tr || '';
            document.getElementById('cont-address-en').value  = contactData.address_en || '';
            document.getElementById('cont-instagram').value   = contactData.instagram || '';
            document.getElementById('cont-linkedin').value    = contactData.linkedin || '';
            document.getElementById('cont-footer-copy').value = contactData.footer_copy || '';
        }

        /* ── UTILITIES ── */
        function toggleAddForm(id) {
            const el = document.getElementById(id);
            el.style.display = el.style.display === 'none' ? 'block' : 'none';
        }
        function updateDashboardStats() {
            const el = document.getElementById('statHotels');
            if (el) el.innerText = hotelsData.length;
            const ey = document.getElementById('statYachts');
            if (ey) ey.innerText = yachtsData.length;
            const er = document.getElementById('statRests');
            if (er) er.innerText = restaurantsData.length;
            const ef = document.getElementById('statRefs');
            if (ef) ef.innerText = refsData.length;
            const eg = document.getElementById('statGuides');
            if (eg) eg.innerText = guideData.length;
            const ev = document.getElementById('statEvents');
            if (ev) ev.innerText = eventsData.length;
            const ej = document.getElementById('statJournal');
            if (ej) ej.innerText = journalData.length;
        }

        /* ── YACHTS CRUD ── */
        function renderYachtsList() {
            const list = document.getElementById('yachtMgrList');
            if (!list) return;
            list.innerHTML = yachtsData.map(y => {
                const nameTr = (y.name && typeof y.name === 'object') ? y.name.tr : (y.name || '');
                const nameEn = (y.name && typeof y.name === 'object') ? y.name.en : '';
                const tagTr  = (y.tag && typeof y.tag === 'object') ? y.tag.tr : (y.tag || '');
                const tagEn  = (y.tag && typeof y.tag === 'object') ? y.tag.en : '';
                const descTr = (y.desc && typeof y.desc === 'object') ? y.desc.tr : (y.desc || '');
                const descEn = (y.desc && typeof y.desc === 'object') ? y.desc.en : '';

                return `
                <div class="mgr-item">
                    <div class="mgr-item-row">
                        <img class="mgr-item-thumb" src="${y.img}">
                        <div class="mgr-item-info">
                            <div class="mgr-item-name">${nameTr}</div>
                            <div class="mgr-item-tag">${tagTr}</div>
                        </div>
                        <div class="mgr-item-actions">
                            <button class="btn btn-outline" onclick="toggleEditYacht(${y.id})"><i class="fas fa-edit"></i></button>
                            <button class="btn" style="background:#fee2e2;color:#ef4444;" onclick="deleteYacht(${y.id})"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                    <div class="mgr-item-edit-area" id="yacht-edit-${y.id}">
                        <div class="mgr-form-grid">
                            <div class="mgr-field"><label>Yat Adı (TR)</label><input type="text" value="${nameTr}" oninput="updateYachtSubField(${y.id},'name','tr',this.value)"></div>
                            <div class="mgr-field"><label>Yat Adı (EN)</label><input type="text" value="${nameEn}" oninput="updateYachtSubField(${y.id},'name','en',this.value)"></div>
                            <div class="mgr-field"><label>Tür & Uzunluk (TR)</label><input type="text" value="${tagTr}" oninput="updateYachtSubField(${y.id},'tag','tr',this.value)"></div>
                            <div class="mgr-field"><label>Tür & Uzunluk (EN)</label><input type="text" value="${tagEn}" oninput="updateYachtSubField(${y.id},'tag','en',this.value)"></div>
                            <div class="mgr-field"><label>Görsel</label><input type="text" value="${y.img}" oninput="updateYachtField(${y.id},'img',this.value)"></div>
                            <div class="mgr-field"><label>Açıklama (TR)</label><textarea oninput="updateYachtDesc(${y.id},'tr',this.value)">${descTr}</textarea></div>
                            <div class="mgr-field"><label>Açıklama (EN)</label><textarea oninput="updateYachtDesc(${y.id},'en',this.value)">${descEn}</textarea></div>
                        </div>
                        <button class="btn btn-primary" onclick="saveYachts();toggleEditYacht(${y.id})">Kaydet</button>
                    </div>
                </div>
            `; }).join('');
        }
        function toggleEditYacht(id) { document.getElementById(`yacht-edit-${id}`).classList.toggle('open'); }
        function updateYachtField(id,f,v) { const x=yachtsData.find(i=>i.id===id); if(x) x[f]=v; }
        function updateYachtSubField(id, parent, lang, val) {
            const y = yachtsData.find(x => x.id === id);
            if (y) {
                if (typeof y[parent] !== 'object') y[parent] = { tr: y[parent] || '', en: '' };
                y[parent][lang] = val;
            }
        }
        function updateYachtDesc(id, lang, val) {
            const y = yachtsData.find(x => x.id === id);
            if (y) {
                if (typeof y.desc !== 'object') y.desc = { tr: y.desc || '', en: '' };
                y.desc[lang] = val;
            }
        }
        function deleteYacht(id) { if(confirm('Silinsin mi?')){ yachtsData=yachtsData.filter(i=>i.id!==id); saveYachts(); renderYachtsList(); } }
        function addYacht() {
            const nameTr = document.getElementById('new-yacht-name-tr').value;
            const nameEn = document.getElementById('new-yacht-name-en').value;
            const tagTr = document.getElementById('new-yacht-tag-tr').value;
            const tagEn = document.getElementById('new-yacht-tag-en').value;
            const img = _pendingYachtImg || document.getElementById('new-yacht-img').value || 'foto.img/yat_yeni.jpg';
            const tr = document.getElementById('new-yacht-desc-tr').value;
            const en = document.getElementById('new-yacht-desc-en').value;
            yachtsData.push({ id:Date.now(), name:{tr:nameTr, en:nameEn}, tag:{tr:tagTr, en:tagEn}, img, desc:{tr,en} });
            saveYachts(); renderYachtsList(); toggleAddForm('yacht-add-form');
            ['name-tr','name-en','tag-tr','tag-en','img','desc-tr','desc-en'].forEach(s => document.getElementById('new-yacht-'+s).value = '');
            _pendingYachtImg = null;
        }
        let _pendingYachtImg = null;
        function previewYachtImg(input) {
            const file = input.files[0]; if(!file) return;
            const reader = new FileReader(); reader.onload = e => { _pendingYachtImg = e.target.result; document.getElementById('new-yacht-img').value = '(yüklendi)'; };
            reader.readAsDataURL(file);
        }

        /* ── GUIDE CRUD ── */
        function renderGuideList() {
            const list = document.getElementById('guideMgrList');
            if (!list) return;
            list.innerHTML = guideData.map(g => {
                const titleTr = (g.title && typeof g.title === 'object') ? g.title.tr : (g.title || '');
                const titleEn = (g.title && typeof g.title === 'object') ? g.title.en : '';
                const tagTr   = (g.tag && typeof g.tag === 'object') ? g.tag.tr : (g.tag || '');
                const tagEn   = (g.tag && typeof g.tag === 'object') ? g.tag.en : '';
                const descTr  = (g.desc && typeof g.desc === 'object') ? g.desc.tr : (g.desc || '');
                const descEn  = (g.desc && typeof g.desc === 'object') ? g.desc.en : '';

                return `
                <div class="mgr-item">
                    <div class="mgr-item-row">
                        <img class="mgr-item-thumb" src="${g.img}">
                        <div class="mgr-item-info">
                            <div class="mgr-item-name">${titleTr}</div>
                            <div class="mgr-item-tag">${tagTr}</div>
                        </div>
                        <div class="mgr-item-actions">
                            <button class="btn btn-outline" onclick="toggleEditGuide(${g.id})"><i class="fas fa-edit"></i></button>
                            <button class="btn" style="background:#fee2e2;color:#ef4444;" onclick="deleteGuide(${g.id})"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                    <div class="mgr-item-edit-area" id="guide-edit-${g.id}">
                        <div class="mgr-form-grid">
                            <div class="mgr-field"><label>Başlık (TR)</label><input type="text" value="${titleTr}" oninput="updateGuideSubField(${g.id},'title','tr',this.value)"></div>
                            <div class="mgr-field"><label>Başlık (EN)</label><input type="text" value="${titleEn}" oninput="updateGuideSubField(${g.id},'title','en',this.value)"></div>
                            <div class="mgr-field"><label>Etiket (TR)</label><input type="text" value="${tagTr}" oninput="updateGuideSubField(${g.id},'tag','tr',this.value)"></div>
                            <div class="mgr-field"><label>Etiket (EN)</label><input type="text" value="${tagEn}" oninput="updateGuideSubField(${g.id},'tag','en',this.value)"></div>
                            <div class="mgr-field"><label>Görsel</label><input type="text" value="${g.img}" oninput="updateGuideField(${g.id},'img',this.value)"></div>
                            <div class="mgr-field"><label>Açıklama (TR)</label><textarea oninput="updateGuideDesc(${g.id},'tr',this.value)">${descTr}</textarea></div>
                            <div class="mgr-field"><label>Açıklama (EN)</label><textarea oninput="updateGuideDesc(${g.id},'en',this.value)">${descEn}</textarea></div>
                        </div>
                        <button class="btn btn-primary" onclick="saveGuides();toggleEditGuide(${g.id})">Kaydet</button>
                    </div>
                </div>
            `; }).join('');
        }
        function toggleEditGuide(id) { document.getElementById(`guide-edit-${id}`).classList.toggle('open'); }
        function updateGuideField(id,f,v) { const x=guideData.find(i=>i.id===id); if(x) x[f]=v; }
        function updateGuideSubField(id, parent, lang, val) {
            const g = guideData.find(x => x.id === id);
            if (g) {
                if (typeof g[parent] !== 'object') g[parent] = { tr: g[parent] || '', en: '' };
                g[parent][lang] = val;
            }
        }
        function updateGuideDesc(id, lang, val) {
            const g = guideData.find(x => x.id === id);
            if (g) {
                if (typeof g.desc !== 'object') g.desc = { tr: g.desc || '', en: '' };
                g.desc[lang] = val;
            }
        }
        function deleteGuide(id) { if(confirm('Silinsin mi?')){ guideData=guideData.filter(i=>i.id!==id); saveGuides(); renderGuideList(); } }
        function addGuide() {
            const titleTr = document.getElementById('new-guide-title-tr').value;
            const titleEn = document.getElementById('new-guide-title-en').value;
            const tagTr = document.getElementById('new-guide-tag-tr').value;
            const tagEn = document.getElementById('new-guide-tag-en').value;
            const img = _pendingGuideImg || document.getElementById('new-guide-img').value || 'foto.img/bodrum.jpg';
            const tr = document.getElementById('new-guide-desc-tr').value;
            const en = document.getElementById('new-guide-desc-en').value;
            guideData.push({ id:Date.now(), title:{tr:titleTr, en:titleEn}, tag:{tr:tagTr, en:tagEn}, img, desc:{tr,en} });
            saveGuides(); renderGuideList(); toggleAddForm('guide-add-form');
            ['title-tr','title-en','tag-tr','tag-en','img','desc-tr','desc-en'].forEach(s => document.getElementById('new-guide-'+s).value = '');
            _pendingGuideImg = null;
        }
        let _pendingGuideImg = null;
        function previewGuideImg(input) {
            const file = input.files[0]; if(!file) return;
            const reader = new FileReader(); reader.onload = e => { _pendingGuideImg = e.target.result; document.getElementById('new-guide-img').value = '(yüklendi)'; };
            reader.readAsDataURL(file);
        }

        /* ── EVENTS CRUD ── */
        function renderEventsList() {
            const list = document.getElementById('eventMgrList');
            if (!list) return;
            list.innerHTML = eventsData.map(e => {
                const titleTr = (e.title && typeof e.title === 'object') ? e.title.tr : (e.title || '');
                const titleEn = (e.title && typeof e.title === 'object') ? e.title.en : '';
                const tagTr   = (e.tag && typeof e.tag === 'object') ? e.tag.tr : (e.tag || '');
                const tagEn   = (e.tag && typeof e.tag === 'object') ? e.tag.en : '';
                const monthTr = (e.month && typeof e.month === 'object') ? e.month.tr : (e.month || '');
                const monthEn = (e.month && typeof e.month === 'object') ? e.month.en : '';
                const locTr   = (e.loc && typeof e.loc === 'object') ? e.loc.tr : (e.loc || '');
                const locEn   = (e.loc && typeof e.loc === 'object') ? e.loc.en : '';

                return `
                <div class="mgr-item">
                    <div class="mgr-item-row">
                        <div class="event-date" style="background:var(--primary);color:white;padding:10px;border-radius:10px;text-align:center;min-width:60px;">
                            <div style="font-weight:800;">${e.day}</div>
                            <div style="font-size:0.7rem;">${monthTr}</div>
                        </div>
                        <div class="mgr-item-info">
                            <div class="mgr-item-name">${titleTr}</div>
                            <div class="mgr-item-tag">${tagTr} | ${locTr}</div>
                        </div>
                        <div class="mgr-item-actions">
                            <button class="btn btn-outline" onclick="toggleEditEvent(${e.id})"><i class="fas fa-edit"></i></button>
                            <button class="btn" style="background:#fee2e2;color:#ef4444;" onclick="deleteEvent(${e.id})"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                    <div class="mgr-item-edit-area" id="event-edit-${e.id}">
                        <div class="mgr-form-grid">
                            <div class="mgr-field"><label>Başlık (TR)</label><input type="text" value="${titleTr}" oninput="updateEventSubField(${e.id},'title','tr',this.value)"></div>
                            <div class="mgr-field"><label>Başlık (EN)</label><input type="text" value="${titleEn}" oninput="updateEventSubField(${e.id},'title','en',this.value)"></div>
                            <div class="mgr-field"><label>Kategori (TR)</label><input type="text" value="${tagTr}" oninput="updateEventSubField(${e.id},'tag','tr',this.value)"></div>
                            <div class="mgr-field"><label>Kategori (EN)</label><input type="text" value="${tagEn}" oninput="updateEventSubField(${e.id},'tag','en',this.value)"></div>
                            <div class="mgr-field"><label>Gün</label><input type="number" value="${e.day}" oninput="updateEventField(${e.id},'day',this.value)"></div>
                            <div class="mgr-field"><label>Ay (TR)</label><input type="text" value="${monthTr}" oninput="updateEventSubField(${e.id},'month','tr',this.value)"></div>
                            <div class="mgr-field"><label>Ay (EN)</label><input type="text" value="${monthEn}" oninput="updateEventSubField(${e.id},'month','en',this.value)"></div>
                            <div class="mgr-field"><label>Konum (TR)</label><input type="text" value="${locTr}" oninput="updateEventSubField(${e.id},'loc','tr',this.value)"></div>
                            <div class="mgr-field"><label>Konum (EN)</label><input type="text" value="${locEn}" oninput="updateEventSubField(${e.id},'loc','en',this.value)"></div>
                        </div>
                        <button class="btn btn-primary" onclick="saveEvents();toggleEditEvent(${e.id})">Kaydet</button>
                    </div>
                </div>
            `; }).join('');
        }
        function toggleEditEvent(id) { document.getElementById(`event-edit-${id}`).classList.toggle('open'); }
        function updateEventField(id,f,v) { const x=eventsData.find(i=>i.id===id); if(x) x[f]=v; }
        function updateEventSubField(id, parent, lang, val) {
            const e = eventsData.find(x => x.id === id);
            if (e) {
                if (typeof e[parent] !== 'object') e[parent] = { tr: e[parent] || '', en: '' };
                e[parent][lang] = val;
            }
        }
        function deleteEvent(id) { if(confirm('Silinsin mi?')){ eventsData=eventsData.filter(i=>i.id!==id); saveEvents(); renderEventsList(); } }
        function addEvent() {
            const titleTr = document.getElementById('new-event-title-tr').value;
            const titleEn = document.getElementById('new-event-title-en').value;
            const tagTr = document.getElementById('new-event-tag-tr').value;
            const tagEn = document.getElementById('new-event-tag-en').value;
            const day = document.getElementById('new-event-day').value;
            const monthTr = document.getElementById('new-event-month-tr').value;
            const monthEn = document.getElementById('new-event-month-en').value;
            const locTr = document.getElementById('new-event-loc-tr').value;
            const locEn = document.getElementById('new-event-loc-en').value;
            eventsData.push({ id:Date.now(), title:{tr:titleTr, en:titleEn}, tag:{tr:tagTr, en:tagEn}, day, month:{tr:monthTr, en:monthEn}, loc:{tr:locTr, en:locEn} });
            saveEvents(); renderEventsList(); toggleAddForm('event-add-form');
            ['title-tr','title-en','tag-tr','tag-en','day','month-tr','month-en','loc-tr','loc-en'].forEach(s => document.getElementById('new-event-'+s).value = '');
        }

        /* ── JOURNAL CRUD ── */
        function renderJournalList() {
            const list = document.getElementById('journalMgrList');
            if (!list) return;
            list.innerHTML = journalData.map(j => {
                const titleTr = (j.title && typeof j.title === 'object') ? j.title.tr : (j.title || '');
                const titleEn = (j.title && typeof j.title === 'object') ? j.title.en : '';
                const tagTr   = (j.tag && typeof j.tag === 'object') ? j.tag.tr : (j.tag || '');
                const tagEn   = (j.tag && typeof j.tag === 'object') ? j.tag.en : '';
                const descTr  = (j.desc && typeof j.desc === 'object') ? j.desc.tr : (j.desc || '');
                const descEn  = (j.desc && typeof j.desc === 'object') ? j.desc.en : '';

                return `
                <div class="mgr-item">
                    <div class="mgr-item-row">
                        <img class="mgr-item-thumb" src="${j.img}">
                        <div class="mgr-item-info">
                            <div class="mgr-item-name">${titleTr}</div>
                            <div class="mgr-item-tag">${tagTr} | ${j.date}</div>
                        </div>
                        <div class="mgr-item-actions">
                            <button class="btn btn-outline" onclick="toggleEditJournal(${j.id})"><i class="fas fa-edit"></i></button>
                            <button class="btn" style="background:#fee2e2;color:#ef4444;" onclick="deleteJournal(${j.id})"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                    <div class="mgr-item-edit-area" id="journal-edit-${j.id}">
                        <div class="mgr-form-grid">
                            <div class="mgr-field"><label>Yazı Başlığı (TR)</label><input type="text" value="${titleTr}" oninput="updateJournalSubField(${j.id},'title','tr',this.value)"></div>
                            <div class="mgr-field"><label>Yazı Başlığı (EN)</label><input type="text" value="${titleEn}" oninput="updateJournalSubField(${j.id},'title','en',this.value)"></div>
                            <div class="mgr-field"><label>Kategori / Etiket (TR)</label><input type="text" value="${tagTr}" oninput="updateJournalSubField(${j.id},'tag','tr',this.value)"></div>
                            <div class="mgr-field"><label>Kategori / Etiket (EN)</label><input type="text" value="${tagEn}" oninput="updateJournalSubField(${j.id},'tag','en',this.value)"></div>
                            <div class="mgr-field"><label>Tarih</label><input type="text" value="${j.date}" oninput="updateJournalField(${j.id},'date',this.value)"></div>
                            <div class="mgr-field"><label>Görsel</label><input type="text" value="${j.img}" oninput="updateJournalField(${j.id},'img',this.value)"></div>
                            <div class="mgr-field"><label>Açıklama (TR)</label><textarea oninput="updateJournalDesc(${j.id},'tr',this.value)">${descTr}</textarea></div>
                            <div class="mgr-field"><label>Açıklama (EN)</label><textarea oninput="updateJournalDesc(${j.id},'en',this.value)">${descEn}</textarea></div>
                        </div>
                        <button class="btn btn-primary" onclick="saveJournal();toggleEditJournal(${j.id})">Kaydet</button>
                    </div>
                </div>
            `; }).join('');
        }
        function toggleEditJournal(id) { document.getElementById(`journal-edit-${id}`).classList.toggle('open'); }
        function updateJournalField(id,f,v) { const x=journalData.find(i=>i.id===id); if(x) x[f]=v; }
        function updateJournalSubField(id, parent, lang, val) {
            const j = journalData.find(x => x.id === id);
            if (j) {
                if (typeof j[parent] !== 'object') j[parent] = { tr: j[parent] || '', en: '' };
                j[parent][lang] = val;
            }
        }

        function updateJournalDesc(id, lang, val) {
            const j = journalData.find(x => x.id === id);
            if (j) {
                if (typeof j.desc !== 'object') j.desc = { tr: j.desc || '', en: '' };
                j.desc[lang] = val;
            }
        }

        function deleteJournal(id) { if(confirm('Silinsin mi?')){ journalData=journalData.filter(i=>i.id!==id); saveJournal(); renderJournalList(); } }
        function addJournal() {
            const titleTr = document.getElementById('new-journal-title-tr').value;
            const titleEn = document.getElementById('new-journal-title-en').value;
            const tagTr = document.getElementById('new-journal-tag-tr').value;
            const tagEn = document.getElementById('new-journal-tag-en').value;
            const date = document.getElementById('new-journal-date').value;
            const img = _pendingJournalImg || document.getElementById('new-journal-img').value || 'foto.img/japonya.jpg';
            const tr = document.getElementById('new-journal-desc-tr').value;
            const en = document.getElementById('new-journal-desc-en').value;
            journalData.push({ id:Date.now(), title:{tr:titleTr, en:titleEn}, tag:{tr:tagTr, en:tagEn}, date, img, desc:{tr,en} });
            saveJournal(); renderJournalList(); toggleAddForm('journal-add-form');
            ['title-tr','title-en','tag-tr','tag-en','date','img','desc-tr','desc-en'].forEach(s => document.getElementById('new-journal-'+s).value = '');
            _pendingJournalImg = null;
        }
        let _pendingJournalImg = null;
        function previewJournalImg(input) {
            const file = input.files[0]; if(!file) return;
            const reader = new FileReader(); reader.onload = e => { _pendingJournalImg = e.target.result; document.getElementById('new-journal-img').value = '(yüklendi)'; };
            reader.readAsDataURL(file);
        }

        // Media List from Directory Scan
        const DEFAULT_MEDIA = [
            {t:'Ana Hero 4K', p:'foto.img/hero_4k.jpg', cat:'hero'},
            {t:'Logo', p:'foto.img/logo.jpg', cat:'hero'},
            {t:'Bodrum Manzara', p:'foto.img/bodrum.jpg', cat:'hero'},
            {t:'Amalfi Sahili', p:'foto.img/amalfi.jpg', cat:'hero'},
            {t:'Kapadokya Balonlar', p:'foto.img/kapadokya.jpg', cat:'hero'},
            {t:'Otel Aman', p:'foto.img/otel_aman.jpg', cat:'otel'},
            {t:'Otel Hero', p:'foto.img/otel_hero.jpg', cat:'otel'},
            {t:'Otel Hillside', p:'foto.img/otel_hillside.jpg', cat:'otel'},
            {t:'Otel Museum', p:'foto.img/otel_museum.jpg', cat:'otel'},
            {t:'Otel Sirenuse', p:'foto.img/otel_sirenuse.jpg', cat:'otel'},
            {t:'Otel Soneva', p:'foto.img/otel_soneva.jpg', cat:'otel'},
            {t:'Restoran Hero', p:'foto.img/rest_hero.jpg', cat:'rest'},
            {t:'Restoran Mikla', p:'foto.img/rest_mikla.jpg', cat:'rest'},
            {t:'Restoran Zuma', p:'foto.img/rest_zuma.jpg', cat:'rest'},
            {t:'Restoran Melengeç', p:'foto.img/rest_melengec.jpg', cat:'rest'},
            {t:'Yat Hero', p:'foto.img/yat_hero.jpg', cat:'yat'},
            {t:'Yat Azure Dream', p:'foto.img/yat_azure_dream.jpg', cat:'yat'},
            {t:'Yat Bodrum Blue', p:'foto.img/yat_bodrum_blue.jpg', cat:'yat'},
            {t:'Yat Aegean Wind', p:'foto.img/yat_aegean_wind.jpg', cat:'yat'},
            {t:'Japonya Journal', p:'foto.img/japonya.jpg', cat:'hero'},
            {t:'Norveç Journal', p:'foto.img/norvec.jpg', cat:'hero'},
            {t:'Sahra Journal', p:'foto.img/sahra.jpg', cat:'hero'}
        ];
        
        let allMedia = [];
        
        function loadMedia() {
            const s = DioAPI.loadSync('dioreal_media_data');
            allMedia = s ? JSON.parse(JSON.stringify(s)) : JSON.parse(JSON.stringify(DEFAULT_MEDIA));
        }
        
        function saveMedia() {
            DioAPI.save('dioreal_media_data', allMedia, null);
        }

        // Core functionality
        document.addEventListener('DOMContentLoaded', () => {
            init();
        });

        function navTo(id, el) {
            document.querySelectorAll('.page-section').forEach(s => s.classList.remove('active'));
            document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
            
            document.getElementById(id).classList.add('active');
            el.classList.add('active');
            
            const title = el.innerText.trim();
            document.getElementById('pageTitle').innerText = title;
        }

        // Page Definitions
        const pages = [
            { id: 'general', name: 'Genel (Nav/Footer)', icon: 'fas fa-globe', prefixes: ['nav_', 'btn_', 'footer_', 'serv_', 'cont_'] },
            { id: 'home', name: 'Ana Sayfa', icon: 'fas fa-home', prefixes: ['hero_', 'dest_', 'man_', 'trend_', 'mq_', 'testi_', 'proc_', 'kassandra_', 'melengec_', 'blue_', 'rups_', 'collab_'] },
            { id: 'about', name: 'Hakkımızda', icon: 'fas fa-info-circle', prefixes: ['about_', 'story_', 'stats_', 'mission_'] },
            { id: 'hotels', name: 'Oteller', icon: 'fas fa-hotel', prefixes: ['otel_'] },
            { id: 'yachts', name: 'Yatlar', icon: 'fas fa-ship', prefixes: ['yacht_'] },
            { id: 'restaurants', name: 'Restoranlar', icon: 'fas fa-utensils', prefixes: ['rest_'] },
            { id: 'guide', name: 'Gezi Rehberi', icon: 'fas fa-map-marked-alt', prefixes: ['guide_', 'tag_'] },
            { id: 'events', name: 'Etkinlikler', icon: 'fas fa-calendar-alt', prefixes: ['event_', 'month_'] },
            { id: 'journal', name: 'Journal', icon: 'fas fa-book-open', prefixes: ['journal_', 'date_'] }
        ];

        function init() {
            renderPageList();
            const totalTexts = Object.keys(langData).length;
            document.getElementById('statTotalTexts').innerText = totalTexts;
            selectPage('general');
            loadMedia();
            renderMedia(allMedia);
            updatePreviewFrame();

            // Yeni yönetim modülleri
            loadHotels();
            loadYachts();
            loadRestaurants();
            loadRefs();
            loadContact();
            loadGuides();
            loadEvents();
            loadJournal();
            renderHotelsList();
            renderYachtsList();
            renderRestaurantsList();
            renderRefsList();
            renderContactForm();
            renderGuideList();
            renderEventsList();
            renderJournalList();
            updateDashboardStats();
        }

        function updatePreviewFrame() {
            const frame = document.getElementById('sitePreviewFrame');
            const select = document.getElementById('previewPageSelect');
            if(frame && select) {
                frame.src = select.value + '?t=' + new Date().getTime();
            }
        }

        function renderPageList() {
            const list = document.getElementById('pageList');
            list.innerHTML = '';
            pages.forEach(p => {
                const item = document.createElement('div');
                item.className = 'page-link';
                item.id = `plink-${p.id}`;
                item.innerHTML = `<i class="${p.icon}"></i> ${p.name}`;
                item.onclick = () => selectPage(p.id);
                list.appendChild(item);
            });
        }

        function selectPage(pageId) {
            document.querySelectorAll('.page-link').forEach(l => l.classList.remove('active'));
            document.getElementById(`plink-${pageId}`).classList.add('active');

            const grid = document.getElementById('editorGrid');
            grid.innerHTML = '';

            const page = pages.find(p => p.id === pageId);
            const keys = Object.keys(langData).filter(key => 
                page.prefixes.some(pre => key.startsWith(pre))
            );

            if (keys.length === 0) {
                grid.innerHTML = '<p style="padding: 2rem; color: var(--text-muted);">Bu sayfa için henüz metin tanımlanmamış.</p>';
                return;
            }

            // Group by prefix for better structure
            const groups = {};
            keys.forEach(key => {
                const prefix = key.split('_')[0];
                if (!groups[prefix]) groups[prefix] = [];
                groups[prefix].push(key);
            });

            for (const prefix in groups) {
                const section = document.createElement('div');
                section.className = 'section-group';
                section.innerHTML = `<div class="section-group-title">${prefix.toUpperCase()} BÖLÜMÜ</div>`;
                
                const fieldGrid = document.createElement('div');
                fieldGrid.style.display = 'grid';
                fieldGrid.style.gridTemplateColumns = 'repeat(auto-fill, minmax(450px, 1fr))';
                fieldGrid.style.gap = '1.5rem';

                groups[prefix].forEach(key => {
                    const card = document.createElement('div');
                    card.className = 'editor-card';
                    card.style.background = 'white';
                    card.style.borderRadius = '20px';
                    card.style.border = '1px solid var(--border)';
                    card.style.padding = '1.5rem';
                    card.innerHTML = `
                        <span class="card-label" style="font-size: 0.8rem; font-weight: 700; color: var(--text-muted); display: block; margin-bottom: 1rem; border-bottom: 1px solid var(--border); padding-bottom: 0.5rem;">${key}</span>
                        <div class="lang-fields" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.2rem;">
                            <div class="field-group">
                                <label style="font-size: 0.7rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; display: flex; align-items: center; gap: 5px;"><img src="https://flagcdn.com/w20/tr.png" style="width:14px;"> Türkçe</label>
                                <textarea style="border: 1px solid var(--border); border-radius: 10px; padding: 0.8rem; min-height: 80px; font-family: inherit; font-size: 0.9rem; outline: none; background: #fcfcfc; transition: 0.3s; resize: vertical;" oninput="updateVal('${key}', 'tr', this.value)">${langData[key].tr}</textarea>
                            </div>
                            <div class="field-group">
                                <label style="font-size: 0.7rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; display: flex; align-items: center; gap: 5px;"><img src="https://flagcdn.com/w20/gb.png" style="width:14px;"> English</label>
                                <textarea style="border: 1px solid var(--border); border-radius: 10px; padding: 0.8rem; min-height: 80px; font-family: inherit; font-size: 0.9rem; outline: none; background: #fcfcfc; transition: 0.3s; resize: vertical;" oninput="updateVal('${key}', 'en', this.value)">${langData[key].en}</textarea>
                            </div>
                        </div>
                    `;
                    fieldGrid.appendChild(card);
                });
                section.appendChild(fieldGrid);
                grid.appendChild(section);
            }
        }

        function updateVal(key, lang, val) {
            langData[key][lang] = val;
        }

        function renderMedia(list) {
            const grid = document.getElementById('mediaGrid');
            grid.innerHTML = '';
            list.forEach((img, idx) => {
                const index = allMedia.indexOf(img);
                const item = document.createElement('div');
                item.className = 'media-item';
                const imgId = 'media-img-' + index;
                const sizeId = 'media-size-' + index;
                item.innerHTML = `
                    <img src="${img.p}" class="media-preview" alt="${img.t}" id="${imgId}" onload="document.getElementById('${sizeId}').innerText = this.naturalWidth + ' x ' + this.naturalHeight + ' px'">
                    <div class="media-overlay">
                        <button class="tool-btn success" onclick="triggerReplace(${index})" title="Görseli Değiştir"><i class="fas fa-exchange-alt"></i></button>
                        <button class="tool-btn" onclick="copyPath('${img.p}')" title="Yolu Kopyala"><i class="fas fa-link"></i></button>
                        <button class="tool-btn danger" onclick="removeMedia(${index})" title="Kaldır"><i class="fas fa-trash-alt"></i></button>
                    </div>
                    <div class="media-meta">
                        <span>${img.t}</span>
                        <small>${img.p.startsWith('data:') ? 'Yeni Yüklenen' : img.p}</small>
                        <div id="${sizeId}" style="font-size: 0.75rem; color: var(--primary); font-weight: 700; margin-top: 5px;"></div>
                    </div>
                `;
                grid.appendChild(item);
            });
        }

        let currentlyReplacing = null;
        let isAddingNew = false;

        function triggerReplace(index) {
            isAddingNew = false;
            currentlyReplacing = index;
            document.getElementById('mediaUploader').value = '';
            document.getElementById('mediaUploader').click();
        }

        function triggerAddNew() {
            isAddingNew = true;
            document.getElementById('mediaUploader').value = '';
            document.getElementById('mediaUploader').click();
        }

        document.getElementById('mediaUploader').onchange = function(e) {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(event) {
                const newSrc = event.target.result;
                
                if (isAddingNew) {
                    allMedia.unshift({
                        t: file.name.split('.')[0],
                        p: newSrc,
                        cat: 'hero'
                    });
                    showToast('Yeni görsel eklendi!', 'check');
                } else {
                    if (currentlyReplacing !== null && allMedia[currentlyReplacing]) {
                        allMedia[currentlyReplacing].p = newSrc;
                        showToast('Görsel başarıyla güncellendi!', 'check');
                    }
                }
                saveMedia();
                renderMedia(allMedia);
            };
            reader.readAsDataURL(file);
        };

        function removeMedia(index) {
            if (confirm('Bu görseli havuzdan kaldırmak istediğinize emin misiniz?')) {
                if (index >= 0 && index < allMedia.length) {
                    allMedia.splice(index, 1);
                    saveMedia();
                    renderMedia(allMedia);
                    showToast('Görsel kaldırıldı.', 'info');
                }
            }
        }

        function filterMedia(cat, el) {
            document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('active'));
            el.classList.add('active');
            if(cat === 'all') renderMedia(allMedia);
            else renderMedia(allMedia.filter(m => m.cat === cat));
        }

        function copyPath(p) {
            navigator.clipboard.writeText(p).then(() => {
                showToast('Dosya yolu kopyalandı!');
            });
        }

        function saveToLocal() {
            DioAPI.save('dioreal_lang_data', langData, function() {
                showToast('Değişiklikler başarıyla yayınlandı!', 'check');
            });
        }

        function copyCode() {
            const code = "const langData = " + JSON.stringify(langData, null, 4) + ";";
            navigator.clipboard.writeText(code).then(() => {
                showToast('JSON kodu panoya kopyalandı!');
            });
        }

        function resetAll() {
            if(confirm('Tüm yayınlanmamış değişiklikleri geri almak istediğinize emin misiniz?')) {
                DioAPI.save('dioreal_lang_data', {}, function() { location.reload(); });
            }
        }

        function showToast(msg, icon = 'check') {
            const t = document.getElementById('toast');
            const m = document.getElementById('toastMsg');
            if (!t || !m) return;
            m.innerText = msg;
            const iconMap = {
                'check': 'fa-circle-check',
                'info':  'fa-circle-info',
                'exclamation': 'fa-circle-exclamation'
            };
            t.querySelector('i').className = `fas ${iconMap[icon] || 'fa-circle-check'}`;
            t.classList.add('show');
            clearTimeout(t._toastTimer);
            t._toastTimer = setTimeout(() => t.classList.remove('show'), 3000);
        }

        // Global Search
        document.getElementById('globalSearch').addEventListener('input', function(e) {
            const term = e.target.value.toLowerCase();
            document.querySelectorAll('.editor-card').forEach(card => {
                const text = card.innerText.toLowerCase();
                card.style.display = text.includes(term) ? 'block' : 'none';
            });
        });
    