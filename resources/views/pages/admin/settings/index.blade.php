{{-- /resources/views/pages/admin/settings/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Pengaturan Sistem')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Pengaturan Sistem</h1>
            <p class="mt-1 text-gray-600">Kelola pengaturan aplikasi dan informasi desa</p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Settings -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Village Info -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-800">
                            <i class="fas fa-building mr-2 text-indigo-600"></i>Informasi Desa
                        </h2>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        <div>
                            <label for="village_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Desa</label>
                            <input type="text" name="village_name" id="village_name" value="{{ $settings['village_name'] }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                                   placeholder="Contoh: Desa Sukamaju">
                        </div>

                        <div>
                            <label for="village_head_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Kepala Desa</label>
                            <input type="text" name="village_head_name" id="village_head_name" value="{{ $settings['village_head_name'] }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                                   placeholder="Contoh: H. Ahmad">
                        </div>

                        <div>
                            <label for="village_address" class="block text-sm font-medium text-gray-700 mb-1">Alamat Kantor Desa</label>
                            <textarea name="village_address" id="village_address" rows="2"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                                      placeholder="Contoh: Jl. Raya Sukamaju No. 1">{{ $settings['village_address'] }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="village_phone" class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                                <input type="text" name="village_phone" id="village_phone" value="{{ $settings['village_phone'] }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                                       placeholder="Contoh: (021) 123-4567">
                            </div>
                            <div>
                                <label for="village_email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" name="village_email" id="village_email" value="{{ $settings['village_email'] }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                                       placeholder="Contoh: info@desa-sukamaju.go.id">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- App Settings -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-800">
                            <i class="fas fa-cog mr-2 text-indigo-600"></i>Pengaturan Aplikasi
                        </h2>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        <div>
                            <label for="app_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Aplikasi</label>
                            <input type="text" name="app_name" id="app_name" value="{{ $settings['app_name'] }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                                   placeholder="Contoh: Desa Pintar">
                        </div>

                        <div>
                            <label for="app_description" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Aplikasi</label>
                            <textarea name="app_description" id="app_description" rows="2"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
                                      placeholder="Deskripsi singkat aplikasi">{{ $settings['app_description'] }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar - Logo Upload -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-800">
                            <i class="fas fa-image mr-2 text-indigo-600"></i>Logo Desa
                        </h2>
                    </div>
                    
                    <div class="p-6">
                        <div class="flex flex-col items-center">
                            @if($settings['village_logo'])
                                <img src="{{ asset('storage/' . $settings['village_logo']) }}" alt="Logo Desa" 
                                     class="w-32 h-32 object-contain mb-4 border rounded-lg">
                            @else
                                <div class="w-32 h-32 bg-gray-100 rounded-lg flex items-center justify-center mb-4">
                                    <i class="fas fa-image text-gray-300 text-4xl"></i>
                                </div>
                            @endif

                            <div class="w-full">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Upload Logo Baru</label>
                                <input type="file" name="village_logo" accept="image/*"
                                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100">
                                <p class="mt-1 text-xs text-gray-500">Maks 2MB. Format: JPG, PNG</p>
                            </div>

                            @if($settings['village_logo'])
                            <button type="button" onclick="removeLogo()" class="mt-3 text-sm text-red-600 hover:text-red-800">
                                <i class="fas fa-trash mr-1"></i>Hapus Logo
                            </button>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Save Button -->
                <button type="submit" class="w-full px-6 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition-colors font-medium">
                    <i class="fas fa-save mr-2"></i>Simpan Pengaturan
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
