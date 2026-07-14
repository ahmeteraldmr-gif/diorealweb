import json
import os

data_dir = 'storage/app/data'
os.makedirs(data_dir, exist_ok=True)

hotels = [
    { "id":1, "name":{"tr":"Maxx Royal Bodrum", "en":"Maxx Royal Bodrum"}, "tag":{"tr":"Bodrum, Türkiye", "en":"Bodrum, Turkey"}, "img":"foto.img/otel_maxx_royal.jpg", "desc":{ "tr":"Eşsiz Ege manzarası ve ultra-lüks tesisleriyle benzersiz bir deneyim sunan 5 yıldızlı resort.", "en":"A 5-star resort offering a unique experience with stunning Aegean views and ultra-luxury facilities." } },
    { "id":2, "name":{"tr":"Museum Hotel", "en":"Museum Hotel"}, "tag":{"tr":"Kapadokya, Türkiye", "en":"Cappadocia, Turkey"}, "img":"foto.img/otel_museum.jpg", "desc":{ "tr":"Antik kaya oymaları içinde, tarihin derinliklerinde unutulmaz bir konaklama deneyimi.", "en":"An unforgettable stay deep in history, inside ancient rock carvings." } },
    { "id":3, "name":{"tr":"Hillside Beach Club", "en":"Hillside Beach Club"}, "tag":{"tr":"Fethiye, Türkiye", "en":"Fethiye, Turkey"}, "img":"foto.img/otel_hillside.jpg", "desc":{ "tr":"Özel plajı, eşsiz koyu ve lüks hizmetleriyle Türkiye'nin en prestijli tatil köyü.", "en":"Turkey's most prestigious resort with its private beach, unique bay and luxury services." } },
    { "id":4, "name":{"tr":"Soneva Jani", "en":"Soneva Jani"}, "tag":{"tr":"Maldivler", "en":"Maldives"}, "img":"foto.img/otel_soneva.jpg", "desc":{ "tr":"Su üstü villalar, kristal berraklığında lagün ve sonsuz gökyüzü altında rüya konaklama.", "en":"Overwater villas, crystal-clear lagoon and dream accommodation under endless skies." } },
    { "id":5, "name":{"tr":"Aman Kyoto", "en":"Aman Kyoto"}, "tag":{"tr":"Japonya", "en":"Japan"}, "img":"foto.img/otel_aman.jpg", "desc":{ "tr":"Japon wabi-sabi felsefesini modern lüksle harmanlayan, orman içinde saklı benzersiz bir sığınak.", "en":"A unique retreat hidden in the forest, blending Japan's wabi-sabi philosophy with modern luxury." } },
    { "id":6, "name":{"tr":"Le Sirenuse", "en":"Le Sirenuse"}, "tag":{"tr":"Amalfi Kıyısı, İtalya", "en":"Amalfi Coast, Italy"}, "img":"foto.img/otel_sirenuse.jpg", "desc":{ "tr":"Positano'nun ikonik manzarası karşısında, denizi ve bougainvillea'ları izleyen efsanevi butik otel.", "en":"Legendary boutique hotel overlooking the sea and bougainvilleas, facing Positano's iconic view." } }
]

restaurants = [
    { "id":1, "name":{"tr":"Mikla", "en":"Mikla"}, "tag":{"tr":"İstanbul · Fine Dining", "en":"Istanbul · Fine Dining"}, "img":"foto.img/rest_mikla.jpg", "desc":{ "tr":"Boğaz manzarasına hâkim terası ve Türk-İskandinav mutfağı füzyonuyla İstanbul'un efsanevi adresi.", "en":"Istanbul's legendary address with its Bosphorus terrace and Turkish-Scandinavian fusion cuisine." } },
    { "id":2, "name":{"tr":"Zuma Bodrum", "en":"Zuma Bodrum"}, "tag":{"tr":"Bodrum · Deniz Kenarı", "en":"Bodrum · Seaside"}, "img":"foto.img/rest_zuma.jpg", "desc":{ "tr":"Japon Izakaya geleneğini modern lüksle buluşturan, Bodrum Marina'nın en prestijli restoranı.", "en":"Bodrum Marina's most prestigious restaurant, blending Japanese Izakaya tradition with modern luxury." } },
    { "id":3, "name":{"tr":"Melengeç Restaurant", "en":"Melengeç Restaurant"}, "tag":{"tr":"Çeşme · Meyhane", "en":"Cesme · Tavern"}, "img":"foto.img/rest_melengec.jpg", "desc":{ "tr":"Ege'nin en taze deniz ürünleri, nefis zeytinyağlılar ve muhteşem Alaçatı manzarasıyla unutulmaz bir sofra.", "en":"An unforgettable table with Aegean's freshest seafood, delicious olive oil dishes and Alaçatı views." } },
    { "id":4, "name":{"tr":"Hideaway", "en":"Hideaway"}, "tag":{"tr":"Kaş · Teras", "en":"Kas · Terrace"}, "img":"foto.img/rest_hideaway.jpg", "desc":{ "tr":"Denize 10 metre yukarıdan bakan terası ve yaratıcı Akdeniz menüsüyle Kaş'ın en romantik adresi.", "en":"Kas's most romantic address with its terrace overlooking the sea and creative Mediterranean menu." } },
    { "id":5, "name":{"tr":"Seki Restaurant", "en":"Seki Restaurant"}, "tag":{"tr":"Kapadokya · Şarap & Yemek", "en":"Cappadocia · Wine & Dine"}, "img":"foto.img/rest_seki.jpg", "desc":{ "tr":"Çardak altında Kapadokya üzüm bağlarından derlenmiş yerel şaraplar ve Anadolu mutfağının en güzel yorumu.", "en":"Local wines from Cappadocia vineyards and the finest interpretation of Anatolian cuisine under a pergola." } },
    { "id":6, "name":{"tr":"Ölüdeniz Terrace", "en":"Ölüdeniz Terrace"}, "tag":{"tr":"Fethiye · Beach Club", "en":"Fethiye · Beach Club"}, "img":"foto.img/rest_oludeniz.jpg", "desc":{ "tr":"Dünyaca ünlü Ölüdeniz lagünüyle iç içe geçmiş sahil restoranı, taze balık ve kokteyller.", "en":"Beachfront restaurant intertwined with the world-famous Ölüdeniz lagoon, fresh fish and cocktails." } }
]

yachts = [
    { "id":1, "name":{"tr":"Bodrum Blue", "en":"Bodrum Blue"}, "tag":{"tr":"Gulet · 24m", "en":"Gulet · 24m"}, "img":"foto.img/yat_bodrum_blue.jpg", "desc":{ "tr":"8 misafir kapasiteli, teak güverteli, Türk el sanatlarıyla donatılmış geleneksel Bodrum gulet'i.", "en":"Traditional Bodrum gulet for 8 guests, with teak deck and Turkish handicrafts." } },
    { "id":2, "name":{"tr":"Azure Dream", "en":"Azure Dream"}, "tag":{"tr":"Motor Yat · 35m", "en":"Motor Yacht · 35m"}, "img":"foto.img/yat_azure_dream.jpg", "desc":{ "tr":"12 misafir kapasiteli, helikopter pisti, jakuzi ve tam donanımlı modern süper yat deneyimi.", "en":"Modern super yacht for 12 guests, featuring helipad, jacuzzi and full equipment." } },
    { "id":3, "name":{"tr":"Aegean Wind", "en":"Aegean Wind"}, "tag":{"tr":"Yelkenli · 18m", "en":"Sailing Yacht · 18m"}, "img":"foto.img/yat_aegean_wind.jpg", "desc":{ "tr":"6 misafir için özel, rüzgarın gücüyle Ege'yi keşfetmek isteyenler için premium yelkenli yat.", "en":"Premium sailing yacht for 6 guests, for those who want to explore the Aegean with wind power." } }
]

def save_json(key, data):
    path = os.path.join(data_dir, f"{key}.json")
    with open(path, 'w', encoding='utf-8') as f:
        json.dump(data, f, ensure_ascii=False, indent=4)

save_json('dioreal_hotels_data', hotels)
save_json('dioreal_restaurants_data', restaurants)
save_json('dioreal_yachts_data', yachts)

print("Default data successfully saved to JSON files.")
