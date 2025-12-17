<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Sistem Desa Digital')</title>

    <!-- Vite Assets (Tailwind CSS) -->
    @vite(['resources/css/app.css'])

    <!-- Google Fonts - Async Loading -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"></noscript>

    <!-- Font Awesome - Only icons needed for auth -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @stack('styles')
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex items-center justify-center min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        @yield('content')
    </div>

    <!-- Conditional SweetAlert2 - Only loaded when needed -->
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
                        confirmButtonColor: '#4F46E5'
                    });
                @endif

                @if(session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: "{{ session('success') }}",
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#4F46E5'
                    });
                @endif
            });
        </script>
    @endif

    @stack('scripts')
</body>
</html>
