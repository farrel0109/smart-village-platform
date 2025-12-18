<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Desa Pintar - Platform Digital untuk Modernisasi Pelayanan Administrasi Desa di Indonesia">
    <title>{{ config('app.name', 'Desa Pintar') }} - Sistem Administrasi Desa Digital</title>
    
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
    <nav class="fixed w-full z-50 transition-colors duration-200" :class="darkMode ? 'bg-surface-dark/95 border-border-dark' : 'bg-white/95 border-border-light'" style="backdrop-filter: blur(12px); border-bottom-width: 1px;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo & Brand -->
                <div class="flex items-center gap-3">
                    <img src="{{ asset('img/logo-desa.png') }}" alt="Logo Desa Pintar" class="h-12 w-auto">
                    <div class="hidden sm:block">
                        <div class="font-black text-xl" :class="darkMode ? 'text-white' : 'text-dark-grey'">Desa Pintar</div>
                        <div class="text-xs text-primary font-bold">Sistem Administrasi Digital</div>
                    </div>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#beranda" class="font-semibold transition-colors" :class="darkMode ? 'text-gray-300 hover:text-white' : 'text-earth hover:text-primary'">Beranda</a>
                    <a href="#layanan" class="font-semibold transition-colors" :class="darkMode ? 'text-gray-300 hover:text-white' : 'text-earth hover:text-primary'">Layanan</a>
                    <a href="#tentang" class="font-semibold transition-colors" :class="darkMode ? 'text-gray-300 hover:text-white' : 'text-earth hover:text-primary'">Tentang</a>
                    <a href="#kontak" class="font-semibold transition-colors" :class="darkMode ? 'text-gray-300 hover:text-white' : 'text-earth hover:text-primary'">Kontak</a>
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
                        <a href="{{ url('/dashboard') }}" class="px-5 py-2.5 text-sm font-bold text-white bg-primary rounded-lg hover:bg-primary-hover transition-colors shadow-lg shadow-primary/20">
                            <span class="material-symbols-outlined text-[18px] align-middle mr-1">dashboard</span>
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2.5 text-sm font-bold rounded-lg transition-colors" :class="darkMode ? 'text-white bg-white/10 hover:bg-white/20' : 'text-primary bg-primary/10 hover:bg-primary/20'">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="hidden sm:inline-flex px-5 py-2.5 text-sm font-bold text-white bg-primary rounded-lg hover:bg-primary-hover transition-colors shadow-lg shadow-primary/20">
                            Daftar Gratis
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section - Indonesian Village Theme -->
    <section id="beranda" class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden" :class="darkMode ? 'bg-gradient-to-br from-surface-dark via-dark-grey to-surface-dark' : 'bg-gradient-to-br from-primary/5 via-white to-sky-blue/5'">
        <!-- Decorative Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%232E7D32&quot; fill-opacity=&quot;0.4&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div>
                    <div class="inline-flex items-center gap-2 py-2 px-4 rounded-full bg-primary/10 border border-primary/20 text-primary mb-6">
                        <span class="material-symbols-outlined text-[20px]">verified</span>
                        <span class="text-sm font-bold">Terpercaya & Aman</span>
                    </div>
                    
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-black mb-6 leading-tight" :class="darkMode ? 'text-white' : 'text-dark-grey'">
                        Digitalisasi Desa,
                        <span class="text-primary">Pelayanan Lebih Mudah</span>
                    </h1>
                    
                    <p class="text-lg md:text-xl mb-8 leading-relaxed" :class="darkMode ? 'text-gray-300' : 'text-text-secondary'">
                        Platform administrasi desa digital yang memudahkan masyarakat dalam mengakses layanan surat-menyurat, informasi, dan data kependudukan <strong class="text-primary">tanpa harus ke kantor desa</strong>.
                    </p>

                    <!-- Trust Indicators -->
                    <div class="flex flex-wrap gap-4 mb-8">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">local_police</span>
                            <span class="text-sm font-semibold">Data Aman</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">speed</span>
                            <span class="text-sm font-semibold">Proses Cepat</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">support_agent</span>
                            <span class="text-sm font-semibold">Gratis 100%</span>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center gap-2 px-8 py-4 text-base font-bold text-white bg-primary rounded-lg hover:bg-primary-hover transition-all shadow-xl shadow-primary/30 transform hover:-translate-y-1">
                            <span class="material-symbols-outlined">arrow_forward</span>
                            Mulai Sekarang - Gratis
                        </a>
                        <a href="#layanan" class="inline-flex items-center justify-center gap-2 px-8 py-4 text-base font-bold rounded-lg border-2 transition-all" :class="darkMode ? 'text-white border-white hover:bg-white hover:text-dark-grey' : 'text-dark-grey border-dark-grey hover:bg-dark-grey hover:text-white'">
                            <span class="material-symbols-outlined">info</span>
                            Pelajari Lebih Lanjut
                        </a>
                    </div>
                </div>

                <!-- Right Image/Illustration -->
                <div class="relative hidden lg:block">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-tr from-primary to-sky-blue rounded-2xl transform rotate-3 opacity-10"></div>
                        <img src="https://images.unsplash.com/photo-1541746972996-4e0b0f43e9a0?q=80&w=2070&auto=format&fit=crop" 
                             alt="Desa Indonesia" 
                             class="relative rounded-2xl shadow-2xl"
                             loading="lazy">
                    </div>
                    
                    <!-- Floating Stats -->
                    <div class="absolute -bottom-6 -left-6 bg-white dark:bg-surface-dark p-6 rounded-xl shadow-xl border border-border-light dark:border-border-dark">
                        <div class="flex items-center gap-3">
                            <div class="size-12 bg-primary/10 rounded-lg flex items-center justify-center">
                                <span class="material-symbols-outlined text-primary text-2xl">people</span>
                            </div>
                            <div>
                                <div class="text-2xl font-black text-dark-grey dark:text-white">1,200+</div>
                                <div class="text-xs text-text-secondary">Warga Terlayani</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="layanan" class="py-20 transition-colors duration-200" :class="darkMode ? 'bg-background-dark' : 'bg-white'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="inline-block px-4 py-2 bg-primary/10 text-primary text-sm font-bold rounded-full mb-4">Layanan Unggulan</span>
                <h2 class="text-3xl md:text-4xl font-black mb-4" :class="darkMode ? 'text-white' : 'text-dark-grey'">Kemudahan untuk Warga Desa</h2>
                <p class="text-text-secondary dark:text-text-secondary-dark max-w-2xl mx-auto text-lg">
                    Semua layanan administrasi desa dalam satu platform digital yang mudah diakses
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Feature 1 -->
                <div class="p-6 rounded-xl shadow-sm hover:shadow-lg transition-all border group" :class="darkMode ? 'bg-surface-dark border-border-dark hover:border-primary' : 'bg-white border-border-light hover:border-primary'">
                    <div class="size-14 bg-sky-blue/10 rounded-xl flex items-center justify-center text-sky-blue mb-4 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-3xl">description</span>
                    </div>
                    <h3 class="text-lg font-bold mb-2" :class="darkMode ? 'text-white' : 'text-dark-grey'">Surat Online</h3>
                    <p class="text-text-secondary dark:text-text-secondary-dark text-sm leading-relaxed">
                        Ajukan surat keterangan <strong>tanpa ke kantor desa</strong>. Proses cepat dan bisa diakses 24/7.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="p-6 rounded-xl shadow-sm hover:shadow-lg transition-all border group" :class="darkMode ? 'bg-surface-dark border-border-dark hover:border-primary' : 'bg-white border-border-light hover:border-primary'">
                    <div class="size-14 bg-primary/10 rounded-xl flex items-center justify-center text-primary mb-4 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-3xl">groups</span>
                    </div>
                    <h3 class="text-lg font-bold mb-2" :class="darkMode ? 'text-white' : 'text-dark-grey'">Data Kependudukan</h3>
                    <p class="text-text-secondary dark:text-text-secondary-dark text-sm leading-relaxed">
                        Informasi data keluarga dan kependudukan <strong>selalu terupdate</strong> dan aman.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="p-6 rounded-xl shadow-sm hover:shadow-lg transition-all border group" :class="darkMode ? 'bg-surface-dark border-border-dark hover:border-primary' : 'bg-white border-border-light hover:border-primary'">
                    <div class="size-14 bg-earth/10 rounded-xl flex items-center justify-center text-earth mb-4 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-3xl">campaign</span>
                    </div>
                    <h3 class="text-lg font-bold mb-2" :class="darkMode ? 'text-white' : 'text-dark-grey'">Pengumuman Desa</h3>
                    <p class="text-text-secondary dark:text-text-secondary-dark text-sm leading-relaxed">
                        Informasi terbaru dari pemerintah desa <strong>langsung ke HP Anda</strong>.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="p-6 rounded-xl shadow-sm hover:shadow-lg transition-all border group" :class="darkMode ? 'bg-surface-dark border-border-dark hover:border-primary' : 'bg-white border-border-light hover:border-primary'">
                    <div class="size-14 bg-primary/10 rounded-xl flex items-center justify-center text-primary mb-4 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-3xl">home</span>
                    </div>
                    <h3 class="text-lg font-bold mb-2" :class="darkMode ? 'text-white' : 'text-dark-grey'">Manajemen Desa</h3>
                    <p class="text-text-secondary dark:text-text-secondary-dark text-sm leading-relaxed">
                        Kelola data RT/RW dan wilayah administratif <strong>lebih terorganisir</strong>.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="p-6 rounded-xl shadow-sm hover:shadow-lg transition-all border group" :class="darkMode ? 'bg-surface-dark border-border-dark hover:border-primary' : 'bg-white border-border-light hover:border-primary'">
                    <div class="size-14 bg-sky-blue/10 rounded-xl flex items-center justify-center text-sky-blue mb-4 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-3xl">analytics</span>
                    </div>
                    <h3 class="text-lg font-bold mb-2" :class="darkMode ? 'text-white' : 'text-dark-grey'">Laporan Transparan</h3>
                    <p class="text-text-secondary dark:text-text-secondary-dark text-sm leading-relaxed">
                        Akses statistik dan laporan desa untuk <strong>transparansi publik</strong>.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="p-6 rounded-xl shadow-sm hover:shadow-lg transition-all border group" :class="darkMode ? 'bg-surface-dark border-border-dark hover:border-primary' : 'bg-white border-border-light hover:border-primary'">
                    <div class="size-14 bg-earth/10 rounded-xl flex items-center justify-center text-earth mb-4 group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-3xl">lock</span>
                    </div>
                    <h3 class="text-lg font-bold mb-2" :class="darkMode ? 'text-white' : 'text-dark-grey'">Keamanan Terjamin</h3>
                    <p class="text-text-secondary dark:text-text-secondary-dark text-sm leading-relaxed">
                        Data pribadi <strong>terenkripsi</strong> dan backup otomatis setiap hari.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 relative overflow-hidden" :class="darkMode ? 'bg-gradient-to-r from-primary to-primary-hover' : 'bg-gradient-to-r from-primary to-sky-blue'">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=&quot;100&quot; height=&quot;100&quot; viewBox=&quot;0 0 100 100&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cpath d=&quot;M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3z&quot; fill=&quot;%23ffffff&quot; fill-opacity=&quot;0.2&quot; fill-rule=&quot;evenodd&quot;/%3E%3C/svg%3E');"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center text-white">
                <div>
                    <div class="text-4xl md:text-5xl font-black mb-2">1,200+</div>
                    <div class="text-sm md:text-base font-semibold opacity-90">Warga Terdaftar</div>
                </div>
                <div>
                    <div class="text-4xl md:text-5xl font-black mb-2">350+</div>
                    <div class="text-sm md:text-base font-semibold opacity-90">Kepala Keluarga</div>
                </div>
                <div>
                    <div class="text-4xl md:text-5xl font-black mb-2">15+</div>
                    <div class="text-sm md:text-base font-semibold opacity-90">Jenis Surat</div>
                </div>
                <div>
                    <div class="text-4xl md:text-5xl font-black mb-2">24/7</div>
                    <div class="text-sm md:text-base font-semibold opacity-90">Akses Online</div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="py-20 transition-colors duration-200" :class="darkMode ? 'bg-surface-dark' : 'bg-background-light'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1">
                    <span class="inline-block px-4 py-2 bg-primary/10 text-primary text-sm font-bold rounded-full mb-4">Tentang Kami</span>
                    <h2 class="text-3xl md:text-4xl font-black mb-6" :class="darkMode ? 'text-white' : 'text-dark-grey'">
                        Membangun Desa Digital Bersama
                    </h2>
                    <p class="text-lg leading-relaxed mb-6" :class="darkMode ? 'text-gray-300' : 'text-text-secondary'">
                        <strong class="text-primary">Desa Pintar</strong> hadir sebagai solusi digitalisasi administrasi desa yang dirancang khusus untuk kemudahan masyarakat Indonesia. Kami memahami bahwa tidak semua warga mudah mengakses kantor desa.
                    </p>
                    <p class="text-lg leading-relaxed mb-6" :class="darkMode ? 'text-gray-300' : 'text-text-secondary'">
                        Dengan platform ini, warga dapat mengurus surat-surat penting, melihat pengumuman desa, dan mengakses informasi kependudukan <strong class="text-primary">kapan saja dan dimana saja</strong> melalui HP atau komputer.
                    </p>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-2xl">check_circle</span>
                            <div>
                                <div class="font-bold mb-1">Mudah Digunakan</div>
                                <div class="text-sm text-text-secondary">Interface sederhana untuk semua kalangan</div>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-2xl">security</span>
                            <div>
                                <div class="font-bold mb-1">Data Aman</div>
                                <div class="text-sm text-text-secondary">Enkripsi tingkat tinggi</div>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-2xl">support_agent</span>
                            <div>
                                <div class="font-bold mb-1">Gratis 100%</div>
                                <div class="text-sm text-text-secondary">Tidak ada biaya tersembunyi</div>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary text-2xl">phone_android</span>
                            <div>
                                <div class="font-bold mb-1">Akses Mobile</div>
                                <div class="text-sm text-text-secondary">Bisa lewat HP apapun</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="order-1 lg:order-2">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-tr from-primary to-sky-blue rounded-2xl transform rotate-3 opacity-10"></div>
                        <img src="https://images.unsplash.com/photo-1551632811-561732d1e306?q=80&w=2070&auto=format&fit=crop" 
                             alt="Gotong Royong Desa" 
                             class="relative rounded-2xl shadow-xl"
                             loading="lazy">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact/CTA Section -->
    <section id="kontak" class="py-20 transition-colors duration-200" :class="darkMode ? 'bg-background-dark' : 'bg-white'">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block px-4 py-2 bg-primary/10 text-primary text-sm font-bold rounded-full mb-4">Hubungi Kami</span>
            <h2 class="text-3xl md:text-4xl font-black mb-4" :class="darkMode ? 'text-white' : 'text-dark-grey'">
                Siap Digitalisasi Desa Anda?
            </h2>
            <p class="text-lg mb-8 max-w-2xl mx-auto" :class="darkMode ? 'text-gray-300' : 'text-text-secondary'">
                Bergabunglah dengan ratusan desa lainnya yang telah menggunakan Desa Pintar untuk meningkatkan pelayanan kepada warga.
            </p>
            
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-12">
                <a href="{{ route('register') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 text-base font-bold text-white bg-primary rounded-lg hover:bg-primary-hover transition-all shadow-xl shadow-primary/30">
                    <span class="material-symbols-outlined">how_to_reg</span>
                    Daftar Sekarang - Gratis
                </a>
                <a href="mailto:admin@desapintar.id" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-4 text-base font-bold rounded-lg border-2 transition-all" 
                   :class="darkMode ? 'text-white border-white hover:bg-white hover:text-dark-grey' : 'text-dark-grey border-dark-grey hover:bg-dark-grey hover:text-white'">
                    <span class="material-symbols-outlined">mail</span>
                    Hubungi Kami
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left">
                <div class="flex items-start gap-3 p-4 rounded-lg" :class="darkMode ? 'bg-surface-dark' : 'bg-background-light'">
                    <span class="material-symbols-outlined text-primary text-2xl">location_on</span>
                    <div>
                        <div class="font-bold mb-1">Alamat</div>
                        <div class="text-sm text-text-secondary">Kantor Kepala Desa</div>
                    </div>
                </div>
                <div class="flex items-start gap-3 p-4 rounded-lg" :class="darkMode ? 'bg-surface-dark' : 'bg-background-light'">
                    <span class="material-symbols-outlined text-primary text-2xl">mail</span>
                    <div>
                        <div class="font-bold mb-1">Email</div>
                        <div class="text-sm text-text-secondary">admin@desapintar.id</div>
                    </div>
                </div>
                <div class="flex items-start gap-3 p-4 rounded-lg" :class="darkMode ? 'bg-surface-dark' : 'bg-background-light'">
                    <span class="material-symbols-outlined text-primary text-2xl">call</span>
                    <div>
                        <div class="font-bold mb-1">Telepon</div>
                        <div class="text-sm text-text-secondary">(021) 1234-5678</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t transition-colors duration-200 pt-12 pb-6" :class="darkMode ? 'bg-surface-dark border-border-dark' : 'bg-white border-border-light'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        <img src="{{ asset('img/logo-desa.png') }}" alt="Logo Desa Pintar" class="h-10 w-auto">
                        <div>
                            <div class="font-black text-lg" :class="darkMode ? 'text-white' : 'text-dark-grey'">Desa Pintar</div>
                            <div class="text-xs text-primary font-bold">Sistem Administrasi Digital</div>
                        </div>
                    </div>
                    <p class="text-text-secondary dark:text-text-secondary-dark leading-relaxed max-w-md text-sm">
                        Platform digital untuk memodernisasi pelayanan administrasi desa di Indonesia. Mewujudkan desa yang maju, mandiri, dan sejahtera melalui teknologi.
                    </p>
                </div>
                
                <div>
                    <h4 class="font-bold mb-3" :class="darkMode ? 'text-white' : 'text-dark-grey'">Navigasi</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#beranda" class="text-text-secondary hover:text-primary dark:text-text-secondary-dark dark:hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="#layanan" class="text-text-secondary hover:text-primary dark:text-text-secondary-dark dark:hover:text-white transition-colors">Layanan</a></li>
                        <li><a href="#tentang" class="text-text-secondary hover:text-primary dark:text-text-secondary-dark dark:hover:text-white transition-colors">Tentang Kami</a></li>
                        <li><a href="#kontak" class="text-text-secondary hover:text-primary dark:text-text-secondary-dark dark:hover:text-white transition-colors">Kontak</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold mb-3" :class="darkMode ? 'text-white' : 'text-dark-grey'">Kontak</h4>
                    <ul class="space-y-2 text-text-secondary dark:text-text-secondary-dark text-sm">
                        <li class="flex items-start gap-2">
                            <span class="material-symbols-outlined text-[18px]">location_on</span>
                            <span>Kantor Kepala Desa</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="material-symbols-outlined text-[18px]">mail</span>
                            <span>admin@desapintar.id</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="material-symbols-outlined text-[18px]">call</span>
                            <span>(021) 1234-5678</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t pt-6 text-center transition-colors duration-200" :class="darkMode ? 'border-border-dark' : 'border-border-light'">
                <p class="text-text-secondary dark:text-gray-500 text-sm">
                    &copy; {{ date('Y') }} Desa Pintar. Hak Cipta Dilindungi Undang-Undang. Dibuat dengan ❤️ untuk desa-desa Indonesia.
                </p>
            </div>
        </div>
    </footer>

    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
