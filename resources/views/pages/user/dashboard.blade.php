{{-- /resources/views/pages/user/dashboard.blade.php --}}

@extends('layouts.user')

@section('title', 'Dashboard')

@section('content')

    <!-- Welcome Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-black text-dark-grey dark:text-white">Selamat Datang, {{ $user->name }}! 👋</h1>
        <p class="mt-1 text-text-secondary dark:text-gray-400 font-medium">Ini adalah dashboard pribadi Anda</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-bold text-text-secondary dark:text-gray-400">Total Surat</p>
                    <p class="text-2xl font-black text-dark-grey dark:text-white">{{ $letterStats['total'] }}</p>
                </div>
                <div class="size-10 bg-primary/10 rounded-lg flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined">mail</span>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-bold text-text-secondary dark:text-gray-400">Menunggu</p>
                    <p class="text-2xl font-black text-yellow-600">{{ $letterStats['pending'] }}</p>
                </div>
                <div class="size-10 bg-yellow-100 rounded-lg flex items-center justify-center text-yellow-600">
                    <span class="material-symbols-outlined">schedule</span>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-bold text-text-secondary dark:text-gray-400">Diproses</p>
                    <p class="text-2xl font-black text-sky-blue">{{ $letterStats['processing'] }}</p>
                </div>
                <div class="size-10 bg-sky-blue/10 rounded-lg flex items-center justify-center text-sky-blue">
                    <span class="material-symbols-outlined">sync</span>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-bold text-text-secondary dark:text-gray-400">Selesai</p>
                    <p class="text-2xl font-black text-primary">{{ $letterStats['completed'] }}</p>
                </div>
                <div class="size-10 bg-primary/10 rounded-lg flex items-center justify-center text-primary">
                    <span class="material-symbols-outlined">check_circle</span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Letters -->
        <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
            <div class="p-6 border-b border-border-light dark:border-border-dark flex items-center justify-between">
                <h2 class="text-lg font-bold text-dark-grey dark:text-white flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">description</span> Pengajuan Surat Terbaru
                </h2>
                <a href="{{ route('user.letters.index') }}" class="text-sm font-bold text-primary hover:text-primary-hover hover:underline">Lihat Semua</a>
            </div>
            <div class="divide-y divide-border-light dark:divide-border-dark">
                @forelse($letters as $letter)
                <div class="p-4 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-bold text-dark-grey dark:text-white">{{ $letter->letterType->name ?? '-' }}</p>
                            <p class="text-sm text-text-secondary dark:text-gray-400">{{ $letter->request_number }}</p>
                        </div>
                        <span class="px-3 py-1 text-[10px] font-bold uppercase tracking-wide rounded-full 
                            @if($letter->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($letter->status === 'processing') bg-sky-blue/10 text-sky-blue
                            @elseif($letter->status === 'completed') bg-primary/10 text-primary
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ $letter->status_label }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="p-8 text-center text-text-secondary dark:text-gray-400">
                    <span class="material-symbols-outlined text-3xl mb-2 text-gray-300 dark:text-gray-600">inbox</span>
                    <p>Belum ada pengajuan surat</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Announcements -->
        <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
            <div class="p-6 border-b border-border-light dark:border-border-dark flex items-center justify-between">
                <h2 class="text-lg font-bold text-dark-grey dark:text-white flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">campaign</span> Pengumuman Terbaru
                </h2>
                <a href="{{ route('user.announcements.index') }}" class="text-sm font-bold text-primary hover:text-primary-hover hover:underline">Lihat Semua</a>
            </div>
            <div class="divide-y divide-border-light dark:divide-border-dark">
                @forelse($announcements as $announcement)
                <a href="{{ route('user.announcements.show', $announcement) }}" class="block p-4 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                    <div class="flex items-start">
                        @if($announcement->image)
                        <img src="{{ Storage::url($announcement->image) }}" class="size-16 rounded-lg object-cover mr-4 border border-border-light dark:border-border-dark">
                        @else
                        <div class="size-16 rounded-lg bg-gray-100 dark:bg-white/5 flex items-center justify-center mr-4 border border-border-light dark:border-border-dark">
                            <span class="material-symbols-outlined text-gray-400">image</span>
                        </div>
                        @endif
                        <div class="flex-1">
                            <p class="font-bold text-dark-grey dark:text-white line-clamp-1">{{ $announcement->title }}</p>
                            <p class="text-sm text-text-secondary dark:text-gray-400 mt-1 line-clamp-2">{{ $announcement->excerpt }}</p>
                            <p class="text-[10px] text-gray-400 mt-2 font-medium">{{ $announcement->published_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </a>
                @empty
                <div class="p-8 text-center text-text-secondary dark:text-gray-400">
                    <span class="material-symbols-outlined text-3xl mb-2 text-gray-300 dark:text-gray-600">campaign_off</span>
                    <p>Belum ada pengumuman</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

@endsection
