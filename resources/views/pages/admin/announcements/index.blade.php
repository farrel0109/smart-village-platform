{{-- /resources/views/pages/admin/announcements/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Pengumuman')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-black text-dark-grey dark:text-white">Pengumuman</h1>
            <p class="mt-1 text-text-secondary dark:text-gray-400">Kelola pengumuman dan berita desa</p>
        </div>

        <a href="{{ route('admin.announcements.create') }}" class="mt-3 sm:mt-0 inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors font-bold">
            <span class="material-symbols-outlined text-[20px]">add</span>Buat Pengumuman
        </a>
    </div>

    <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-white/5 border-b border-border-light dark:border-border-dark">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light dark:divide-border-dark">
                    @forelse($announcements as $announcement)
                    <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if($announcement->image)
                                <img src="{{ Storage::url($announcement->image) }}" class="size-12 rounded-lg object-cover mr-3">
                                @else
                                <div class="size-12 rounded-lg bg-gray-100 dark:bg-white/5 flex items-center justify-center mr-3">
                                    <span class="material-symbols-outlined text-gray-400">campaign</span>
                                </div>
                                @endif
                                <div>
                                    <p class="font-bold text-dark-grey dark:text-white">{{ $announcement->title }}</p>
                                    <p class="text-sm text-text-secondary dark:text-gray-400">{{ Str::limit($announcement->excerpt, 50) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide rounded-full
                                {{ $announcement->category === 'urgent' ? 'bg-red-100 text-red-800' : 
                                   ($announcement->category === 'event' ? 'bg-sky-blue/10 text-sky-blue' : 'bg-gray-100 text-gray-800 dark:bg-white/10 dark:text-gray-300') }}">
                                <span class="material-symbols-outlined text-[14px]">
                                    {{ $announcement->category === 'urgent' ? 'priority_high' : ($announcement->category === 'event' ? 'event' : 'article') }}
                                </span>
                                {{ $announcement->category_label }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.announcements.toggle', $announcement) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-bold rounded-full transition-colors
                                    {{ $announcement->is_published ? 'bg-primary/10 text-primary hover:bg-primary/20' : 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200' }}">
                                    <span class="material-symbols-outlined text-[14px]">{{ $announcement->is_published ? 'visibility' : 'visibility_off' }}</span>
                                    {{ $announcement->is_published ? 'Publik' : 'Draft' }}
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-sm text-text-secondary dark:text-gray-400">
                            {{ $announcement->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 text-center text-sm">
                            <div class="flex items-center justify-center gap-1">
                                <a href="{{ route('admin.announcements.edit', $announcement) }}" class="p-2 text-yellow-600 hover:bg-yellow-50 dark:hover:bg-yellow-900/20 rounded-lg transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="size-16 rounded-full bg-gray-100 dark:bg-white/5 flex items-center justify-center mx-auto mb-4">
                                <span class="material-symbols-outlined text-3xl text-gray-400">campaign</span>
                            </div>
                            <h3 class="text-lg font-bold text-dark-grey dark:text-white mb-1">Belum ada pengumuman</h3>
                            <p class="text-text-secondary dark:text-gray-400">Buat pengumuman pertama Anda.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($announcements->hasPages())
        <div class="px-6 py-4 border-t border-border-light dark:border-border-dark">
            {{ $announcements->links() }}
        </div>
        @endif
    </div>

@endsection
