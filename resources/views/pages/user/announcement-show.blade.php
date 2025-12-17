{{-- /resources/views/pages/user/announcement-show.blade.php --}}

@extends('layouts.user')

@section('title', $announcement->title)

@section('content')

    <div class="max-w-4xl mx-auto">
        <!-- Back Button -->
        <a href="{{ route('user.announcements.index') }}" class="inline-flex items-center text-primary hover:text-primary-hover font-bold mb-6 group">
            <span class="material-symbols-outlined mr-2 group-hover:-translate-x-1 transition-transform">arrow_back</span>
            Kembali ke Pengumuman
        </a>

        <article class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
            @if($announcement->image)
            <img src="{{ Storage::url($announcement->image) }}" class="w-full h-64 md:h-96 object-cover">
            @endif

            <div class="p-6 md:p-8">
                <div class="flex items-center gap-3 mb-4">
                    <span class="px-3 py-1 bg-primary/10 text-primary text-xs font-bold rounded-full">Pengumuman</span>
                    <span class="text-sm text-text-secondary dark:text-gray-400">{{ $announcement->published_at->format('d F Y') }}</span>
                </div>

                <h1 class="text-2xl md:text-3xl font-black text-dark-grey dark:text-white mb-6">{{ $announcement->title }}</h1>

                <div class="prose prose-sm md:prose max-w-none dark:prose-invert">
                    {!! nl2br(e($announcement->content)) !!}
                </div>
            </div>
        </article>
    </div>

@endsection
