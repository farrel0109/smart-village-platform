@extends('layouts.auth-split')

@section('title', 'Verifikasi 2FA')

@section('image', 'https://images.unsplash.com/photo-1614064641938-3e821efd8536?q=80&w=2664&auto=format&fit=crop')

@section('left_content')
    <h1 class="text-4xl xl:text-5xl font-black leading-tight tracking-tight text-white mb-6 drop-shadow-md">
        Keamanan<br/>
        <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-300 to-sky-200">Prioritas Kami.</span>
    </h1>
    <p class="text-lg text-gray-100 mb-10 font-medium leading-relaxed max-w-md">
        Lindungi akun Anda dengan verifikasi dua langkah untuk memastikan data Anda tetap aman.
    </p>
@endsection

@section('content_header')
    <div class="flex items-center gap-3 mb-2">
        <span class="material-symbols-outlined text-primary text-3xl">security</span>
        <h2 class="text-3xl font-bold tracking-tight text-dark-grey dark:text-white">Verifikasi 2FA</h2>
    </div>
    <p class="mt-2 text-sm text-text-secondary dark:text-text-secondary-dark">
        Masukkan kode 6 digit yang dikirimkan ke perangkat Anda.
    </p>
@endsection

@section('content')
    @if(session('error'))
        <div class="bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded-lg mb-6">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('two-factor.verify.post') }}" method="POST" class="space-y-6">
        @csrf

        <div class="space-y-2">
            <label for="code" class="block text-sm font-semibold text-dark-grey dark:text-white">Kode Verifikasi</label>
            <input type="text" name="code" id="code" 
                   class="w-full px-4 py-4 text-center text-2xl tracking-widest border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary font-mono transition-all"
                   maxlength="6" pattern="[0-9]{6}" required autofocus
                   placeholder="000000">
            @error('code')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="w-full justify-center rounded-lg bg-primary hover:bg-primary-hover px-3 py-3.5 text-sm font-bold leading-6 text-white shadow-lg shadow-primary/20 hover:shadow-primary/40 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-primary transition-all transform active:scale-[0.98]">
            Verifikasi
        </button>
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('logout') }}" class="text-sm font-medium text-text-secondary dark:text-gray-400 hover:text-primary dark:hover:text-white transition-colors"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Kembali ke halaman login
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
    </div>
@endsection
