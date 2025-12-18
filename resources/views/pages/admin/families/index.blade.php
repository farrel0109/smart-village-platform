{{-- /resources/views/pages/admin/families/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Kartu Keluarga')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-black text-dark-grey dark:text-white">Kartu Keluarga</h1>
            <p class="mt-1 text-text-secondary dark:text-gray-400">Kelola data Kartu Keluarga</p>
        </div>

        <a href="{{ route('admin.families.create') }}" class="mt-3 sm:mt-0 inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors font-bold">
            <span class="material-symbols-outlined text-[20px]">add</span>Tambah KK
        </a>
    </div>

    <!-- Search -->
    <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark p-4 mb-6">
        <form method="GET" action="{{ route('admin.families.index') }}" class="flex gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari No. KK atau Nama Kepala Keluarga..."
                       class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary">
            </div>
            <button type="submit" class="px-4 py-3 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors">
                <span class="material-symbols-outlined">search</span>
            </button>
        </form>
    </div>

    <!-- Families Table -->
    <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-white/5 border-b border-border-light dark:border-border-dark">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">No. KK</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Kepala Keluarga</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Alamat</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Anggota</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-surface-dark divide-y divide-border-light dark:divide-border-dark">
                    @forelse($families as $family)
                    <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-dark-grey dark:text-white">
                            {{ $family->kk_number }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="size-8 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined text-[18px]">person</span>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-bold text-dark-grey dark:text-white">{{ $family->head_name }}</div>
                                    @if($family->village)
                                    <div class="text-xs text-text-secondary dark:text-gray-400">{{ $family->village->name }}</div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-text-secondary dark:text-gray-400 max-w-xs truncate">
                            {{ $family->full_address }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide rounded-full bg-sky-blue/10 text-sky-blue">
                                <span class="material-symbols-outlined text-[14px]">groups</span>
                                {{ $family->members_count }} orang
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide rounded-full {{ $family->status === 'active' ? 'bg-primary/10 text-primary' : 'bg-gray-100 text-gray-800 dark:bg-white/10 dark:text-gray-300' }}">
                                <span class="material-symbols-outlined text-[14px]">{{ $family->status === 'active' ? 'check_circle' : 'cancel' }}</span>
                                {{ $family->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm">
                            <div class="flex items-center justify-center gap-1">
                                <a href="{{ route('admin.families.show', $family) }}" class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Detail">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </a>
                                <a href="{{ route('admin.families.edit', $family) }}" class="p-2 text-yellow-600 hover:bg-yellow-50 dark:hover:bg-yellow-900/20 rounded-lg transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('admin.families.destroy', $family) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus KK ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors" title="Hapus">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="size-16 rounded-full bg-gray-100 dark:bg-white/5 flex items-center justify-center mx-auto mb-4">
                                <span class="material-symbols-outlined text-3xl text-gray-400">family_restroom</span>
                            </div>
                            <h3 class="text-lg font-bold text-dark-grey dark:text-white mb-1">Belum ada data Kartu Keluarga</h3>
                            <p class="text-text-secondary dark:text-gray-400">Mulai dengan menambahkan KK pertama.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($families->hasPages())
        <div class="px-6 py-4 border-t border-border-light dark:border-border-dark">
            {{ $families->links() }}
        </div>
        @endif
    </div>

@endsection
