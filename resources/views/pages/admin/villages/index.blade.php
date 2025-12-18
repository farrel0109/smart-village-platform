@extends('layouts.app')

@section('title', 'Kelola Desa')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-black text-dark-grey dark:text-white">Kelola Desa</h1>
            <p class="mt-1 text-text-secondary dark:text-gray-400">Daftar desa yang tergabung di Desa Pintar</p>
        </div>
        <a href="{{ route('admin.villages.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors shadow-sm font-bold mt-4 sm:mt-0">
            <span class="material-symbols-outlined text-[20px]">add</span>
            Daftarkan Desa Baru
        </a>
    </div>

    <!-- Villages Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($villages as $village)
            <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden hover:shadow-md transition-shadow">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="size-12 rounded-xl bg-gradient-to-br from-primary to-primary-hover flex items-center justify-center">
                            <span class="material-symbols-outlined text-white text-2xl">location_city</span>
                        </div>
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide rounded-full {{ $village->is_active ? 'bg-primary/10 text-primary' : 'bg-red-100 text-red-800' }}">
                            <span class="material-symbols-outlined text-[12px]">{{ $village->is_active ? 'check_circle' : 'cancel' }}</span>
                            {{ $village->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>
                    
                    <h3 class="text-lg font-bold text-dark-grey dark:text-white mb-1">{{ $village->name }}</h3>
                    <p class="text-sm text-text-secondary dark:text-gray-400 mb-4 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[16px]">location_on</span>
                        {{ $village->district }}, {{ $village->regency }}
                    </p>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="bg-gray-50 dark:bg-white/5 rounded-lg p-3 text-center">
                            <div class="text-2xl font-black text-primary">{{ $village->users_count }}</div>
                            <div class="text-xs text-text-secondary dark:text-gray-400">Users</div>
                        </div>
                        <div class="bg-gray-50 dark:bg-white/5 rounded-lg p-3 text-center">
                            <div class="text-2xl font-black text-sky-blue">{{ $village->residents_count }}</div>
                            <div class="text-xs text-text-secondary dark:text-gray-400">Penduduk</div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-border-light dark:border-border-dark">
                        <span class="text-xs text-text-secondary dark:text-gray-400 font-mono">Kode: {{ $village->code }}</span>
                        <div class="flex items-center gap-1">
                            <a href="{{ route('admin.villages.edit', $village) }}" 
                               class="p-2 text-yellow-600 hover:bg-yellow-50 dark:hover:bg-yellow-900/20 rounded-lg transition-colors" title="Edit">
                                <span class="material-symbols-outlined text-[20px]">edit</span>
                            </a>
                            <form action="{{ route('admin.villages.destroy', $village) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Yakin ingin menghapus desa ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors" title="Hapus">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark">
                <div class="size-16 rounded-full bg-gray-100 dark:bg-white/5 flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-3xl text-gray-400">location_city</span>
                </div>
                <h3 class="text-lg font-bold text-dark-grey dark:text-white mb-1">Belum ada desa terdaftar</h3>
                <p class="text-text-secondary dark:text-gray-400 mb-4">Mulai dengan mendaftarkan desa pertama</p>
                <a href="{{ route('admin.villages.create') }}" 
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors font-bold">
                    <span class="material-symbols-outlined text-[20px]">add</span> Daftarkan Desa
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($villages->hasPages())
        <div class="mt-6">
            {{ $villages->links() }}
        </div>
    @endif
@endsection
