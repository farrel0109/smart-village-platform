@extends('layouts.app')

@section('title', 'Tambah Penduduk')

@section('page-title', 'Tambah Penduduk')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-black text-dark-grey dark:text-white">Tambah Data Penduduk</h1>
            <p class="mt-1 text-text-secondary dark:text-gray-400">Silakan isi data penduduk baru</p>
        </div>
        <a href="{{ route('admin.residents.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 text-dark-grey dark:text-white bg-gray-100 dark:bg-white/10 rounded-lg hover:bg-gray-200 dark:hover:bg-white/20 transition-colors font-bold mt-4 sm:mt-0">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            Kembali
        </a>
    </div>

    <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark p-6">
        <form action="{{ route('admin.residents.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- NIK -->
                <div>
                    <label for="nik" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">NIK <span class="text-red-500">*</span></label>
                    <input type="text" name="nik" id="nik" maxlength="16" required
                           class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary @error('nik') border-red-500 @enderror"
                           value="{{ old('nik') }}" placeholder="Masukkan NIK (16 digit)">
                    @error('nik')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama -->
                <div>
                    <label for="name" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" required
                           class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary @error('name') border-red-500 @enderror"
                           value="{{ old('name') }}" placeholder="Masukkan nama lengkap">
                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jenis Kelamin -->
                <div>
                    <label for="gender" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                    <select name="gender" id="gender" required
                            class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary @error('gender') border-red-500 @enderror">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('gender')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tempat Lahir -->
                <div>
                    <label for="birth_place" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Tempat Lahir <span class="text-red-500">*</span></label>
                    <input type="text" name="birth_place" id="birth_place" required
                           class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary @error('birth_place') border-red-500 @enderror"
                           value="{{ old('birth_place') }}" placeholder="Masukkan tempat lahir">
                    @error('birth_place')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tanggal Lahir -->
                <div>
                    <label for="birth_date" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                    <input type="date" name="birth_date" id="birth_date" required
                           class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary @error('birth_date') border-red-500 @enderror"
                           value="{{ old('birth_date') }}">
                    @error('birth_date')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Agama -->
                <div>
                    <label for="religion" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Agama</label>
                    <input type="text" name="religion" id="religion"
                           class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary"
                           value="{{ old('religion') }}" placeholder="Masukkan agama">
                </div>

                <!-- Status Pernikahan -->
                <div>
                    <label for="marital_status" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Status Pernikahan <span class="text-red-500">*</span></label>
                    <select name="marital_status" id="marital_status" required
                            class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary @error('marital_status') border-red-500 @enderror">
                        <option value="">Pilih Status</option>
                        <option value="single" {{ old('marital_status') == 'single' ? 'selected' : '' }}>Belum Menikah</option>
                        <option value="married" {{ old('marital_status') == 'married' ? 'selected' : '' }}>Menikah</option>
                        <option value="divorced" {{ old('marital_status') == 'divorced' ? 'selected' : '' }}>Cerai</option>
                        <option value="widowed" {{ old('marital_status') == 'widowed' ? 'selected' : '' }}>Duda/Janda</option>
                    </select>
                    @error('marital_status')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pekerjaan -->
                <div>
                    <label for="occupation" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Pekerjaan</label>
                    <input type="text" name="occupation" id="occupation"
                           class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary"
                           value="{{ old('occupation') }}" placeholder="Masukkan pekerjaan">
                </div>

                <!-- No. Telepon -->
                <div>
                    <label for="phone" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">No. Telepon</label>
                    <input type="text" name="phone" id="phone" maxlength="15"
                           class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary"
                           value="{{ old('phone') }}" placeholder="Masukkan no. telepon">
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Status <span class="text-red-500">*</span></label>
                    <select name="status" id="status" required
                            class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary @error('status') border-red-500 @enderror">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="moved" {{ old('status') == 'moved' ? 'selected' : '' }}>Pindah</option>
                        <option value="deceased" {{ old('status') == 'deceased' ? 'selected' : '' }}>Meninggal</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Alamat -->
                <div class="md:col-span-2">
                    <label for="address" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Alamat <span class="text-red-500">*</span></label>
                    <textarea name="address" id="address" rows="3" required
                              class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary @error('address') border-red-500 @enderror"
                              placeholder="Masukkan alamat lengkap">{{ old('address') }}</textarea>
                    @error('address')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end mt-6 pt-6 border-t border-border-light dark:border-border-dark">
                <button type="submit"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-primary text-white font-bold rounded-lg hover:bg-primary-hover transition-colors shadow-sm">
                    <span class="material-symbols-outlined">save</span>
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
@endsection
