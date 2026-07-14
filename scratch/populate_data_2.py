import json
import os

data_dir = 'storage/app/data'
os.makedirs(data_dir, exist_ok=True)

guide = [
    { "id":1, "title":{"tr":"Bodrum Komple Rehber", "en":"Bodrum Complete Guide"}, "tag":{"tr":"Destinasyon Rehberi", "en":"Destination Guide"}, "img":"foto.img/bodrum.jpg", "desc":{ "tr":"Gidilecek plajlar, gece hayatı, en iyi restoranlar ve gizli koylar. Bodrum'da yapılacak her şey.", "en":"Beaches to go, night life, best restaurants and hidden bays. Everything to do in Bodrum." } },
    { "id":2, "title":{"tr":"Kapadokya Gizli Köşeleri", "en":"Hidden Corners of Cappadocia"}, "tag":{"tr":"Destinasyon Rehberi", "en":"Destination Guide"}, "img":"foto.img/kapadokya.jpg", "desc":{ "tr":"Turistik yerler dışında, peri bacalarının arasında saklı kalmış otantik köyler.", "en":"Authentic villages hidden among fairy chimneys, apart from tourist attractions." } },
    { "id":3, "title":{"tr":"Çeşme & Alaçatı Mayıs", "en":"Cesme & Alacati May"}, "tag":{"tr":"Sezon Rehberi", "en":"Season Guide"}, "img":"foto.img/cesme.jpg", "desc":{ "tr":"Kalabalık öncesi Çeşme'nin en keyifli hali. Rüzgar festivali ve sakin kafeler.", "en":"The most pleasant state of Cesme before the crowd. Wind festival and quiet cafes." } }
]

events = [
    { "id":1, "title":{"tr":"İstanbul Yemek Festivali 2026", "en":"Istanbul Food Festival 2026"}, "tag":{"tr":"Gastronomi", "en":"Gastronomy"}, "day":15, "month":{"tr":"Mayıs", "en":"May"}, "loc":{"tr":"📍 Beşiktaş Meydanı, İstanbul", "en":"📍 Besiktas Square, Istanbul"} },
    { "id":2, "title":{"tr":"Bodrum Uluslararası Bale Festivali", "en":"Bodrum International Ballet Festival"}, "tag":{"tr":"Kültür & Sanat", "en":"Culture & Art"}, "day":22, "month":{"tr":"Mayıs", "en":"May"}, "loc":{"tr":"📍 Bodrum Kalesi Açık Hava Sahnesi", "en":"📍 Bodrum Castle Open Air Stage"} },
    { "id":3, "title":{"tr":"Alaçatı Rüzgar Sörfü Festivali", "en":"Alacati Windsurfing Festival"}, "tag":{"tr":"Spor & Macera", "en":"Sport & Adventure"}, "day":8, "month":{"tr":"Haziran", "en":"June"}, "loc":{"tr":"📍 Alaçatı Limanı, Çeşme", "en":"📍 Alacati Port, Cesme"} }
]

journal = [
    { "id":1, "title":{"tr":"Japonya'da Çay Seremonisi", "en":"Tea Ceremony in Japan"}, "tag":{"tr":"Yurtdışı · Asya", "en":"Abroad · Asia"}, "date":"22 Nisan 2026", "img":"foto.img/japonya.jpg", "desc":{ "tr":"Kyoto'nun arka sokaklarında yaşadığımız benzersiz çay deneyimi.", "en":"Unique tea experience we had in the back streets of Kyoto." } },
    { "id":2, "title":{"tr":"Su Üstü Villada Bir Hafta", "en":"A Week in an Overwater Villa"}, "tag":{"tr":"Konaklama", "en":"Accommodation"}, "date":"15 Nisan 2026", "img":"foto.img/maldivler.jpg", "desc":{ "tr":"Maldivler'de su üstü villa deneyimi gerçekten değer mi?", "en":"Is the overwater villa experience in the Maldives really worth it?" } },
    { "id":3, "title":{"tr":"Bodrum'da Bir Yaz: Sessizlik", "en":"A Summer in Bodrum: Silence"}, "tag":{"tr":"Türkiye · Ege", "en":"Turkey · Aegean"}, "date":"10 Nisan 2026", "img":"foto.img/bodrum.jpg", "desc":{ "tr":"Sezon öncesi Bodrum'un sakinliği ve huzuru.", "en":"The peace and quiet of Bodrum before the season." } },
    { "id":4, "title":{"tr":"Kapadokya'da Balon Keyfi", "en":"Hot Air Balloon in Cappadocia"}, "tag":{"tr":"Kültür · Macera", "en":"Culture · Adventure"}, "date":"05 Nisan 2026", "img":"foto.img/kapadokya.jpg", "desc":{ "tr":"Peri bacaları üzerinde unutulmaz bir uçuş.", "en":"An unforgettable flight over fairy chimneys." } },
    { "id":5, "title":{"tr":"Patagonya Sessizliği", "en":"Patagonia Silence"}, "tag":{"tr":"Yurtdışı · Doğa", "en":"Abroad · Nature"}, "date":"01 Nisan 2026", "img":"foto.img/patagonya.jpg", "desc":{ "tr":"Dünyanın ucunda doğayla baş başa.", "en":"Alone with nature at the end of the world." } }
]

def save_json(key, data):
    path = os.path.join(data_dir, f"{key}.json")
    with open(path, 'w', encoding='utf-8') as f:
        json.dump(data, f, ensure_ascii=False, indent=4)

save_json('dioreal_guide_data', guide)
save_json('dioreal_events_data', events)
save_json('dioreal_journal_data', journal)

print("Remaining data correctly generated.")
