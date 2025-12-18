{{-- /resources/views/pages/profile/two-factor.blade.php --}}

@extends('layouts.app')

@section('title', 'Keamanan - 2FA')

@section('content')

    <div class="max-w-2xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <div>
                <h1 class="text-3xl font-black text-dark-grey dark:text-white">Autentikasi Dua Faktor</h1>
                <p class="mt-1 text-text-secondary dark:text-gray-400">Tambahkan lapisan keamanan ekstra untuk akun Anda</p>
            </div>
        </div>

        <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
            <div class="p-6 border-b border-border-light dark:border-border-dark">
                <div class="flex items-center">
                    <div class="size-12 rounded-full flex items-center justify-center {{ $enabled ? 'bg-primary/10 text-primary' : 'bg-gray-100 dark:bg-white/10 text-text-secondary dark:text-gray-400' }}">
                        <span class="material-symbols-outlined text-xl">security</span>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-lg font-bold text-dark-grey dark:text-white">Status 2FA</h2>
                        <p class="{{ $enabled ? 'text-primary' : 'text-text-secondary dark:text-gray-400' }}">
                            {{ $enabled ? 'Aktif' : 'Tidak Aktif' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="p-6">
                @if($enabled)
                    <div class="bg-primary/10 border border-primary/30 rounded-lg p-4 mb-6">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-primary">check_circle</span>
                            <div>
                                <p class="font-bold text-primary">2FA sudah aktif!</p>
                                <p class="text-sm text-primary/80 mt-1">Akun Anda dilindungi dengan verifikasi dua langkah.</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('two-factor.disable') }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">
                                Masukkan Password untuk Menonaktifkan
                            </label>
                            <input type="password" name="password" id="password" required
                                   class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-red-500 focus:border-red-500">
                        </div>

                        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-bold"
                                onclick="return confirm('Yakin ingin menonaktifkan 2FA?')">
                            <span class="material-symbols-outlined text-[20px]">close</span>Nonaktifkan 2FA
                        </button>
                    </form>
                @else
                    <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4 mb-6">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-yellow-600 dark:text-yellow-400">warning</span>
                            <div>
                                <p class="font-bold text-yellow-800 dark:text-yellow-300">2FA belum aktif</p>
                                <p class="text-sm text-yellow-700 dark:text-yellow-400 mt-1">Aktifkan 2FA untuk keamanan akun yang lebih baik.</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('two-factor.enable') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">
                                Masukkan Password untuk Mengaktifkan
                            </label>
                            <input type="password" name="password" id="password" required
                                   class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary">
                        </div>

                        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors font-bold">
                            <span class="material-symbols-outlined text-[20px]">security</span>Aktifkan 2FA
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('profile.index') }}" class="inline-flex items-center gap-2 text-primary hover:text-primary-hover font-bold">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span>Kembali ke Profil
            </a>
        </div>
    </div>

@endsection
