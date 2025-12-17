{{-- /resources/views/pages/admin/import/preview.blade.php --}}

@extends('layouts.app')

@section('title', 'Preview Import')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Preview Import</h1>
            <p class="mt-1 text-gray-600">
                {{ $type === 'residents' ? 'Data Penduduk' : 'Data Keluarga' }} - 
                <span class="font-semibold">{{ $totalRows }} baris</span>
            </p>
        </div>
    </div>

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            {{ session('error') }}
        </div>
    @endif

    <!-- Preview Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden mb-6">
        <div class="p-6 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">
                <i class="fas fa-table mr-2 text-indigo-600"></i>Preview Data
            </h2>
            @if($totalRows > 50)
            <span class="text-sm text-gray-500">Menampilkan 50 dari {{ $totalRows }} baris</span>
            @endif
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        @if(!empty($data[0]))
                            @foreach(array_keys($data[0]) as $header)
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">{{ $header }}</th>
                            @endforeach
                        @endif
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($data as $index => $row)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-500">{{ $index + 1 }}</td>
                        @foreach($row as $value)
                        <td class="px-4 py-3 text-gray-800">{{ $value }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Actions -->
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.import.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>

        <div class="flex items-center space-x-4">
            <div class="text-sm text-gray-600">
                <i class="fas fa-info-circle text-blue-500 mr-1"></i>
                {{ $totalRows }} data akan diimport
            </div>
            
            <form action="{{ route('admin.import.process') }}" method="POST">
                @csrf
                <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors"
                        onclick="return confirm('Yakin ingin mengimport {{ $totalRows }} data?')">
                    <i class="fas fa-check mr-2"></i>Import Sekarang
                </button>
            </form>
        </div>
    </div>

@endsection
