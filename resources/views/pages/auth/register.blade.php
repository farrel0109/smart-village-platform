@extends('layouts.auth')

@section('title', 'Daftar | Desa Pintar')

@section('content')
    <div class="max-w-4xl w-full bg-white shadow-xl rounded-lg overflow-hidden md:flex">
        <!-- Image Side -->
        <div class="hidden md:block md:w-1/2">
            <div class="h-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center p-8">
                <div class="text-center text-white">
                    <div class="w-20 h-20 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-home text-4xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold mb-2">Desa Pintar</h2>
                    <p class="text-indigo-100">Digitalisasi Administrasi Desa dalam Genggaman Anda</p>
                </div>
            </div>
        </div>

        <!-- Form Side -->
        <div class="w-full md:w-1/2 p-8 sm:p-10">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-900">Buat Akun Baru</h1>
                <p class="mt-2 text-sm text-gray-600">Isi data untuk mendaftar sebagai warga</p>
            </div>

            <form action="{{ route('register.submit') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Nama -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                    <input id="name" name="name" type="text" required autofocus
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror"
                           placeholder="Masukkan nama lengkap" value="{{ old('name') }}">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                    <input id="email" name="email" type="email" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror"
                           placeholder="Masukkan email" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
                    <input id="password" name="password" type="password" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('password') border-red-500 @enderror"
                           placeholder="Minimal 6 karakter">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Village Selection -->
                <div>
                    <label for="village_id" class="block text-sm font-medium text-gray-700 mb-1">
                        <i class="fas fa-map-marker-alt text-indigo-600 mr-1"></i> Pilih Desa
                    </label>
                    <select id="village_id" name="village_id" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('village_id') border-red-500 @enderror">
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
                    @error('village_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">
                        <i class="fas fa-info-circle mr-1"></i>
                        Pilih desa tempat anda tinggal
                    </p>
                </div>

                <!-- Submit -->
                <button type="submit"
                        class="w-full py-3 px-4 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    <i class="fas fa-user-plus mr-2"></i> Daftar Sekarang
                </button>

                <!-- Info -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                    <p class="text-xs text-blue-800">
                        <i class="fas fa-info-circle mr-1"></i>
                        Setelah mendaftar, akun anda akan diverifikasi oleh admin desa sebelum dapat digunakan.
                    </p>
                </div>

                <!-- Login Link -->
                <div class="text-sm text-center text-gray-600">
                    <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                        Sudah punya akun? Masuk disini
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
