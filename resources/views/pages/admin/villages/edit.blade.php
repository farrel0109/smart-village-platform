@extends('layouts.app')

@section('title', 'Edit Desa')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-black text-dark-grey dark:text-white">Edit Desa</h1>
            <p class="mt-1 text-text-secondary dark:text-gray-400">{{ $village->name }}</p>
        </div>
        <a href="{{ route('admin.villages.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 text-dark-grey dark:text-white bg-gray-100 dark:bg-white/10 rounded-lg hover:bg-gray-200 dark:hover:bg-white/20 transition-colors font-bold mt-4 sm:mt-0">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            Kembali
        </a>
    </div>

    <form action="{{ route('admin.villages.update', $village) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark p-6">
            <h3 class="text-lg font-bold text-dark-grey dark:text-white mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">location_city</span>
                Informasi Desa
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Nama Desa *</label>
                    <input type="text" name="name" value="{{ old('name', $village->name) }}" required
                           class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary @error('name') border-red-500 @enderror">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Kode Desa *</label>
                    <input type="text" name="code" value="{{ old('code', $village->code) }}" required
                           class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary @error('code') border-red-500 @enderror">
                    @error('code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Provinsi *</label>
                    <input type="text" name="province" value="{{ old('province', $village->province) }}" required
                           class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary @error('province') border-red-500 @enderror">
                    @error('province') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Kabupaten/Kota *</label>
                    <input type="text" name="regency" value="{{ old('regency', $village->regency) }}" required
                           class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary @error('regency') border-red-500 @enderror">
                    @error('regency') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Kecamatan *</label>
                    <input type="text" name="district" value="{{ old('district', $village->district) }}" required
                           class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary @error('district') border-red-500 @enderror">
                    @error('district') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Alamat</label>
                    <input type="text" name="address" value="{{ old('address', $village->address) }}"
                           class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary">
                </div>

                <div>
                    <label class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone', $village->phone) }}"
                           class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary">
                </div>

                <div>
                    <label class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $village->email) }}"
                           class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary">
                </div>

                <div class="md:col-span-2">
                    <label class="flex items-center cursor-pointer">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" 
                               {{ old('is_active', $village->is_active) ? 'checked' : '' }}
                               class="rounded text-primary focus:ring-primary w-5 h-5">
                        <span class="ml-3 text-sm font-bold text-dark-grey dark:text-white">Desa Aktif</span>
                    </label>
                </div>
            </div>

            <div class="mt-6 flex justify-end">
                <button type="submit" 
                        class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors font-bold">
                    <span class="material-symbols-outlined">save</span>
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
@endsection
