{{-- /resources/views/pages/profile/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-black text-dark-grey dark:text-white">Profil Saya</h1>
            <p class="mt-1 text-text-secondary dark:text-gray-400">Informasi akun dan pengaturan</p>
        </div>

        <nav class="text-sm mt-3 sm:mt-0" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-text-secondary dark:text-gray-400">
                <li>
                    <a href="{{ auth()->user()->role->name === 'user' ? route('user.dashboard') : route('admin.dashboard') }}" class="text-primary hover:underline">
                        <span class="material-symbols-outlined text-[20px]">home</span>
                    </a>
                </li>
                <li>
                    <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                </li>
                <li>
                    <span class="font-bold text-dark-grey dark:text-white">Profil</span>
                </li>
            </ol>
        </nav>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Information -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
                <div class="p-6 border-b border-border-light dark:border-border-dark flex items-center justify-between">
                    <h2 class="text-lg font-bold text-dark-grey dark:text-white">Informasi Profil</h2>
                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors font-bold text-sm">
                        <span class="material-symbols-outlined text-[18px]">edit</span>Edit Profil
                    </a>
                </div>
                
                <div class="p-6">
                    <div class="space-y-5">
                        <div>
                            <label class="text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Nama Lengkap</label>
                            <p class="mt-1 text-lg font-bold text-dark-grey dark:text-white">{{ $user->name }}</p>
                        </div>

                        <div>
                            <label class="text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Email</label>
                            <p class="mt-1 text-lg text-dark-grey dark:text-white">{{ $user->email }}</p>
                        </div>

                        <div>
                            <label class="text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Role</label>
                            <p class="mt-2">
                                <span class="inline-flex items-center gap-1 px-3 py-1 text-sm font-bold rounded-full 
                                    @if($user->role->name === 'superadmin') bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400
                                    @elseif($user->role->name === 'admin') bg-sky-blue/10 text-sky-blue
                                    @else bg-primary/10 text-primary
                                    @endif">
                                    <span class="material-symbols-outlined text-[16px]">
                                        @if($user->role->name === 'superadmin') verified_user
                                        @elseif($user->role->name === 'admin') admin_panel_settings
                                        @else person
                                        @endif
                                    </span>
                                    {{ ucfirst($user->role->name) }}
                                </span>
                            </p>
                        </div>

                        @if($user->village)
                        <div>
                            <label class="text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Desa</label>
                            <p class="mt-1 text-lg text-dark-grey dark:text-white flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">location_city</span>
                                {{ $user->village->name }}
                            </p>
                        </div>
                        @endif

                        <div>
                            <label class="text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Status Akun</label>
                            <p class="mt-2">
                                <span class="inline-flex items-center gap-1 px-3 py-1 text-sm font-bold rounded-full 
                                    @if($user->status === 'approved') bg-primary/10 text-primary
                                    @elseif($user->status === 'pending' || $user->status === 'submitted') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    <span class="material-symbols-outlined text-[16px]">
                                        @if($user->status === 'approved') check_circle
                                        @elseif($user->status === 'pending' || $user->status === 'submitted') schedule
                                        @else cancel
                                        @endif
                                    </span>
                                    {{ ucfirst($user->status) }}
                                </span>
                            </p>
                        </div>

                        <div>
                            <label class="text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Terdaftar Sejak</label>
                            <p class="mt-1 text-lg text-dark-grey dark:text-white">{{ $user->created_at->format('d F Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="lg:col-span-1">
            <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
                <div class="p-6 border-b border-border-light dark:border-border-dark">
                    <h2 class="text-lg font-bold text-dark-grey dark:text-white">Pengaturan</h2>
                </div>
                
                <div class="p-4">
                    <div class="space-y-2">
                        <a href="{{ route('profile.edit') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-white/5 transition-colors group">
                            <div class="size-10 bg-primary/10 rounded-lg flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined">person_edit</span>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-bold text-dark-grey dark:text-white">Edit Profil</p>
                                <p class="text-xs text-text-secondary dark:text-gray-400">Ubah informasi akun</p>
                            </div>
                        </a>

                        <a href="{{ route('profile.edit') }}#password" class="flex items-center p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-white/5 transition-colors group">
                            <div class="size-10 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg flex items-center justify-center text-yellow-600 dark:text-yellow-400 group-hover:bg-yellow-500 group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined">key</span>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-bold text-dark-grey dark:text-white">Ubah Password</p>
                                <p class="text-xs text-text-secondary dark:text-gray-400">Keamanan akun</p>
                            </div>
                        </a>

                        <a href="{{ route('two-factor.index') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-white/5 transition-colors group">
                            <div class="size-10 bg-sky-blue/10 rounded-lg flex items-center justify-center text-sky-blue group-hover:bg-sky-blue group-hover:text-white transition-colors">
                                <span class="material-symbols-outlined">security</span>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-bold text-dark-grey dark:text-white">Two-Factor Auth</p>
                                <p class="text-xs text-text-secondary dark:text-gray-400">Keamanan tambahan</p>
                            </div>
                        </a>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full flex items-center p-3 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors text-left group">
                                <div class="size-10 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center text-red-600 dark:text-red-400 group-hover:bg-red-600 group-hover:text-white transition-colors">
                                    <span class="material-symbols-outlined">logout</span>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-bold text-red-600 dark:text-red-400">Logout</p>
                                    <p class="text-xs text-text-secondary dark:text-gray-400">Keluar dari akun</p>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Account Card -->
            <div class="mt-6 bg-gradient-to-br from-primary to-primary-hover rounded-xl shadow-lg text-white p-6">
                <div class="flex items-center mb-4">
                    <div class="size-16 bg-white/20 rounded-full flex items-center justify-center text-2xl font-black">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="ml-4">
                        <p class="font-bold text-lg">{{ $user->name }}</p>
                        <p class="text-sm text-white/80">{{ $user->email }}</p>
                    </div>
                </div>
                <div class="border-t border-white/20 pt-4">
                    <p class="text-xs text-white/70">Akun Terverifikasi</p>
                    <p class="text-sm font-bold mt-1 flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">verified</span>
                        Status: {{ ucfirst($user->status) }}
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection
