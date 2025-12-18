@extends('layouts.app')

@section('title', 'Daftarkan Desa Baru')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-black text-dark-grey dark:text-white">Daftarkan Desa Baru</h1>
            <p class="mt-1 text-text-secondary dark:text-gray-400">Isi data desa dan admin pengelola</p>
        </div>
        <a href="{{ route('admin.villages.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 text-dark-grey dark:text-white bg-gray-100 dark:bg-white/10 rounded-lg hover:bg-gray-200 dark:hover:bg-white/20 transition-colors font-bold mt-4 sm:mt-0">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            Kembali
        </a>
    </div>

    <form action="{{ route('admin.villages.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Village Information -->
            <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark p-6">
                <h3 class="text-lg font-bold text-dark-grey dark:text-white mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">location_city</span>
                    Informasi Desa
                </h3>

                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Nama Desa *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary @error('name') border-red-500 @enderror"
                                   placeholder="Desa Sukamaju">
                            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Kode Desa *</label>
                            <input type="text" name="code" value="{{ old('code') }}" required
                                   class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary @error('code') border-red-500 @enderror"
                                   placeholder="DSA005">
                            @error('code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Provinsi *</label>
                        <input type="text" name="province" value="{{ old('province', 'Sulawesi Selatan') }}" required
                               class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary @error('province') border-red-500 @enderror">
                        @error('province') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Kabupaten/Kota *</label>
                        <input type="text" name="regency" value="{{ old('regency') }}" required
                               class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary @error('regency') border-red-500 @enderror"
                               placeholder="Kabupaten Bone">
                        @error('regency') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Kecamatan *</label>
                        <input type="text" name="district" value="{{ old('district') }}" required
                               class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary @error('district') border-red-500 @enderror"
                               placeholder="Kecamatan Tanete Riattang">
                        @error('district') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Alamat Kantor Desa</label>
                        <input type="text" name="address" value="{{ old('address') }}"
                               class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary"
                               placeholder="Jl. Desa No. 1">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Telepon</label>
                            <input type="text" name="phone" value="{{ old('phone') }}"
                                   class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary"
                                   placeholder="081234567890">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary"
                                   placeholder="admin@desa.id">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Admin Account -->
            <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark p-6">
                <h3 class="text-lg font-bold text-dark-grey dark:text-white mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">admin_panel_settings</span>
                    Akun Admin Desa
                </h3>
                <p class="text-sm text-text-secondary dark:text-gray-400 mb-4">
                    Akun ini akan digunakan untuk mengelola desa yang didaftarkan.
                </p>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Nama Admin *</label>
                        <input type="text" name="admin_name" value="{{ old('admin_name') }}" required
                               class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary @error('admin_name') border-red-500 @enderror"
                               placeholder="Nama lengkap admin">
                        @error('admin_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Email Admin *</label>
                        <input type="email" name="admin_email" value="{{ old('admin_email') }}" required
                               class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary @error('admin_email') border-red-500 @enderror"
                               placeholder="admin@desa.id">
                        @error('admin_email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Password *</label>
                        <input type="password" name="admin_password" required
                               class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary @error('admin_password') border-red-500 @enderror"
                               placeholder="Minimal 6 karakter">
                        @error('admin_password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-6 p-4 bg-sky-blue/10 rounded-lg flex items-start gap-3">
                    <span class="material-symbols-outlined text-sky-blue">info</span>
                    <p class="text-sm text-sky-blue">
                        Admin desa akan otomatis diaktifkan dan dapat langsung login setelah pendaftaran.
                    </p>
                </div>
            </div>
        </div>

        <!-- Submit -->
        <div class="mt-6 flex justify-end">
            <button type="submit" 
                    class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors font-bold">
                <span class="material-symbols-outlined">add</span>
                Daftarkan Desa
            </button>
        </div>
    </form>
@endsection
