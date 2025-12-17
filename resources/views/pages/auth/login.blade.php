<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk - Desa Pintar</title>
    
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
                <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 4H17.3334V17.3334H30.6666V30.6666H44V44H4V4Z" fill="currentColor"></path>
                </svg>
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
            <div class="absolute inset-0 bg-cover bg-center z-0 scale-105" data-alt="Beautiful aerial view of green rice terraces in Bali" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAWAJr_Rdeiued17PlYMMeUPQw2UCvVr2W0mahGtZ4DBgqpd1KLowbLd7shdQdM0eGyKvfjz1J47bJaWw1RZSxfIZg6wg7_d11LQIbI0Xj6oTHQzlH_2PuGNSvR1YtYA08uvVhyTm3GbWGFTRD9qOCpT97Yns0bUo6YJ7XE8kDS7My4wY7A1hMIqt1lO0YxIY7TNlBIu0V5M7kefK9ONcoKp70ReAb06iOQJDgUnVfwXlmExiYl45De0CA0iwgcKwSVRRGpJCyKmT4');"></div>
            <div class="absolute inset-0 bg-gradient-to-tr from-dark-grey via-primary/80 to-sky-blue/40 z-10 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-dark-grey via-transparent to-transparent z-10 opacity-80"></div>
            <div class="relative z-20 max-w-xl px-12 text-center lg:text-left">
                <h1 class="text-4xl xl:text-5xl font-black leading-tight tracking-tight text-white mb-6 drop-shadow-md">
                    Inovasi Desa,<br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-300 to-sky-200">Masa Depan Warga.</span>
                </h1>
                <p class="text-lg text-gray-100 mb-10 font-medium leading-relaxed max-w-md">
                    Portal layanan digital terpadu yang menghubungkan kearifan lokal dengan teknologi masa depan untuk kemajuan bersama.
                </p>
                <div class="flex flex-row items-center gap-5 bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/10 inline-flex">
                    <div class="flex -space-x-3">
                        <img alt="User avatar 1" class="w-10 h-10 rounded-full border-2 border-dark-grey object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDiXo1AR24FffKnwHtacCWai-fCITy9g9x06DqJl2L3rsS-hL5Z3elfIHk6yyE9sBxeembGck265VcOG2EtiCcyGN_mw2AhnVPIZW--89U4q2ej1w0Wjh223EjNaS0is3t1MOWd4q9-41LXhb_eHNS_NvgRQIhFTFvUpbCTzyrQLOGnx9OZVgYBYxFP9ek54LaNE1i_goRViclRFZ5uS9Vqtp8wJC3O0Z59G3RUPBzhc63Ds2dvN2Y6VnCtUYIHLRCw7j_NkHlBvbA"/>
                        <img alt="User avatar 2" class="w-10 h-10 rounded-full border-2 border-dark-grey object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDoc3K_4wli20KXcDWKKNnXeUI_kmnmjrLtpfJOfXjjKFCPMBtKlRkiH3pIbqCk2lXzvcCbd1iPQTU8BpSWpdECTD52mIjjIyCWeg7q8k_vU04gDRHwKoE99FH51lWr0R7cYAg4tSNC6C8YOLhuUTqyCxC4ROZ7XjxH3u7Hrj8iVAehwZgcuXownG6qeJQJVotySX3Zz22n0WXo6_BcoTluHWfLXJlam6Yj8rfbhoqQPwKTWvGkpym-A5Qk91eGfGcQ2OBkNQphaNI"/>
                        <img alt="User avatar 3" class="w-10 h-10 rounded-full border-2 border-dark-grey object-cover" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDJhQ0ijyHyEvCLDwFafUzkfOKgrfIJSf-Hcou0hfRJRakKbOVekFWZeGzrXU6Pqu2b3xgBjKXX_jWpW6hziiHwUdiy9v9jONRO3Wsl5JCQ_D0RAYl-guib8xfXaJReHynHA4sHPeuckbrbDSuZdSVe0b833D6Bb0WZCfpF_PKkB1HlxuOEv5C_2JORLITPfOuOPVUGMMNQPAqkq3T5kInIVtZ4lJOnBxoKCrh0ixANRaexxcqD6TCz4P-QXxy9CY-hHP7ctRXAdr8"/>
                        <div class="w-10 h-10 rounded-full border-2 border-dark-grey bg-sky-blue flex items-center justify-center text-white font-bold text-xs">
                            +2k
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-sm font-bold text-white">Warga Terhubung</span>
                        <span class="text-xs text-green-200">Bergabung sekarang</span>
                    </div>
                </div>
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
                    <h2 class="text-3xl font-bold tracking-tight text-dark-grey dark:text-white">Selamat Datang</h2>
                    <p class="mt-2 text-sm text-text-secondary dark:text-text-secondary-dark">
                        Silakan masuk untuk mengakses layanan desa digital.
                    </p>
                </div>

                <div class="w-full">
                <div class="w-full">
                    <!-- Laravel Form -->
                    <form action="{{ route('authenticate') }}" class="space-y-6" method="POST">
                        @csrf
                        
                        <!-- Email Field -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-dark-grey dark:text-gray-200" for="email">
                                Alamat Email
                            </label>
                            <div class="relative rounded-lg shadow-sm group">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 transition-colors">
                                    <span class="material-symbols-outlined text-sky-blue group-focus-within:text-primary text-[20px]">mail</span>
                                </div>
                                <input class="block w-full rounded-lg border-0 py-3.5 pl-10 text-dark-grey ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary dark:bg-surface-dark dark:ring-border-dark dark:text-white dark:placeholder:text-gray-500 sm:text-sm sm:leading-6 transition-all @error('email') ring-red-500 @enderror" 
                                       id="email" 
                                       name="email" 
                                       placeholder="nama@email.com" 
                                       type="email" 
                                       value="{{ old('email') }}" 
                                       required 
                                       autofocus/>
                            </div>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <label class="block text-sm font-semibold text-dark-grey dark:text-gray-200" for="password">
                                    Kata Sandi
                                </label>
                                <div class="text-sm">
                                    <a class="font-medium text-sky-blue hover:text-sky-blue/80 transition-colors" href="#">Lupa kata sandi?</a>
                                </div>
                            </div>
                            <div class="relative rounded-lg shadow-sm group">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <span class="material-symbols-outlined text-sky-blue group-focus-within:text-primary text-[20px]">lock</span>
                                </div>
                                <input class="block w-full rounded-lg border-0 py-3.5 pl-10 pr-10 text-dark-grey ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary dark:bg-surface-dark dark:ring-border-dark dark:text-white dark:placeholder:text-gray-500 sm:text-sm sm:leading-6 transition-all @error('password') ring-red-500 @enderror" 
                                       id="password" 
                                       name="password" 
                                       placeholder="••••••••" 
                                       type="password" 
                                       required/>
                                <button class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer text-gray-400 hover:text-dark-grey dark:text-gray-500 dark:hover:text-white transition-colors" type="button">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </button>
                            </div>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center">
                            <input class="h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary dark:bg-surface-dark dark:border-border-dark dark:checked:bg-primary" 
                                   id="remember-me" 
                                   name="remember" 
                                   type="checkbox"/>
                            <label class="ml-2 block text-sm text-text-secondary dark:text-gray-300" for="remember-me">Ingat saya di perangkat ini</label>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button class="flex w-full justify-center rounded-lg bg-primary hover:bg-primary-hover px-3 py-3.5 text-sm font-bold leading-6 text-white shadow-lg shadow-primary/20 hover:shadow-primary/40 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary transition-all transform active:scale-[0.98]" type="submit">
                                Masuk
                            </button>
                        </div>
                    </form>

                    <!-- Divider -->
                    <div class="relative mt-8">
                        <div aria-hidden="true" class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200 dark:border-border-dark"></div>
                        </div>
                        <div class="relative flex justify-center">
                            <span class="bg-white dark:bg-background-dark px-4 text-sm text-text-secondary dark:text-gray-500">Atau masuk menggunakan</span>
                        </div>
                    </div>

                    <!-- Social Login -->
                    <div class="mt-6 grid grid-cols-2 gap-4">
                        <a class="flex w-full items-center justify-center gap-3 rounded-lg bg-white dark:bg-surface-dark px-3 py-2.5 text-sm font-semibold text-dark-grey dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-border-dark hover:bg-gray-50 dark:hover:bg-border-dark/50 transition-all group" href="#">
                            <svg aria-hidden="true" class="h-5 w-5 opacity-80 group-hover:opacity-100" viewBox="0 0 24 24">
                                <path d="M12.0003 20.45c-4.6617 0-8.45-3.7883-8.45-8.45 0-4.6617 3.7883-8.45 8.45-8.45 4.6617 0 8.45 3.7883 8.45 8.45 0 4.6617-3.7883 8.45-8.45 8.45zm0-18.9C6.2364 1.55 1.55 6.2364 1.55 12c0 5.7636 4.6864 10.45 10.4503 10.45 5.7636 0 10.45-4.6864 10.45-10.45 0-5.7636-4.6864-10.45-10.45-10.45z" fill="currentColor"></path>
                            </svg>
                            <span class="text-sm font-semibold">Google</span>
                        </a>
                        <a class="flex w-full items-center justify-center gap-3 rounded-lg bg-white dark:bg-surface-dark px-3 py-2.5 text-sm font-semibold text-dark-grey dark:text-white shadow-sm ring-1 ring-inset ring-gray-300 dark:ring-border-dark hover:bg-gray-50 dark:hover:bg-border-dark/50 transition-all group" href="#">
                            <span class="material-symbols-outlined text-[20px] text-dark-grey dark:text-white opacity-80 group-hover:opacity-100">qr_code_scanner</span>
                            <span class="text-sm font-semibold">Scan KTP</span>
                        </a>
                    </div>

                    <p class="mt-8 text-center text-sm text-text-secondary dark:text-gray-400">
                        Belum terdaftar sebagai warga?
                        <a class="font-bold leading-6 text-sky-blue hover:text-sky-blue/80 transition-colors" href="{{ route('register') }}">Daftar sekarang</a>
                    </p>
                </div>
            </div>
            
            <div class="mt-10 lg:mt-auto py-4">
                <p class="text-xs text-center text-gray-400">
                    © {{ date('Y') }} Desa Pintar. Dilindungi oleh Pemerintah Daerah.
                </p>
            </div>
        </div>
    </main>

    <!-- SweetAlert2 Logic (Copied from Layout) -->
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
