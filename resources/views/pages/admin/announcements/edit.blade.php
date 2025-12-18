{{-- /resources/views/pages/admin/announcements/edit.blade.php --}}

@extends('layouts.app')

@section('title', 'Edit Pengumuman')

@section('content')

    <div class="max-w-3xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <div>
                <h1 class="text-3xl font-black text-dark-grey dark:text-white">Edit Pengumuman</h1>
                <p class="mt-1 text-text-secondary dark:text-gray-400">{{ $announcement->title }}</p>
            </div>
        </div>

        <form action="{{ route('admin.announcements.update', $announcement) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
                <div class="p-6 space-y-5">
                    <div>
                        <label for="title" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">
                            Judul <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title', $announcement->title) }}"
                               class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary" required>
                    </div>

                    <div>
                        <label for="category" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <select name="category" id="category" class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary" required>
                            <option value="general" {{ old('category', $announcement->category) === 'general' ? 'selected' : '' }}>Umum</option>
                            <option value="urgent" {{ old('category', $announcement->category) === 'urgent' ? 'selected' : '' }}>Penting</option>
                            <option value="event" {{ old('category', $announcement->category) === 'event' ? 'selected' : '' }}>Acara</option>
                        </select>
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">
                            Isi Pengumuman <span class="text-red-500">*</span>
                        </label>
                        <textarea name="content" id="content" rows="8"
                                  class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary" required>{{ old('content', $announcement->content) }}</textarea>
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Gambar</label>
                        @if($announcement->image)
                        <div class="mb-3">
                            <img src="{{ Storage::url($announcement->image) }}" class="w-32 h-32 object-cover rounded-lg border border-border-light dark:border-border-dark">
                        </div>
                        @endif
                        <input type="file" name="image" id="image" accept="image/*"
                               class="block w-full text-sm text-text-secondary file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="is_published" id="is_published" value="1" 
                               {{ old('is_published', $announcement->is_published) ? 'checked' : '' }}
                               class="h-5 w-5 text-primary focus:ring-primary border-border-light dark:border-border-dark rounded">
                        <label for="is_published" class="ml-3 text-sm font-bold text-dark-grey dark:text-white">Publikasikan</label>
                    </div>
                </div>

                <div class="px-6 py-4 bg-gray-50 dark:bg-white/5 border-t border-border-light dark:border-border-dark flex justify-end gap-3">
                    <a href="{{ route('admin.announcements.index') }}" class="px-4 py-2 font-bold text-dark-grey dark:text-white bg-gray-100 dark:bg-white/10 rounded-lg hover:bg-gray-200 dark:hover:bg-white/20 transition-colors">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2 bg-primary text-white font-bold rounded-lg hover:bg-primary-hover transition-colors">
                        <span class="material-symbols-outlined text-[20px]">save</span>Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>

@endsection
