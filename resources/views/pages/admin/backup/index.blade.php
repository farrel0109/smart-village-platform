{{-- /resources/views/pages/admin/backup/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Backup & Restore')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-black text-dark-grey dark:text-white">Backup & Restore</h1>
            <p class="mt-1 text-text-secondary dark:text-gray-400">Kelola backup database</p>
        </div>

        <form action="{{ route('admin.backup.create') }}" method="POST" class="mt-3 sm:mt-0">
            @csrf
            <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors font-bold"
                    onclick="return confirm('Buat backup database sekarang?')">
                <span class="material-symbols-outlined text-[20px]">database</span>Buat Backup
            </button>
        </form>
    </div>

    <!-- Info Card -->
    <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-xl p-4 mb-6">
        <div class="flex items-start gap-3">
            <span class="material-symbols-outlined text-yellow-600 dark:text-yellow-400">info</span>
            <div>
                <p class="font-bold text-yellow-800 dark:text-yellow-300">Catatan Penting</p>
                <ul class="text-sm text-yellow-700 dark:text-yellow-400 mt-1 list-disc list-inside">
                    <li>Backup dilakukan secara manual, pastikan untuk backup secara berkala</li>
                    <li>File backup disimpan di server dan dapat didownload</li>
                    <li>Untuk restore, hubungi administrator sistem</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Backups Table -->
    <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
        <div class="p-6 border-b border-border-light dark:border-border-dark">
            <h2 class="text-lg font-bold text-dark-grey dark:text-white flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">inventory_2</span>
                Daftar Backup
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-white/5 border-b border-border-light dark:border-border-dark">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Nama File</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Ukuran</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light dark:divide-border-dark">
                    @forelse($backups as $backup)
                    <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="size-8 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined text-[18px]">folder_zip</span>
                                </div>
                                <span class="ml-3 font-bold text-dark-grey dark:text-white">{{ $backup['name'] }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-text-secondary dark:text-gray-400">{{ $backup['size'] }}</td>
                        <td class="px-6 py-4 text-sm text-text-secondary dark:text-gray-400">{{ $backup['date'] }}</td>
                        <td class="px-6 py-4 text-center text-sm">
                            <div class="flex items-center justify-center gap-1">
                                <a href="{{ route('admin.backup.download', $backup['name']) }}" 
                                   class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Download">
                                    <span class="material-symbols-outlined text-[20px]">download</span>
                                </a>
                                <form action="{{ route('admin.backup.destroy', $backup['name']) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Yakin ingin menghapus backup ini?')">
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
                                <span class="material-symbols-outlined text-3xl text-gray-400">database</span>
                            </div>
                            <h3 class="text-lg font-bold text-dark-grey dark:text-white mb-1">Belum ada backup tersedia</h3>
                            <p class="text-text-secondary dark:text-gray-400">Klik tombol "Buat Backup" untuk membuat backup baru</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
