{{-- /resources/views/pages/admin/reports/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Laporan & Export')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-black text-dark-grey dark:text-white">Laporan & Export</h1>
            <p class="mt-1 text-text-secondary dark:text-gray-400">Export data ke format CSV</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Resident Export -->
        <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
            <div class="bg-gradient-to-r from-sky-blue to-sky-blue/80 p-6 text-white">
                <div class="flex items-center">
                    <div class="size-12 bg-white/20 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl">groups</span>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold">Data Penduduk</h3>
                        <p class="text-sm text-white/80">Export semua data penduduk</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.reports.export-residents') }}" method="GET">
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Status</label>
                        <select name="status" class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary">
                            <option value="">Semua Status</option>
                            <option value="active">Aktif</option>
                            <option value="moved">Pindah</option>
                            <option value="deceased">Meninggal</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-sky-blue text-white rounded-lg hover:bg-sky-blue/80 transition-colors font-bold">
                        <span class="material-symbols-outlined">download</span>Export CSV
                    </button>
                </form>
            </div>
        </div>

        <!-- Family Export -->
        <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
            <div class="bg-gradient-to-r from-earth to-earth/80 p-6 text-white">
                <div class="flex items-center">
                    <div class="size-12 bg-white/20 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl">family_restroom</span>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold">Kartu Keluarga</h3>
                        <p class="text-sm text-white/80">Export data Kartu Keluarga</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.reports.export-families') }}" method="GET">
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Status</label>
                        <select name="status" class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary">
                            <option value="">Semua Status</option>
                            <option value="active">Aktif</option>
                            <option value="inactive">Tidak Aktif</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-earth text-white rounded-lg hover:bg-earth/80 transition-colors font-bold">
                        <span class="material-symbols-outlined">download</span>Export CSV
                    </button>
                </form>
            </div>
        </div>

        <!-- Letter Export -->
        <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
            <div class="bg-gradient-to-r from-primary to-primary-hover p-6 text-white">
                <div class="flex items-center">
                    <div class="size-12 bg-white/20 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-2xl">mail</span>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-bold">Pengajuan Surat</h3>
                        <p class="text-sm text-white/80">Export data pengajuan surat</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.reports.export-letters') }}" method="GET">
                    <div class="grid grid-cols-2 gap-2 mb-4">
                        <div>
                            <label class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Dari</label>
                            <input type="date" name="from_date" class="w-full px-3 py-2.5 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Sampai</label>
                            <input type="date" name="to_date" class="w-full px-3 py-2.5 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white text-sm focus:ring-2 focus:ring-primary focus:border-primary">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Status</label>
                        <select name="status" class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary">
                            <option value="">Semua Status</option>
                            <option value="pending">Pending</option>
                            <option value="processing">Diproses</option>
                            <option value="completed">Selesai</option>
                            <option value="rejected">Ditolak</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors font-bold">
                        <span class="material-symbols-outlined">download</span>Export CSV
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection
