{{-- /resources/views/pages/auth/two-factor-verify.blade.php --}}

@extends('layouts.auth')

@section('title', 'Verifikasi 2FA')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-primary via-primary-hover to-earth flex items-center justify-center p-4">
    <div class="bg-white dark:bg-surface-dark rounded-2xl shadow-xl w-full max-w-md p-8 border border-border-light dark:border-border-dark">
        <div class="text-center mb-8">
            <div class="size-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-primary text-3xl">security</span>
            </div>
            <h1 class="text-2xl font-black text-dark-grey dark:text-white">Verifikasi 2FA</h1>
            <p class="text-text-secondary dark:text-gray-400 mt-2">Masukkan kode 6 digit Anda</p>
        </div>

        @if(session('error'))
            <div class="bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-800 text-red-700 dark:text-red-400 px-4 py-3 rounded-lg mb-6">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('two-factor.verify.post') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="code" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Kode Verifikasi</label>
                <input type="text" name="code" id="code" 
                       class="w-full px-4 py-4 text-center text-2xl tracking-widest border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary font-mono"
                       maxlength="6" pattern="[0-9]{6}" required autofocus
                       placeholder="000000">
                @error('code')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full px-4 py-3 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors font-bold text-lg">
                Verifikasi
            </button>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('logout') }}" class="text-sm text-text-secondary dark:text-gray-400 hover:text-dark-grey dark:hover:text-white transition-colors"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Kembali ke halaman login
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
        </div>
    </div>
</div>

@endsection
