{{-- /resources/views/pages/admin/letter-templates/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Template Surat')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-black text-dark-grey dark:text-white">Template Surat</h1>
            <p class="mt-1 text-text-secondary dark:text-gray-400">Kelola template untuk berbagai jenis surat</p>
        </div>

        <a href="{{ route('admin.letter-templates.create') }}" class="mt-3 sm:mt-0 inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors font-bold">
            <span class="material-symbols-outlined text-[20px]">add</span>Tambah Template
        </a>
    </div>

    <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-white/5 border-b border-border-light dark:border-border-dark">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Nama Template</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Jenis Surat</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light dark:divide-border-dark">
                    @forelse($templates as $template)
                    <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="size-8 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined text-[18px]">description</span>
                                </div>
                                <span class="ml-3 text-sm font-bold text-dark-grey dark:text-white">{{ $template->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-text-secondary dark:text-gray-400">{{ $template->letterType->name ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide rounded-full {{ $template->is_active ? 'bg-primary/10 text-primary' : 'bg-gray-100 text-gray-800 dark:bg-white/10 dark:text-gray-300' }}">
                                <span class="material-symbols-outlined text-[14px]">{{ $template->is_active ? 'check_circle' : 'cancel' }}</span>
                                {{ $template->is_active ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center text-sm">
                            <div class="flex items-center justify-center gap-1">
                                <a href="{{ route('admin.letter-templates.preview', $template) }}" class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Preview">
                                    <span class="material-symbols-outlined text-[20px]">visibility</span>
                                </a>
                                <a href="{{ route('admin.letter-templates.edit', $template) }}" class="p-2 text-yellow-600 hover:bg-yellow-50 dark:hover:bg-yellow-900/20 rounded-lg transition-colors" title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <form action="{{ route('admin.letter-templates.destroy', $template) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus template ini?')">
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
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="size-16 rounded-full bg-gray-100 dark:bg-white/5 flex items-center justify-center mx-auto mb-4">
                                <span class="material-symbols-outlined text-3xl text-gray-400">description</span>
                            </div>
                            <h3 class="text-lg font-bold text-dark-grey dark:text-white mb-1">Belum ada template surat</h3>
                            <p class="text-text-secondary dark:text-gray-400">Buat template pertama untuk memulai.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($templates->hasPages())
        <div class="px-6 py-4 border-t border-border-light dark:border-border-dark">
            {{ $templates->links() }}
        </div>
        @endif
    </div>

@endsection
