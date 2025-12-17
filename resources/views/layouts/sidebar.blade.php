<!-- Mobile Sidebar Toggle -->
<div class="lg:hidden fixed top-4 left-4 z-50">
    <button onclick="toggleSidebar()" class="p-2 rounded-md bg-indigo-600 text-white shadow-lg hover:bg-indigo-700 transition-colors">
        <i class="fas fa-bars"></i>
    </button>
</div>

<!-- Sidebar -->
<aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-64 bg-gray-900 text-white flex flex-col transform -translate-x-full lg:translate-x-0 lg:static lg:inset-auto transition-transform duration-300 ease-in-out">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="flex items-center h-16 px-4 border-b border-gray-800 bg-gray-800 shrink-0">
        <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center">
            <i class="fas fa-home text-white"></i>
        </div>
        <div class="ml-3">
            <span class="text-lg font-bold text-white">Desa<span class="text-indigo-400">Pintar</span></span>
        </div>
    </a>

    <!-- Admin Badge -->
    @if(auth()->user()->isSuperAdmin())
        <div class="px-4 py-2 bg-purple-900/50">
            <span class="text-xs font-medium text-purple-300">
                <i class="fas fa-crown mr-1"></i> Super Admin
            </span>
        </div>
    @else
        <div class="px-4 py-2 bg-indigo-900/50">
            <span class="text-xs font-medium text-indigo-300">
                <i class="fas fa-user-shield mr-1"></i> Admin Desa
            </span>
            @if(auth()->user()->village)
                <p class="text-xs text-gray-400 truncate">{{ auth()->user()->village->name }}</p>
            @endif
        </div>
    @endif

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center p-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
            <i class="fas fa-tachometer-alt w-6 text-center"></i>
            <span class="ml-3">Dashboard</span>
        </a>

        <!-- Penduduk -->
        <a href="{{ route('admin.residents.index') }}"
           class="flex items-center p-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.residents.*') ? 'bg-indigo-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
            <i class="fas fa-users w-6 text-center"></i>
            <span class="ml-3">Penduduk</span>
        </a>

        <!-- Layanan Surat -->
        <a href="{{ route('admin.letters.index') }}"
           class="flex items-center p-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.letters.*') ? 'bg-indigo-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
            <i class="fas fa-file-alt w-6 text-center"></i>
            <span class="ml-3">Pengajuan Surat</span>
            @php
                $pendingCount = \App\Models\LetterRequest::when(!auth()->user()->isSuperAdmin() && auth()->user()->village_id, function($q) {
                    $q->where('village_id', auth()->user()->village_id);
                })->where('status', 'pending')->count();
            @endphp
            @if($pendingCount > 0)
                <span class="ml-auto bg-yellow-500 text-xs px-2 py-0.5 rounded-full text-gray-900">{{ $pendingCount }}</span>
            @endif
        </a>

        <!-- User Management -->
        <a href="{{ route('admin.users.index') }}"
           class="flex items-center p-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-indigo-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
            <i class="fas fa-user-check w-6 text-center"></i>
            <span class="ml-3">Verifikasi User</span>
            @php
                $pendingUsers = \App\Models\User::whereHas('role', fn($q) => $q->where('name', 'user'))
                    ->when(!auth()->user()->isSuperAdmin() && auth()->user()->village_id, function($q) {
                        $q->where('village_id', auth()->user()->village_id);
                    })->where('status', 'submitted')->count();
            @endphp
            @if($pendingUsers > 0)
                <span class="ml-auto bg-yellow-500 text-xs px-2 py-0.5 rounded-full text-gray-900">{{ $pendingUsers }}</span>
            @endif
        </a>

        <!-- Divider -->
        <div class="border-t border-gray-800 my-3"></div>

        <!-- Superadmin Only - Village Management -->
        @if(auth()->user()->isSuperAdmin())
            <p class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Super Admin</p>
            
            <a href="{{ route('admin.villages.index') }}"
               class="flex items-center p-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.villages.*') ? 'bg-indigo-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
                <i class="fas fa-building w-6 text-center"></i>
                <span class="ml-3">Kelola Desa</span>
            </a>
        @endif

        <!-- Divider -->
        <div class="border-t border-gray-800 my-3"></div>

        <!-- Activity Logs -->
        <a href="{{ route('admin.activity-logs.index') }}"
           class="flex items-center p-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.activity-logs.*') ? 'bg-indigo-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
            <i class="fas fa-history w-6 text-center"></i>
            <span class="ml-3">Activity Logs</span>
        </a>

        <!-- Kartu Keluarga -->
        <a href="{{ route('admin.families.index') }}"
           class="flex items-center p-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.families.*') ? 'bg-indigo-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
            <i class="fas fa-house-user w-6 text-center"></i>
            <span class="ml-3">Kartu Keluarga</span>
        </a>


        <!-- Reports / Statistics -->
        <a href="{{ route('admin.reports.index') }}"
           class="flex items-center p-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.reports.*') ? 'bg-indigo-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
            <i class="fas fa-chart-bar w-6 text-center"></i>
            <span class="ml-3">Laporan</span>
        </a>

        <!-- Announcements -->
        <a href="{{ route('admin.announcements.index') }}"
           class="flex items-center p-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.announcements.*') ? 'bg-indigo-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
            <i class="fas fa-bullhorn w-6 text-center"></i>
            <span class="ml-3">Pengumuman</span>
        </a>

        <!-- Backup -->
        <a href="{{ route('admin.backup.index') }}"
           class="flex items-center p-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.backup.*') ? 'bg-indigo-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
            <i class="fas fa-database w-6 text-center"></i>
            <span class="ml-3">Backup</span>
        </a>

        <!-- Settings -->
        <a href="{{ route('admin.settings.index') }}"
           class="flex items-center p-3 rounded-lg transition-colors duration-200 {{ request()->routeIs('admin.settings.*') ? 'bg-indigo-600 text-white' : 'text-gray-400 hover:bg-gray-800 hover:text-white' }}">
            <i class="fas fa-cog w-6 text-center"></i>
            <span class="ml-3">Pengaturan</span>
        </a>
    </nav>

    <!-- User Section at Bottom -->
    <div class="p-4 border-t border-gray-800 shrink-0">
        <div class="flex items-center">
            <div class="w-8 h-8 rounded-full bg-indigo-600 flex items-center justify-center">
                <i class="fas fa-user text-white text-sm"></i>
            </div>
            <div class="ml-3 flex-1 min-w-0">
                <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-400 truncate">{{ auth()->user()->role->name ?? 'Admin' }}</p>
            </div>
            <form action="{{ route('logout') }}" method="POST" class="ml-2">
                @csrf
                <button type="submit" class="p-2 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition-colors" title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- Sidebar Backdrop for Mobile -->
<div id="sidebar-backdrop" class="fixed inset-0 z-30 bg-black bg-opacity-50 lg:hidden hidden" onclick="toggleSidebar()"></div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebar-backdrop');

        sidebar.classList.toggle('-translate-x-full');
        backdrop.classList.toggle('hidden');
    }
</script>
