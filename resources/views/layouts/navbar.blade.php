<!-- Top Navbar -->
<header :class="darkMode ? 'bg-gray-800 border-gray-700' : 'bg-white border-gray-200'" class="shadow-sm border-b shrink-0">
    <div class="flex items-center justify-between h-16 px-6 sticky top-0 z-50">
        <!-- Left Side - Page Title & Breadcrumb -->
        <div class="flex items-center">
            <!-- Mobile menu button placeholder (for spacing on mobile) -->
            <div class="w-10 lg:hidden"></div>
            
            <div>
                <h1 :class="darkMode ? 'text-white' : 'text-gray-800'" class="text-lg font-semibold">
                    @yield('page-title', 'Dashboard')
                </h1>
            </div>
        </div>

        <!-- Right Side - User Actions -->
        <div class="flex items-center space-x-4">
            <!-- Dark Mode Toggle -->
            <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)" 
                    class="p-2 rounded-lg transition-colors"
                    :class="darkMode ? 'text-yellow-400 hover:bg-gray-700' : 'text-gray-500 hover:bg-gray-100'">
                <i :class="darkMode ? 'fas fa-sun' : 'fas fa-moon'"></i>
            </button>
            <!-- Notifications Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors relative">
                    <i class="fas fa-bell"></i>
                    @php
                        $unreadCount = \App\Models\Notification::unreadCountForUser(auth()->id());
                    @endphp
                    @if($unreadCount > 0)
                    <span class="absolute top-0 right-0 inline-flex items-center justify-center px-1.5 py-0.5 text-xs font-bold leading-none text-white bg-red-500 rounded-full">
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
                     class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 z-50"
                     style="display: none;">
                    
                    <div class="px-4 py-3 border-b border-gray-100 flex items-center justify-between">
                        <span class="font-semibold text-gray-800">Notifikasi</span>
                        @if($unreadCount > 0)
                        <form action="{{ route('notifications.mark-all-read') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-xs text-indigo-600 hover:text-indigo-800">Tandai semua dibaca</button>
                        </form>
                        @endif
                    </div>

                    <div class="max-h-80 overflow-y-auto">
                        @php
                            $notifications = \App\Models\Notification::where('user_id', auth()->id())->latest()->take(5)->get();
                        @endphp
                        @forelse($notifications as $notification)
                        <a href="{{ route('notifications.mark-read', $notification) }}" 
                           class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100 {{ !$notification->read_at ? 'bg-indigo-50' : '' }}">
                            <div class="flex items-start">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center mr-3 {{ !$notification->read_at ? 'bg-indigo-100 text-indigo-600' : 'bg-gray-100 text-gray-500' }}">
                                    <i class="fas {{ $notification->type === 'letter_status' ? 'fa-envelope' : 'fa-user' }} text-sm"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-800 {{ !$notification->read_at ? 'font-semibold' : '' }}">{{ $notification->title }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ $notification->message }}</p>
                                    <p class="text-xs text-gray-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </a>
                        @empty
                        <div class="px-4 py-6 text-center text-gray-500 text-sm">
                            <i class="fas fa-bell-slash text-2xl mb-2 text-gray-300"></i>
                            <p>Tidak ada notifikasi</p>
                        </div>
                        @endforelse
                    </div>

                    <a href="{{ route('notifications.index') }}" class="block px-4 py-2 text-center text-sm text-indigo-600 hover:bg-gray-50 border-t border-gray-100">
                        Lihat Semua
                    </a>
                </div>
            </div>

            <!-- User Menu Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="hidden sm:flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 transition-colors">
                    <div class="text-right">
                        <div class="text-sm font-medium text-gray-800">{{ auth()->user()->name ?? 'Admin' }}</div>
                        <div class="text-xs text-gray-500">{{ auth()->user()->role->name ?? 'Administrator' }}</div>
                    </div>
                    <div class="w-9 h-9 rounded-full bg-indigo-100 flex items-center justify-center">
                        <i class="fas fa-user text-indigo-600"></i>
                    </div>
                    <i class="fas fa-chevron-down text-xs text-gray-400"></i>
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
                     class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 py-2 z-50"
                     style="display: none;">
                    
                    <div class="px-4 py-3 border-b border-gray-100">
                        <p class="text-sm font-medium text-gray-800">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ auth()->user()->email }}</p>
                    </div>

                    <a href="{{ route('profile.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                        <i class="fas fa-user-circle w-5 mr-2"></i>
                        Profil Saya
                    </a>

                    <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                        <i class="fas fa-cog w-5 mr-2"></i>
                        Pengaturan
                    </a>

                    <div class="border-t border-gray-100 my-2"></div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                            <i class="fas fa-sign-out-alt w-5 mr-2"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

