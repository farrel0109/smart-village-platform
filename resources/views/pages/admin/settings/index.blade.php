{{-- /resources/views/pages/admin/settings/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Pengaturan Sistem')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-black text-dark-grey dark:text-white">Pengaturan Sistem</h1>
            <p class="mt-1 text-text-secondary dark:text-gray-400">Kelola pengaturan aplikasi dan informasi desa</p>
        </div>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Settings -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Village Info -->
                <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
                    <div class="p-6 border-b border-border-light dark:border-border-dark">
                        <h2 class="text-lg font-bold text-dark-grey dark:text-white flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">apartment</span>Informasi Desa
                        </h2>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        <div>
                            <label for="village_name" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Nama Desa</label>
                            <input type="text" name="village_name" id="village_name" value="{{ $settings['village_name'] }}"
                                   class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary"
                                   placeholder="Contoh: Desa Sukamaju">
                        </div>

                        <div>
                            <label for="village_head_name" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Nama Kepala Desa</label>
                            <input type="text" name="village_head_name" id="village_head_name" value="{{ $settings['village_head_name'] }}"
                                   class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary"
                                   placeholder="Contoh: H. Ahmad">
                        </div>

                        <div>
                            <label for="village_address" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Alamat Kantor Desa</label>
                            <textarea name="village_address" id="village_address" rows="2"
                                      class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary"
                                      placeholder="Contoh: Jl. Raya Sukamaju No. 1">{{ $settings['village_address'] }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="village_phone" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Telepon</label>
                                <input type="text" name="village_phone" id="village_phone" value="{{ $settings['village_phone'] }}"
                                       class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary"
                                       placeholder="Contoh: (021) 123-4567">
                            </div>
                            <div>
                                <label for="village_email" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Email</label>
                                <input type="email" name="village_email" id="village_email" value="{{ $settings['village_email'] }}"
                                       class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary"
                                       placeholder="Contoh: info@desa-sukamaju.go.id">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- App Settings -->
                <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
                    <div class="p-6 border-b border-border-light dark:border-border-dark">
                        <h2 class="text-lg font-bold text-dark-grey dark:text-white flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">settings</span>Pengaturan Aplikasi
                        </h2>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        <div>
                            <label for="app_name" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Nama Aplikasi</label>
                            <input type="text" name="app_name" id="app_name" value="{{ $settings['app_name'] }}"
                                   class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary"
                                   placeholder="Contoh: Desa Pintar">
                        </div>

                        <div>
                            <label for="app_description" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Deskripsi Aplikasi</label>
                            <textarea name="app_description" id="app_description" rows="2"
                                      class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary"
                                      placeholder="Deskripsi singkat aplikasi">{{ $settings['app_description'] }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar - Logo Upload -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
                    <div class="p-6 border-b border-border-light dark:border-border-dark">
                        <h2 class="text-lg font-bold text-dark-grey dark:text-white flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">image</span>Logo Desa
                        </h2>
                    </div>
                    
                    <div class="p-6">
                        <div class="flex flex-col items-center">
                            @if($settings['village_logo'])
                                <img src="{{ asset('storage/' . $settings['village_logo']) }}" alt="Logo Desa" 
                                     class="size-32 object-contain mb-4 border border-border-light dark:border-border-dark rounded-xl bg-white dark:bg-white/5">
                            @else
                                <div class="size-32 bg-gray-100 dark:bg-white/5 rounded-xl flex items-center justify-center mb-4">
                                    <span class="material-symbols-outlined text-5xl text-gray-300 dark:text-gray-600">image</span>
                                </div>
                            @endif

                            <div class="w-full">
                                <label class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Upload Logo Baru</label>
                                <input type="file" name="village_logo" accept="image/*"
                                       class="w-full text-sm text-text-secondary file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                                <p class="mt-2 text-xs text-text-secondary dark:text-gray-400">Maks 2MB. Format: JPG, PNG</p>
                            </div>

                            @if($settings['village_logo'])
                            <button type="button" onclick="removeLogo()" class="mt-4 inline-flex items-center gap-1 text-sm font-bold text-red-600 hover:text-red-800 transition-colors">
                                <span class="material-symbols-outlined text-[18px]">delete</span>Hapus Logo
                            </button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Save Button -->
                <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary text-white rounded-xl hover:bg-primary-hover transition-colors font-bold">
                    <span class="material-symbols-outlined">save</span>Simpan Pengaturan
                </button>
            </div>
        </div>
    </form>

    <!-- Remove Logo Form (hidden) -->
    <form id="removeLogoForm" action="{{ route('admin.settings.remove-logo') }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function removeLogo() {
            if (confirm('Yakin ingin menghapus logo?')) {
                document.getElementById('removeLogoForm').submit();
            }
        }
    </script>

@endsection
