@extends('layouts.app')

@section('title', 'Kelola Desa')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola Desa</h1>
            <p class="text-gray-600">Daftar desa yang tergabung di Desa Pintar</p>
        </div>
        <a href="{{ route('admin.villages.create') }}"
           class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors shadow-sm mt-4 sm:mt-0">
            <i class="fas fa-plus mr-2"></i>
            Daftarkan Desa Baru
        </a>
    </div>

    <!-- Villages Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($villages as $village)
            <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
                            <i class="fas fa-building text-white text-xl"></i>
                        </div>
                        <span class="px-2 py-1 text-xs rounded-full {{ $village->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $village->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>
                    
                    <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $village->name }}</h3>
                    <p class="text-sm text-gray-500 mb-4">
                        <i class="fas fa-map-marker-alt mr-1"></i>
                        {{ $village->district }}, {{ $village->regency }}
                    </p>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="bg-gray-50 rounded-lg p-3 text-center">
                            <div class="text-2xl font-bold text-indigo-600">{{ $village->users_count }}</div>
                            <div class="text-xs text-gray-500">Users</div>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-3 text-center">
                            <div class="text-2xl font-bold text-green-600">{{ $village->residents_count }}</div>
                            <div class="text-xs text-gray-500">Penduduk</div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <span class="text-xs text-gray-400">Kode: {{ $village->code }}</span>
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('admin.villages.edit', $village) }}" 
                               class="p-2 text-yellow-600 hover:bg-yellow-50 rounded-lg transition-colors" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.villages.destroy', $village) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Yakin ingin menghapus desa ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 bg-white rounded-xl shadow-sm">
                <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-building text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-1">Belum ada desa terdaftar</h3>
                <p class="text-gray-500 mb-4">Mulai dengan mendaftarkan desa pertama</p>
                <a href="{{ route('admin.villages.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    <i class="fas fa-plus mr-2"></i> Daftarkan Desa
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
