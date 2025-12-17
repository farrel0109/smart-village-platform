<!-- Sidebar -->
<aside class="fixed inset-y-0 left-0 z-40 w-64 bg-surface-dark text-white flex flex-col transition-transform duration-300 ease-in-out border-r border-border-dark lg:translate-x-0 lg:static lg:inset-auto"
       :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
    <!-- Brand Logo -->
    <div class="flex items-center h-16 px-6 border-b border-border-dark bg-surface-dark shrink-0 gap-3">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
            <div class="size-8 text-primary">
                <svg fill="none" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 4H17.3334V17.3334H30.6666V30.6666H44V44H4V4Z" fill="currentColor"></path>
                </svg>
            </div>
            <div>
                <span class="text-lg font-bold text-white">Desa<span class="text-primary">Pintar</span></span>
            </div>
        </a>
        
        <!-- Close Button (Mobile Only) -->
        <button @click="sidebarOpen = false" class="lg:hidden ml-auto text-gray-400 hover:text-white">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>

    <!-- Admin Badge -->
    @if(auth()->user()->isSuperAdmin())
        <div class="px-6 py-3 bg-primary/10 border-b border-border-dark">
            <span class="text-xs font-bold text-primary uppercase tracking-wider flex items-center gap-2">
                <span class="material-symbols-outlined text-[16px]">verified_user</span> Super Admin
            </span>
        </div>
    @else
        <div class="px-6 py-3 bg-surface-dark border-b border-border-dark">
            <span class="text-xs font-bold text-gray-400 uppercase tracking-wider flex items-center gap-2">
                <span class="material-symbols-outlined text-[16px]">admin_panel_settings</span> Admin Desa
            </span>
            @if(auth()->user()->village)
                <p class="text-xs text-white mt-1 font-medium truncate">{{ auth()->user()->village->name }}</p>
            @endif
        </div>
    @endif

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto py-4 px-4 space-y-1">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center p-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
            <span class="material-symbols-outlined w-6 text-center {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-gray-500 group-hover:text-white' }}">dashboard</span>
            <span class="ml-3 font-medium text-sm">Dashboard</span>
        </a>

        <!-- Penduduk -->
        <a href="{{ route('admin.residents.index') }}"
           class="flex items-center p-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.residents.*') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
            <span class="material-symbols-outlined w-6 text-center {{ request()->routeIs('admin.residents.*') ? 'text-white' : 'text-gray-500 group-hover:text-white' }}">groups</span>
            <span class="ml-3 font-medium text-sm">Penduduk</span>
        </a>

        <!-- Layanan Surat -->
        <a href="{{ route('admin.letters.index') }}"
           class="flex items-center p-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.letters.*') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
            <span class="material-symbols-outlined w-6 text-center {{ request()->routeIs('admin.letters.*') ? 'text-white' : 'text-gray-500 group-hover:text-white' }}">description</span>
            <span class="ml-3 font-medium text-sm">Pengajuan Surat</span>
            @php
                $pendingCount = \App\Models\LetterRequest::when(!auth()->user()->isSuperAdmin() && auth()->user()->village_id, function($q) {
                    $q->where('village_id', auth()->user()->village_id);
                })->where('status', 'pending')->count();
            @endphp
            @if($pendingCount > 0)
                <span class="ml-auto bg-red-500 text-[10px] font-bold px-2 py-0.5 rounded-full text-white">{{ $pendingCount }}</span>
            @endif
        </a>

        <!-- User Management -->
        <a href="{{ route('admin.users.index') }}"
           class="flex items-center p-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.users.*') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
            <span class="material-symbols-outlined w-6 text-center {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-gray-500 group-hover:text-white' }}">manage_accounts</span>
            <span class="ml-3 font-medium text-sm">Verifikasi User</span>
            @php
                $pendingUsers = \App\Models\User::whereHas('role', fn($q) => $q->where('name', 'user'))
                    ->when(!auth()->user()->isSuperAdmin() && auth()->user()->village_id, function($q) {
                        $q->where('village_id', auth()->user()->village_id);
                    })->where('status', 'submitted')->count();
            @endphp
            @if($pendingUsers > 0)
                <span class="ml-auto bg-red-500 text-[10px] font-bold px-2 py-0.5 rounded-full text-white">{{ $pendingUsers }}</span>
            @endif
        </a>

        <!-- Divider -->
        <div class="border-t border-border-dark my-3"></div>

        <!-- Superadmin Only - Village Management -->
        @if(auth()->user()->isSuperAdmin())
            <p class="px-3 text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Super Admin</p>
            
            <a href="{{ route('admin.villages.index') }}"
               class="flex items-center p-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.villages.*') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
                <span class="material-symbols-outlined w-6 text-center {{ request()->routeIs('admin.villages.*') ? 'text-white' : 'text-gray-500 group-hover:text-white' }}">location_city</span>
                <span class="ml-3 font-medium text-sm">Kelola Desa</span>
            </a>
        @endif

        <!-- Divider -->
        <div class="border-t border-border-dark my-3"></div>

        <!-- Activity Logs -->
        <a href="{{ route('admin.activity-logs.index') }}"
           class="flex items-center p-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.activity-logs.*') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
            <span class="material-symbols-outlined w-6 text-center {{ request()->routeIs('admin.activity-logs.*') ? 'text-white' : 'text-gray-500 group-hover:text-white' }}">history</span>
            <span class="ml-3 font-medium text-sm">Activity Logs</span>
        </a>

        <!-- Kartu Keluarga -->
        <a href="{{ route('admin.families.index') }}"
           class="flex items-center p-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.families.*') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
            <span class="material-symbols-outlined w-6 text-center {{ request()->routeIs('admin.families.*') ? 'text-white' : 'text-gray-500 group-hover:text-white' }}">family_restroom</span>
            <span class="ml-3 font-medium text-sm">Kartu Keluarga</span>
        </a>


        <!-- Reports / Statistics -->
        <a href="{{ route('admin.reports.index') }}"
           class="flex items-center p-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.reports.*') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
            <span class="material-symbols-outlined w-6 text-center {{ request()->routeIs('admin.reports.*') ? 'text-white' : 'text-gray-500 group-hover:text-white' }}">bar_chart</span>
            <span class="ml-3 font-medium text-sm">Laporan</span>
        </a>

        <!-- Announcements -->
        <a href="{{ route('admin.announcements.index') }}"
           class="flex items-center p-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.announcements.*') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
            <span class="material-symbols-outlined w-6 text-center {{ request()->routeIs('admin.announcements.*') ? 'text-white' : 'text-gray-500 group-hover:text-white' }}">campaign</span>
            <span class="ml-3 font-medium text-sm">Pengumuman</span>
        </a>

        <!-- Backup -->
        <a href="{{ route('admin.backup.index') }}"
           class="flex items-center p-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.backup.*') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
            <span class="material-symbols-outlined w-6 text-center {{ request()->routeIs('admin.backup.*') ? 'text-white' : 'text-gray-500 group-hover:text-white' }}">cloud_sync</span>
            <span class="ml-3 font-medium text-sm">Backup</span>
        </a>

        <!-- Settings -->
        <a href="{{ route('admin.settings.index') }}"
           class="flex items-center p-3 rounded-lg transition-all duration-200 group {{ request()->routeIs('admin.settings.*') ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-gray-400 hover:bg-white/5 hover:text-white' }}">
            <span class="material-symbols-outlined w-6 text-center {{ request()->routeIs('admin.settings.*') ? 'text-white' : 'text-gray-500 group-hover:text-white' }}">settings</span>
            <span class="ml-3 font-medium text-sm">Pengaturan</span>
        </a>
    </nav>

    <!-- User Section at Bottom -->
    <div class="p-4 border-t border-border-dark shrink-0 bg-surface-dark">
        <div class="flex items-center">
            <div class="size-9 rounded-full bg-primary flex items-center justify-center text-white font-bold text-sm">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
            <div class="ml-3 flex-1 min-w-0">
                <p class="text-sm font-bold text-white truncate">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-400 truncate">{{ auth()->user()->role->name ?? 'Admin' }}</p>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="ml-2">
                @csrf
                <button type="submit" class="p-2 text-gray-400 hover:text-red-500 hover:bg-white/5 rounded-lg transition-colors" title="Logout">
                    <span class="material-symbols-outlined text-[20px]">logout</span>
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- Sidebar Backdrop for Mobile -->
<div x-show="sidebarOpen" 
     @click="sidebarOpen = false"
     x-transition:enter="transition-opacity ease-linear duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition-opacity ease-linear duration-300"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-30 bg-black/50 lg:hidden backdrop-blur-sm"
     style="display: none;"></div>
