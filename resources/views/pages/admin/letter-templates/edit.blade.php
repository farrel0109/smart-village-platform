{{-- /resources/views/pages/admin/letter-templates/edit.blade.php --}}

@extends('layouts.app')

@section('title', 'Edit Template Surat')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-black text-dark-grey dark:text-white">Edit Template Surat</h1>
            <p class="mt-1 text-text-secondary dark:text-gray-400">{{ $letterTemplate->name }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <form action="{{ route('admin.letter-templates.update', $letterTemplate) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
                    <div class="p-6 border-b border-border-light dark:border-border-dark">
                        <h2 class="text-lg font-bold text-dark-grey dark:text-white flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">description</span>
                            Data Template
                        </h2>
                    </div>
                    
                    <div class="p-6 space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">
                                    Nama Template <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name', $letterTemplate->name) }}"
                                       class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary @error('name') border-red-500 @enderror"
                                       required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="letter_type_id" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">
                                    Jenis Surat <span class="text-red-500">*</span>
                                </label>
                                <select name="letter_type_id" id="letter_type_id"
                                        class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary" required>
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
                            <label for="content" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">
                                Konten Template (HTML) <span class="text-red-500">*</span>
                            </label>
                            <textarea name="content" id="content" rows="15"
                                      class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary font-mono text-sm @error('content') border-red-500 @enderror"
                                      required>{{ old('content', $letterTemplate->content) }}</textarea>
                            @error('content')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" value="1" 
                                   {{ old('is_active', $letterTemplate->is_active) ? 'checked' : '' }}
                                   class="h-5 w-5 text-primary focus:ring-primary border-border-light dark:border-border-dark rounded">
                            <label for="is_active" class="ml-3 text-sm font-bold text-dark-grey dark:text-white">Aktifkan template ini</label>
                        </div>
                    </div>

                    <div class="px-6 py-4 bg-gray-50 dark:bg-white/5 border-t border-border-light dark:border-border-dark flex justify-end gap-3">
                        <a href="{{ route('admin.letter-templates.index') }}" class="px-4 py-2 font-bold text-dark-grey dark:text-white bg-gray-100 dark:bg-white/10 rounded-lg hover:bg-gray-200 dark:hover:bg-white/20 transition-colors">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center gap-2 px-5 py-2 bg-primary text-white font-bold rounded-lg hover:bg-primary-hover transition-colors">
                            <span class="material-symbols-outlined text-[20px]">save</span>Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Placeholders Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden sticky top-6">
                <div class="p-6 border-b border-border-light dark:border-border-dark">
                    <h2 class="text-lg font-bold text-dark-grey dark:text-white flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">code</span>
                        Placeholder
                    </h2>
                </div>
                <div class="p-4 max-h-96 overflow-y-auto">
                    <p class="text-sm text-text-secondary dark:text-gray-400 mb-3">Gunakan placeholder berikut dalam konten template:</p>
                    <div class="space-y-2">
                        @foreach($placeholders as $placeholder => $description)
                        <div class="flex items-start">
                            <code class="px-2 py-1 bg-primary/10 text-primary rounded text-xs font-mono">{{ $placeholder }}</code>
                            <span class="ml-2 text-xs text-text-secondary dark:text-gray-400">{{ $description }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
