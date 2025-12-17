{{-- /resources/views/pages/admin/import/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Import Data')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Import Data</h1>
            <p class="mt-1 text-gray-600">Import data penduduk atau keluarga dari file CSV</p>
        </div>
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

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Import Residents -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-6 text-white">
                <div class="flex items-center">
                    <div class="w-14 h-14 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-semibold">Import Penduduk</h3>
                        <p class="text-sm text-blue-100">Upload data penduduk dari CSV</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.import.preview') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="residents">
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">File CSV</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors">
                            <input type="file" name="file" accept=".csv,.txt" required
                                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-600 hover:file:bg-blue-100">
                            <p class="mt-2 text-xs text-gray-500">Format: CSV (max 5MB)</p>
                        </div>
                    </div>

                    <div class="flex space-x-3">
                        <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-upload mr-2"></i>Upload & Preview
                        </button>
                        <a href="{{ route('admin.import.template', 'residents') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fas fa-download"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Import Families -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 p-6 text-white">
                <div class="flex items-center">
                    <div class="w-14 h-14 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-house-user text-2xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-xl font-semibold">Import Keluarga</h3>
                        <p class="text-sm text-purple-100">Upload data Kartu Keluarga dari CSV</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.import.preview') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="type" value="families">
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">File CSV</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-purple-400 transition-colors">
                            <input type="file" name="file" accept=".csv,.txt" required
                                   class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-purple-50 file:text-purple-600 hover:file:bg-purple-100">
                            <p class="mt-2 text-xs text-gray-500">Format: CSV (max 5MB)</p>
                        </div>
                    </div>

                    <div class="flex space-x-3">
                        <button type="submit" class="flex-1 px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                            <i class="fas fa-upload mr-2"></i>Upload & Preview
                        </button>
                        <a href="{{ route('admin.import.template', 'families') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fas fa-download"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Instructions -->
    <div class="mt-6 bg-white rounded-xl shadow-md p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            <i class="fas fa-info-circle text-blue-500 mr-2"></i>Petunjuk Import
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-600">
            <div>
                <h4 class="font-medium text-gray-800 mb-2">Format Penduduk:</h4>
                <ul class="list-disc list-inside space-y-1">
                    <li><strong>NIK</strong> - 16 digit (wajib, unik)</li>
                    <li><strong>Nama</strong> - Nama lengkap (wajib)</li>
                    <li><strong>Jenis Kelamin</strong> - L/P atau Laki-laki/Perempuan</li>
                    <li><strong>Tempat Lahir</strong> - Kota/kabupaten (wajib)</li>
                    <li><strong>Tanggal Lahir</strong> - Format YYYY-MM-DD (wajib)</li>
                    <li><strong>Alamat, Agama, Pekerjaan, Telepon</strong> - Opsional</li>
                </ul>
            </div>
            <div>
                <h4 class="font-medium text-gray-800 mb-2">Format Keluarga:</h4>
                <ul class="list-disc list-inside space-y-1">
                    <li><strong>No KK</strong> - 16 digit (wajib, unik)</li>
                    <li><strong>Kepala Keluarga</strong> - Nama KK (wajib)</li>
                    <li><strong>Alamat</strong> - Alamat lengkap (wajib)</li>
                    <li><strong>RT, RW</strong> - Opsional</li>
                </ul>
            </div>
        </div>
    </div>

@endsection
