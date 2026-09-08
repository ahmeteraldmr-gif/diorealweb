<!DOCTYPE html>
<html lang="tr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RehberKoçum - Akıllı Öğrenci Takip ve Eğitim Koçluğu Platformu</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CDN for instant dynamic compilation -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        display: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        accent: {
                            blue: '#4f46e5',
                            green: '#10b981',
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FAF9F6;
        }
        h1, h2, h3, h4, .font-display {
            font-family: 'Outfit', sans-serif;
        }
        .hero-gradient {
            background: radial-gradient(circle at 85% 15%, rgba(79, 70, 229, 0.08) 0%, rgba(255, 255, 255, 0) 50%),
                        radial-gradient(circle at 15% 85%, rgba(16, 185, 129, 0.08) 0%, rgba(255, 255, 255, 0) 50%);
        }
        .glass-header {
            backdrop-filter: blur(16px);
            background-color: rgba(250, 249, 246, 0.85);
            border-bottom: 1px solid rgba(226, 232, 240, 0.6);
        }
        .premium-card {
            background: #ffffff;
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.03);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .premium-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.07);
            border-color: rgba(79, 70, 229, 0.3);
        }
        .demo-btn {
            border: none !important;
            transition: all 0.2s ease;
        }
        .demo-btn:hover {
            transform: scale(1.02);
            filter: brightness(0.95);
        }
        .text-gradient {
            background: linear-gradient(135deg, #1e1b4b 0%, #4f46e5 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        form {
            display: block;
            width: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body class="antialiased min-h-screen flex flex-col justify-between hero-gradient text-slate-800">

    <!-- Header Navigation -->
    <header class="sticky top-0 z-50 glass-header w-full">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <span class="text-2xl font-black tracking-tight text-slate-900">
                    rehber<span class="text-indigo-600">koçum</span>
                </span>
            </div>
            
            <nav class="hidden md:flex items-center space-x-8 text-sm font-semibold text-slate-600">
                <a href="#nedir" class="hover:text-indigo-600 transition">Nedir?</a>
                <a href="#neden-var" class="hover:text-indigo-600 transition">Neden RehberKoçum?</a>
                <a href="#ozellikler" class="hover:text-indigo-600 transition">Özellikler</a>
                <a href="#nasil-calisir" class="hover:text-indigo-600 transition">Nasıl Çalışır?</a>
            </nav>
            
            <div class="flex items-center space-x-4">
                <a href="{{ route('login') }}" class="px-5 py-2.5 border border-slate-200 text-slate-700 bg-white rounded-xl text-sm font-bold hover:bg-slate-50 transition shadow-sm" style="text-decoration: none;">
                    Giriş Yap
                </a>
            </div>
        </div>
    </header>

    <!-- Main Section -->
    <main class="flex-grow w-full max-w-7xl mx-auto px-6 py-12 md:py-20 space-y-24">
        
        <!-- Hero Section -->
        <section class="max-w-4xl mx-auto text-center space-y-8 py-6">
            <!-- Hero Text -->
            <div class="space-y-4">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-100 shadow-sm mx-auto">
                    ⚡ Yapay Zeka Destekli & Akıllı Koçluk Platformu
                </span>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-slate-900 leading-tight">
                    Öğrencilerinizi <br>
                    <span class="text-gradient">Akıllı İlerleme</span> ile Takip Edin
                </h1>
                <p class="text-base md:text-lg text-slate-600 max-w-2xl mx-auto leading-relaxed">
                    Sınava hazırlanan öğrenciler için ders, konu analizi, günlük soru takibi ve deneme gelişimlerini tek bir akıllı platformdan yönetin. Koçluk verimliliğinizi 3 katına çıkarın.
                </p>
            </div>

            <!-- CTA Button -->
            <div class="pt-4">
                <a href="{{ route('login') }}" 
                   class="inline-block px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl text-base font-extrabold shadow-lg shadow-indigo-200 transition-all hover:scale-105" style="text-decoration: none;">
                    Sisteme Giriş Yap ➜
                </a>
            </div>
        </section>

        <!-- Nedir Section (separation/ne işe yarar) -->
        <section id="nedir" class="space-y-12">
            <div class="text-center space-y-4 max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900">RehberKoçum Ne İşe Yarar?</h2>
                <p class="text-slate-600">RehberKoçum, eğitim koçları ile sınava hazırlanan öğrenciler arasındaki iletişimi dijitalleştiren ve hızlandıran akıllı bir takip platformudur.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1 -->
                <div class="premium-card p-6 rounded-3xl">
                    <div class="text-3xl mb-4">🎯</div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Hassas Takip Yolu</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Öğrencinizin hangi dersten, hangi konuyu ve alt konuyu tamamladığını basamak basamak görün, eksik noktaları tespit edin.</p>
                </div>
                <!-- Card 2 -->
                <div class="premium-card p-6 rounded-3xl">
                    <div class="text-3xl mb-4">⚡</div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Hızlı Program Yapımı</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Saatlik ya da serbest çalışma hedefleri koyarak dakikalar içinde haftalık çalışma programı oluşturun ve öğrenciye atayın.</p>
                </div>
                <!-- Card 3 -->
                <div class="premium-card p-6 rounded-3xl">
                    <div class="text-3xl mb-4">📊</div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">TYT / AYT Analizleri</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Deneme sınav sonuçlarını net, doğru ve yanlış sayılarıyla takip edin. Gelişimi sekmeli grafiklerle anında analiz edin.</p>
                </div>
                <!-- Card 4 -->
                <div class="premium-card p-6 rounded-3xl">
                    <div class="text-3xl mb-4">📄</div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">PDF Raporlama</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">Tek tıklamayla tüm deneme gelişim verilerini ve ders ortalamalarını barındıran Türkçe karakter uyumlu PDF çıktısını alın.</p>
                </div>
            </div>
        </section>

        <!-- Neden RehberKoçum Var Section (Neden Varız?) -->
        <section id="neden-var" class="bg-indigo-900 text-white rounded-3xl p-8 md:p-12 shadow-xl relative overflow-hidden flex flex-col md:flex-row items-center gap-8 justify-between">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_80%_120%,rgba(99,102,241,0.35),transparent_70%)]"></div>
            <div class="space-y-4 max-w-2xl z-10">
                <span class="text-xs font-bold tracking-widest text-indigo-300 uppercase">Biz Neden Varız?</span>
                <h2 class="text-3xl md:text-4xl font-extrabold leading-tight">Geleneksel, Dağınık Takip Sistemlerine Son Vermek İçin</h2>
                <p class="text-sm md:text-base text-indigo-100/90 leading-relaxed">
                    Sınava hazırlık süreci karmaşık ve streslidir. Koçların ve kurumların öğrencileri WhatsApp mesajları, Excel dosyaları veya fiziksel ajandalar üzerinden takip etmesi büyük zaman kaybına ve kritik bilgilerin kaçmasına yol açar. RehberKoçum, her şeyi tek bir bulut tabanlı merkezde birleştirerek koçların işini otomatikleştirir, öğrencilere ise verilerle desteklenmiş bir yol haritası sunar.
                </p>
            </div>
            <div class="z-10 flex-shrink-0 bg-indigo-800/80 backdrop-blur border border-indigo-700 p-6 rounded-2xl space-y-3 w-full md:w-80">
                <h4 class="text-sm font-bold text-indigo-200 uppercase tracking-wider">Geliştirme Amacımız</h4>
                <ul class="text-xs space-y-2 text-indigo-100">
                    <li class="flex items-center gap-2">🟢 Kağıt/Excel dağınıklığını önlemek</li>
                    <li class="flex items-center gap-2">🟢 Öğrenciyi verilerle motive etmek</li>
                    <li class="flex items-center gap-2">🟢 Koçların raporlama süresini azaltmak</li>
                    <li class="flex items-center gap-2">🟢 Net hedeflerle başarı oranını artırmak</li>
                </ul>
            </div>
        </section>

        <!-- Detaylı Özellikler (Core Features) -->
        <section id="ozellikler" class="space-y-12">
            <div class="text-center space-y-4 max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900">Güçlü Eğitim Altyapısı</h2>
                <p class="text-slate-600">Hem koçun hem öğrencinin ihtiyaç duyduğu tüm araçlar en premium tasarımla bir arada.</p>
            </div>

            <div class="space-y-6">
                <!-- Feature 1 -->
                <div class="bg-white p-6 md:p-8 rounded-3xl border border-slate-200/80 shadow-sm flex flex-col md:flex-row items-center gap-8">
                    <div class="p-4 bg-indigo-50 rounded-2xl text-4xl text-indigo-600 flex-shrink-0">📚</div>
                    <div class="space-y-2">
                        <h3 class="text-xl font-bold text-slate-900">Konu & Müfredat Ağacı</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Sistemdeki tüm alanlar (Sayısal, Sözel, Eşit Ağırlık, Dil) altında dersler, konular ve alt konular olarak hiyerarşik yapıdadır. Öğrenci tamamladığı alt konuları işaretlediğinde koç bunu anlık olarak kendi panelinde görür.
                        </p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-6 md:p-8 rounded-3xl border border-slate-200/80 shadow-sm flex flex-col md:flex-row items-center gap-8">
                    <div class="p-4 bg-emerald-50 rounded-2xl text-4xl text-emerald-600 flex-shrink-0">🗓️</div>
                    <div class="space-y-2">
                        <h3 class="text-xl font-bold text-slate-900">Gelişmiş Program Sihirbazı</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Koçlar, öğrencilerine haftalık çalışma planları oluştururken saatli (09:00 - 10:30 gibi) veya serbest hedefli görevler oluşturabilir. Öğrenci gün içinde tamamladığı görevleri işaretledikçe koç gelişim oranını anlık olarak izleyebilir.
                        </p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-6 md:p-8 rounded-3xl border border-slate-200/80 shadow-sm flex flex-col md:flex-row items-center gap-8">
                    <div class="p-4 bg-purple-50 rounded-2xl text-4xl text-purple-600 flex-shrink-0">📊</div>
                    <div class="space-y-2">
                        <h3 class="text-xl font-bold text-slate-900">TYT/AYT Gelişim Grafikleri ve Karşılaştırma</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Gelişmiş sekmeli yapı sayesinde TYT ve AYT sınavları tamamen ayrıştırılır. En iyi netler, genel ders ortalamaları ve zaman içindeki gelişim grafikleri tek ekrandan izlenir. İki farklı deneme ders bazında yan yana karşılaştırılabilir.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== NASIL ÇALIŞIR? - Premium Redesign ===== -->
        <section id="nasil-calisir" class="py-24 relative overflow-hidden">

            <!-- Background decoration -->
            <div class="absolute inset-0 pointer-events-none">
                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[900px] h-[500px] bg-gradient-to-b from-violet-100/60 to-transparent rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 right-0 w-96 h-96 bg-indigo-100/40 rounded-full blur-3xl"></div>
            </div>

            <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6">

                <!-- Section Header -->
                <div class="text-center space-y-4 mb-16">
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold bg-violet-50 text-violet-700 border border-violet-200 shadow-sm">
                        🎬 İnteraktif Demo
                    </span>
                    <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight">
                        Nasıl <span class="text-transparent bg-clip-text bg-gradient-to-r from-violet-600 to-indigo-600">Çalışır?</span>
                    </h2>
                    <p class="text-slate-500 text-base md:text-lg max-w-xl mx-auto leading-relaxed">
                        Koçluk sürecini dijitalleştiren 4 adımı canlı olarak keşfedin.
                    </p>
                </div>

                <!-- Step pills (above demo) -->
                <div class="flex flex-wrap justify-center gap-3 mb-8">
                    <button type="button" id="pill-0" onclick="demoGoTo(0)" class="demo-pill flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold transition-all duration-300 bg-indigo-600 text-white shadow-lg shadow-indigo-200">
                        <span class="w-5 h-5 rounded-full bg-white/25 flex items-center justify-center text-xs font-black">1</span>
                        Öğrenci Ekle
                    </button>
                    <button type="button" id="pill-1" onclick="demoGoTo(1)" class="demo-pill flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold transition-all duration-300 bg-white text-slate-500 border border-slate-200 hover:border-emerald-300 hover:text-emerald-700">
                        <span class="w-5 h-5 rounded-full bg-slate-100 flex items-center justify-center text-xs font-black">2</span>
                        Ders Ata
                    </button>
                    <button type="button" id="pill-2" onclick="demoGoTo(2)" class="demo-pill flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold transition-all duration-300 bg-white text-slate-500 border border-slate-200 hover:border-purple-300 hover:text-purple-700">
                        <span class="w-5 h-5 rounded-full bg-slate-100 flex items-center justify-center text-xs font-black">3</span>
                        Program Kur
                    </button>
                    <button type="button" id="pill-3" onclick="demoGoTo(3)" class="demo-pill flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold transition-all duration-300 bg-white text-slate-500 border border-slate-200 hover:border-rose-300 hover:text-rose-700">
                        <span class="w-5 h-5 rounded-full bg-slate-100 flex items-center justify-center text-xs font-black">4</span>
                        Gelişimi İzle
                    </button>
                </div>

                <!-- Main Demo Window -->
                <div class="rounded-[2rem] overflow-hidden shadow-[0_32px_80px_-12px_rgba(99,102,241,0.3)] border border-white/60" style="background:linear-gradient(145deg,#1e1b4b 0%,#0f172a 60%,#1a0533 100%);">

                    <!-- Browser chrome bar -->
                    <div class="flex items-center gap-3 px-5 py-3 border-b border-white/10" style="background:rgba(255,255,255,0.04);">
                        <div class="flex gap-1.5">
                            <div class="w-3 h-3 rounded-full bg-red-500/80"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-400/80"></div>
                            <div class="w-3 h-3 rounded-full bg-emerald-400/80"></div>
                        </div>
                        <div class="flex-1 mx-3 bg-white/8 border border-white/10 rounded-lg px-4 py-1.5 text-[11px] text-white/40 font-mono flex items-center gap-2">
                            <svg class="w-3 h-3 text-white/25 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            <span id="demo-url">rehberkoçum.com/koc/ogrenciler/yeni</span>
                        </div>
                        <div class="hidden sm:flex items-center gap-2 text-white/25 text-[10px] font-medium">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400/60 animate-pulse"></span>
                            Canlı Demo
                        </div>
                    </div>

                    <!-- Progress bar -->
                    <div class="h-[3px]" style="background:rgba(255,255,255,0.06);">
                        <div id="demo-prog" class="h-full rounded-full" style="width:0%;background:linear-gradient(90deg,#818cf8,#a78bfa);transition:none;"></div>
                    </div>

                    <!-- Panel content area -->
                    <div class="relative min-h-[460px] md:min-h-[420px] overflow-hidden">

                        <!-- ── Panel 0: Öğrenci Ekle ── -->
                        <div id="dpanel-0" class="demo-panel absolute inset-0 p-6 md:p-10 flex flex-col gap-5" style="opacity:1;transition:opacity 0.5s,transform 0.5s;transform:translateX(0);">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-xl bg-indigo-600 flex items-center justify-center shadow-lg shadow-indigo-900/60">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                                </div>
                                <div>
                                    <h3 class="text-white font-extrabold text-base leading-tight">Yeni Öğrenci Oluştur</h3>
                                    <p class="text-indigo-300/70 text-[11px] font-mono">koç › öğrenciler › yeni</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 flex-1">
                                <!-- Form -->
                                <div class="md:col-span-3 rounded-2xl border border-white/10 p-5 space-y-3.5" style="background:rgba(255,255,255,0.05);">
                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <div class="text-white/40 text-[10px] uppercase font-bold tracking-widest mb-1.5">Ad</div>
                                            <div class="bg-white/8 border border-indigo-400/40 rounded-xl h-9 flex items-center px-3 gap-1 ring-1 ring-indigo-500/40">
                                                <span class="text-white/80 text-xs">Ali</span>
                                                <span class="w-px h-4 bg-indigo-400 animate-pulse ml-0.5"></span>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="text-white/40 text-[10px] uppercase font-bold tracking-widest mb-1.5">Soyad</div>
                                            <div class="bg-white/8 border border-white/10 rounded-xl h-9 flex items-center px-3">
                                                <span class="text-white/80 text-xs">Yılmaz</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="text-white/40 text-[10px] uppercase font-bold tracking-widest mb-1.5">E-posta</div>
                                        <div class="bg-white/8 border border-white/10 rounded-xl h-9 flex items-center px-3">
                                            <span class="text-white/70 text-xs truncate">ali.yilmaz@gmail.com</span>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-3">
                                        <div>
                                            <div class="text-white/40 text-[10px] uppercase font-bold tracking-widest mb-1.5">Şifre</div>
                                            <div class="bg-white/8 border border-white/10 rounded-xl h-9 flex items-center px-3">
                                                <span class="text-white/60 text-xs tracking-widest">••••••••</span>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="text-white/40 text-[10px] uppercase font-bold tracking-widest mb-1.5">Sınıf</div>
                                            <div class="bg-white/8 border border-white/10 rounded-xl h-9 flex items-center px-3">
                                                <span class="text-white/70 text-xs">12. Sınıf</span>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="w-full h-10 rounded-xl flex items-center justify-center gap-2 text-white text-xs font-extrabold shadow-xl shadow-indigo-900/50 mt-1 transition-transform hover:scale-[1.02]" style="background:linear-gradient(135deg,#4f46e5,#7c3aed);">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                        Öğrenci Oluştur
                                    </button>
                                </div>
                                <!-- Student list -->
                                <div class="md:col-span-2 space-y-2.5">
                                    <div class="text-white/40 text-[10px] uppercase font-bold tracking-widest">Kayıtlı Öğrenciler</div>
                                    <div class="rounded-xl p-3 flex items-center gap-3 border border-indigo-400/50" style="background:rgba(99,102,241,0.2);">
                                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-indigo-500 to-violet-600 flex items-center justify-center text-white font-black text-xs shadow-lg">AY</div>
                                        <div class="flex-1 min-w-0">
                                            <div class="text-white text-xs font-bold">Ali Yılmaz</div>
                                            <div class="text-indigo-300 text-[10px] flex items-center gap-1"><span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>Yeni eklendi ✓</div>
                                        </div>
                                    </div>
                                    <div class="rounded-xl p-3 flex items-center gap-3 border border-white/8 opacity-60" style="background:rgba(255,255,255,0.04);">
                                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-purple-600 to-pink-600 flex items-center justify-center text-white font-black text-xs">ZK</div>
                                        <div><div class="text-white text-xs font-semibold">Zeynep Kara</div><div class="text-white/30 text-[10px]">aktif öğrenci</div></div>
                                    </div>
                                    <div class="rounded-xl p-3 flex items-center gap-3 border border-white/8 opacity-35" style="background:rgba(255,255,255,0.04);">
                                        <div class="w-9 h-9 rounded-full bg-gradient-to-br from-emerald-600 to-teal-600 flex items-center justify-center text-white font-black text-xs">MB</div>
                                        <div><div class="text-white text-xs font-semibold">Mert Bulut</div><div class="text-white/30 text-[10px]">aktif öğrenci</div></div>
                                    </div>
                                    <div class="rounded-xl px-3 py-2 flex items-center gap-2 border border-dashed border-white/15">
                                        <svg class="w-3.5 h-3.5 text-white/25" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                        <span class="text-white/25 text-[10px]">Yeni öğrenci ekle...</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ── Panel 1: Ders Ata ── -->
                        <div id="dpanel-1" class="demo-panel absolute inset-0 p-6 md:p-10 flex flex-col gap-5" style="opacity:0;transition:opacity 0.5s,transform 0.5s;transform:translateX(60px);pointer-events:none;">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-xl bg-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-900/60">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                                </div>
                                <div>
                                    <h3 class="text-white font-extrabold text-base leading-tight">Ders & Konu Ataması</h3>
                                    <p class="text-emerald-300/70 text-[11px] font-mono">koç › Ali Yılmaz › dersler</p>
                                </div>
                                <span class="ml-auto hidden sm:flex items-center gap-1.5 text-emerald-300 text-[10px] font-bold bg-emerald-500/15 border border-emerald-500/30 px-2.5 py-1 rounded-full">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>Ali Yılmaz
                                </span>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 flex-1">
                                <div class="rounded-2xl p-4 border border-emerald-500/30" style="background:rgba(16,185,129,0.1);">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-emerald-400 text-[10px] font-black uppercase tracking-widest">TYT</span>
                                        <span class="text-emerald-400 text-[10px] bg-emerald-400/20 px-2 py-0.5 rounded-full font-bold">4/5</span>
                                    </div>
                                    <div class="space-y-2">
                                        <div class="flex items-center gap-2"><div class="w-4 h-4 rounded-md bg-emerald-500 flex items-center justify-center flex-shrink-0"><svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div><span class="text-white text-[11px]">Matematik</span></div>
                                        <div class="flex items-center gap-2"><div class="w-4 h-4 rounded-md bg-emerald-500 flex items-center justify-center flex-shrink-0"><svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div><span class="text-white text-[11px]">Türkçe</span></div>
                                        <div class="flex items-center gap-2"><div class="w-4 h-4 rounded-md bg-emerald-500 flex items-center justify-center flex-shrink-0"><svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div><span class="text-white text-[11px]">Fizik</span></div>
                                        <div class="flex items-center gap-2"><div class="w-4 h-4 rounded-md border border-white/20 flex-shrink-0"></div><span class="text-white/35 text-[11px]">Kimya</span></div>
                                    </div>
                                </div>
                                <div class="rounded-2xl p-4 border border-indigo-500/30" style="background:rgba(99,102,241,0.1);">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="text-indigo-400 text-[10px] font-black uppercase tracking-widest">AYT</span>
                                        <span class="text-indigo-400 text-[10px] bg-indigo-400/20 px-2 py-0.5 rounded-full font-bold">3/6</span>
                                    </div>
                                    <div class="space-y-2">
                                        <div class="flex items-center gap-2"><div class="w-4 h-4 rounded-md bg-indigo-500 flex items-center justify-center flex-shrink-0"><svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div><span class="text-white text-[11px]">Mat (AYT)</span></div>
                                        <div class="flex items-center gap-2"><div class="w-4 h-4 rounded-md bg-indigo-500 flex items-center justify-center flex-shrink-0"><svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg></div><span class="text-white text-[11px]">Fizik (AYT)</span></div>
                                        <div class="flex items-center gap-2"><div class="w-4 h-4 rounded-md border border-white/20 animate-pulse flex-shrink-0"></div><span class="text-white/50 text-[11px]">Kimya...</span></div>
                                        <div class="flex items-center gap-2"><div class="w-4 h-4 rounded-md border border-white/15 flex-shrink-0"></div><span class="text-white/25 text-[11px]">Biyoloji</span></div>
                                    </div>
                                </div>
                                <div class="rounded-2xl p-4 border border-white/10" style="background:rgba(255,255,255,0.04);">
                                    <div class="text-white/40 text-[10px] uppercase font-bold tracking-widest mb-3">Atama Günlüğü</div>
                                    <div class="space-y-3">
                                        <div class="flex items-start gap-2"><div class="w-1.5 h-1.5 rounded-full bg-emerald-400 mt-1 flex-shrink-0"></div><div><div class="text-white text-[11px] font-semibold">Matematik - Limit</div><div class="text-white/30 text-[9px]">az önce</div></div></div>
                                        <div class="flex items-start gap-2"><div class="w-1.5 h-1.5 rounded-full bg-emerald-400 mt-1 flex-shrink-0"></div><div><div class="text-white text-[11px] font-semibold">Türkçe - Paragraf</div><div class="text-white/30 text-[9px]">2 dk önce</div></div></div>
                                        <div class="flex items-start gap-2"><div class="w-1.5 h-1.5 rounded-full bg-yellow-400 mt-1 flex-shrink-0 animate-pulse"></div><div><div class="text-white/60 text-[11px] font-semibold">Fizik - Kuvvet...</div><div class="text-yellow-400/60 text-[9px]">atanıyor...</div></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- ── Panel 2: Program Kur ── -->
                        <div id="dpanel-2" class="demo-panel absolute inset-0 p-6 md:p-10 flex flex-col gap-5" style="opacity:0;transition:opacity 0.5s,transform 0.5s;transform:translateX(60px);pointer-events:none;">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-xl bg-purple-600 flex items-center justify-center shadow-lg shadow-purple-900/60">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <h3 class="text-white font-extrabold text-base leading-tight">Haftalık Çalışma Programı</h3>
                                    <p class="text-purple-300/70 text-[11px] font-mono">koç › ali-yilmaz › program</p>
                                </div>
                                <span class="ml-auto hidden sm:flex items-center gap-1.5 text-purple-300 text-[10px] font-bold bg-purple-500/15 border border-purple-500/30 px-2.5 py-1 rounded-full">
                                    <span class="w-1.5 h-1.5 rounded-full bg-purple-400 animate-pulse"></span>Ali Yılmaz için
                                </span>
                            </div>
                            <div class="flex-1 overflow-x-auto rounded-2xl border border-white/10" style="background:rgba(255,255,255,0.04);">
                                <table class="w-full text-[11px] text-white border-collapse min-w-[380px]">
                                    <thead><tr>
                                        <th class="py-3 px-3 text-white/30 font-semibold text-left w-14 border-b border-r border-white/8">Saat</th>
                                        <th class="py-3 px-2 text-white/50 font-bold text-center border-b border-r border-white/8">Pzt</th>
                                        <th class="py-3 px-2 text-white/50 font-bold text-center border-b border-r border-white/8">Sal</th>
                                        <th class="py-3 px-2 text-white/50 font-bold text-center border-b border-r border-white/8">Çar</th>
                                        <th class="py-3 px-2 text-white/50 font-bold text-center border-b border-r border-white/8">Per</th>
                                        <th class="py-3 px-2 text-white/50 font-bold text-center border-b border-white/8">Cum</th>
                                    </tr></thead>
                                    <tbody>
                                        <tr>
                                            <td class="py-2 px-3 border-r border-b border-white/8 text-white/25 font-mono text-[10px]">09:00</td>
                                            <td class="py-1.5 px-1.5 border-r border-b border-white/8"><div class="bg-indigo-600/60 rounded-lg px-2 py-1.5 text-center font-semibold text-[10px]">Matematik</div></td>
                                            <td class="py-1.5 px-1.5 border-r border-b border-white/8"><div class="bg-emerald-600/60 rounded-lg px-2 py-1.5 text-center font-semibold text-[10px]">Türkçe</div></td>
                                            <td class="py-1.5 px-1.5 border-r border-b border-white/8"></td>
                                            <td class="py-1.5 px-1.5 border-r border-b border-white/8"><div class="bg-purple-600/60 rounded-lg px-2 py-1.5 text-center font-semibold text-[10px]">Kimya</div></td>
                                            <td class="py-1.5 px-1.5 border-b border-white/8"><div class="bg-indigo-600/60 rounded-lg px-2 py-1.5 text-center font-semibold text-[10px]">Matematik</div></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-3 border-r border-b border-white/8 text-white/25 font-mono text-[10px]">11:00</td>
                                            <td class="py-1.5 px-1.5 border-r border-b border-white/8"><div class="bg-yellow-600/60 rounded-lg px-2 py-1.5 text-center font-semibold text-[10px]">Fizik</div></td>
                                            <td class="py-1.5 px-1.5 border-r border-b border-white/8"></td>
                                            <td class="py-1.5 px-1.5 border-r border-b border-white/8"><div class="bg-emerald-600/60 rounded-lg px-2 py-1.5 text-center font-semibold text-[10px]">Türkçe</div></td>
                                            <td class="py-1.5 px-1.5 border-r border-b border-white/8"><div class="bg-indigo-600/60 rounded-lg px-2 py-1.5 text-center font-semibold text-[10px]">Matematik</div></td>
                                            <td class="py-1.5 px-1.5 border-b border-white/8"></td>
                                        </tr>
                                        <tr>
                                            <td class="py-2 px-3 border-r border-white/8 text-white/25 font-mono text-[10px]">14:00</td>
                                            <td class="py-1.5 px-1.5 border-r border-white/8"></td>
                                            <td class="py-1.5 px-1.5 border-r border-white/8"><div class="bg-purple-600/60 rounded-lg px-2 py-1.5 text-center font-semibold text-[10px]">Kimya</div></td>
                                            <td class="py-1.5 px-1.5 border-r border-white/8"><div class="bg-yellow-600/60 rounded-lg px-2 py-1.5 text-center font-semibold text-[10px]">Fizik</div></td>
                                            <td class="py-1.5 px-1.5 border-r border-white/8"></td>
                                            <td class="py-1.5 px-1.5"><div class="bg-gradient-to-r from-emerald-600 to-emerald-500 rounded-lg px-2 py-1.5 text-center font-bold text-[10px] animate-pulse">Türkçe ✏️</div></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="text-white/30 text-[10px] flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-purple-400"></span>15 görev • 5 gün</div>
                                <button class="h-8 rounded-lg flex items-center px-3 text-white text-[11px] font-bold gap-1.5 shadow-lg shadow-purple-900/40 transition-transform hover:scale-105" style="background:linear-gradient(135deg,#7c3aed,#9333ea);">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                    Öğrenciye Gönder
                                </button>
                            </div>
                        </div>

                        <!-- ── Panel 3: Gelişimi İzle ── -->
                        <div id="dpanel-3" class="demo-panel absolute inset-0 p-6 md:p-10 flex flex-col gap-5" style="opacity:0;transition:opacity 0.5s,transform 0.5s;transform:translateX(60px);pointer-events:none;">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-xl bg-rose-600 flex items-center justify-center shadow-lg shadow-rose-900/60">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                </div>
                                <div>
                                    <h3 class="text-white font-extrabold text-base leading-tight">Gelişim Takip Paneli</h3>
                                    <p class="text-rose-300/70 text-[11px] font-mono">ali-yilmaz • Bu Hafta</p>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                <div class="rounded-2xl p-4 border border-indigo-500/30" style="background:rgba(99,102,241,0.15);">
                                    <div class="text-indigo-300 text-[10px] uppercase font-black tracking-widest">TYT Net Ort.</div>
                                    <div class="text-4xl font-black text-white mt-2">74.5</div>
                                    <div class="flex items-center gap-1 mt-1">
                                        <svg class="w-3 h-3 text-emerald-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"/></svg>
                                        <span class="text-emerald-400 text-[10px] font-semibold">+3.2 bu hafta</span>
                                    </div>
                                    <div class="flex items-end gap-0.5 h-10 mt-4">
                                        <div class="flex-1 bg-indigo-500/30 rounded-sm" style="height:35%"></div>
                                        <div class="flex-1 bg-indigo-500/45 rounded-sm" style="height:50%"></div>
                                        <div class="flex-1 bg-indigo-500/55 rounded-sm" style="height:45%"></div>
                                        <div class="flex-1 bg-indigo-500/70 rounded-sm" style="height:62%"></div>
                                        <div class="flex-1 bg-indigo-500/85 rounded-sm" style="height:72%"></div>
                                        <div class="flex-1 bg-indigo-400 rounded-sm animate-pulse" style="height:92%"></div>
                                    </div>
                                </div>
                                <div class="rounded-2xl p-4 border border-yellow-500/30" style="background:rgba(234,179,8,0.1);">
                                    <div class="text-yellow-300 text-[10px] uppercase font-black tracking-widest">Görev Tamamlama</div>
                                    <div class="text-4xl font-black text-white mt-2">18<span class="text-lg text-white/30">/24</span></div>
                                    <div class="text-yellow-400 text-[10px] font-semibold mt-1">%75 Tamamlandı</div>
                                    <div class="w-full h-2.5 bg-white/10 rounded-full mt-4 overflow-hidden">
                                        <div class="h-full rounded-full" style="width:75%;background:linear-gradient(90deg,#eab308,#facc15);"></div>
                                    </div>
                                </div>
                                <div class="rounded-2xl p-4 border border-white/10 space-y-3" style="background:rgba(255,255,255,0.04);">
                                    <div class="text-white/40 text-[10px] uppercase font-black tracking-widest">Son Aktiviteler</div>
                                    <div class="flex items-center gap-2"><div class="w-1.5 h-1.5 rounded-full bg-emerald-400 flex-shrink-0"></div><span class="text-white text-[11px]">Limit konusu ✓</span></div>
                                    <div class="flex items-center gap-2"><div class="w-1.5 h-1.5 rounded-full bg-emerald-400 flex-shrink-0"></div><span class="text-white text-[11px]">35 soru çözüldü</span></div>
                                    <div class="flex items-center gap-2"><div class="w-1.5 h-1.5 rounded-full bg-yellow-400 flex-shrink-0 animate-pulse"></div><span class="text-white/70 text-[11px]">Deneme girildi</span></div>
                                </div>
                            </div>
                            <div class="grid grid-cols-4 gap-2">
                                <div class="rounded-xl p-3 text-center border border-white/10" style="background:rgba(255,255,255,0.04);"><div class="text-white font-black text-lg">12</div><div class="text-white/30 text-[9px] mt-0.5 uppercase tracking-wider">Konu</div></div>
                                <div class="rounded-xl p-3 text-center border border-white/10" style="background:rgba(255,255,255,0.04);"><div class="text-white font-black text-lg">340</div><div class="text-white/30 text-[9px] mt-0.5 uppercase tracking-wider">Soru</div></div>
                                <div class="rounded-xl p-3 text-center border border-white/10" style="background:rgba(255,255,255,0.04);"><div class="text-white font-black text-lg">5</div><div class="text-white/30 text-[9px] mt-0.5 uppercase tracking-wider">Deneme</div></div>
                                <div class="rounded-xl p-3 text-center border border-emerald-500/30" style="background:rgba(16,185,129,0.12);"><div class="text-emerald-400 font-black text-lg">↑</div><div class="text-white/30 text-[9px] mt-0.5 uppercase tracking-wider">Trend</div></div>
                            </div>
                        </div>

                    </div><!-- /panels -->

                    <!-- Bottom bar with controls -->
                    <div class="flex items-center justify-between px-6 py-3 border-t border-white/10" style="background:rgba(255,255,255,0.03);">
                        <!-- Dot indicators -->
                        <div class="flex items-center gap-1.5">
                            <div id="dd0" class="h-1 rounded-full transition-all duration-400" style="width:24px;background:#818cf8;"></div>
                            <div id="dd1" class="h-1 rounded-full bg-white/20 transition-all duration-400" style="width:8px;"></div>
                            <div id="dd2" class="h-1 rounded-full bg-white/20 transition-all duration-400" style="width:8px;"></div>
                            <div id="dd3" class="h-1 rounded-full bg-white/20 transition-all duration-400" style="width:8px;"></div>
                        </div>
                        <!-- Controls -->
                        <div class="flex items-center gap-2">
                            <button type="button" onclick="demoGoTo((window._demoState.current - 1 + 4) % 4)" class="w-7 h-7 rounded-lg flex items-center justify-center text-white/40 hover:text-white/80 hover:bg-white/10 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                            </button>
                            <button type="button" id="demo-play-btn" onclick="demoTogglePlay()" class="flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-[11px] font-bold transition-all" style="background:rgba(99,102,241,0.3);color:#a5b4fc;border:1px solid rgba(99,102,241,0.4);">
                                <svg id="demo-pi" class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                                <svg id="demo-pai" class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24" style="display:none;"><path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/></svg>
                                <span id="demo-play-lbl">Otomatik Oynat</span>
                            </button>
                            <button type="button" onclick="demoGoTo((window._demoState.current + 1) % 4)" class="w-7 h-7 rounded-lg flex items-center justify-center text-white/40 hover:text-white/80 hover:bg-white/10 transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </div>
                    </div>

                </div><!-- /demo window -->

                <!-- Bottom CTA strip -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-3 mt-10 text-sm text-slate-500">
                    <span>Daha fazlasını görmek ister misiniz?</span>
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full font-bold text-white shadow-lg shadow-indigo-200 transition-all hover:shadow-indigo-300 hover:scale-105 text-sm" style="background:linear-gradient(135deg,#4f46e5,#7c3aed);">
                        Ücretsiz Deneyin
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>

            </div>
        </section>

        {{-- Subscription Packages (Geçici olarak kaldırıldı) --}}
    </main>

    <!-- Footer Section -->
    <footer class="w-full border-t border-slate-200 bg-white py-12 mt-16 text-xs text-slate-500">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8 justify-between">
            <div class="space-y-3">
                <span class="text-lg font-black tracking-tight text-slate-900">
                    rehber<span class="text-indigo-600">koçum</span>
                </span>
                <p class="text-slate-500 max-w-xs leading-relaxed">
                    Eğitim koçluğu sürecini akıllı yazılım çözümleriyle kolaylaştırıp öğrencilerinizi başarıya taşıyoruz.
                </p>
            </div>
            
            <div class="space-y-3">
                <h4 class="text-slate-800 font-bold uppercase tracking-wider text-[10px]">Hızlı Bağlantılar</h4>
                <ul class="space-y-2 text-slate-500">
                    <li><a href="#nedir" class="hover:text-indigo-600 transition">Nedir?</a></li>
                    <li><a href="#neden-var" class="hover:text-indigo-600 transition">Neden RehberKoçum?</a></li>
                    <li><a href="#ozellikler" class="hover:text-indigo-600 transition">Özellikler</a></li>
                    <li><a href="#nasil-calisir" class="hover:text-indigo-600 transition">Nasıl Çalışır?</a></li>
                </ul>
            </div>

            <div class="space-y-3">
                <p>&copy; 2026 rehberkoçum. Tüm hakları saklıdır.</p>
                <p>Bulut tabanlı öğrenci takip platformu. Özel kullanım lisansı.</p>
            </div>
        </div>
    </footer>

<script>
(function() {
    var TOTAL = 4;
    var DURATION = 5000;
    var current = 0;
    var playing = false;
    var rafId = null;
    var startTime = null;

    // Expose state for prev/next buttons
    window._demoState = { current: 0 };

    var urls = [
        'rehberkoçum.com/koc/ogrenciler/yeni',
        'rehberkoçum.com/koc/ali-yilmaz/dersler',
        'rehberkoçum.com/koc/ali-yilmaz/program',
        'rehberkoçum.com/koc/ali-yilmaz/gelisim'
    ];

    var pillActiveClasses = [
        ['bg-indigo-600', 'text-white', 'shadow-indigo-200'],
        ['bg-emerald-600', 'text-white', 'shadow-emerald-200'],
        ['bg-purple-600',  'text-white', 'shadow-purple-200'],
        ['bg-rose-600',    'text-white', 'shadow-rose-200']
    ];

    var dotColors = ['#818cf8','#34d399','#c084fc','#fb7185'];

    function showPanel(idx) {
        for (var i = 0; i < TOTAL; i++) {
            var p = document.getElementById('dpanel-' + i);
            if (!p) continue;
            if (i === idx) {
                p.style.opacity = '1';
                p.style.transform = 'translateX(0)';
                p.style.pointerEvents = 'auto';
            } else {
                p.style.opacity = '0';
                p.style.transform = i < idx ? 'translateX(-40px)' : 'translateX(40px)';
                p.style.pointerEvents = 'none';
            }

            // Pills
            var pill = document.getElementById('pill-' + i);
            if (!pill) continue;
            if (i === idx) {
                pill.className = 'demo-pill flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold transition-all duration-300 shadow-lg ' + pillActiveClasses[i].join(' ');
                var numSpan = pill.querySelector('span');
                if (numSpan) numSpan.className = 'w-5 h-5 rounded-full bg-white/25 flex items-center justify-center text-xs font-black';
            } else {
                pill.className = 'demo-pill flex items-center gap-2 px-4 py-2 rounded-full text-sm font-bold transition-all duration-300 bg-white text-slate-500 border border-slate-200 hover:border-indigo-200';
                var numSpan2 = pill.querySelector('span');
                if (numSpan2) numSpan2.className = 'w-5 h-5 rounded-full bg-slate-100 flex items-center justify-center text-xs font-black';
            }
        }

        // URL bar
        var urlEl = document.getElementById('demo-url');
        if (urlEl) urlEl.textContent = urls[idx];

        // Dots
        for (var d = 0; d < TOTAL; d++) {
            var dot = document.getElementById('dd' + d);
            if (!dot) continue;
            if (d === idx) {
                dot.style.width = '24px';
                dot.style.background = dotColors[idx];
                dot.style.opacity = '1';
            } else {
                dot.style.width = '8px';
                dot.style.background = 'rgba(255,255,255,0.2)';
                dot.style.opacity = '1';
            }
        }

        current = idx;
        window._demoState.current = idx;
        resetProgress();
    }

    function resetProgress() {
        var bar = document.getElementById('demo-prog');
        if (!bar) return;
        bar.style.transition = 'none';
        bar.style.width = '0%';
    }

    function tick(ts) {
        if (!playing) return;
        if (!startTime) startTime = ts;
        var elapsed = ts - startTime;
        var pct = Math.min((elapsed / DURATION) * 100, 100);
        var bar = document.getElementById('demo-prog');
        if (bar) {
            bar.style.transition = 'none';
            bar.style.width = pct + '%';
        }
        if (pct >= 100) {
            showPanel((current + 1) % TOTAL);
            startTime = null;
        }
        rafId = requestAnimationFrame(tick);
    }

    function startPlay() {
        playing = true;
        startTime = null;
        rafId = requestAnimationFrame(tick);
        var pi  = document.getElementById('demo-pi');
        var pai = document.getElementById('demo-pai');
        var lbl = document.getElementById('demo-play-lbl');
        if (pi)  pi.style.display  = 'none';
        if (pai) pai.style.display = '';
        if (lbl) lbl.textContent   = 'Duraklat';
        var btn = document.getElementById('demo-play-btn');
        if (btn) btn.style.background = 'rgba(99,102,241,0.5)';
    }

    function stopPlay() {
        playing = false;
        if (rafId) cancelAnimationFrame(rafId);
        rafId = null;
        startTime = null;
        resetProgress();
        var pi  = document.getElementById('demo-pi');
        var pai = document.getElementById('demo-pai');
        var lbl = document.getElementById('demo-play-lbl');
        if (pi)  pi.style.display  = '';
        if (pai) pai.style.display = 'none';
        if (lbl) lbl.textContent   = 'Otomatik Oynat';
        var btn = document.getElementById('demo-play-btn');
        if (btn) btn.style.background = 'rgba(99,102,241,0.3)';
    }

    window.demoGoTo = function(idx) {
        stopPlay();
        showPanel(idx);
    };

    window.demoTogglePlay = function() {
        if (playing) { stopPlay(); } else { startPlay(); }
    };

    // Init
    showPanel(0);
})();
</script>

</body>
</html>