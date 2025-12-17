@extends('layouts.app')

@section('title', 'Daftarkan Desa Baru')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Daftarkan Desa Baru</h1>
            <p class="mt-1 text-gray-600">Isi data desa dan admin pengelola</p>
        </div>
        <a href="{{ route('admin.villages.index') }}"
           class="inline-flex items-center px-4 py-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors mt-4 sm:mt-0">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali
        </a>
    </div>

    <form action="{{ route('admin.villages.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Village Information -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-building text-indigo-600 mr-2"></i>
                    Informasi Desa
                </h3>

                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Desa *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror"
                                   placeholder="Desa Sukamaju">
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kode Desa *</label>
                            <input type="text" name="code" value="{{ old('code') }}" required
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 @error('code') border-red-500 @enderror"
                                   placeholder="DSA005">
                            @error('code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Provinsi *</label>
                        <input type="text" name="province" value="{{ old('province', 'Sulawesi Selatan') }}" required
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 @error('province') border-red-500 @enderror">
                        @error('province') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kabupaten/Kota *</label>
                        <input type="text" name="regency" value="{{ old('regency') }}" required
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 @error('regency') border-red-500 @enderror"
                               placeholder="Kabupaten Bone">
                        @error('regency') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kecamatan *</label>
                        <input type="text" name="district" value="{{ old('district') }}" required
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 @error('district') border-red-500 @enderror"
                               placeholder="Kecamatan Tanete Riattang">
                        @error('district') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Kantor Desa</label>
                        <input type="text" name="address" value="{{ old('address') }}"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500"
                               placeholder="Jl. Desa No. 1">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                            <input type="text" name="phone" value="{{ old('phone') }}"
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500"
                                   placeholder="081234567890">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500"
                                   placeholder="admin@desa.id">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Admin Account -->
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-user-shield text-indigo-600 mr-2"></i>
                    Akun Admin Desa
                </h3>
                <p class="text-sm text-gray-500 mb-4">
                    Akun ini akan digunakan untuk mengelola desa yang didaftarkan.
                </p>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Admin *</label>
                        <input type="text" name="admin_name" value="{{ old('admin_name') }}" required
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 @error('admin_name') border-red-500 @enderror"
                               placeholder="Nama lengkap admin">
                        @error('admin_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Admin *</label>
                        <input type="email" name="admin_email" value="{{ old('admin_email') }}" required
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 @error('admin_email') border-red-500 @enderror"
                               placeholder="admin@desa.id">
                        @error('admin_email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Password *</label>
                        <input type="password" name="admin_password" required
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-indigo-500 @error('admin_password') border-red-500 @enderror"
                               placeholder="Minimal 6 karakter">
                        @error('admin_password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                    <p class="text-sm text-blue-800">
                        <i class="fas fa-info-circle mr-1"></i>
                        Admin desa akan otomatis diaktifkan dan dapat langsung login setelah pendaftaran.
                    </p>
                </div>
            </div>
        </div>

        <!-- Submit -->
        <div class="mt-6 flex justify-end">
            <button type="submit" 
                    class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
                <i class="fas fa-plus mr-2"></i>
                Daftarkan Desa
            </button>
        </div>
    </form>
@endsection
