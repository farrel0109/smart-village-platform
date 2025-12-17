{{-- /resources/views/pages/profile/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Profil Saya</h1>
            <p class="mt-1 text-gray-600">Informasi akun dan pengaturan</p>
        </div>

        <nav class="text-sm mt-3 sm:mt-0" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-gray-500">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="text-indigo-600 hover:underline">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li>
                    <i class="fas fa-chevron-right text-xs"></i>
                </li>
                <li>
                    <span class="font-medium text-gray-700">Profil</span>
                </li>
            </ol>
        </nav>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Profile Information -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-800">Informasi Profil</h2>
                    <a href="{{ route('profile.edit') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                        <i class="fas fa-edit mr-2"></i>Edit Profil
                    </a>
                </div>
                
                <div class="p-6">
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Nama Lengkap</label>
                            <p class="mt-1 text-lg text-gray-800">{{ $user->name }}</p>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-500">Email</label>
                            <p class="mt-1 text-lg text-gray-800">{{ $user->email }}</p>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-500">Role</label>
                            <p class="mt-1">
                                <span class="px-3 py-1 text-sm font-semibold rounded-full 
                                    @if($user->role->name === 'superadmin') bg-purple-100 text-purple-800
                                    @elseif($user->role->name === 'admin') bg-blue-100 text-blue-800
                                    @else bg-green-100 text-green-800
                                    @endif">
                                    {{ ucfirst($user->role->name) }}
                                </span>
                            </p>
                        </div>

                        @if($user->village)
                        <div>
                            <label class="text-sm font-medium text-gray-500">Desa</label>
                            <p class="mt-1 text-lg text-gray-800">{{ $user->village->name }}</p>
                        </div>
                        @endif

                        <div>
                            <label class="text-sm font-medium text-gray-500">Status Akun</label>
                            <p class="mt-1">
                                <span class="px-3 py-1 text-sm font-semibold rounded-full 
                                    @if($user->status === 'approved') bg-green-100 text-green-800
                                    @elseif($user->status === 'pending' || $user->status === 'submitted') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </p>
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-500">Terdaftar Sejak</label>
                            <p class="mt-1 text-lg text-gray-800">{{ $user->created_at->format('d F Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">Pengaturan</h2>
                </div>
                
                <div class="p-6">
                    <div class="space-y-3">
                        <a href="{{ route('profile.edit') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="flex-shrink-0 w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-user-edit text-indigo-600"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-800">Edit Profil</p>
                                <p class="text-xs text-gray-500">Ubah informasi akun</p>
                            </div>
                        </a>

                        <a href="{{ route('profile.edit') }}#password" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="flex-shrink-0 w-10 h-10 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-key text-yellow-600"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-800">Ubah Password</p>
                                <p class="text-xs text-gray-500">Keamanan akun</p>
                            </div>
                        </a>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full flex items-center p-3 rounded-lg hover:bg-red-50 transition-colors text-left">
                                <div class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-sign-out-alt text-red-600"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-red-600">Logout</p>
                                    <p class="text-xs text-gray-500">Keluar dari akun</p>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Account Info -->
            <div class="mt-6 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-md text-white p-6">
                <div class="flex items-center mb-4">
                    <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center text-2xl font-bold">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="ml-4">
                        <p class="font-semibold text-lg">{{ $user->name }}</p>
                        <p class="text-sm text-indigo-100">{{ $user->email }}</p>
                    </div>
                </div>
                <div class="border-t border-white border-opacity-20 pt-4">
                    <p class="text-xs text-indigo-100">Akun Terverifikasi</p>
                    <p class="text-sm font-medium mt-1">✓ Status: {{ ucfirst($user->status) }}</p>
                </div>
            </div>
        </div>
    </div>

@endsection
