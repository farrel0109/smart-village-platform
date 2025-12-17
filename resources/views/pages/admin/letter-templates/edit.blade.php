{{-- /resources/views/pages/admin/letter-templates/edit.blade.php --}}

@extends('layouts.app')

@section('title', 'Edit Template Surat')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Edit Template Surat</h1>
            <p class="mt-1 text-gray-600">{{ $letterTemplate->name }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <form action="{{ route('admin.letter-templates.update', $letterTemplate) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-800">Data Template</h2>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nama Template <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name', $letterTemplate->name) }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 @error('name') border-red-500 @enderror"
                                       required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="letter_type_id" class="block text-sm font-medium text-gray-700 mb-1">
                                    Jenis Surat <span class="text-red-500">*</span>
                                </label>
                                <select name="letter_type_id" id="letter_type_id"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" required>
                                    <option value="">-- Pilih Jenis Surat --</option>
                                    @foreach($letterTypes as $type)
                                        <option value="{{ $type->id }}" {{ old('letter_type_id', $letterTemplate->letter_type_id) == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('letter_type_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-1">
                                Konten Template (HTML) <span class="text-red-500">*</span>
                            </label>
                            <textarea name="content" id="content" rows="15"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 font-mono text-sm @error('content') border-red-500 @enderror"
                                      required>{{ old('content', $letterTemplate->content) }}</textarea>
                            @error('content')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1" 
                                   {{ old('is_active', $letterTemplate->is_active) ? 'checked' : '' }}
                                   class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="is_active" class="ml-2 text-sm text-gray-700">Aktifkan template ini</label>
                        </div>
                    </div>

                    <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3">
                        <a href="{{ route('admin.letter-templates.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                            Batal
                        </a>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                            <i class="fas fa-save mr-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Placeholders Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md overflow-hidden sticky top-6">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">
                        <i class="fas fa-code mr-2 text-indigo-600"></i>Placeholder
                    </h2>
                </div>
                <div class="p-4 max-h-96 overflow-y-auto">
                    <p class="text-sm text-gray-500 mb-3">Gunakan placeholder berikut dalam konten template:</p>
                    <div class="space-y-2">
                        @foreach($placeholders as $placeholder => $description)
                        <div class="flex items-start">
                            <code class="px-2 py-1 bg-indigo-50 text-indigo-600 rounded text-xs font-mono">{{ $placeholder }}</code>
                            <span class="ml-2 text-xs text-gray-600">{{ $description }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
