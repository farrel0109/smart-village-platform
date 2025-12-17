@extends('layouts.landing')

@section('title', 'Desa Pintar - Digitalisasi Administrasi Desa dalam Genggaman Anda')

@section('content')
    <!-- Hero Section -->
    <section class="hero-pattern min-h-screen flex items-center pt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Text Content -->
                <div class="text-white">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold leading-tight mb-6">
                        Digitalisasi Administrasi Desa dalam
                        <span class="text-yellow-300">Genggaman Anda</span>
                    </h1>
                    <p class="text-lg md:text-xl text-indigo-100 mb-8 leading-relaxed">
                        Desa Pintar membantu desa mengelola data penduduk, layanan administrasi, dan informasi desa secara digital, efisien, dan terintegrasi.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-indigo-600 rounded-xl font-bold hover:bg-gray-100 transition-colors shadow-lg text-center">
                            <i class="fas fa-rocket mr-2"></i> Daftar Sekarang
                        </a>
                        <a href="#features" class="px-8 py-4 border-2 border-white text-white rounded-xl font-bold hover:bg-white hover:text-indigo-600 transition-colors text-center">
                            <i class="fas fa-info-circle mr-2"></i> Pelajari Lebih Lanjut
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-2 gap-6 mt-12">
                        <div class="bg-white/10 backdrop-blur rounded-xl p-4">
                            <div class="text-3xl font-bold text-yellow-300">{{ $stats['villages'] ?? 0 }}+</div>
                            <div class="text-indigo-100">Desa Terdaftar</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur rounded-xl p-4">
                            <div class="text-3xl font-bold text-yellow-300">{{ $stats['features'] ?? 5 }}</div>
                            <div class="text-indigo-100">Fitur Utama</div>
                        </div>
                    </div>
                </div>

                <!-- Illustration -->
                <div class="hidden lg:block">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-yellow-300/20 to-transparent rounded-3xl"></div>
                        <div class="bg-white/10 backdrop-blur-lg rounded-3xl p-8 border border-white/20">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-white rounded-xl p-4 shadow-lg">
                                    <div class="w-10 h-10 rounded-lg bg-indigo-100 flex items-center justify-center mb-3">
                                        <i class="fas fa-users text-indigo-600"></i>
                                    </div>
                                    <h4 class="font-semibold text-gray-800">Data Penduduk</h4>
                                    <p class="text-sm text-gray-500">Kelola data warga</p>
                                </div>
                                <div class="bg-white rounded-xl p-4 shadow-lg">
                                    <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center mb-3">
                                        <i class="fas fa-file-alt text-green-600"></i>
                                    </div>
                                    <h4 class="font-semibold text-gray-800">Layanan Surat</h4>
                                    <p class="text-sm text-gray-500">Pengajuan online</p>
                                </div>
                                <div class="bg-white rounded-xl p-4 shadow-lg">
                                    <div class="w-10 h-10 rounded-lg bg-yellow-100 flex items-center justify-center mb-3">
                                        <i class="fas fa-chart-bar text-yellow-600"></i>
                                    </div>
                                    <h4 class="font-semibold text-gray-800">Statistik</h4>
                                    <p class="text-sm text-gray-500">Laporan visual</p>
                                </div>
                                <div class="bg-white rounded-xl p-4 shadow-lg">
                                    <div class="w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center mb-3">
                                        <i class="fas fa-bell text-red-600"></i>
                                    </div>
                                    <h4 class="font-semibold text-gray-800">Notifikasi</h4>
                                    <p class="text-sm text-gray-500">Informasi desa</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Fitur Unggulan</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Semua yang anda butuhkan untuk mengelola administrasi desa dalam satu platform terintegrasi
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="group p-6 bg-gray-50 rounded-2xl hover:bg-indigo-600 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl gradient-bg flex items-center justify-center mb-4 group-hover:bg-white transition-all">
                        <i class="fas fa-users text-2xl text-white group-hover:text-indigo-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-white">Manajemen Penduduk</h3>
                    <p class="text-gray-600 group-hover:text-indigo-100">
                        Kelola data penduduk lengkap dengan NIK, alamat, status, dan informasi keluarga.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="group p-6 bg-gray-50 rounded-2xl hover:bg-indigo-600 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl gradient-bg flex items-center justify-center mb-4 group-hover:bg-white transition-all">
                        <i class="fas fa-file-signature text-2xl text-white group-hover:text-indigo-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-white">Layanan Surat</h3>
                    <p class="text-gray-600 group-hover:text-indigo-100">
                        Pengajuan surat keterangan, domisili, SKTM secara online dan cepat.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="group p-6 bg-gray-50 rounded-2xl hover:bg-indigo-600 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl gradient-bg flex items-center justify-center mb-4 group-hover:bg-white transition-all">
                        <i class="fas fa-chart-pie text-2xl text-white group-hover:text-indigo-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-white">Dashboard & Statistik</h3>
                    <p class="text-gray-600 group-hover:text-indigo-100">
                        Visualisasi data kependudukan dan laporan statistik yang informatif.
                    </p>
                </div>

                <!-- Feature 4 -->
                <div class="group p-6 bg-gray-50 rounded-2xl hover:bg-indigo-600 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl gradient-bg flex items-center justify-center mb-4 group-hover:bg-white transition-all">
                        <i class="fas fa-mobile-alt text-2xl text-white group-hover:text-indigo-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-white">Akses Mobile</h3>
                    <p class="text-gray-600 group-hover:text-indigo-100">
                        Akses dari mana saja melalui smartphone atau komputer.
                    </p>
                </div>

                <!-- Feature 5 -->
                <div class="group p-6 bg-gray-50 rounded-2xl hover:bg-indigo-600 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl gradient-bg flex items-center justify-center mb-4 group-hover:bg-white transition-all">
                        <i class="fas fa-shield-alt text-2xl text-white group-hover:text-indigo-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-white">Keamanan Data</h3>
                    <p class="text-gray-600 group-hover:text-indigo-100">
                        Data terenkripsi dan aman dengan sistem autentikasi berlapis.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="group p-6 bg-gray-50 rounded-2xl hover:bg-indigo-600 transition-all duration-300">
                    <div class="w-14 h-14 rounded-xl gradient-bg flex items-center justify-center mb-4 group-hover:bg-white transition-all">
                        <i class="fas fa-headset text-2xl text-white group-hover:text-indigo-600"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-white">Dukungan 24/7</h3>
                    <p class="text-gray-600 group-hover:text-indigo-100">
                        Tim support siap membantu kapanpun anda membutuhkan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Cara Kerja</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Mulai gunakan Desa Pintar dalam 3 langkah mudah
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="relative">
                    <div class="flex items-center justify-center w-16 h-16 rounded-full gradient-bg text-white text-2xl font-bold mx-auto mb-6">
                        1
                    </div>
                    <h3 class="text-xl font-bold text-center text-gray-900 mb-2">Daftar Akun</h3>
                    <p class="text-center text-gray-600">
                        Daftarkan desa atau diri anda sebagai warga dengan memilih lokasi desa.
                    </p>
                </div>

                <!-- Arrow -->
                <div class="hidden md:block absolute left-1/3 top-8 w-1/3">
                    <div class="border-t-2 border-dashed border-indigo-300"></div>
                </div>

                <!-- Step 2 -->
                <div class="relative">
                    <div class="flex items-center justify-center w-16 h-16 rounded-full gradient-bg text-white text-2xl font-bold mx-auto mb-6">
                        2
                    </div>
                    <h3 class="text-xl font-bold text-center text-gray-900 mb-2">Verifikasi Admin</h3>
                    <p class="text-center text-gray-600">
                        Admin desa akan memverifikasi data anda untuk keamanan.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="relative">
                    <div class="flex items-center justify-center w-16 h-16 rounded-full gradient-bg text-white text-2xl font-bold mx-auto mb-6">
                        3
                    </div>
                    <h3 class="text-xl font-bold text-center text-gray-900 mb-2">Mulai Menggunakan</h3>
                    <p class="text-center text-gray-600">
                        Akses semua fitur sesuai dengan role anda (Admin/Warga).
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Villages Section -->
    <section id="villages" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Desa Terdaftar</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Desa-desa yang sudah menggunakan Desa Pintar
                </p>
            </div>

            @if($villages->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($villages as $village)
                        <div class="bg-gray-50 rounded-xl p-6 hover:shadow-lg transition-shadow">
                            <div class="w-12 h-12 rounded-lg gradient-bg flex items-center justify-center mb-4">
                                <i class="fas fa-building text-white"></i>
                            </div>
                            <h4 class="font-bold text-gray-900">{{ $village->name }}</h4>
                            <p class="text-sm text-gray-500">{{ $village->regency }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-building text-gray-300 text-5xl mb-4"></i>
                    <p class="text-gray-500">Belum ada desa terdaftar</p>
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 gradient-bg">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                Siap Digitalisasi Desa Anda?
            </h2>
            <p class="text-indigo-100 text-lg mb-8 max-w-2xl mx-auto">
                Bergabunglah dengan desa-desa lain yang sudah merasakan kemudahan Desa Pintar dalam mengelola administrasi.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-indigo-600 rounded-xl font-bold hover:bg-gray-100 transition-colors shadow-lg">
                    <i class="fas fa-user-plus mr-2"></i> Daftar Sebagai Warga
                </a>
                <a href="mailto:info@desapintar.id" class="px-8 py-4 border-2 border-white text-white rounded-xl font-bold hover:bg-white hover:text-indigo-600 transition-colors">
                    <i class="fas fa-envelope mr-2"></i> Hubungi Kami
                </a>
            </div>
        </div>
    </section>
@endsection
