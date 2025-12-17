<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar - Desa Pintar</title>
    
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
            <div class="absolute inset-0 bg-cover bg-center z-0 scale-105" style="background-image: url('https://images.unsplash.com/photo-1500382017468-9049fed747ef?q=80&w=2832&auto=format&fit=crop');"></div>
            <div class="absolute inset-0 bg-gradient-to-tr from-dark-grey via-primary/80 to-sky-blue/40 z-10 mix-blend-multiply"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-dark-grey via-transparent to-transparent z-10 opacity-80"></div>
            <div class="relative z-20 max-w-xl px-12 text-center lg:text-left">
                <h1 class="text-4xl xl:text-5xl font-black leading-tight tracking-tight text-white mb-6 drop-shadow-md">
                    Bergabunglah<br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-300 to-sky-200">Bersama Kami.</span>
                </h1>
                <p class="text-lg text-gray-100 mb-10 font-medium leading-relaxed max-w-md">
                    Daftarkan diri Anda untuk mengakses layanan administrasi desa yang lebih mudah, cepat, dan transparan.
                </p>
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
                    <h2 class="text-3xl font-bold tracking-tight text-dark-grey dark:text-white">Buat Akun Baru</h2>
                    <p class="mt-2 text-sm text-text-secondary dark:text-text-secondary-dark">
                        Isi data diri Anda untuk mendaftar.
                    </p>
                </div>

                <form action="{{ route('register.submit') }}" class="space-y-5" method="POST">
                    @csrf
                    
                    <!-- Name Field -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-dark-grey dark:text-gray-200" for="name">
                            Nama Lengkap
                        </label>
                        <div class="relative rounded-lg shadow-sm group">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 transition-colors">
                                <span class="material-symbols-outlined text-sky-blue group-focus-within:text-primary text-[20px]">badge</span>
                            </div>
                            <input class="block w-full rounded-lg border-0 py-3.5 pl-10 text-dark-grey ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary dark:bg-surface-dark dark:ring-border-dark dark:text-white dark:placeholder:text-gray-500 sm:text-sm sm:leading-6 transition-all @error('name') ring-red-500 @enderror" 
                                   id="name" 
                                   name="name" 
                                   placeholder="Nama Lengkap" 
                                   type="text" 
                                   value="{{ old('name') }}" 
                                   required 
                                   autofocus/>
                        </div>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

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
                                   required/>
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-dark-grey dark:text-gray-200" for="password">
                            Kata Sandi
                        </label>
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

                    <!-- Village Selection -->
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-dark-grey dark:text-gray-200" for="village_id">
                            Pilih Desa
                        </label>
                        <div class="relative rounded-lg shadow-sm group">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 transition-colors">
                                <span class="material-symbols-outlined text-sky-blue group-focus-within:text-primary text-[20px]">location_on</span>
                            </div>
                            <select id="village_id" name="village_id" required
                                    class="block w-full rounded-lg border-0 py-3.5 pl-10 text-dark-grey ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary dark:bg-surface-dark dark:ring-border-dark dark:text-white sm:text-sm sm:leading-6 transition-all @error('village_id') ring-red-500 @enderror">
                                <option value="">-- Pilih Desa --</option>
                                @foreach($villages->groupBy('regency') as $regency => $villageGroup)
                                    <optgroup label="{{ $regency }}">
                                        @foreach($villageGroup as $village)
                                            <option value="{{ $village->id }}" {{ old('village_id') == $village->id ? 'selected' : '' }}>
                                                {{ $village->name }} - Kec. {{ $village->district }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                        @error('village_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button class="flex w-full justify-center rounded-lg bg-primary hover:bg-primary-hover px-3 py-3.5 text-sm font-bold leading-6 text-white shadow-lg shadow-primary/20 hover:shadow-primary/40 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary transition-all transform active:scale-[0.98]" type="submit">
                            Daftar Sekarang
                        </button>
                    </div>
                </form>

                <p class="mt-8 text-center text-sm text-text-secondary dark:text-gray-400">
                    Sudah punya akun?
                    <a class="font-bold leading-6 text-sky-blue hover:text-sky-blue/80 transition-colors" href="{{ route('login') }}">Masuk disini</a>
                </p>
            </div>
            
            <div class="mt-10 lg:mt-auto py-4">
                <p class="text-xs text-center text-gray-400">
                    © {{ date('Y') }} Desa Pintar. Dilindungi oleh Pemerintah Daerah.
                </p>
            </div>
        </div>
    </main>
</body>
</html>
