<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Desa Pintar - Digitalisasi Administrasi Desa dalam Genggaman Anda">

    <title>@yield('title', 'Desa Pintar - Sistem Administrasi Desa Digital')</title>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css'])

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .hero-pattern {
            background-color: #667eea;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.08'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>

    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50">
    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-white/90 backdrop-blur-md shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('landing') }}" class="flex items-center space-x-2">
                        <div class="w-10 h-10 rounded-lg gradient-bg flex items-center justify-center">
                            <i class="fas fa-home text-white text-lg"></i>
                        </div>
                        <span class="text-xl font-bold text-gray-900">Desa<span class="text-indigo-600">Pintar</span></span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="text-gray-600 hover:text-indigo-600 transition-colors">Fitur</a>
                    <a href="#how-it-works" class="text-gray-600 hover:text-indigo-600 transition-colors">Cara Kerja</a>
                    <a href="#villages" class="text-gray-600 hover:text-indigo-600 transition-colors">Desa</a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex items-center space-x-4">
                    @auth
                        <a href="{{ auth()->user()->hasRole('user') ? route('user.dashboard') : route('admin.dashboard') }}" class="text-gray-600 hover:text-indigo-600 font-medium transition-colors">
                            Dashboard
                        </a>
                        <div class="hidden md:flex items-center space-x-2 pl-4 border-l border-gray-200">
                            <div class="text-sm text-gray-600">
                                {{ auth()->user()->name }}
                            </div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-gray-400 hover:text-red-600 transition-colors" title="Logout">
                                    <i class="fas fa-sign-out-alt"></i>
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-600 font-medium transition-colors">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors shadow-sm font-medium">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-10 h-10 rounded-lg gradient-bg flex items-center justify-center">
                            <i class="fas fa-home text-white text-lg"></i>
                        </div>
                        <span class="text-xl font-bold">Desa<span class="text-indigo-400">Pintar</span></span>
                    </div>
                    <p class="text-gray-400 text-sm max-w-md">
                        Digitalisasi administrasi desa dalam genggaman Anda. Kelola data penduduk, layanan surat, dan informasi desa dengan mudah dan efisien.
                    </p>
                </div>

                <!-- Links -->
                <div>
                    <h4 class="font-semibold mb-4">Navigasi</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#features" class="hover:text-white transition-colors">Fitur</a></li>
                        <li><a href="#how-it-works" class="hover:text-white transition-colors">Cara Kerja</a></li>
                        <li><a href="#villages" class="hover:text-white transition-colors">Desa Terdaftar</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h4 class="font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><i class="fas fa-envelope mr-2"></i> info@desapintar.id</li>
                        <li><i class="fas fa-phone mr-2"></i> (021) 123-4567</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} Desa Pintar. All rights reserved.
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
