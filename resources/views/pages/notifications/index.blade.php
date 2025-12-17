{{-- /resources/views/pages/notifications/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Notifikasi')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Notifikasi</h1>
            <p class="mt-1 text-gray-600">Semua notifikasi Anda</p>
        </div>

        @if($notifications->where('read_at', null)->count() > 0)
        <form action="{{ route('notifications.mark-all-read') }}" method="POST" class="mt-3 sm:mt-0">
            @csrf
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                <i class="fas fa-check-double mr-2"></i>Tandai Semua Dibaca
            </button>
        </form>
        @endif
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        @forelse($notifications as $notification)
        <a href="{{ route('notifications.mark-read', $notification) }}" 
           class="block px-6 py-4 border-b border-gray-100 hover:bg-gray-50 transition-colors {{ !$notification->read_at ? 'bg-indigo-50' : '' }}">
            <div class="flex items-start">
                <div class="w-10 h-10 rounded-full flex items-center justify-center mr-4 {{ !$notification->read_at ? 'bg-indigo-100 text-indigo-600' : 'bg-gray-100 text-gray-500' }}">
                    @if($notification->type === 'letter_status')
                    <i class="fas fa-envelope"></i>
                    @elseif($notification->type === 'user_approval')
                    <i class="fas fa-user-check"></i>
                    @else
                    <i class="fas fa-bell"></i>
                    @endif
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-between">
                        <p class="text-base font-semibold text-gray-800 {{ !$notification->read_at ? 'font-bold' : '' }}">
                            {{ $notification->title }}
                        </p>
                        <span class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-sm text-gray-600 mt-1">{{ $notification->message }}</p>
                    @if(!$notification->read_at)
                    <span class="inline-flex items-center mt-2 text-xs text-indigo-600">
                        <i class="fas fa-circle text-[6px] mr-1"></i>Belum dibaca
                    </span>
                    @endif
                </div>
            </div>
        </a>
        @empty
        <div class="px-6 py-12 text-center text-gray-500">
            <i class="fas fa-bell-slash text-4xl mb-3 text-gray-300"></i>
            <p class="text-lg">Tidak ada notifikasi</p>
            <p class="text-sm text-gray-400 mt-1">Notifikasi akan muncul di sini</p>
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
