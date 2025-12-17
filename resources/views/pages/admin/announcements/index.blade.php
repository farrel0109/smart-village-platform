{{-- /resources/views/pages/admin/announcements/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Pengumuman')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Pengumuman</h1>
            <p class="mt-1 text-gray-600">Kelola pengumuman dan berita desa</p>
        </div>

        <a href="{{ route('admin.announcements.create') }}" class="mt-3 sm:mt-0 inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
            <i class="fas fa-plus mr-2"></i>Buat Pengumuman
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Judul</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($announcements as $announcement)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if($announcement->image)
                                <img src="{{ Storage::url($announcement->image) }}" class="w-12 h-12 rounded-lg object-cover mr-3">
                                @else
                                <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center mr-3">
                                    <i class="fas fa-bullhorn text-gray-400"></i>
                                </div>
                                @endif
                                <div>
                                    <p class="font-medium text-gray-800">{{ $announcement->title }}</p>
                                    <p class="text-sm text-gray-500">{{ Str::limit($announcement->excerpt, 50) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full 
                                {{ $announcement->category === 'urgent' ? 'bg-red-100 text-red-800' : 
                                   ($announcement->category === 'event' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800') }}">
                                {{ $announcement->category_label }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.announcements.toggle', $announcement) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-3 py-1 text-xs font-semibold rounded-full transition-colors
                                    {{ $announcement->is_published ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-yellow-100 text-yellow-800 hover:bg-yellow-200' }}">
                                    {{ $announcement->is_published ? 'Publik' : 'Draft' }}
                                </button>
                            </form>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $announcement->created_at->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4 text-center text-sm">
                            <a href="{{ route('admin.announcements.edit', $announcement) }}" class="text-yellow-600 hover:text-yellow-800 mx-1" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.announcements.destroy', $announcement) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                            <i class="fas fa-bullhorn fa-3x mb-3 text-gray-300"></i>
                            <p>Belum ada pengumuman</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($announcements->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $announcements->links() }}
        </div>
        @endif
    </div>

@endsection
