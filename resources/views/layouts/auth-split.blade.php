<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Desa Pintar') - Desa Pintar</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-display bg-background-light dark:bg-background-dark text-dark-grey dark:text-white min-h-screen flex flex-col antialiased">
    
    <!-- Header -->
    <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-border-light dark:border-border-dark px-6 lg:px-10 py-4 bg-white dark:bg-surface-dark sticky top-0 z-50 shadow-sm">
        <div class="flex items-center gap-3">
            <div class="size-8 text-primary">
                <img src="{{ asset('img/logo-desa.svg') }}" alt="Logo Desa Pintar">
            </div>
            <h2 class="text-dark-grey dark:text-white text-xl font-bold leading-tight tracking-tight">Desa Pintar</h2>
        </div>
        <div class="flex items-center gap-8">
            <a class="text-earth hover:text-primary dark:text-gray-300 dark:hover:text-white text-sm font-medium transition-colors hidden sm:block" href="{{ url('/') }}">Beranda</a>
            <a class="text-earth hover:text-primary dark:text-gray-300 dark:hover:text-white text-sm font-medium transition-colors hidden sm:block" href="#">Bantuan</a>
        </div>
    </header>

    <main class="flex-1 flex flex-col lg:flex-row h-full">
        <!-- Left Side (Image) -->
        <div class="relative hidden lg:flex lg:w-1/2 xl:w-7/12 bg-dark-grey items-center justify-center overflow-hidden">
            <div class="absolute inset-0 bg-cover bg-center z-0 scale-105" style="background-image: url('@yield('image', 'https://lh3.googleusercontent.com/aida-public/AB6AXuAWAJr_Rdeiued17PlYMMeUPQw2UCvVr2W0mahGtZ4DBgqpd1KLowbLd7shdQdM0eGyKvfjz1J47bJaWw1RZSxfIZg6wg7_d11LQIbI0Xj6oTHQzlH_2PuGNSvR1YtYA08uvVhyTm3GbWGFTRD9qOCpT97Yns0bUo6YJ7XE8kDS7My4wY7A1hMIqt1lO0YxIY7TNlBIu0V5M7kefK9ONcoKp70ReAb06iOQJDgUnVfwXlmExiYl45De0CA0iwgcKwSVRRGpJCyKmT4')');"></div>
            <div class="absolute inset-0 bg-gradient-to-tr from-dark-grey via-primary/80 to-sky-blue/40 z-10 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-dark-grey via-transparent to-transparent z-10 opacity-80"></div>
            <div class="relative z-20 max-w-xl px-12 text-center lg:text-left">
                @yield('left_content')
            </div>
        </div>

        <!-- Right Side (Form) -->
        <div class="flex-1 flex flex-col justify-center items-center p-6 lg:p-12 xl:p-24 bg-white dark:bg-background-dark">
            <div class="w-full max-w-md space-y-8">
                <div class="text-center lg:text-left">
                    <div class="inline-block p-2 bg-primary/10 rounded-lg mb-4 lg:hidden">
                        <div class="size-6 text-primary">
                            <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg"><path d="M4 4H17.3334V17.3334H30.6666V30.6666H44V44H4V4Z" fill="currentColor"></path></svg>
                        </div>
                    </div>
                    @yield('content_header')
                </div>

                <div class="w-full">
                    @yield('content')
                </div>
                
                <div class="mt-10 lg:mt-auto py-4">
                    <p class="text-xs text-center text-gray-400">
                        © {{ date('Y') }} Desa Pintar. Dilindungi oleh Pemerintah Daerah.
                    </p>
                </div>
            </div>
        </div>
    </main>

    <!-- SweetAlert2 Logic -->
    @if(session('status_modal') || session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if(session('status_modal'))
                    @php
                        $status = session('status_modal');
                        $configs = [
                            'submitted' => ['icon' => 'info', 'title' => 'Sedang Diproses', 'text' => 'Akun anda masih menunggu persetujuan admin.'],
                            'rejected' => ['icon' => 'error', 'title' => 'Ditolak', 'text' => 'Akun anda telah ditolak oleh admin.'],
                            'invalid' => ['icon' => 'warning', 'title' => 'Login Gagal', 'text' => 'Email atau kata sandi salah.'],
                        ];
                        $config = $configs[$status] ?? ['icon' => 'info', 'title' => 'Info', 'text' => 'Pemberitahuan.'];
                    @endphp
                    Swal.fire({
                        icon: "{{ $config['icon'] }}",
                        title: "{{ $config['title'] }}",
                        text: "{{ $config['text'] }}",
                        confirmButtonText: 'Tutup',
                        confirmButtonColor: '#2E7D32'
                    });
                @endif

                @if(session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: "{{ session('success') }}",
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#2E7D32'
                    });
                @endif
            });
        </script>
    @endif
</body>
</html>
