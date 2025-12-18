{{-- /resources/views/pages/profile/edit.blade.php --}}

@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-black text-dark-grey dark:text-white">Edit Profil</h1>
            <p class="mt-1 text-text-secondary dark:text-gray-400">Perbarui informasi akun Anda</p>
        </div>

        <nav class="text-sm mt-3 sm:mt-0" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-text-secondary dark:text-gray-400">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="text-primary hover:underline">
                        <span class="material-symbols-outlined text-[20px]">home</span>
                    </a>
                </li>
                <li><span class="material-symbols-outlined text-[16px]">chevron_right</span></li>
                <li><a href="{{ route('profile.index') }}" class="text-primary hover:underline">Profil</a></li>
                <li><span class="material-symbols-outlined text-[16px]">chevron_right</span></li>
                <li><span class="font-bold text-dark-grey dark:text-white">Edit</span></li>
            </ol>
        </nav>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Edit Profile Form -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Profile Information -->
            <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
                <div class="p-6 border-b border-border-light dark:border-border-dark">
                    <h2 class="text-lg font-bold text-dark-grey dark:text-white">Informasi Profil</h2>
                    <p class="text-sm text-text-secondary dark:text-gray-400 mt-1">Perbarui nama dan email Anda</p>
                </div>
                
                <form action="{{ route('profile.update') }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <div class="space-y-5">
                        <div>
                            <label for="name" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="name" 
                                   id="name" 
                                   value="{{ old('name', $user->name) }}"
                                   class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary @error('name') border-red-500 @enderror"
                                   required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" 
                                   name="email" 
                                   id="email" 
                                   value="{{ old('email', $user->email) }}"
                                   class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary @error('email') border-red-500 @enderror"
                                   required>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-3">
                        <a href="{{ route('profile.index') }}" class="px-4 py-2.5 font-bold text-dark-grey dark:text-white bg-gray-100 dark:bg-white/10 rounded-lg hover:bg-gray-200 dark:hover:bg-white/20 transition-colors">
                            Batal
                        </a>
                        <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors font-bold">
                            <span class="material-symbols-outlined text-[20px]">save</span>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Change Password -->
            <div id="password" class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
                <div class="p-6 border-b border-border-light dark:border-border-dark">
                    <h2 class="text-lg font-bold text-dark-grey dark:text-white">Ubah Password</h2>
                    <p class="text-sm text-text-secondary dark:text-gray-400 mt-1">Pastikan akun Anda menggunakan password yang kuat</p>
                </div>
                
                <form action="{{ route('profile.update-password') }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <div class="space-y-5">
                        <div>
                            <label for="current_password" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">
                                Password Saat Ini <span class="text-red-500">*</span>
                            </label>
                            <input type="password" 
                                   name="current_password" 
                                   id="current_password" 
                                   class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary @error('current_password') border-red-500 @enderror"
                                   required>
                            @error('current_password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">
                                Password Baru <span class="text-red-500">*</span>
                            </label>
                            <input type="password" 
                                   name="password" 
                                   id="password" 
                                   class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary @error('password') border-red-500 @enderror"
                                   required>
                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-text-secondary dark:text-gray-400">Minimal 8 karakter</p>
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">
                                Konfirmasi Password Baru <span class="text-red-500">*</span>
                            </label>
                            <input type="password" 
                                   name="password_confirmation" 
                                   id="password_confirmation" 
                                   class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary"
                                   required>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end">
                        <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors font-bold">
                            <span class="material-symbols-outlined text-[20px]">key</span>Ubah Password
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Info Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-sky-blue/10 border border-sky-blue/30 rounded-xl p-6">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-sky-blue text-2xl">info</span>
                    <div>
                        <h3 class="text-sm font-bold text-sky-blue">Informasi</h3>
                        <div class="mt-2 text-sm text-sky-blue/80 space-y-2">
                            <p>• Pastikan email yang Anda gunakan aktif dan dapat diakses</p>
                            <p>• Password harus minimal 8 karakter</p>
                            <p>• Gunakan kombinasi huruf, angka, dan simbol untuk keamanan lebih baik</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark p-6">
                <h3 class="text-sm font-bold text-dark-grey dark:text-white mb-3">Data Akun</h3>
                <div class="space-y-3 text-sm text-text-secondary dark:text-gray-400">
                    <div class="flex justify-between">
                        <span>Role:</span>
                        <span class="font-bold text-dark-grey dark:text-white">{{ ucfirst($user->role->name) }}</span>
                    </div>
                    @if($user->village)
                    <div class="flex justify-between">
                        <span>Desa:</span>
                        <span class="font-bold text-dark-grey dark:text-white">{{ $user->village->name }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between">
                        <span>Status:</span>
                        <span class="font-bold text-primary">{{ ucfirst($user->status) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
