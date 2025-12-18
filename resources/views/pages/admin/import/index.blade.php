{{-- /resources/views/pages/admin/import/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Import Data')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-black text-dark-grey dark:text-white">Import Data</h1>
            <p class="mt-1 text-text-secondary dark:text-gray-400">Import data penduduk atau keluarga dari file CSV</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Import Residents -->
        <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
            <div class="bg-gradient-to-r from-sky-blue to-sky-blue/80 p-6 text-white">
                <div class="flex items-center">
                    <div class="size-14 bg-white/20 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl">groups</span>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold">Import Penduduk</h3>
                        <p class="text-sm text-white/80">Upload data penduduk dari CSV</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.import.preview') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="residents">
                    
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-dark-grey dark:text-white mb-2">File CSV</label>
                        <div class="border-2 border-dashed border-border-light dark:border-border-dark rounded-lg p-6 text-center hover:border-sky-blue transition-colors">
                            <input type="file" name="file" accept=".csv,.txt" required
                                   class="block w-full text-sm text-text-secondary file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-sky-blue/10 file:text-sky-blue hover:file:bg-sky-blue/20">
                            <p class="mt-2 text-xs text-text-secondary dark:text-gray-400">Format: CSV (max 5MB)</p>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2 bg-sky-blue text-white rounded-lg hover:bg-sky-blue/80 transition-colors font-bold">
                            <span class="material-symbols-outlined text-[20px]">upload</span>Upload & Preview
                        </button>
                        <a href="{{ route('admin.import.template', 'residents') }}" class="inline-flex items-center justify-center px-4 py-2 border border-border-light dark:border-border-dark text-dark-grey dark:text-white rounded-lg hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                            <span class="material-symbols-outlined">download</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Import Families -->
        <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
            <div class="bg-gradient-to-r from-earth to-earth/80 p-6 text-white">
                <div class="flex items-center">
                    <div class="size-14 bg-white/20 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl">family_restroom</span>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-bold">Import Keluarga</h3>
                        <p class="text-sm text-white/80">Upload data Kartu Keluarga dari CSV</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.import.preview') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="families">
                    
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-dark-grey dark:text-white mb-2">File CSV</label>
                        <div class="border-2 border-dashed border-border-light dark:border-border-dark rounded-lg p-6 text-center hover:border-earth transition-colors">
                            <input type="file" name="file" accept=".csv,.txt" required
                                   class="block w-full text-sm text-text-secondary file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-earth/10 file:text-earth hover:file:bg-earth/20">
                            <p class="mt-2 text-xs text-text-secondary dark:text-gray-400">Format: CSV (max 5MB)</p>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2 bg-earth text-white rounded-lg hover:bg-earth/80 transition-colors font-bold">
                            <span class="material-symbols-outlined text-[20px]">upload</span>Upload & Preview
                        </button>
                        <a href="{{ route('admin.import.template', 'families') }}" class="inline-flex items-center justify-center px-4 py-2 border border-border-light dark:border-border-dark text-dark-grey dark:text-white rounded-lg hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                            <span class="material-symbols-outlined">download</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Instructions -->
    <div class="mt-6 bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark p-6">
        <h3 class="text-lg font-bold text-dark-grey dark:text-white mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary">info</span>
            Petunjuk Import
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-text-secondary dark:text-gray-400">
            <div>
                <h4 class="font-bold text-dark-grey dark:text-white mb-2">Format Penduduk:</h4>
                <ul class="list-disc list-inside space-y-1">
                    <li><strong>NIK</strong> - 16 digit (wajib, unik)</li>
                    <li><strong>Nama</strong> - Nama lengkap (wajib)</li>
                    <li><strong>Jenis Kelamin</strong> - L/P atau Laki-laki/Perempuan</li>
                    <li><strong>Tempat Lahir</strong> - Kota/kabupaten (wajib)</li>
                    <li><strong>Tanggal Lahir</strong> - Format YYYY-MM-DD (wajib)</li>
                    <li><strong>Alamat, Agama, Pekerjaan, Telepon</strong> - Opsional</li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-dark-grey dark:text-white mb-2">Format Keluarga:</h4>
                <ul class="list-disc list-inside space-y-1">
                    <li><strong>No KK</strong> - 16 digit (wajib, unik)</li>
                    <li><strong>Kepala Keluarga</strong> - Nama KK (wajib)</li>
                    <li><strong>Alamat</strong> - Alamat lengkap (wajib)</li>
                    <li><strong>RT, RW</strong> - Opsional</li>
                </ul>
            </div>
        </div>
    </div>

@endsection
