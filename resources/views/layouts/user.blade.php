<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard - Desa Pintar')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    @stack('styles')
</head>
<body class="bg-background-light font-display text-dark-grey">

<!-- Navbar -->
<nav class="bg-white shadow-sm fixed w-full z-50 border-b border-border-light">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('user.dashboard') }}" class="flex items-center space-x-2">
                    <div class="size-8 text-primary">
                        <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 4H17.3334V17.3334H30.6666V30.6666H44V44H4V4Z" fill="currentColor"></path>
                        </svg>
                    </div>
                    <span class="text-lg font-bold text-dark-grey">Desa<span class="text-primary">Pintar</span></span>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center space-x-6">
                <a href="{{ route('user.dashboard') }}" 
                   class="text-sm font-bold {{ request()->routeIs('user.dashboard') ? 'text-primary' : 'text-text-secondary hover:text-primary' }} transition-colors">
                    <span class="material-symbols-outlined text-[20px] align-bottom mr-1">dashboard</span> Dashboard
                </a>
                <a href="{{ route('user.letters.index') }}" 
                   class="text-sm font-bold {{ request()->routeIs('user.letters.*') ? 'text-primary' : 'text-text-secondary hover:text-primary' }} transition-colors">
                    <span class="material-symbols-outlined text-[20px] align-bottom mr-1">description</span> Pengajuan Surat
                </a>
            </div>

            <div class="flex items-center space-x-4">
                <span class="text-sm text-gray-600">{{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-gray-500 hover:text-red-600 transition-colors" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- Mobile Navigation -->
<div class="md:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 z-50">
    <div class="flex justify-around py-3">
        <a href="{{ route('user.dashboard') }}" 
           class="flex flex-col items-center {{ request()->routeIs('user.dashboard') ? 'text-indigo-600' : 'text-gray-500' }}">
            <i class="fas fa-home text-lg"></i>
            <span class="text-xs mt-1">Dashboard</span>
        </a>
        <a href="{{ route('user.letters.index') }}" 
           class="flex flex-col items-center {{ request()->routeIs('user.letters.*') ? 'text-indigo-600' : 'text-gray-500' }}">
            <i class="fas fa-file-alt text-lg"></i>
            <span class="text-xs mt-1">Surat</span>
        </a>
        <form action="{{ route('logout') }}" method="POST" class="flex flex-col items-center text-gray-500">
            @csrf
            <button type="submit" class="flex flex-col items-center">
                <i class="fas fa-sign-out-alt text-lg"></i>
                <span class="text-xs mt-1">Logout</span>
            </button>
        </form>
    </div>
</div>

<!-- Main Content -->
<main class="pt-20 pb-24 md:pb-8 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))
            <div data-auto-dismiss class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-600 mr-2"></i>
                    <span class="text-green-800">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @yield('content')
    </div>
</main>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@stack('scripts')
</body>
</html>
