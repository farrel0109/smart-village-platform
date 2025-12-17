<!-- Top Navbar -->
<header :class="darkMode ? 'bg-surface-dark border-border-dark' : 'bg-white border-border-light'" class="shadow-sm border-b shrink-0 transition-colors duration-200">
    <div class="flex items-center justify-between h-16 px-6 sticky top-0 z-50">
        <!-- Left Side - Page Title & Breadcrumb -->
        <div class="flex items-center gap-4">
            <!-- Mobile Menu Button -->
            <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-lg text-text-secondary hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-white/5 transition-colors">
                <span class="material-symbols-outlined">menu</span>
            </button>
            
            <div>
                <h1 :class="darkMode ? 'text-white' : 'text-dark-grey'" class="text-lg font-bold tracking-tight">
                    @yield('page-title', 'Dashboard')
                </h1>
            </div>
        </div>

        <!-- Right Side - User Actions -->
        <div class="flex items-center space-x-3">
            <!-- Dark Mode Toggle -->
            <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)" 
                    class="p-2 rounded-lg transition-colors"
                    :class="darkMode ? 'text-yellow-400 hover:bg-white/10' : 'text-text-secondary hover:bg-gray-100'">
                <span class="material-symbols-outlined text-[24px]" x-text="darkMode ? 'light_mode' : 'dark_mode'"></span>
            </button>

            <!-- Notifications Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="p-2 text-text-secondary hover:text-primary hover:bg-primary/5 rounded-lg transition-colors relative">
                    <span class="material-symbols-outlined text-[24px]">notifications</span>
                    @php
                        $unreadCount = \App\Models\Notification::unreadCountForUser(auth()->id());
                    @endphp
                    @if($unreadCount > 0)
                    <span class="absolute top-1 right-1 inline-flex items-center justify-center size-4 text-[10px] font-bold leading-none text-white bg-red-500 rounded-full ring-2 ring-white dark:ring-surface-dark">
                        {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                    </span>
                    @endif
                </button>

                <!-- Notifications Dropdown -->
                <div x-show="open" 
                     @click.away="open = false"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-80 bg-white dark:bg-surface-dark rounded-xl shadow-xl border border-border-light dark:border-border-dark z-50"
                     style="display: none;">
                    
                    <div class="px-4 py-3 border-b border-border-light dark:border-border-dark flex items-center justify-between">
                        <span class="font-bold text-dark-grey dark:text-white">Notifikasi</span>
                        @if($unreadCount > 0)
                        <form action="{{ route('notifications.mark-all-read') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-xs font-bold text-primary hover:text-primary-hover">Tandai semua dibaca</button>
                        </form>
                        @endif
                    </div>

                    <div class="max-h-80 overflow-y-auto">
                        @php
                            $notifications = \App\Models\Notification::where('user_id', auth()->id())->latest()->take(5)->get();
                        @endphp
                        @forelse($notifications as $notification)
                        <a href="{{ route('notifications.mark-read', $notification) }}" 
                           class="block px-4 py-3 hover:bg-gray-50 dark:hover:bg-white/5 border-b border-border-light dark:border-border-dark {{ !$notification->read_at ? 'bg-primary/5 dark:bg-primary/10' : '' }}">
                            <div class="flex items-start">
                                <div class="size-8 rounded-full flex items-center justify-center mr-3 shrink-0 {{ !$notification->read_at ? 'bg-primary/20 text-primary' : 'bg-gray-100 dark:bg-white/10 text-gray-500 dark:text-gray-400' }}">
                                    <span class="material-symbols-outlined text-[18px]">{{ $notification->type === 'letter_status' ? 'mail' : 'person' }}</span>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-bold text-dark-grey dark:text-white {{ !$notification->read_at ? '' : 'font-medium' }}">{{ $notification->title }}</p>
                                    <p class="text-xs text-text-secondary dark:text-gray-400 truncate">{{ $notification->message }}</p>
                                    <p class="text-[10px] text-gray-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </a>
                        @empty
                        <div class="px-4 py-8 text-center text-gray-500 dark:text-gray-400 text-sm">
                            <span class="material-symbols-outlined text-4xl mb-2 text-gray-300 dark:text-gray-600">notifications_off</span>
                            <p>Tidak ada notifikasi</p>
                        </div>
                        @endforelse
                    </div>

                    <a href="{{ route('notifications.index') }}" class="block px-4 py-3 text-center text-sm font-bold text-primary hover:bg-gray-50 dark:hover:bg-white/5 rounded-b-xl transition-colors">
                        Lihat Semua
                    </a>
                </div>
            </div>

            <!-- User Menu Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="hidden sm:flex items-center space-x-3 p-1.5 pr-3 rounded-full hover:bg-gray-50 dark:hover:bg-white/5 transition-colors border border-transparent hover:border-border-light dark:hover:border-border-dark">
                    <div class="size-8 rounded-full bg-primary flex items-center justify-center text-white font-bold text-sm">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div class="text-left hidden md:block">
                        <div class="text-sm font-bold text-dark-grey dark:text-white leading-none">{{ auth()->user()->name ?? 'Admin' }}</div>
                        <div class="text-[10px] font-medium text-text-secondary dark:text-gray-400 mt-0.5">{{ auth()->user()->role->name ?? 'Administrator' }}</div>
                    </div>
                    <span class="material-symbols-outlined text-gray-400 text-[20px]">expand_more</span>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" 
                     @click.away="open = false"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-56 bg-white dark:bg-surface-dark rounded-xl shadow-xl border border-border-light dark:border-border-dark py-2 z-50"
                     style="display: none;">
                    
                    <div class="px-4 py-3 border-b border-border-light dark:border-border-dark">
                        <p class="text-sm font-bold text-dark-grey dark:text-white">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-text-secondary dark:text-gray-400">{{ auth()->user()->email }}</p>
                    </div>

                    <a href="{{ route('profile.index') }}" class="flex items-center px-4 py-2.5 text-sm font-medium text-dark-grey dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                        <span class="material-symbols-outlined text-[20px] mr-3 text-gray-400">account_circle</span>
                        Profil Saya
                    </a>

                    <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2.5 text-sm font-medium text-dark-grey dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                        <span class="material-symbols-outlined text-[20px] mr-3 text-gray-400">settings</span>
                        Pengaturan
                    </a>

                    <div class="border-t border-border-light dark:border-border-dark my-2"></div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-4 py-2.5 text-sm font-medium text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors">
                            <span class="material-symbols-outlined text-[20px] mr-3">logout</span>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
