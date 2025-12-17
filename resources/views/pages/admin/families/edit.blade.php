{{-- /resources/views/pages/admin/families/edit.blade.php --}}

@extends('layouts.app')

@section('title', 'Edit Kartu Keluarga')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Edit Kartu Keluarga</h1>
            <p class="mt-1 text-gray-600 font-mono">{{ $family->kk_number }}</p>
        </div>

        <nav class="text-sm mt-3 sm:mt-0" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-gray-500">
                <li><a href="{{ route('admin.dashboard') }}" class="text-indigo-600 hover:underline"><i class="fas fa-home"></i></a></li>
                <li><i class="fas fa-chevron-right text-xs"></i></li>
                <li><a href="{{ route('admin.families.index') }}" class="text-indigo-600 hover:underline">Kartu Keluarga</a></li>
                <li><i class="fas fa-chevron-right text-xs"></i></li>
                <li><span class="font-medium text-gray-700">Edit</span></li>
            </ol>
        </nav>
    </div>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Data Kartu Keluarga</h2>
        </div>
        
        <form action="{{ route('admin.families.update', $family) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="kk_number" class="block text-sm font-medium text-gray-700 mb-1">
                        Nomor KK <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="kk_number" id="kk_number" value="{{ old('kk_number', $family->kk_number) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 @error('kk_number') border-red-500 @enderror"
                           maxlength="16" pattern="[0-9]{16}" required>
                    @error('kk_number')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="head_name" class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Kepala Keluarga <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="head_name" id="head_name" value="{{ old('head_name', $family->head_name) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 @error('head_name') border-red-500 @enderror"
                           required>
                    @error('head_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="head_resident_id" class="block text-sm font-medium text-gray-700 mb-1">
                        Kepala Keluarga dari Data Penduduk
                    </label>
                    <select name="head_resident_id" id="head_resident_id"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                        <option value="">-- Pilih atau Kosongkan --</option>
                        @foreach($residents as $resident)
                            <option value="{{ $resident->id }}" {{ old('head_resident_id', $family->head_resident_id) == $resident->id ? 'selected' : '' }}>
                                {{ $resident->name }} ({{ $resident->nik }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select name="status" id="status"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                        <option value="active" {{ old('status', $family->status) === 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status', $family->status) === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-1">
                        Alamat <span class="text-red-500">*</span>
                    </label>
                    <textarea name="address" id="address" rows="2"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 @error('address') border-red-500 @enderror"
                              required>{{ old('address', $family->address) }}</textarea>
                    @error('address')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="rt" class="block text-sm font-medium text-gray-700 mb-1">RT</label>
                    <input type="text" name="rt" id="rt" value="{{ old('rt', $family->rt) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                           maxlength="5">
                </div>

                <div>
                    <label for="rw" class="block text-sm font-medium text-gray-700 mb-1">RW</label>
                    <input type="text" name="rw" id="rw" value="{{ old('rw', $family->rw) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                           maxlength="5">
                </div>
            </div>

            <div class="mt-6 flex items-center justify-end space-x-3">
                <a href="{{ route('admin.families.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                    <i class="fas fa-save mr-2"></i>Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

@endsection
