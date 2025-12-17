{{-- /resources/views/pages/user/announcements.blade.php --}}

@extends('layouts.user')

@section('title', 'Pengumuman')

@section('content')

    <div class="mb-8">
        <h1 class="text-3xl font-black text-dark-grey dark:text-white">Pengumuman Desa</h1>
        <p class="mt-1 text-text-secondary dark:text-gray-400 font-medium">Informasi terbaru dari desa Anda</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($announcements as $announcement)
        <a href="{{ route('user.announcements.show', $announcement) }}" class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden hover:shadow-md transition-shadow group">
            @if($announcement->image)
            <img src="{{ Storage::url($announcement->image) }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
            @else
            <div class="w-full h-48 bg-gray-100 dark:bg-white/5 flex items-center justify-center">
                <span class="material-symbols-outlined text-6xl text-gray-300 dark:text-gray-600">campaign</span>
            </div>
            @endif
            <div class="p-5">
                <p class="text-[10px] text-primary font-bold uppercase tracking-wider mb-2">{{ $announcement->published_at->format('d M Y') }}</p>
                <h3 class="text-lg font-bold text-dark-grey dark:text-white line-clamp-2 group-hover:text-primary transition-colors">{{ $announcement->title }}</h3>
                <p class="text-sm text-text-secondary dark:text-gray-400 mt-2 line-clamp-3">{{ $announcement->excerpt }}</p>
            </div>
        </a>
        @empty
        <div class="col-span-full p-12 text-center text-text-secondary dark:text-gray-400 bg-white dark:bg-surface-dark rounded-xl border border-border-light dark:border-border-dark">
            <span class="material-symbols-outlined text-5xl mb-3 text-gray-300 dark:text-gray-600">campaign_off</span>
            <p class="font-medium">Belum ada pengumuman saat ini</p>
        </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $announcements->links() }}
    </div>

@endsection
