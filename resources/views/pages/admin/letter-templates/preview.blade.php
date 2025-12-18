{{-- /resources/views/pages/admin/letter-templates/preview.blade.php --}}

@extends('layouts.app')

@section('title', 'Preview Template')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-black text-dark-grey dark:text-white">Preview Template</h1>
            <p class="mt-1 text-text-secondary dark:text-gray-400">{{ $letterTemplate->name }}</p>
        </div>

        <div class="mt-3 sm:mt-0 flex gap-2">
            <a href="{{ route('admin.letter-templates.edit', $letterTemplate) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors font-bold">
                <span class="material-symbols-outlined text-[20px]">edit</span>Edit
            </a>
            <a href="{{ route('admin.letter-templates.index') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-border-light dark:border-border-dark text-dark-grey dark:text-white rounded-lg hover:bg-gray-50 dark:hover:bg-white/5 transition-colors font-bold">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span>Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Preview -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
                <div class="p-6 border-b border-border-light dark:border-border-dark">
                    <h2 class="text-lg font-bold text-dark-grey dark:text-white flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">description</span>
                        Hasil Preview
                    </h2>
                    <p class="text-sm text-text-secondary dark:text-gray-400">Dengan data contoh</p>
                </div>
                
                <div class="p-8">
                    <div class="prose max-w-none border border-border-light dark:border-border-dark rounded-lg p-8 bg-white shadow-inner">
                        {!! $parsedContent !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
                <div class="p-6 border-b border-border-light dark:border-border-dark">
                    <h2 class="text-lg font-bold text-dark-grey dark:text-white">Info Template</h2>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Nama</label>
                        <p class="font-bold text-dark-grey dark:text-white mt-1">{{ $letterTemplate->name }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Jenis Surat</label>
                        <p class="font-bold text-dark-grey dark:text-white mt-1">{{ $letterTemplate->letterType->name ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Status</label>
                        <p class="mt-1">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide rounded-full {{ $letterTemplate->is_active ? 'bg-primary/10 text-primary' : 'bg-gray-100 text-gray-800 dark:bg-white/10 dark:text-gray-300' }}">
                                <span class="material-symbols-outlined text-[14px]">{{ $letterTemplate->is_active ? 'check_circle' : 'cancel' }}</span>
                                {{ $letterTemplate->is_active ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </p>
                    </div>
                    <div>
                        <label class="text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Dibuat</label>
                        <p class="text-dark-grey dark:text-white mt-1">{{ $letterTemplate->created_at->format('d F Y, H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-xl p-4">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-yellow-600 dark:text-yellow-400">info</span>
                    <div>
                        <p class="text-sm font-bold text-yellow-800 dark:text-yellow-300">Catatan</p>
                        <p class="text-sm text-yellow-700 dark:text-yellow-400">Preview ini menggunakan data contoh. Data sebenarnya akan diisi saat surat dicetak.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
