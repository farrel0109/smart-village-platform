{{-- /resources/views/pages/admin/families/edit.blade.php --}}

@extends('layouts.app')

@section('title', 'Edit Kartu Keluarga')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-black text-dark-grey dark:text-white">Edit Kartu Keluarga</h1>
            <p class="mt-1 text-text-secondary dark:text-gray-400 font-mono">{{ $family->kk_number }}</p>
        </div>

        <nav class="text-sm mt-3 sm:mt-0" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-text-secondary dark:text-gray-400">
                <li><a href="{{ route('admin.dashboard') }}" class="text-primary hover:underline"><span class="material-symbols-outlined text-[20px]">home</span></a></li>
                <li><span class="material-symbols-outlined text-[16px]">chevron_right</span></li>
                <li><a href="{{ route('admin.families.index') }}" class="text-primary hover:underline">Kartu Keluarga</a></li>
                <li><span class="material-symbols-outlined text-[16px]">chevron_right</span></li>
                <li><span class="font-bold text-dark-grey dark:text-white">Edit</span></li>
            </ol>
        </nav>
    </div>

    <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
        <div class="p-6 border-b border-border-light dark:border-border-dark">
            <h2 class="text-lg font-bold text-dark-grey dark:text-white flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">family_restroom</span>
                Data Kartu Keluarga
            </h2>
        </div>
        
        <form action="{{ route('admin.families.update', $family) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="kk_number" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">
                        Nomor KK <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="kk_number" id="kk_number" value="{{ old('kk_number', $family->kk_number) }}"
                           class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary @error('kk_number') border-red-500 @enderror"
                           maxlength="16" pattern="[0-9]{16}" required>
                    @error('kk_number')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="head_name" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">
                        Nama Kepala Keluarga <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="head_name" id="head_name" value="{{ old('head_name', $family->head_name) }}"
                           class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary @error('head_name') border-red-500 @enderror"
                           required>
                    @error('head_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="head_resident_id" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">
                        Kepala Keluarga dari Data Penduduk
                    </label>
                    <select name="head_resident_id" id="head_resident_id"
                            class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary">
                        <option value="">-- Pilih atau Kosongkan --</option>
                        @foreach($residents as $resident)
                            <option value="{{ $resident->id }}" {{ old('head_resident_id', $family->head_resident_id) == $resident->id ? 'selected' : '' }}>
                                {{ $resident->name }} ({{ $resident->nik }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="status" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status" id="status"
                            class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary" required>
                        <option value="active" {{ old('status', $family->status) === 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status', $family->status) === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label for="address" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">
                        Alamat <span class="text-red-500">*</span>
                    </label>
                    <textarea name="address" id="address" rows="2"
                              class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary @error('address') border-red-500 @enderror"
                              required>{{ old('address', $family->address) }}</textarea>
                    @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="rt" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">RT</label>
                    <input type="text" name="rt" id="rt" value="{{ old('rt', $family->rt) }}"
                           class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary"
                           maxlength="5">
                </div>

                <div>
                    <label for="rw" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">RW</label>
                    <input type="text" name="rw" id="rw" value="{{ old('rw', $family->rw) }}"
                           class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary"
                           maxlength="5">
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end gap-3">
                <a href="{{ route('admin.families.index') }}" class="px-4 py-2.5 font-bold text-dark-grey dark:text-white bg-gray-100 dark:bg-white/10 rounded-lg hover:bg-gray-200 dark:hover:bg-white/20 transition-colors">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors font-bold">
                    <span class="material-symbols-outlined text-[20px]">save</span>Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

@endsection
