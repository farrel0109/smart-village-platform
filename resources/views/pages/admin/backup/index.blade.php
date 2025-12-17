{{-- /resources/views/pages/admin/backup/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Backup & Restore')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Backup & Restore</h1>
            <p class="mt-1 text-gray-600">Kelola backup database</p>
        </div>

        <form action="{{ route('admin.backup.create') }}" method="POST" class="mt-3 sm:mt-0">
            @csrf
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors"
                    onclick="return confirm('Buat backup database sekarang?')">
                <i class="fas fa-database mr-2"></i>Buat Backup
            </button>
        </form>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            {{ session('error') }}
        </div>
    @endif

    <!-- Info Card -->
    <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-6">
        <div class="flex items-start">
            <i class="fas fa-info-circle text-yellow-600 mt-0.5 mr-3"></i>
            <div>
                <p class="font-medium text-yellow-800">Catatan Penting</p>
                <ul class="text-sm text-yellow-700 mt-1 list-disc list-inside">
                    <li>Backup dilakukan secara manual, pastikan untuk backup secara berkala</li>
                    <li>File backup disimpan di server dan dapat didownload</li>
                    <li>Untuk restore, hubungi administrator sistem</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Backups Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-800">
                <i class="fas fa-archive mr-2 text-indigo-600"></i>Daftar Backup
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama File</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ukuran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($backups as $backup)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <i class="fas fa-file-code text-gray-400 mr-3"></i>
                                <span class="font-medium text-gray-800">{{ $backup['name'] }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $backup['size'] }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $backup['date'] }}</td>
                        <td class="px-6 py-4 text-center text-sm">
                            <a href="{{ route('admin.backup.download', $backup['name']) }}" 
                               class="text-blue-600 hover:text-blue-800 mx-1" title="Download">
                                <i class="fas fa-download"></i>
                            </a>
                            <form action="{{ route('admin.backup.destroy', $backup['name']) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Yakin ingin menghapus backup ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 mx-1" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                            <i class="fas fa-database fa-3x mb-3 text-gray-300"></i>
                            <p>Belum ada backup tersedia</p>
                            <p class="text-sm text-gray-400 mt-1">Klik tombol "Buat Backup" untuk membuat backup baru</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection
