{{-- /resources/views/pages/admin/import/preview.blade.php --}}

@extends('layouts.app')

@section('title', 'Preview Import')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-black text-dark-grey dark:text-white">Preview Import</h1>
            <p class="mt-1 text-text-secondary dark:text-gray-400">
                {{ $type === 'residents' ? 'Data Penduduk' : 'Data Keluarga' }} - 
                <span class="font-bold">{{ $totalRows }} baris</span>
            </p>
        </div>
    </div>

    <!-- Preview Table -->
    <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden mb-6">
        <div class="p-6 border-b border-border-light dark:border-border-dark flex items-center justify-between">
            <h2 class="text-lg font-bold text-dark-grey dark:text-white flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">table_view</span>
                Preview Data
            </h2>
            @if($totalRows > 50)
            <span class="text-sm text-text-secondary dark:text-gray-400">Menampilkan 50 dari {{ $totalRows }} baris</span>
            @endif
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-white/5 border-b border-border-light dark:border-border-dark">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">No</th>
                        @if(!empty($data[0]))
                            @foreach(array_keys($data[0]) as $header)
                            <th class="px-4 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">{{ $header }}</th>
                            @endforeach
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light dark:divide-border-dark">
                    @foreach($data as $index => $row)
                    <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                        <td class="px-4 py-3 text-text-secondary dark:text-gray-400">{{ $index + 1 }}</td>
                        @foreach($row as $value)
                        <td class="px-4 py-3 text-dark-grey dark:text-white">{{ $value }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Actions -->
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.import.index') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-border-light dark:border-border-dark text-dark-grey dark:text-white rounded-lg hover:bg-gray-50 dark:hover:bg-white/5 transition-colors font-bold">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span>Kembali
        </a>

        <div class="flex items-center gap-4">
            <div class="text-sm text-text-secondary dark:text-gray-400 flex items-center gap-1">
                <span class="material-symbols-outlined text-[18px] text-primary">info</span>
                {{ $totalRows }} data akan diimport
            </div>
            
            <form action="{{ route('admin.import.process') }}" method="POST">
                @csrf
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-2 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors font-bold"
                        onclick="return confirm('Yakin ingin mengimport {{ $totalRows }} data?')">
                    <span class="material-symbols-outlined text-[20px]">check</span>Import Sekarang
                </button>
            </form>
        </div>
    </div>

@endsection
