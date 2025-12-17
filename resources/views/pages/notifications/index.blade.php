{{-- /resources/views/pages/notifications/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Notifikasi')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-black text-dark-grey dark:text-white">Notifikasi</h1>
            <p class="mt-1 text-text-secondary dark:text-gray-400">Semua notifikasi Anda</p>
        </div>

        @if($notifications->where('read_at', null)->count() > 0)
        <form action="{{ route('notifications.mark-all-read') }}" method="POST" class="mt-3 sm:mt-0">
            @csrf
            <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors font-bold">
                <span class="material-symbols-outlined text-[20px]">done_all</span>Tandai Semua Dibaca
            </button>
        </form>
        @endif
    </div>

    <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
        @forelse($notifications as $notification)
        <a href="{{ route('notifications.mark-read', $notification) }}" 
           class="block px-6 py-4 border-b border-border-light dark:border-border-dark hover:bg-gray-50 dark:hover:bg-white/5 transition-colors {{ !$notification->read_at ? 'bg-primary/5 dark:bg-primary/10' : '' }}">
            <div class="flex items-start">
                <div class="size-10 rounded-full flex items-center justify-center mr-4 {{ !$notification->read_at ? 'bg-primary/20 text-primary' : 'bg-gray-100 dark:bg-white/10 text-gray-500 dark:text-gray-400' }}">
                    @if($notification->type === 'letter_status')
                    <span class="material-symbols-outlined">mail</span>
                    @elseif($notification->type === 'user_approval')
                    <span class="material-symbols-outlined">person_add</span>
                    @else
                    <span class="material-symbols-outlined">notifications</span>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-base font-bold text-dark-grey dark:text-white truncate {{ !$notification->read_at ? '' : 'font-medium' }}">
                            {{ $notification->title }}
                        </p>
                        <span class="text-xs text-gray-400 whitespace-nowrap">{{ $notification->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-sm text-text-secondary dark:text-gray-400 mt-1 line-clamp-2">{{ $notification->message }}</p>
                    @if(!$notification->read_at)
                    <span class="inline-flex items-center gap-1 mt-2 text-xs font-bold text-primary">
                        <span class="size-2 rounded-full bg-primary"></span>Belum dibaca
                    </span>
                    @endif
                </div>
            </div>
        </a>
        @empty
        <div class="px-6 py-12 text-center">
            <div class="size-16 rounded-full bg-gray-100 dark:bg-white/5 flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-3xl text-gray-400">notifications_off</span>
            </div>
            <h3 class="text-lg font-bold text-dark-grey dark:text-white mb-1">Tidak ada notifikasi</h3>
            <p class="text-text-secondary dark:text-gray-400">Notifikasi akan muncul di sini</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($notifications->hasPages())
    <div class="mt-6">
        {{ $notifications->links() }}
    </div>
    @endif

@endsection
