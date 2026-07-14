import re

with open('resources/views/admin.blade.php', 'r') as f:
    content = f.read()

# HOTELS
hotel_vars = """
                const descEn = (h.desc && typeof h.desc === 'object') ? h.desc.en : '';
                const longDescTr = (h.long_desc && typeof h.long_desc === 'object') ? h.long_desc.tr : (h.long_desc || '');
                const longDescEn = (h.long_desc && typeof h.long_desc === 'object') ? h.long_desc.en : '';
"""
content = content.replace("                const descEn = (h.desc && typeof h.desc === 'object') ? h.desc.en : '';", hotel_vars)

hotel_fields = """
                            <div class="mgr-field"><label>Açıklama (EN)</label><textarea oninput="updateHotelDesc(${h.id},'en',this.value)">${descEn}</textarea></div>
                            <div class="mgr-field" style="grid-column:1/-1;"><label>Detay Sayfası Uzun Açıklama (TR)</label><textarea style="height:120px;" oninput="updateHotelSubField(${h.id},'long_desc','tr',this.value)">${longDescTr}</textarea></div>
                            <div class="mgr-field" style="grid-column:1/-1;"><label>Detay Sayfası Uzun Açıklama (EN)</label><textarea style="height:120px;" oninput="updateHotelSubField(${h.id},'long_desc','en',this.value)">${longDescEn}</textarea></div>
                            <div class="mgr-field" style="grid-column:1/-1;"><label>Galeri (Yeni Resim Ekle)</label><input type="file" accept="image/*" onchange="addHotelGalleryImg(${h.id},this)"></div>
                            <div class="mgr-field" style="grid-column:1/-1;">
                                <div style="display:flex; gap:10px; flex-wrap:wrap;">
                                    ${(h.gallery || []).map((g, idx) => `<div style="position:relative;"><img src="${g}" style="width:80px;height:80px;object-fit:cover;border-radius:4px;"><button type="button" onclick="removeHotelGalleryImg(${h.id},${idx})" style="position:absolute;top:0;right:0;background:red;color:white;border:none;cursor:pointer;width:20px;height:20px;border-radius:50%;font-size:10px;">X</button></div>`).join('')}
                                </div>
                            </div>
"""
content = content.replace("                            <div class=\"mgr-field\"><label>Açıklama (EN)</label><textarea oninput=\"updateHotelDesc(${h.id},'en',this.value)\">${descEn}</textarea></div>", hotel_fields)

hotel_js = """
        function replaceHotelImg(id, input) {
"""
hotel_js_new = """
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
"""
content = content.replace(hotel_js, hotel_js_new)

# RESTAURANTS
rest_vars = """
                const descEn = (r.desc && typeof r.desc === 'object') ? r.desc.en : '';
                const longDescTr = (r.long_desc && typeof r.long_desc === 'object') ? r.long_desc.tr : (r.long_desc || '');
                const longDescEn = (r.long_desc && typeof r.long_desc === 'object') ? r.long_desc.en : '';
"""
content = content.replace("                const descEn = (r.desc && typeof r.desc === 'object') ? r.desc.en : '';", rest_vars)

rest_fields = """
                            <div class="mgr-field"><label>Açıklama (EN)</label><textarea oninput="updateRestDesc(${r.id},'en',this.value)">${descEn}</textarea></div>
                            <div class="mgr-field" style="grid-column:1/-1;"><label>Detay Sayfası Uzun Açıklama (TR)</label><textarea style="height:120px;" oninput="updateRestSubField(${r.id},'long_desc','tr',this.value)">${longDescTr}</textarea></div>
                            <div class="mgr-field" style="grid-column:1/-1;"><label>Detay Sayfası Uzun Açıklama (EN)</label><textarea style="height:120px;" oninput="updateRestSubField(${r.id},'long_desc','en',this.value)">${longDescEn}</textarea></div>
                            <div class="mgr-field" style="grid-column:1/-1;"><label>Galeri (Yeni Resim Ekle)</label><input type="file" accept="image/*" onchange="addRestGalleryImg(${r.id},this)"></div>
                            <div class="mgr-field" style="grid-column:1/-1;">
                                <div style="display:flex; gap:10px; flex-wrap:wrap;">
                                    ${(r.gallery || []).map((g, idx) => `<div style="position:relative;"><img src="${g}" style="width:80px;height:80px;object-fit:cover;border-radius:4px;"><button type="button" onclick="removeRestGalleryImg(${r.id},${idx})" style="position:absolute;top:0;right:0;background:red;color:white;border:none;cursor:pointer;width:20px;height:20px;border-radius:50%;font-size:10px;">X</button></div>`).join('')}
                                </div>
                            </div>
"""
content = content.replace("                            <div class=\"mgr-field\"><label>Açıklama (EN)</label><textarea oninput=\"updateRestDesc(${r.id},'en',this.value)\">${descEn}</textarea></div>", rest_fields)

rest_js = """
        function replaceRestImg(id, input) {
"""
rest_js_new = """
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
"""
content = content.replace(rest_js, rest_js_new)

with open('resources/views/admin.blade.php', 'w') as f:
    f.write(content)

print("Admin panel successfully updated for detail fields.")
