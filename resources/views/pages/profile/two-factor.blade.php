{{-- /resources/views/pages/profile/two-factor.blade.php --}}

@extends('layouts.app')

@section('title', 'Keamanan - 2FA')

@section('content')

    <div class="max-w-2xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Autentikasi Dua Faktor</h1>
                <p class="mt-1 text-gray-600">Tambahkan lapisan keamanan ekstra untuk akun Anda</p>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center {{ $enabled ? 'bg-green-100 text-green-600' : 'bg-gray-100 text-gray-600' }}">
                        <i class="fas fa-shield-alt text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-xl font-semibold text-gray-800">Status 2FA</h2>
                        <p class="{{ $enabled ? 'text-green-600' : 'text-gray-500' }}">
                            {{ $enabled ? 'Aktif' : 'Tidak Aktif' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="p-6">
                @if($enabled)
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                        <div class="flex items-start">
                            <i class="fas fa-check-circle text-green-600 mt-0.5 mr-3"></i>
                            <div>
                                <p class="font-medium text-green-800">2FA sudah aktif!</p>
                                <p class="text-sm text-green-700 mt-1">Akun Anda dilindungi dengan verifikasi dua langkah.</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('two-factor.disable') }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                                Masukkan Password untuk Menonaktifkan
                            </label>
                            <input type="password" name="password" id="password" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500">
                        </div>

                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700"
                                onclick="return confirm('Yakin ingin menonaktifkan 2FA?')">
                            <i class="fas fa-times mr-2"></i>Nonaktifkan 2FA
                        </button>
                    </form>
                @else
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-triangle text-yellow-600 mt-0.5 mr-3"></i>
                            <div>
                                <p class="font-medium text-yellow-800">2FA belum aktif</p>
                                <p class="text-sm text-yellow-700 mt-1">Aktifkan 2FA untuk keamanan akun yang lebih baik.</p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('two-factor.enable') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                                Masukkan Password untuk Mengaktifkan
                            </label>
                            <input type="password" name="password" id="password" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                        </div>

                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                            <i class="fas fa-shield-alt mr-2"></i>Aktifkan 2FA
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('profile.index') }}" class="text-indigo-600 hover:text-indigo-800">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Profil
            </a>
        </div>
    </div>

@endsection
