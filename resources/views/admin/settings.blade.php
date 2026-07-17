@extends('admin.layouts.app')

@section('title', 'Genel Ayarlar')

@section('page_title', 'Genel Ayarlar')
@section('page_subtitle', 'Sitenin iletişim bilgileri, sosyal ağ entegrasyonları, hero başlıkları, anasayfa/hakkımızda içerikleri ve marka referanslarının yönetimi.')

@section('content')
<style>
    .tab-btn {
        background: none;
        border: none;
        padding: 0.75rem 1.5rem;
        font-family: var(--font-body), sans-serif;
        font-size: 0.9rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.5) !important;
        cursor: pointer;
        border-bottom: 2px solid transparent;
        margin-bottom: -2px;
        transition: all 0.3s ease;
    }
    .tab-btn:hover {
        color: #ffffff !important;
    }
    .tab-btn.active {
        color: var(--primary, #c8a96e) !important;
        border-bottom-color: var(--primary, #c8a96e) !important;
    }
    .setting-tab-pane {
        display: none;
    }
    .setting-tab-pane.active {
        display: block;
    }
    .img-preview-container {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid var(--border-color);
        padding: 1rem;
        border-radius: var(--radius-md);
        margin-top: 0.5rem;
    }
    .img-preview {
        width: 120px;
        height: 80px;
        object-fit: cover;
        border-radius: 4px;
        background: #111;
        border: 1px solid rgba(255,255,255,0.1);
    }
    .form-section-title {
        color: var(--primary, #c8a96e);
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 0.5rem;
        margin-top: 2rem;
        margin-bottom: 1.5rem;
        font-size: 1.1rem;
        font-weight: 500;
    }
</style>

<div style="display: grid; grid-template-columns: 1fr; gap: 2.5rem;">
    
    <!-- General settings form -->
    <div class="panel-card">
        <div class="panel-card-header" style="flex-direction: column; align-items: flex-start; gap: 1rem; border-bottom: none; padding-bottom: 0;">
            <h3 class="panel-card-title">
                <i class="fas fa-sliders-h" style="color: var(--primary); margin-right: 0.5rem;"></i> Genel Ayarları Güncelle
            </h3>
            
            <div class="tabs-navigation" style="display: flex; gap: 0.5rem; border-bottom: 2px solid var(--border-color); width: 100%;">
                <button type="button" class="tab-btn active" onclick="switchSettingTab(event, 'tab-general')">İletişim & Genel</button>
                <button type="button" class="tab-btn" onclick="switchSettingTab(event, 'tab-homepage')">Anasayfa İçeriği</button>
                <button type="button" class="tab-btn" onclick="switchSettingTab(event, 'tab-about')">Hakkımızda İçeriği</button>
            </div>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" style="padding: 1.5rem;">
            @csrf

            <!-- ── TAB 1: GENERAL & CONTACT ── -->
            <div id="tab-general" class="setting-tab-pane active">
                
                <h4 class="form-section-title" style="margin-top: 0;">Hero Giriş Başlığı</h4>
                <div class="lang-tabs-container">
                    <button type="button" class="lang-tab active" data-lang="tr" onclick="switchLanguageTab('tr')">Türkçe</button>
                    <button type="button" class="lang-tab" data-lang="en" onclick="switchLanguageTab('en')">English</button>
                </div>

                <div class="lang-pane active" data-lang="tr">
                    <div class="form-group">
                        <label class="form-label" for="hero_title_tr">Ana Başlık (TR)</label>
                        <textarea class="form-control" name="hero_title_tr" id="hero_title_tr" rows="2" placeholder="Örn: Türkiye ve dünyada seçkin&#10;deneyimlerin kapısını aralıyoruz.">{{ $settings['hero_title_tr'] ?? '' }}</textarea>
                        <small style="color: var(--text-muted); display: block; margin-top: 0.25rem;">Satır atlamak istediğiniz yerlerde normal Enter tuşuna basabilirsiniz.</small>
                    </div>
                </div>

                <div class="lang-pane" data-lang="en">
                    <div class="form-group">
                        <label class="form-label" for="hero_title_en">Ana Başlık (EN)</label>
                        <textarea class="form-control" name="hero_title_en" id="hero_title_en" rows="2" placeholder="Örn: Opening doors to exclusive&#10;experiences globally.">{{ $settings['hero_title_en'] ?? '' }}</textarea>
                        <small style="color: var(--text-muted); display: block; margin-top: 0.25rem;">Satır atlamak istediğiniz yerlerde normal Enter tuşuna basabilirsiniz.</small>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem; margin-top: 1.5rem;">
                    <!-- Contact Info Section -->
                    <div>
                        <h4 class="form-section-title" style="margin-top: 0;">İletişim Bilgileri</h4>
                        
                        <div class="form-group">
                            <label class="form-label" for="contact_email">E-posta Adresi</label>
                            <input type="email" class="form-control" name="contact_email" id="contact_email" value="{{ $settings['contact_email'] ?? '' }}" placeholder="info@diorealdijital.com">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="contact_phone">Telefon Numarası</label>
                            <input type="text" class="form-control" name="contact_phone" id="contact_phone" value="{{ $settings['contact_phone'] ?? '' }}" placeholder="+90 212 555 0100">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="contact_address_tr">Adres (TR)</label>
                            <input type="text" class="form-control" name="contact_address_tr" id="contact_address_tr" value="{{ $settings['contact_address_tr'] ?? '' }}" placeholder="İstanbul, Türkiye">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="contact_address_en">Adres (EN)</label>
                            <input type="text" class="form-control" name="contact_address_en" id="contact_address_en" value="{{ $settings['contact_address_en'] ?? '' }}" placeholder="Istanbul, Turkey">
                        </div>
                    </div>

                    <!-- Social Media & Integrations -->
                    <div>
                        <h4 class="form-section-title" style="margin-top: 0;">Sosyal Ağlar & Entegrasyonlar</h4>

                        <div class="form-group">
                            <label class="form-label" for="instagram">Instagram Profili</label>
                            <input type="url" class="form-control" name="instagram" id="instagram" value="{{ $settings['instagram'] ?? '' }}" placeholder="https://instagram.com/kullanici">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="linkedin">LinkedIn Profili</label>
                            <input type="url" class="form-control" name="linkedin" id="linkedin" value="{{ $settings['linkedin'] ?? '' }}" placeholder="https://linkedin.com/company/sirket">
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="whatsapp">WhatsApp Buton Numarası</label>
                            <input type="text" class="form-control" name="whatsapp" id="whatsapp" value="{{ $settings['whatsapp'] ?? '' }}" placeholder="905320000000">
                            <small style="color: var(--text-muted); display: block; margin-top: 0.25rem;">Numaranın başına + veya 0 koymadan, ülke koduyla bitişik yazın (Örn: 905321234567).</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="footer_copy">Footer Telif Yazısı (Copyright)</label>
                            <input type="text" class="form-control" name="footer_copy" id="footer_copy" value="{{ $settings['footer_copy'] ?? '' }}" placeholder="© 2026 Dioreal Dijital. All Rights Reserved.">
                        </div>
                    </div>
                </div>
            </div>

            <!-- ── TAB 2: HOMEPAGE CONTENT ── -->
            <div id="tab-homepage" class="setting-tab-pane">
                
                <!-- Hero Background Slides -->
                <h4 class="form-section-title" style="margin-top: 0;">Anasayfa Hero Slayt Görselleri</h4>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                    <div class="form-group">
                        <label class="form-label">Slayt 1 Görseli</label>
                        <div class="img-preview-container">
                            <img class="img-preview" src="{{ asset($settings['hero_slide_1'] ?? 'foto.img/hero_4k.jpg') }}" alt="Slide 1">
                            <input type="file" name="hero_slide_1" accept="image/*">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Slayt 2 Görseli</label>
                        <div class="img-preview-container">
                            <img class="img-preview" src="{{ asset($settings['hero_slide_2'] ?? 'foto.img/hero_slide_2.jpg') }}" alt="Slide 2">
                            <input type="file" name="hero_slide_2" accept="image/*">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Slayt 3 Görseli</label>
                        <div class="img-preview-container">
                            <img class="img-preview" src="{{ asset($settings['hero_slide_3'] ?? 'foto.img/hero_slide_3.jpg') }}" alt="Slide 3">
                            <input type="file" name="hero_slide_3" accept="image/*">
                        </div>
                    </div>
                </div>

                <!-- Manifesto Selection -->
                <h4 class="form-section-title">Bu Ayın Seçkinleri (Manifesto Başlığı)</h4>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                    <div class="form-group">
                        <label class="form-label" for="man_eyebrow_tr">Üst Başlık (TR)</label>
                        <input type="text" class="form-control" name="man_eyebrow_tr" id="man_eyebrow_tr" value="{{ $settings['man_eyebrow_tr'] ?? 'BU AYIN SEÇKİNLERİ' }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="man_eyebrow_en">Üst Başlık (EN)</label>
                        <input type="text" class="form-control" name="man_eyebrow_en" id="man_eyebrow_en" value="{{ $settings['man_eyebrow_en'] ?? "THIS MONTH'S SELECTION" }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="man_p1_tr">Açıklama Metni (TR)</label>
                    <textarea class="form-control" name="man_p1_tr" id="man_p1_tr" rows="3">{{ $settings['man_p1_tr'] ?? 'Sizler için özenle seçtiğimiz bu ayın en trend otel, restoran, yat ve plaj lokasyonlarının ardındaki eşsiz hikayeleri keşfedin.' }}</textarea>
                </div>
                <div class="form-group">
                    <label class="form-label" for="man_p1_en">Açıklama Metni (EN)</label>
                    <textarea class="form-control" name="man_p1_en" id="man_p1_en" rows="3">{{ $settings['man_p1_en'] ?? "Explore the unique stories behind this month's trending hotels, restaurants, yachts, and beach spots carefully selected for you." }}</textarea>
                </div>

                <!-- Trends Cards Grid -->
                <h4 class="form-section-title">Seçkin Trend Lokasyon Kartları</h4>
                <div style="display: grid; grid-template-columns: 1fr; gap: 2rem;">
                    
                    <!-- Trend 1: Otel -->
                    <div style="background: rgba(255, 255, 255, 0.01); border: 1px solid var(--border-color); padding: 1.5rem; border-radius: var(--radius-lg);">
                        <h5 style="color: var(--primary); font-size: 1rem; margin-bottom: 1rem;"><i class="fas fa-hotel"></i> Trend 1: Otel Kartı</h5>
                        <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 1.5rem;">
                            <div>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                    <div class="form-group">
                                        <label class="form-label">Kart Başlığı (TR)</label>
                                        <input type="text" class="form-control" name="trend_otel_title_tr" value="{{ $settings['trend_otel_title_tr'] ?? 'Kassandra Villa' }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Kart Başlığı (EN)</label>
                                        <input type="text" class="form-control" name="trend_otel_title_en" value="{{ $settings['trend_otel_title_en'] ?? 'Kassandra Villa' }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Alt Açıklama (TR)</label>
                                    <input type="text" class="form-control" name="trend_otel_desc_tr" value="{{ $settings['trend_otel_desc_tr'] ?? 'Ege\'nin gizli kalmış koylarında uyanmanın eşsiz hissi.' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Alt Açıklama (EN)</label>
                                    <input type="text" class="form-control" name="trend_otel_desc_en" value="{{ $settings['trend_otel_desc_en'] ?? 'The unique feeling of waking up in the hidden bays of the Aegean.' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Görsel</label>
                                <div class="img-preview-container" style="height: calc(100% - 25px); margin-top: 0;">
                                    <img class="img-preview" src="{{ asset($settings['trend_otel_img'] ?? 'foto.img/about_safari.jpg') }}" alt="Trend Otel">
                                    <input type="file" name="trend_otel_img" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Trend 2: Restoran -->
                    <div style="background: rgba(255, 255, 255, 0.01); border: 1px solid var(--border-color); padding: 1.5rem; border-radius: var(--radius-lg);">
                        <h5 style="color: var(--primary); font-size: 1rem; margin-bottom: 1rem;"><i class="fas fa-utensils"></i> Trend 2: Restoran Kartı</h5>
                        <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 1.5rem;">
                            <div>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                    <div class="form-group">
                                        <label class="form-label">Kart Başlığı (TR)</label>
                                        <input type="text" class="form-control" name="trend_rest_title_tr" value="{{ $settings['trend_rest_title_tr'] ?? 'Melengeç' }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Kart Başlığı (EN)</label>
                                        <input type="text" class="form-control" name="trend_rest_title_en" value="{{ $settings['trend_rest_title_en'] ?? 'Melengeç' }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Alt Açıklama (TR)</label>
                                    <input type="text" class="form-control" name="trend_rest_desc_tr" value="{{ $settings['trend_rest_desc_tr'] ?? 'Taze deniz ürünleri ile unutulmaz bir gastronomi yolculuğu.' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Alt Açıklama (EN)</label>
                                    <input type="text" class="form-control" name="trend_rest_desc_en" value="{{ $settings['trend_rest_desc_en'] ?? 'An unforgettable gastronomic journey with fresh seafood.' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Görsel</label>
                                <div class="img-preview-container" style="height: calc(100% - 25px); margin-top: 0;">
                                    <img class="img-preview" src="{{ asset($settings['trend_rest_img'] ?? 'foto.img/rest_mikla.jpg') }}" alt="Trend Restoran">
                                    <input type="file" name="trend_rest_img" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Trend 3: Yat -->
                    <div style="background: rgba(255, 255, 255, 0.01); border: 1px solid var(--border-color); padding: 1.5rem; border-radius: var(--radius-lg);">
                        <h5 style="color: var(--primary); font-size: 1rem; margin-bottom: 1rem;"><i class="fas fa-ship"></i> Trend 3: Yat Kartı</h5>
                        <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 1.5rem;">
                            <div>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                    <div class="form-group">
                                        <label class="form-label">Kart Başlığı (TR)</label>
                                        <input type="text" class="form-control" name="trend_yat_title_tr" value="{{ $settings['trend_yat_title_tr'] ?? 'Blue Voyage' }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Kart Başlığı (EN)</label>
                                        <input type="text" class="form-control" name="trend_yat_title_en" value="{{ $settings['trend_yat_title_en'] ?? 'Blue Voyage' }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Alt Açıklama (TR)</label>
                                    <input type="text" class="form-control" name="trend_yat_desc_tr" value="{{ $settings['trend_yat_desc_tr'] ?? 'Sonsuz mavilikte rotalar. Rüzgarın sesinden başka hiçbir şey yok.' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Alt Açıklama (EN)</label>
                                    <input type="text" class="form-control" name="trend_yat_desc_en" value="{{ $settings['trend_yat_desc_en'] ?? 'Routes in infinite blue. Nothing but the sound of the wind.' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Görsel</label>
                                <div class="img-preview-container" style="height: calc(100% - 25px); margin-top: 0;">
                                    <img class="img-preview" src="{{ asset($settings['trend_yat_img'] ?? 'foto.img/about_yacht.jpg') }}" alt="Trend Yat">
                                    <input type="file" name="trend_yat_img" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Trend 4: Beach -->
                    <div style="background: rgba(255, 255, 255, 0.01); border: 1px solid var(--border-color); padding: 1.5rem; border-radius: var(--radius-lg);">
                        <h5 style="color: var(--primary); font-size: 1rem; margin-bottom: 1rem;"><i class="fas fa-umbrella-beach"></i> Trend 4: Plaj Kartı</h5>
                        <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 1.5rem;">
                            <div>
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                    <div class="form-group">
                                        <label class="form-label">Kart Başlığı (TR)</label>
                                        <input type="text" class="form-control" name="trend_beach_title_tr" value="{{ $settings['trend_beach_title_tr'] ?? 'Rups Beach' }}">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Kart Başlığı (EN)</label>
                                        <input type="text" class="form-control" name="trend_beach_title_en" value="{{ $settings['trend_beach_title_en'] ?? 'Rups Beach' }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Alt Açıklama (TR)</label>
                                    <input type="text" class="form-control" name="trend_beach_desc_tr" value="{{ $settings['trend_beach_desc_tr'] ?? 'Altın kumlar ve kristal sular. Müziğin ritmine eşlik eden anlar.' }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Alt Açıklama (EN)</label>
                                    <input type="text" class="form-control" name="trend_beach_desc_en" value="{{ $settings['trend_beach_desc_en'] ?? 'Golden sands and crystal waters. Moments accompanying the rhythm of the music.' }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Görsel</label>
                                <div class="img-preview-container" style="height: calc(100% - 25px); margin-top: 0;">
                                    <img class="img-preview" src="{{ asset($settings['trend_beach_img'] ?? 'foto.img/bodrum.jpg') }}" alt="Trend Beach">
                                    <input type="file" name="trend_beach_img" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ── TAB 3: ABOUT PAGE CONTENT ── -->
            <div id="tab-about" class="setting-tab-pane">
                
                <!-- Hero Section -->
                <h4 class="form-section-title" style="margin-top: 0;">Hakkımızda Hero Bölümü</h4>
                <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                    <div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label class="form-label">Üst Başlık / Eyebrow (TR)</label>
                                <input type="text" class="form-control" name="about_hero_eyebrow_tr" value="{{ $settings['about_hero_eyebrow_tr'] ?? 'Biz Kimiz' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Üst Başlık / Eyebrow (EN)</label>
                                <input type="text" class="form-control" name="about_hero_eyebrow_en" value="{{ $settings['about_hero_eyebrow_en'] ?? 'Who We Are' }}">
                            </div>
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label class="form-label">Ana Başlık (TR)</label>
                                <input type="text" class="form-control" name="about_hero_title_tr" value="{{ $settings['about_hero_title_tr'] ?? 'Dioreal Dijital' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Ana Başlık (EN)</label>
                                <input type="text" class="form-control" name="about_hero_title_en" value="{{ $settings['about_hero_title_en'] ?? 'Dioreal Digital' }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Hero Arka Plan Görseli</label>
                        <div class="img-preview-container" style="height: calc(100% - 25px); margin-top: 0;">
                            <img class="img-preview" src="{{ asset($settings['about_hero_img'] ?? 'foto.img/hero_4k.jpg') }}" alt="About Hero">
                            <input type="file" name="about_hero_img" accept="image/*">
                        </div>
                    </div>
                </div>

                <!-- Story Section -->
                <h4 class="form-section-title">Hikayemiz Bölümü</h4>
                <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                    <div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label class="form-label">Üst Başlık (TR)</label>
                                <input type="text" class="form-control" name="about_story_eyebrow_tr" value="{{ $settings['about_story_eyebrow_tr'] ?? 'Hikayemiz' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Üst Başlık (EN)</label>
                                <input type="text" class="form-control" name="about_story_eyebrow_en" value="{{ $settings['about_story_eyebrow_en'] ?? 'Our Story' }}">
                            </div>
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label class="form-label">Hikaye Başlığı (TR)</label>
                                <input type="text" class="form-control" name="about_story_title_tr" value="{{ $settings['about_story_title_tr'] ?? '15 yıldır lüks seyahatin sesi' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Hikaye Başlığı (EN)</label>
                                <input type="text" class="form-control" name="about_story_title_en" value="{{ $settings['about_story_title_en'] ?? 'Voice of luxury travel for 15 years' }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Paragraf 1 (TR)</label>
                            <textarea class="form-control" name="about_story_p1_tr" rows="2">{{ $settings['about_story_p1_tr'] ?? '2010 yılında İstanbul\'da kurulan Dioreal Dijital, Türkiye\'nin öncü lüks seyahat ve yaşam tarzı medya platformuna dönüşmüştür.' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Paragraf 1 (EN)</label>
                            <textarea class="form-control" name="about_story_p1_en" rows="2">{{ $settings['about_story_p1_en'] ?? 'Founded in Istanbul in 2010, Dioreal Digital has evolved into Turkey\'s leading luxury travel and lifestyle media platform.' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Paragraf 2 (TR)</label>
                            <textarea class="form-control" name="about_story_p2_tr" rows="2">{{ $settings['about_story_p2_tr'] ?? 'Her destinasyonda bizzat bulunarak, her oteli bizatihi deneyimleyerek ve her markayı özenle seçerek güvenilir bir referans noktası haline geldik.' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Paragraf 2 (EN)</label>
                            <textarea class="form-control" name="about_story_p2_en" rows="2">{{ $settings['about_story_p2_en'] ?? 'By personally visiting every destination and experiencing every hotel firsthand, we\'ve become a trusted reference.' }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Hikayemiz Bölüm Görseli</label>
                        <div class="img-preview-container" style="height: calc(100% - 25px); margin-top: 0;">
                            <img class="img-preview" src="{{ asset($settings['about_story_img'] ?? 'foto.img/about_yacht.jpg') }}" alt="Story Image">
                            <input type="file" name="about_story_img" accept="image/*">
                        </div>
                    </div>
                </div>

                <!-- Stats Section -->
                <h4 class="form-section-title">İstatistikler & Rakamlar</h4>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div class="form-group">
                        <label class="form-label">Bölüm Başlığı (TR)</label>
                        <input type="text" class="form-control" name="about_stats_title_tr" value="{{ $settings['about_stats_title_tr'] ?? '15 Yılın Mirası' }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Bölüm Başlığı (EN)</label>
                        <input type="text" class="form-control" name="about_stats_title_en" value="{{ $settings['about_stats_title_en'] ?? 'Legacy of 15 Years' }}">
                    </div>
                </div>
                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 2rem;">
                    <!-- Stat 1 -->
                    <div style="background: rgba(255, 255, 255, 0.01); border: 1px solid var(--border-color); padding: 1rem; border-radius: var(--radius-md);">
                        <h6 style="color: var(--primary); margin-bottom: 0.5rem;">İstatistik 1</h6>
                        <div class="form-group">
                            <label class="form-label">Değer (Sayı)</label>
                            <input type="text" class="form-control" name="about_stat1_num" value="{{ $settings['about_stat1_num'] ?? '150+' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Etiket (TR)</label>
                            <input type="text" class="form-control" name="about_stat1_label_tr" value="{{ $settings['about_stat1_label_tr'] ?? 'Destinasyon' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Etiket (EN)</label>
                            <input type="text" class="form-control" name="about_stat1_label_en" value="{{ $settings['about_stat1_label_en'] ?? 'Destinations' }}">
                        </div>
                    </div>
                    <!-- Stat 2 -->
                    <div style="background: rgba(255, 255, 255, 0.01); border: 1px solid var(--border-color); padding: 1rem; border-radius: var(--radius-md);">
                        <h6 style="color: var(--primary); margin-bottom: 0.5rem;">İstatistik 2</h6>
                        <div class="form-group">
                            <label class="form-label">Değer (Sayı)</label>
                            <input type="text" class="form-control" name="about_stat2_num" value="{{ $settings['about_stat2_num'] ?? '2M+' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Etiket (TR)</label>
                            <input type="text" class="form-control" name="about_stat2_label_tr" value="{{ $settings['about_stat2_label_tr'] ?? 'Aylık Okuyucu' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Etiket (EN)</label>
                            <input type="text" class="form-control" name="about_stat2_label_en" value="{{ $settings['about_stat2_label_en'] ?? 'Monthly Readers' }}">
                        </div>
                    </div>
                    <!-- Stat 3 -->
                    <div style="background: rgba(255, 255, 255, 0.01); border: 1px solid var(--border-color); padding: 1rem; border-radius: var(--radius-md);">
                        <h6 style="color: var(--primary); margin-bottom: 0.5rem;">İstatistik 3</h6>
                        <div class="form-group">
                            <label class="form-label">Değer (Sayı)</label>
                            <input type="text" class="form-control" name="about_stat3_num" value="{{ $settings['about_stat3_num'] ?? '300+' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Etiket (TR)</label>
                            <input type="text" class="form-control" name="about_stat3_label_tr" value="{{ $settings['about_stat3_label_tr'] ?? 'Marka Ortağı' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Etiket (EN)</label>
                            <input type="text" class="form-control" name="about_stat3_label_en" value="{{ $settings['about_stat3_label_en'] ?? 'Brand Partners' }}">
                        </div>
                    </div>
                    <!-- Stat 4 -->
                    <div style="background: rgba(255, 255, 255, 0.01); border: 1px solid var(--border-color); padding: 1rem; border-radius: var(--radius-md);">
                        <h6 style="color: var(--primary); margin-bottom: 0.5rem;">İstatistik 4</h6>
                        <div class="form-group">
                            <label class="form-label">Değer (Sayı)</label>
                            <input type="text" class="form-control" name="about_stat4_num" value="{{ $settings['about_stat4_num'] ?? '15' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Etiket (TR)</label>
                            <input type="text" class="form-control" name="about_stat4_label_tr" value="{{ $settings['about_stat4_label_tr'] ?? 'Yıllık Deneyim' }}">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Etiket (EN)</label>
                            <input type="text" class="form-control" name="about_stat4_label_en" value="{{ $settings['about_stat4_label_en'] ?? 'Years of Experience' }}">
                        </div>
                    </div>
                </div>

                <!-- Mission Section -->
                <h4 class="form-section-title">Misyonumuz Bölümü</h4>
                <div style="display: grid; grid-template-columns: 1.3fr 1fr; gap: 1.5rem;">
                    <div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label class="form-label">Üst Başlık (TR)</label>
                                <input type="text" class="form-control" name="about_mission_eyebrow_tr" value="{{ $settings['about_mission_eyebrow_tr'] ?? 'Misyonumuz' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Üst Başlık (EN)</label>
                                <input type="text" class="form-control" name="about_mission_eyebrow_en" value="{{ $settings['about_mission_eyebrow_en'] ?? 'Our Mission' }}">
                            </div>
                        </div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                            <div class="form-group">
                                <label class="form-label">Misyon Başlığı (TR)</label>
                                <input type="text" class="form-control" name="about_mission_title_tr" value="{{ $settings['about_mission_title_tr'] ?? 'Anlamlı deneyimler için' }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Misyon Başlığı (EN)</label>
                                <input type="text" class="form-control" name="about_mission_title_en" value="{{ $settings['about_mission_title_en'] ?? 'For meaningful experiences' }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Paragraf 1 (TR)</label>
                            <textarea class="form-control" name="about_mission_p1_tr" rows="2">{{ $settings['about_mission_p1_tr'] ?? 'Sadece güzel yerler göstermiyoruz. Seyahatin ruhunu, bir destinasyonun gerçek özünü, yerel kültürün derinliğini aktarıyoruz.' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Paragraf 1 (EN)</label>
                            <textarea class="form-control" name="about_mission_p1_en" rows="2">{{ $settings['about_mission_p1_en'] ?? 'We don\'t just show beautiful places. We convey the true essence of a destination.' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Paragraf 2 (TR)</label>
                            <textarea class="form-control" name="about_mission_p2_tr" rows="2">{{ $settings['about_mission_p2_tr'] ?? 'Okuyucularımız bize güvenir, markalarımız bize inanır, destinasyonlar bizi ortaklık arar çünkü söylediğimiz her şey gerçek.' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Paragraf 2 (EN)</label>
                            <textarea class="form-control" name="about_mission_p2_en" rows="2">{{ $settings['about_mission_p2_en'] ?? 'Our readers trust us, our brands believe in us, and destinations seek partnerships because everything we say is authentic.' }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Misyon Bölüm Görseli</label>
                        <div class="img-preview-container" style="height: calc(100% - 25px); margin-top: 0;">
                            <img class="img-preview" src="{{ asset($settings['about_mission_img'] ?? 'foto.img/about_safari.jpg') }}" alt="Mission Image">
                            <input type="file" name="about_mission_img" accept="image/*">
                        </div>
                    </div>
                </div>

            </div>

            <!-- Form Submit -->
            <div style="border-top: 1px solid var(--border-color); padding-top: 1.5rem; display: flex; justify-content: flex-end; margin-top: 2rem;">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Değişiklikleri Kaydet
                </button>
            </div>
        </form>
    </div>

    <!-- Brands & Collaborations Management -->
    <div class="panel-card">
        <div class="panel-card-header">
            <h3 class="panel-card-title">
                <i class="fas fa-handshake" style="color: var(--primary); margin-right: 0.5rem;"></i> Marka Referansları
            </h3>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; padding: 1.5rem;">
            
            <!-- Existing Brands Grid -->
            <div>
                <h4 style="color: var(--primary); margin-bottom: 1rem; font-size: 1.05rem;">Mevcut Referanslar</h4>
                
                @if(isset($settings['brands']) && is_array($settings['brands']) && count($settings['brands']) > 0)
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(130px, 1fr)); gap: 1rem; max-height: 400px; overflow-y: auto; padding-right: 0.5rem;">
                        @foreach($settings['brands'] as $index => $brand)
                            <div style="background: rgba(15, 23, 42, 0.4); border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 0.75rem; display: flex; flex-direction: column; align-items: center; justify-content: space-between; text-align: center; height: 120px; position: relative;">
                                <div style="width: 100%; height: 50px; display: flex; align-items: center; justify-content: center; background: rgba(0, 0, 0, 0.1); border-radius: 4px; overflow: hidden; margin-bottom: 0.5rem;">
                                    <img src="{{ asset($brand['img']) }}" alt="{{ $brand['name'] }}" style="max-width: 90%; max-height: 90%; object-fit: contain; filter: brightness(0) invert(1);">
                                </div>
                                <span style="font-size: 0.8rem; font-weight: 500; text-overflow: ellipsis; white-space: nowrap; overflow: hidden; width: 100%;">{{ $brand['name'] }}</span>
                                
                                <button type="button" onclick="openEditModal({{ $index }}, '{{ addslashes($brand['name']) }}', '{{ asset($brand['img']) }}', '{{ route('admin.settings.update_brand', $index) }}')" style="position: absolute; top: 5px; right: 32px; background: rgba(59, 130, 246, 0.2); border: 1px solid rgba(59, 130, 246, 0.3); color: #93c5fd; width: 22px; height: 22px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 0.7rem; transition: var(--transition);" title="Düzenle">
                                    <i class="fas fa-edit"></i>
                                </button>
                                
                                <form action="{{ route('admin.settings.delete_brand', $index) }}" method="POST" onsubmit="return confirm('Bu markayı referanslardan kaldırmak istediğinizden emin misiniz?');" style="position: absolute; top: 5px; right: 5px;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background: rgba(239, 68, 68, 0.2); border: 1px solid rgba(239, 68, 68, 0.3); color: #f87171; width: 22px; height: 22px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 0.7rem; transition: var(--transition);">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p style="color: var(--text-muted); font-size: 0.9rem;">Henüz bir referans marka eklenmemiş.</p>
                @endif
            </div>

            <!-- Add Brand Form -->
            <div style="background: rgba(255, 255, 255, 0.02); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 1.5rem;">
                <h4 style="color: var(--primary); margin-bottom: 1.25rem; font-size: 1.05rem;">Yeni Referans Ekle</h4>
                
                <form action="{{ route('admin.settings.add_brand') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label class="form-label" for="brand_name">Marka Adı</label>
                        <input type="text" class="form-control" name="brand_name" id="brand_name" required placeholder="Örn: Gucci">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="brand_logo">Marka Logosu</label>
                        <input type="file" class="form-control" name="brand_logo" id="brand_logo" required accept="image/*">
                        <small style="color: var(--text-muted); display: block; margin-top: 0.25rem;">Şeffaf arka planlı PNG, SVG veya WEBP formatı önerilir.</small>
                    </div>

                    <div style="margin-top: 1.5rem;">
                        <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center;">
                            <i class="fas fa-plus"></i> Referans Markayı Ekle
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>

<!-- Edit Brand Modal -->
<div id="editBrandModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.7); backdrop-filter: blur(8px); z-index: 9999; align-items: center; justify-content: center; padding: 2rem;">
    <div style="background: #1e293b; border: 1px solid rgba(255,255,255,0.1); border-radius: var(--radius-lg); width: 100%; max-width: 450px; padding: 2rem; position: relative; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.55);">
        <button onclick="closeEditModal()" style="position: absolute; top: 1.5rem; right: 1.5rem; background: none; border: none; color: var(--text-muted); cursor: pointer; font-size: 1.2rem; transition: color 0.3s;" onmouseover="this.style.color='white'" onmouseout="this.style.color='var(--text-muted)'">
            <i class="fas fa-times"></i>
        </button>
        <h4 style="color: var(--primary); font-size: 1.25rem; margin-bottom: 1.5rem; font-family: var(--font-display);"><i class="fas fa-edit"></i> Referansı Düzenle</h4>
        
        <form id="editBrandForm" action="" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group" style="margin-bottom: 1.25rem;">
                <label class="form-label" style="display: block; margin-bottom: 0.5rem; font-size: 0.85rem; color: rgba(255,255,255,0.7);">Marka Adı</label>
                <input type="text" class="form-control" name="brand_name" id="edit_brand_name" required style="width: 100%; padding: 0.75rem; background: rgba(15, 23, 42, 0.4); border: 1px solid var(--border-color); border-radius: var(--radius-md); color: white;">
            </div>

            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label class="form-label" style="display: block; margin-bottom: 0.5rem; font-size: 0.85rem; color: rgba(255,255,255,0.7);">Mevcut Logo</label>
                <div style="height: 60px; display: flex; align-items: center; justify-content: center; background: rgba(0, 0, 0, 0.2); border-radius: var(--radius-md); overflow: hidden; margin-bottom: 0.75rem; border: 1px solid rgba(255,255,255,0.05);">
                    <img id="edit_brand_preview" src="" alt="Mevcut Logo" style="max-height: 80%; object-fit: contain; filter: brightness(0) invert(1);">
                </div>
                <label class="form-label" style="display: block; margin-bottom: 0.5rem; font-size: 0.85rem; color: rgba(255,255,255,0.7);">Yeni Logo (Opsiyonel)</label>
                <input type="file" class="form-control" name="brand_logo" accept="image/*" style="width: 100%; padding: 0.5rem; background: rgba(15, 23, 42, 0.4); border: 1px solid var(--border-color); border-radius: var(--radius-md); color: white;">
                <small style="color: var(--text-muted); display: block; margin-top: 0.25rem; font-size: 0.75rem;">Logo değiştirmek istemiyorsanız boş bırakın.</small>
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <button type="button" onclick="closeEditModal()" class="btn btn-secondary" style="flex: 1; justify-content: center; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: white; padding: 0.75rem; border-radius: var(--radius-md); cursor: pointer;">İptal</button>
                <button type="submit" class="btn btn-primary" style="flex: 2; justify-content: center; padding: 0.75rem; border-radius: var(--radius-md);">Değişiklikleri Kaydet</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(index, name, imgUrl, updateUrl) {
        const modal = document.getElementById('editBrandModal');
        const nameInput = document.getElementById('edit_brand_name');
        const previewImg = document.getElementById('edit_brand_preview');
        const form = document.getElementById('editBrandForm');
        
        nameInput.value = name;
        previewImg.src = imgUrl;
        form.action = updateUrl;
        
        modal.style.display = 'flex';
    }

    function closeEditModal() {
        document.getElementById('editBrandModal').style.display = 'none';
    }

    function switchSettingTab(event, tabId) {
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.setting-tab-pane').forEach(pane => pane.classList.remove('active'));
        
        event.currentTarget.classList.add('active');
        document.getElementById(tabId).classList.add('active');
    }

    // Instant Image Preview Script
    document.addEventListener('DOMContentLoaded', function() {
        const fileInputs = document.querySelectorAll('input[type="file"][accept^="image"]');
        fileInputs.forEach(input => {
            input.addEventListener('change', function(e) {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Find the nearest img preview element
                        let container = input.closest('.img-preview-container');
                        if (container) {
                            let img = container.querySelector('.img-preview');
                            if (img) {
                                img.src = e.target.result;
                            }
                        }
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    });
</script>
@endsection
