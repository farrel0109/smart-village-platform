{{-- /resources/views/pages/admin/letter-templates/preview.blade.php --}}

@extends('layouts.app')

@section('title', 'Preview Template')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Preview Template</h1>
            <p class="mt-1 text-gray-600">{{ $letterTemplate->name }}</p>
        </div>

        <div class="mt-3 sm:mt-0 flex space-x-2">
            <a href="{{ route('admin.letter-templates.edit', $letterTemplate) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors">
                <i class="fas fa-edit mr-2"></i>Edit
            </a>
            <a href="{{ route('admin.letter-templates.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Preview -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">
                        <i class="fas fa-file-alt mr-2 text-indigo-600"></i>Hasil Preview
                    </h2>
                    <p class="text-sm text-gray-500">Dengan data contoh</p>
                </div>
                
                <div class="p-8">
                    <div class="prose max-w-none border border-gray-200 rounded-lg p-8 bg-white shadow-inner">
                        {!! $parsedContent !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Info Template</h2>
                </div>
                <div class="p-6 space-y-3">
                    <div>
                        <label class="text-sm text-gray-500">Nama</label>
                        <p class="font-medium text-gray-800">{{ $letterTemplate->name }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Jenis Surat</label>
                        <p class="font-medium text-gray-800">{{ $letterTemplate->letterType->name ?? '-' }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Status</label>
                        <p>
                            <span class="px-2 py-1 text-xs rounded-full {{ $letterTemplate->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $letterTemplate->is_active ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </p>
                    </div>
                    <div>
                        <label class="text-sm text-gray-500">Dibuat</label>
                        <p class="text-gray-800">{{ $letterTemplate->created_at->format('d F Y, H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-yellow-600 mt-0.5 mr-2"></i>
                    <div>
                        <p class="text-sm font-medium text-yellow-800">Catatan</p>
                        <p class="text-sm text-yellow-700">Preview ini menggunakan data contoh. Data sebenarnya akan diisi saat surat dicetak.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
