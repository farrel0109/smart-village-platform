{{-- /resources/views/pages/admin/announcements/create.blade.php --}}

@extends('layouts.app')

@section('title', 'Buat Pengumuman')

@section('content')

    <div class="max-w-3xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <div>
                <h1 class="text-3xl font-black text-dark-grey dark:text-white">Buat Pengumuman</h1>
                <p class="mt-1 text-text-secondary dark:text-gray-400">Buat pengumuman baru untuk warga</p>
            </div>
        </div>

        <form action="{{ route('admin.announcements.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
                <div class="p-6 space-y-5">
                    <div>
                        <label for="title" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">
                            Judul <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                               class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary" required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select name="category" id="category" class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary" required>
                            <option value="general" {{ old('category') === 'general' ? 'selected' : '' }}>Umum</option>
                            <option value="urgent" {{ old('category') === 'urgent' ? 'selected' : '' }}>Penting</option>
                            <option value="event" {{ old('category') === 'event' ? 'selected' : '' }}>Acara</option>
                        </select>
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">
                            Isi Pengumuman <span class="text-red-500">*</span>
                        </label>
                        <textarea name="content" id="content" rows="8"
                                  class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary" required>{{ old('content') }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Gambar (Opsional)</label>
                        <input type="file" name="image" id="image" accept="image/*"
                               class="block w-full text-sm text-text-secondary file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}
                               class="h-5 w-5 text-primary focus:ring-primary border-border-light dark:border-border-dark rounded">
                        <label for="is_published" class="ml-3 text-sm font-bold text-dark-grey dark:text-white">Publikasikan langsung</label>
                    </div>
                </div>

                <div class="px-6 py-4 bg-gray-50 dark:bg-white/5 border-t border-border-light dark:border-border-dark flex justify-end gap-3">
                    <a href="{{ route('admin.announcements.index') }}" class="px-4 py-2 font-bold text-dark-grey dark:text-white bg-gray-100 dark:bg-white/10 rounded-lg hover:bg-gray-200 dark:hover:bg-white/20 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2 bg-primary text-white font-bold rounded-lg hover:bg-primary-hover transition-colors">
                        <span class="material-symbols-outlined text-[20px]">save</span>Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection
