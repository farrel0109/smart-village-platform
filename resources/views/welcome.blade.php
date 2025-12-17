<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Desa Pintar') }} - Pelayanan Desa Digital</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-display antialiased text-dark-grey bg-background-light dark:bg-background-dark dark:text-white">
    
    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-white/90 dark:bg-surface-dark/90 backdrop-blur-md border-b border-border-light dark:border-border-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-2">
                    <div class="size-8 text-primary">
                        <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 4H17.3334V17.3334H30.6666V30.6666H44V44H4V4Z" fill="currentColor"></path>
                        </svg>
                    </div>
                    <span class="font-bold text-xl text-dark-grey dark:text-white">Desa Pintar</span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#beranda" class="text-earth hover:text-primary dark:text-gray-300 dark:hover:text-white font-medium transition-colors">Beranda</a>
                    <a href="#layanan" class="text-earth hover:text-primary dark:text-gray-300 dark:hover:text-white font-medium transition-colors">Layanan</a>
                    <a href="#tentang" class="text-earth hover:text-primary dark:text-gray-300 dark:hover:text-white font-medium transition-colors">Tentang</a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center gap-3">
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
    <section id="beranda" class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden bg-dark-grey">
        <!-- Background Image & Gradient (Matches Login Page) -->
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
    <section id="layanan" class="py-20 bg-white dark:bg-surface-dark">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-dark-grey dark:text-white mb-4">Layanan Unggulan</h2>
                <p class="text-text-secondary dark:text-text-secondary-dark max-w-2xl mx-auto">Kami menghadirkan berbagai fitur untuk memudahkan warga dalam berinteraksi dengan pemerintah desa.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-background-light dark:bg-background-dark p-8 rounded-2xl shadow-sm hover:shadow-md transition-shadow border border-border-light dark:border-border-dark group">
                    <div class="w-14 h-14 bg-sky-blue/10 rounded-xl flex items-center justify-center text-sky-blue text-2xl mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined">description</span>
                    </div>
                    <h3 class="text-xl font-bold text-dark-grey dark:text-white mb-3">Surat Online</h3>
                    <p class="text-text-secondary dark:text-text-secondary-dark leading-relaxed">
                        Ajukan surat keterangan usaha, domisili, kelahiran, dan lainnya langsung dari smartphone Anda tanpa antri.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-background-light dark:bg-background-dark p-8 rounded-2xl shadow-sm hover:shadow-md transition-shadow border border-border-light dark:border-border-dark group">
                    <div class="w-14 h-14 bg-primary/10 rounded-xl flex items-center justify-center text-primary text-2xl mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined">groups</span>
                    </div>
                    <h3 class="text-xl font-bold text-dark-grey dark:text-white mb-3">Data Kependudukan</h3>
                    <p class="text-text-secondary dark:text-text-secondary-dark leading-relaxed">
                        Pengelolaan data penduduk dan keluarga yang terintegrasi, aman, dan selalu terupdate secara real-time.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-background-light dark:bg-background-dark p-8 rounded-2xl shadow-sm hover:shadow-md transition-shadow border border-border-light dark:border-border-dark group">
                    <div class="w-14 h-14 bg-earth/10 rounded-xl flex items-center justify-center text-earth text-2xl mb-6 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined">analytics</span>
                    </div>
                    <h3 class="text-xl font-bold text-dark-grey dark:text-white mb-3">Transparansi Data</h3>
                    <p class="text-text-secondary dark:text-text-secondary-dark leading-relaxed">
                        Akses informasi statistik desa, anggaran, dan laporan pembangunan sebagai wujud transparansi publik.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-20 bg-dark-grey text-white relative overflow-hidden">
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
                    <div class="text-4xl font-black mb-2 text-primary">50+</div>
                    <div class="text-gray-300 text-sm font-bold uppercase tracking-wider">Layanan Surat</div>
                </div>
                <div>
                    <div class="text-4xl font-black mb-2 text-sky-blue">24/7</div>
                    <div class="text-gray-300 text-sm font-bold uppercase tracking-wider">Akses Sistem</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-white dark:bg-surface-dark border-t border-border-light dark:border-border-dark pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="size-8 text-primary">
                            <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 4H17.3334V17.3334H30.6666V30.6666H44V44H4V4Z" fill="currentColor"></path>
                            </svg>
                        </div>
                        <span class="font-bold text-xl text-dark-grey dark:text-white">Desa Pintar</span>
                    </div>
                    <p class="text-text-secondary dark:text-text-secondary-dark leading-relaxed max-w-md">
                        Platform digital untuk memodernisasi pelayanan administrasi desa di Indonesia. Mewujudkan desa yang maju, mandiri, dan sejahtera.
                    </p>
                </div>
                
                <div>
                    <h4 class="font-bold text-dark-grey dark:text-white mb-4">Tautan</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-text-secondary hover:text-primary dark:text-text-secondary-dark dark:hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="#" class="text-text-secondary hover:text-primary dark:text-text-secondary-dark dark:hover:text-white transition-colors">Layanan</a></li>
                        <li><a href="#" class="text-text-secondary hover:text-primary dark:text-text-secondary-dark dark:hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="text-text-secondary hover:text-primary dark:text-text-secondary-dark dark:hover:text-white transition-colors">Kontak</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-dark-grey dark:text-white mb-4">Kontak</h4>
                    <ul class="space-y-2 text-text-secondary dark:text-text-secondary-dark">
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-[18px]">location_on</span> Kantor Kepala Desa</li>
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-[18px]">mail</span> admin@desapintar.id</li>
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-[18px]">call</span> (021) 1234-5678</li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-border-light dark:border-border-dark pt-8 text-center">
                <p class="text-text-secondary dark:text-gray-500 text-sm">
                    &copy; {{ date('Y') }} Desa Pintar. Hak Cipta Dilindungi Undang-Undang.
                </p>
            </div>
        </div>
    </footer>

</body>
</html>
