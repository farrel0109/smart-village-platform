{{-- /resources/views/pages/user/dashboard.blade.php --}}

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <!-- Welcome Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Selamat Datang, {{ $user->name }}! 👋</h1>
        <p class="mt-1 text-gray-600">Ini adalah dashboard pribadi Anda</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl shadow-md p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Surat</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $letterStats['total'] }}</p>
                </div>
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-envelope text-indigo-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Menunggu</p>
                    <p class="text-2xl font-bold text-yellow-600">{{ $letterStats['pending'] }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Diproses</p>
                    <p class="text-2xl font-bold text-blue-600">{{ $letterStats['processing'] }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-spinner text-blue-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-md p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Selesai</p>
                    <p class="text-2xl font-bold text-green-600">{{ $letterStats['completed'] }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check text-green-600"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Letters -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-800">
                    <i class="fas fa-envelope mr-2 text-indigo-600"></i>Pengajuan Surat Terbaru
                </h2>
                <a href="{{ route('user.letters') }}" class="text-sm text-indigo-600 hover:text-indigo-800">Lihat Semua</a>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($letters as $letter)
                <div class="p-4 hover:bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-800">{{ $letter->letterType->name ?? '-' }}</p>
                            <p class="text-sm text-gray-500">{{ $letter->request_number }}</p>
                        </div>
                        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-{{ $letter->status_color }}-100 text-{{ $letter->status_color }}-800">
                            {{ $letter->status_label }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="p-8 text-center text-gray-500">
                    <i class="fas fa-inbox text-3xl mb-2 text-gray-300"></i>
                    <p>Belum ada pengajuan surat</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Announcements -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-800">
                    <i class="fas fa-bullhorn mr-2 text-indigo-600"></i>Pengumuman Terbaru
                </h2>
                <a href="{{ route('user.announcements') }}" class="text-sm text-indigo-600 hover:text-indigo-800">Lihat Semua</a>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($announcements as $announcement)
                <a href="{{ route('user.announcements.show', $announcement) }}" class="block p-4 hover:bg-gray-50">
                    <div class="flex items-start">
                        @if($announcement->image)
                        <img src="{{ Storage::url($announcement->image) }}" class="w-16 h-16 rounded-lg object-cover mr-4">
                        @else
                        <div class="w-16 h-16 rounded-lg bg-gray-100 flex items-center justify-center mr-4">
                            <i class="fas fa-newspaper text-gray-400"></i>
                        </div>
                        @endif
                        <div class="flex-1">
                            <p class="font-medium text-gray-800">{{ $announcement->title }}</p>
                            <p class="text-sm text-gray-500 mt-1">{{ $announcement->excerpt }}</p>
                            <p class="text-xs text-gray-400 mt-2">{{ $announcement->published_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </a>
                @empty
                <div class="p-8 text-center text-gray-500">
                    <i class="fas fa-bullhorn text-3xl mb-2 text-gray-300"></i>
                    <p>Belum ada pengumuman</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

@endsection
