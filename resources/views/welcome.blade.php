<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Desa Pintar') }} - Pelayanan Desa Digital</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-display antialiased" :class="darkMode ? 'bg-background-dark text-white' : 'bg-background-light text-dark-grey'">
    
    <!-- Navbar -->
    <nav class="fixed w-full z-50 transition-colors duration-200" :class="darkMode ? 'bg-surface-dark/90 border-border-dark' : 'bg-white/90 border-border-light'" style="backdrop-filter: blur(12px); border-bottom-width: 1px;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-2">
                    <div class="size-8 text-primary">
                        <svg fill="none" viewBox="0 0 48 48" src="public/images/logo.png">
                            <path d="M4 4H17.3334V17.3334H30.6666V30.6666H44V44H4V4Z" fill="currentColor"></path>
                        </svg>
                    </div>
                    <span class="font-black text-xl" :class="darkMode ? 'text-white' : 'text-dark-grey'">Desa Pintar</span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#beranda" class="font-medium transition-colors" :class="darkMode ? 'text-gray-300 hover:text-white' : 'text-earth hover:text-primary'">Beranda</a>
                    <a href="#layanan" class="font-medium transition-colors" :class="darkMode ? 'text-gray-300 hover:text-white' : 'text-earth hover:text-primary'">Layanan</a>
                    <a href="#tentang" class="font-medium transition-colors" :class="darkMode ? 'text-gray-300 hover:text-white' : 'text-earth hover:text-primary'">Tentang</a>
                    <a href="#kontak" class="font-medium transition-colors" :class="darkMode ? 'text-gray-300 hover:text-white' : 'text-earth hover:text-primary'">Kontak</a>
                </div>

                <!-- Auth & Dark Mode -->
                <div class="flex items-center gap-3">
                    <!-- Dark Mode Toggle -->
                    <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)" 
                            class="p-2 rounded-lg transition-colors"
                            :class="darkMode ? 'text-yellow-400 hover:bg-white/10' : 'text-text-secondary hover:bg-gray-100'">
                        <span class="material-symbols-outlined text-[24px]" x-text="darkMode ? 'light_mode' : 'dark_mode'"></span>
                    </button>

                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 text-sm font-bold text-white bg-primary rounded-full hover:bg-primary-hover transition-colors shadow-lg shadow-primary/20">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2.5 text-sm font-bold text-primary bg-primary/10 rounded-full hover:bg-primary/20 transition-colors">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="hidden sm:inline-flex px-5 py-2.5 text-sm font-bold text-white bg-primary rounded-full hover:bg-primary-hover transition-colors shadow-lg shadow-primary/20">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden" :class="darkMode ? 'bg-surface-dark' : 'bg-dark-grey'">
        <!-- Background Image & Gradient -->
        <div class="absolute inset-0 bg-cover bg-center z-0 scale-105" style="background-image: url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=2832&auto=format&fit=crop');"></div>
        <div class="absolute inset-0 bg-gradient-to-tr from-dark-grey via-primary/80 to-sky-blue/40 z-10 mix-blend-multiply"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-dark-grey via-transparent to-transparent z-10 opacity-80"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-20">
            <span class="inline-block py-1 px-3 rounded-full bg-white/10 backdrop-blur-md text-white text-sm font-bold mb-6 border border-white/20">
                🚀 Sistem Informasi Desa Digital Terpadu
            </span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white leading-tight mb-6 tracking-tight drop-shadow-lg">
                Inovasi Desa, <br class="hidden md:block">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-300 to-sky-200">Masa Depan Warga.</span>
            </h1>
            <p class="text-lg md:text-xl text-gray-200 mb-10 max-w-2xl mx-auto leading-relaxed font-medium drop-shadow-md">
                Portal layanan digital terpadu yang menghubungkan kearifan lokal dengan teknologi masa depan untuk kemajuan bersama.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 text-base font-bold text-primary bg-white rounded-full hover:bg-gray-50 transition-all shadow-xl shadow-black/20 transform hover:-translate-y-1">
                    Mulai Sekarang
                </a>
                <a href="#layanan" class="w-full sm:w-auto px-8 py-4 text-base font-bold text-white bg-white/10 backdrop-blur-md border border-white/20 rounded-full hover:bg-white/20 transition-all">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="layanan" class="py-20 transition-colors duration-200" :class="darkMode ? 'bg-background-dark' : 'bg-white'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-black mb-4" :class="darkMode ? 'text-white' : 'text-dark-grey'">Layanan Unggulan</h2>
                <p class="text-text-secondary dark:text-text-secondary-dark max-w-2xl mx-auto">Kami menghadirkan berbagai fitur untuk memudahkan warga dalam berinteraksi dengan pemerintah desa.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="p-8 rounded-2xl shadow-sm hover:shadow-md transition-all border group" :class="darkMode ? 'bg-surface-dark border-border-dark' : 'bg-background-light border-border-light'">
                    <div class="w-14 h-14 bg-sky-blue/10 rounded-xl flex items-center justify-center text-sky-blue text-2xl mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined">description</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3" :class="darkMode ? 'text-white' : 'text-dark-grey'">Surat Online</h3>
                    <p class="text-text-secondary dark:text-text-secondary-dark leading-relaxed">
                        Ajukan surat keterangan usaha, domisili, kelahiran, dan lainnya langsung dari smartphone Anda tanpa antri.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="p-8 rounded-2xl shadow-sm hover:shadow-md transition-all border group" :class="darkMode ? 'bg-surface-dark border-border-dark' : 'bg-background-light border-border-light'">
                    <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center text-primary text-2xl mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined">groups</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3" :class="darkMode ? 'text-white' : 'text-dark-grey'">Data Kependudukan</h3>
                    <p class="text-text-secondary dark:text-text-secondary-dark leading-relaxed">
                        Pengelolaan data penduduk dan keluarga yang terintegrasi, aman, dan selalu terupdate secara real-time.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="p-8 rounded-2xl shadow-sm hover:shadow-md transition-all border group" :class="darkMode ? 'bg-surface-dark border-border-dark' : 'bg-background-light border-border-light'">
                    <div class="w-14 h-14 bg-earth/10 rounded-xl flex items-center justify-center text-earth text-2xl mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined">notifications</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3" :class="darkMode ? 'text-white' : 'text-dark-grey'">Pengumuman Desa</h3>
                    <p class="text-text-secondary dark:text-text-secondary-dark leading-relaxed">
                        Informasi terbaru dan pengumuman penting dari pemerintah desa langsung ke genggaman Anda.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="p-8 rounded-2xl shadow-sm hover:shadow-md transition-all border group" :class="darkMode ? 'bg-surface-dark border-border-dark' : 'bg-background-light border-border-light'">
                    <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center text-primary text-2xl mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined">home</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3" :class="darkMode ? 'text-white' : 'text-dark-grey'">Manajemen Desa</h3>
                    <p class="text-text-secondary dark:text-text-secondary-dark leading-relaxed">
                        Kelola data desa, RT/RW, dan wilayah administratif dengan sistem yang terorganisir dan mudah digunakan.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="p-8 rounded-2xl shadow-sm hover:shadow-md transition-all border group" :class="darkMode ? 'bg-surface-dark border-border-dark' : 'bg-background-light border-border-light'">
                    <div class="w-14 h-14 bg-sky-blue/10 rounded-xl flex items-center justify-center text-sky-blue text-2xl mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined">analytics</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3" :class="darkMode ? 'text-white' : 'text-dark-grey'">Laporan & Statistik</h3>
                    <p class="text-text-secondary dark:text-text-secondary-dark leading-relaxed">
                        Akses laporan statistik penduduk, demografi, dan visualisasi data untuk transparansi dan akuntabilitas.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="p-8 rounded-2xl shadow-sm hover:shadow-md transition-all border group" :class="darkMode ? 'bg-surface-dark border-border-dark' : 'bg-background-light border-border-light'">
                    <div class="w-14 h-14 bg-earth/10 rounded-xl flex items-center justify-center text-earth text-2xl mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined">backup</span>
                    </div>
                    <h3 class="text-xl font-bold mb-3" :class="darkMode ? 'text-white' : 'text-dark-grey'">Backup & Keamanan</h3>
                    <p class="text-text-secondary dark:text-text-secondary-dark leading-relaxed">
                        Sistem backup otomatis dan keamanan data berlapis untuk melindungi informasi penting desa Anda.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 text-white relative overflow-hidden" :class="darkMode ? 'bg-surface-dark' : 'bg-dark-grey'">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-5"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-primary/20 to-sky-blue/20 mix-blend-overlay"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl font-black mb-2 text-primary">1,200+</div>
                    <div class="text-gray-300 text-sm font-bold uppercase tracking-wider">Penduduk</div>
                </div>
                <div>
                    <div class="text-4xl font-black mb-2 text-sky-blue">350+</div>
                    <div class="text-gray-300 text-sm font-bold uppercase tracking-wider">Kepala Keluarga</div>
                </div>
                <div>
                    <div class="text-4xl font-black mb-2 text-primary">15+</div>
                    <div class="text-gray-300 text-sm font-bold uppercase tracking-wider">Jenis Surat</div>
                </div>
                <div>
                    <div class="text-4xl font-black mb-2 text-sky-blue">24/7</div>
                    <div class="text-gray-300 text-sm font-bold uppercase tracking-wider">Akses Sistem</div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="py-20 transition-colors duration-200" :class="darkMode ? 'bg-background-dark' : 'bg-white'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-black mb-6" :class="darkMode ? 'text-white' : 'text-dark-grey'">Tentang Desa Pintar</h2>
                    <p class="text-text-secondary dark:text-text-secondary-dark leading-relaxed mb-6">
                        <strong class="text-primary">Desa Pintar</strong> adalah platform digital yang dirancang khusus untuk memodernisasi sistem administrasi dan pelayanan desa di Indonesia. Kami percaya bahwa teknologi dapat menjembatani kesenjangan antara pemerintah desa dan warga, menciptakan ekosistem yang lebih efisien, transparan, dan responsif.
                    </p>
                    <p class="text-text-secondary dark:text-text-secondary-dark leading-relaxed mb-6">
                        Dengan fitur-fitur seperti pengajuan surat online, manajemen data kependudukan, dan sistem pengumuman terintegrasi, kami membantu desa-desa di seluruh Indonesia untuk melangkah menuju era digital dengan percaya diri.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <span class="inline-flex items-center gap-2 px-4 py-2 bg-primary/10 text-primary rounded-full text-sm font-bold">
                            <span class="material-symbols-outlined text-[18px]">check_circle</span>
                            Mudah Digunakan
                        </span>
                        <span class="inline-flex items-center gap-2 px-4 py-2 bg-sky-blue/10 text-sky-blue rounded-full text-sm font-bold">
                            <span class="material-symbols-outlined text-[18px]">security</span>
                            Aman & Terenkripsi
                        </span>
                        <span class="inline-flex items-center gap-2 px-4 py-2 bg-earth/10 text-earth rounded-full text-sm font-bold">
                            <span class="material-symbols-outlined text-[18px]">support_agent</span>
                            Dukungan 24/7
                        </span>
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-tr from-primary to-sky-blue rounded-2xl transform rotate-3"></div>
                    <img src="https://images.unsplash.com/photo-1573164713714-d95e436ab8d6?q=80&w=2069&auto=format&fit=crop" 
                         alt="Team collaboration" 
                         class="relative rounded-2xl shadow-2xl">
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="kontak" class="py-20 transition-colors duration-200" :class="darkMode ? 'bg-surface-dark' : 'bg-background-light'">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-black mb-4" :class="darkMode ? 'text-white' : 'text-dark-grey'">Siap Memulai?</h2>
            <p class="text-text-secondary dark:text-text-secondary-dark mb-8 max-w-2xl mx-auto">
                Bergabunglah dengan ratusan desa lainnya yang telah menggunakan Desa Pintar untuk meningkatkan pelayanan kepada warganya.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 text-base font-bold text-white bg-primary rounded-full hover:bg-primary-hover transition-all shadow-lg shadow-primary/20">
                    Daftar Sekarang
                </a>
                <a href="mailto:admin@desapintar.id" class="w-full sm:w-auto px-8 py-4 text-base font-bold transition-all rounded-full border" 
                   :class="darkMode ? 'text-white bg-white/10 border-border-dark hover:bg-white/20' : 'text-dark-grey bg-gray-100 border-border-light hover:bg-gray-200'">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t transition-colors duration-200 pt-16 pb-8" :class="darkMode ? 'bg-background-dark border-border-dark' : 'bg-white border-border-light'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="size-8 text-primary">
                            <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 4H17.3334V17.3334H30.6666V30.6666H44V44H4V4Z" fill="currentColor"></path>
                            </svg>
                        </div>
                        <span class="font-black text-xl" :class="darkMode ? 'text-white' : 'text-dark-grey'">Desa Pintar</span>
                    </div>
                    <p class="text-text-secondary dark:text-text-secondary-dark leading-relaxed max-w-md">
                        Platform digital untuk memodernisasi pelayanan administrasi desa di Indonesia. Mewujudkan desa yang maju, mandiri, dan sejahtera.
                    </p>
                </div>
                
                <div>
                    <h4 class="font-bold mb-4" :class="darkMode ? 'text-white' : 'text-dark-grey'">Tautan</h4>
                    <ul class="space-y-2">
                        <li><a href="#beranda" class="text-text-secondary hover:text-primary dark:text-text-secondary-dark dark:hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="#layanan" class="text-text-secondary hover:text-primary dark:text-text-secondary-dark dark:hover:text-white transition-colors">Layanan</a></li>
                        <li><a href="#tentang" class="text-text-secondary hover:text-primary dark:text-text-secondary-dark dark:hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="#kontak" class="text-text-secondary hover:text-primary dark:text-text-secondary-dark dark:hover:text-white transition-colors">Kontak</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-4" :class="darkMode ? 'text-white' : 'text-dark-grey'">Kontak</h4>
                    <ul class="space-y-2 text-text-secondary dark:text-text-secondary-dark">
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-[18px]">location_on</span> Kantor Kepala Desa</li>
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-[18px]">mail</span> admin@desapintar.id</li>
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-[18px]">call</span> (021) 1234-5678</li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t pt-8 text-center transition-colors duration-200" :class="darkMode ? 'border-border-dark' : 'border-border-light'">
                <p class="text-text-secondary dark:text-gray-500 text-sm">
                    &copy; {{ date('Y') }} Desa Pintar. Hak Cipta Dilindungi Undang-Undang.
                </p>
            </div>
        </div>
    </footer>

    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
