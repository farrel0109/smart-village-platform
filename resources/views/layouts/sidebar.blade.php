<!-- Sidebar -->
<aside class="fixed inset-y-0 left-0 z-40 bg-white dark:bg-surface-dark text-dark-grey dark:text-white flex flex-col transition-all duration-300 ease-in-out border-r border-border-light dark:border-border-dark lg:translate-x-0 lg:static lg:inset-auto shadow-lg lg:shadow-none"
       :class="[
           sidebarOpen ? 'translate-x-0' : '-translate-x-full',
           sidebarCollapsed ? 'lg:w-20' : 'lg:w-72',
           'w-72'
       ]">
    
    <!-- Brand Logo -->
    <div class="flex items-center h-20 px-6 border-b border-border-light dark:border-border-dark shrink-0 gap-3 transition-all duration-300"
         :class="sidebarCollapsed ? 'lg:justify-center lg:px-0' : 'justify-between'">
        
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 overflow-hidden whitespace-nowrap">
            <img src="{{ asset('img/logo-desa.png') }}" alt="Logo" class="h-10 w-auto transition-all duration-300" :class="sidebarCollapsed ? 'lg:h-8' : 'h-10'">
            <div class="transition-opacity duration-300" :class="sidebarCollapsed ? 'lg:hidden' : 'block'">
                <div class="font-black text-lg leading-none text-dark-grey dark:text-white">Desa<span class="text-primary">Pintar</span></div>
                <div class="text-[10px] font-bold text-primary tracking-wider">ADMIN PANEL</div>
            </div>
        </a>
        
        <!-- Close Button (Mobile Only) -->
        <button @click="sidebarOpen = false" class="lg:hidden ml-auto text-gray-400 hover:text-primary transition-colors">
            <span class="material-symbols-outlined">close</span>
        </button>
    </div>

    <!-- User Profile Summary (Collapsible) -->
    <div class="border-b border-border-light dark:border-border-dark transition-all duration-300"
         :class="sidebarCollapsed ? 'lg:py-4 lg:px-0' : 'px-6 py-4'">
        
        <div class="flex items-center gap-3" :class="sidebarCollapsed ? 'lg:justify-center' : ''">
            <div class="relative shrink-0">
                <div class="size-10 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold border-2 border-primary/20">
                    {{ substr(auth()->user()->name, 0, 1) }}
                </div>
                <div class="absolute bottom-0 right-0 size-3 bg-green-500 border-2 border-white dark:border-surface-dark rounded-full"></div>
            </div>
            
            <div class="overflow-hidden transition-all duration-300" :class="sidebarCollapsed ? 'lg:hidden' : 'block'">
                <p class="text-sm font-bold truncate text-dark-grey dark:text-white">{{ auth()->user()->name }}</p>
                <p class="text-xs text-text-secondary dark:text-gray-400 truncate flex items-center gap-1">
                    @if(auth()->user()->isSuperAdmin())
                        <span class="material-symbols-outlined text-[14px] text-primary">verified</span> Super Admin
                    @else
                        <span class="material-symbols-outlined text-[14px]">admin_panel_settings</span> Admin Desa
                    @endif
                </p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto py-4 space-y-1 custom-scrollbar" 
         :class="sidebarCollapsed ? 'px-2' : 'px-4'">
        
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center rounded-lg transition-all duration-200 group relative"
           :class="[
               {{ request()->routeIs('admin.dashboard') ? 'true' : 'false' }} 
               ? 'bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-400' 
               : 'text-text-secondary dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-dark-grey dark:hover:text-white',
               sidebarCollapsed ? 'justify-center p-3' : 'p-3'
           ]"
           :title="sidebarCollapsed ? 'Dashboard' : ''">
            <span class="material-symbols-outlined transition-colors duration-200"
                  :class="[
                      {{ request()->routeIs('admin.dashboard') ? 'true' : 'false' }} ? 'text-primary' : 'text-gray-400 group-hover:text-primary',
                      sidebarCollapsed ? 'text-[24px]' : 'text-[22px]'
                  ]">dashboard</span>
            
            <span class="font-medium text-sm whitespace-nowrap transition-all duration-300"
                  :class="[
                      sidebarCollapsed ? 'lg:hidden' : 'ml-3 block'
                  ]">Dashboard</span>
            
            <!-- Active Indicator -->
            @if(request()->routeIs('admin.dashboard'))
                <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-primary rounded-r-full"
                     :class="sidebarCollapsed ? 'hidden' : 'block'"></div>
            @endif
        </a>

        <!-- Section Label -->
        <div class="mt-6 mb-2 transition-all duration-300" :class="sidebarCollapsed ? 'lg:hidden' : 'px-3'">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Menu Utama</p>
        </div>
        <div class="my-4 border-t border-border-light dark:border-border-dark lg:hidden" :class="sidebarCollapsed ? 'lg:block lg:mx-2' : 'hidden'"></div>

        <!-- Penduduk -->
        <a href="{{ route('admin.residents.index') }}"
           class="flex items-center rounded-lg transition-all duration-200 group relative"
           :class="[
               {{ request()->routeIs('admin.residents.*') ? 'true' : 'false' }} 
               ? 'bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-400' 
               : 'text-text-secondary dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-dark-grey dark:hover:text-white',
               sidebarCollapsed ? 'justify-center p-3' : 'p-3'
           ]"
           :title="sidebarCollapsed ? 'Data Penduduk' : ''">
            <span class="material-symbols-outlined transition-colors duration-200"
                  :class="[
                      {{ request()->routeIs('admin.residents.*') ? 'true' : 'false' }} ? 'text-primary' : 'text-gray-400 group-hover:text-primary',
                      sidebarCollapsed ? 'text-[24px]' : 'text-[22px]'
                  ]">groups</span>
            <span class="font-medium text-sm whitespace-nowrap transition-all duration-300"
                  :class="sidebarCollapsed ? 'lg:hidden' : 'ml-3 block'">Data Penduduk</span>
            @if(request()->routeIs('admin.residents.*'))
                <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-primary rounded-r-full" :class="sidebarCollapsed ? 'hidden' : 'block'"></div>
            @endif
        </a>

        <!-- Kartu Keluarga -->
        <a href="{{ route('admin.families.index') }}"
           class="flex items-center rounded-lg transition-all duration-200 group relative"
           :class="[
               {{ request()->routeIs('admin.families.*') ? 'true' : 'false' }} 
               ? 'bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-400' 
               : 'text-text-secondary dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-dark-grey dark:hover:text-white',
               sidebarCollapsed ? 'justify-center p-3' : 'p-3'
           ]"
           :title="sidebarCollapsed ? 'Kartu Keluarga' : ''">
            <span class="material-symbols-outlined transition-colors duration-200"
                  :class="[
                      {{ request()->routeIs('admin.families.*') ? 'true' : 'false' }} ? 'text-primary' : 'text-gray-400 group-hover:text-primary',
                      sidebarCollapsed ? 'text-[24px]' : 'text-[22px]'
                  ]">family_restroom</span>
            <span class="font-medium text-sm whitespace-nowrap transition-all duration-300"
                  :class="sidebarCollapsed ? 'lg:hidden' : 'ml-3 block'">Kartu Keluarga</span>
            @if(request()->routeIs('admin.families.*'))
                <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-primary rounded-r-full" :class="sidebarCollapsed ? 'hidden' : 'block'"></div>
            @endif
        </a>

        <!-- Layanan Surat -->
        <a href="{{ route('admin.letters.index') }}"
           class="flex items-center rounded-lg transition-all duration-200 group relative"
           :class="[
               {{ request()->routeIs('admin.letters.*') ? 'true' : 'false' }} 
               ? 'bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-400' 
               : 'text-text-secondary dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-dark-grey dark:hover:text-white',
               sidebarCollapsed ? 'justify-center p-3' : 'p-3'
           ]"
           :title="sidebarCollapsed ? 'Layanan Surat' : ''">
            <div class="relative">
                <span class="material-symbols-outlined transition-colors duration-200"
                      :class="[
                          {{ request()->routeIs('admin.letters.*') ? 'true' : 'false' }} ? 'text-primary' : 'text-gray-400 group-hover:text-primary',
                          sidebarCollapsed ? 'text-[24px]' : 'text-[22px]'
                      ]">description</span>
                @php
                    $pendingCount = \App\Models\LetterRequest::when(!auth()->user()->isSuperAdmin() && auth()->user()->village_id, function($q) {
                        $q->where('village_id', auth()->user()->village_id);
                    })->where('status', 'pending')->count();
                @endphp
                @if($pendingCount > 0 && request()->routeIs('admin.letters.*') == false)
                    <span class="absolute -top-1 -right-1 size-2.5 bg-red-500 rounded-full border-2 border-white dark:border-surface-dark"></span>
                @endif
            </div>
            <span class="font-medium text-sm whitespace-nowrap transition-all duration-300"
                  :class="sidebarCollapsed ? 'lg:hidden' : 'ml-3 block'">Layanan Surat</span>
            
            @if($pendingCount > 0)
                <span class="ml-auto bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full transition-all duration-300"
                      :class="sidebarCollapsed ? 'lg:hidden' : 'block'">{{ $pendingCount }}</span>
            @endif

            @if(request()->routeIs('admin.letters.*'))
                <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-primary rounded-r-full" :class="sidebarCollapsed ? 'hidden' : 'block'"></div>
            @endif
        </a>

        <!-- Section Label -->
        <div class="mt-6 mb-2 transition-all duration-300" :class="sidebarCollapsed ? 'lg:hidden' : 'px-3'">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Administrasi</p>
        </div>
        <div class="my-4 border-t border-border-light dark:border-border-dark lg:hidden" :class="sidebarCollapsed ? 'lg:block lg:mx-2' : 'hidden'"></div>

        <!-- Pengumuman -->
        <a href="{{ route('admin.announcements.index') }}"
           class="flex items-center rounded-lg transition-all duration-200 group relative"
           :class="[
               {{ request()->routeIs('admin.announcements.*') ? 'true' : 'false' }} 
               ? 'bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-400' 
               : 'text-text-secondary dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-dark-grey dark:hover:text-white',
               sidebarCollapsed ? 'justify-center p-3' : 'p-3'
           ]"
           :title="sidebarCollapsed ? 'Pengumuman' : ''">
            <span class="material-symbols-outlined transition-colors duration-200"
                  :class="[
                      {{ request()->routeIs('admin.announcements.*') ? 'true' : 'false' }} ? 'text-primary' : 'text-gray-400 group-hover:text-primary',
                      sidebarCollapsed ? 'text-[24px]' : 'text-[22px]'
                  ]">campaign</span>
            <span class="font-medium text-sm whitespace-nowrap transition-all duration-300"
                  :class="sidebarCollapsed ? 'lg:hidden' : 'ml-3 block'">Pengumuman</span>
            @if(request()->routeIs('admin.announcements.*'))
                <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-primary rounded-r-full" :class="sidebarCollapsed ? 'hidden' : 'block'"></div>
            @endif
        </a>

        <!-- Laporan -->
        <a href="{{ route('admin.reports.index') }}"
           class="flex items-center rounded-lg transition-all duration-200 group relative"
           :class="[
               {{ request()->routeIs('admin.reports.*') ? 'true' : 'false' }} 
               ? 'bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-400' 
               : 'text-text-secondary dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-dark-grey dark:hover:text-white',
               sidebarCollapsed ? 'justify-center p-3' : 'p-3'
           ]"
           :title="sidebarCollapsed ? 'Laporan' : ''">
            <span class="material-symbols-outlined transition-colors duration-200"
                  :class="[
                      {{ request()->routeIs('admin.reports.*') ? 'true' : 'false' }} ? 'text-primary' : 'text-gray-400 group-hover:text-primary',
                      sidebarCollapsed ? 'text-[24px]' : 'text-[22px]'
                  ]">bar_chart</span>
            <span class="font-medium text-sm whitespace-nowrap transition-all duration-300"
                  :class="sidebarCollapsed ? 'lg:hidden' : 'ml-3 block'">Laporan</span>
            @if(request()->routeIs('admin.reports.*'))
                <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-primary rounded-r-full" :class="sidebarCollapsed ? 'hidden' : 'block'"></div>
            @endif
        </a>

        <!-- Verifikasi User -->
        <a href="{{ route('admin.users.index') }}"
           class="flex items-center rounded-lg transition-all duration-200 group relative"
           :class="[
               {{ request()->routeIs('admin.users.*') ? 'true' : 'false' }} 
               ? 'bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-400' 
               : 'text-text-secondary dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-dark-grey dark:hover:text-white',
               sidebarCollapsed ? 'justify-center p-3' : 'p-3'
           ]"
           :title="sidebarCollapsed ? 'Verifikasi User' : ''">
            <div class="relative">
                <span class="material-symbols-outlined transition-colors duration-200"
                      :class="[
                          {{ request()->routeIs('admin.users.*') ? 'true' : 'false' }} ? 'text-primary' : 'text-gray-400 group-hover:text-primary',
                          sidebarCollapsed ? 'text-[24px]' : 'text-[22px]'
                      ]">manage_accounts</span>
                @php
                    $pendingUsers = \App\Models\User::whereHas('role', fn($q) => $q->where('name', 'user'))
                        ->when(!auth()->user()->isSuperAdmin() && auth()->user()->village_id, function($q) {
                            $q->where('village_id', auth()->user()->village_id);
                        })->where('status', 'submitted')->count();
                @endphp
                @if($pendingUsers > 0 && request()->routeIs('admin.users.*') == false)
                    <span class="absolute -top-1 -right-1 size-2.5 bg-red-500 rounded-full border-2 border-white dark:border-surface-dark"></span>
                @endif
            </div>
            <span class="font-medium text-sm whitespace-nowrap transition-all duration-300"
                  :class="sidebarCollapsed ? 'lg:hidden' : 'ml-3 block'">Verifikasi User</span>
            
            @if($pendingUsers > 0)
                <span class="ml-auto bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full transition-all duration-300"
                      :class="sidebarCollapsed ? 'lg:hidden' : 'block'">{{ $pendingUsers }}</span>
            @endif

            @if(request()->routeIs('admin.users.*'))
                <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-primary rounded-r-full" :class="sidebarCollapsed ? 'hidden' : 'block'"></div>
            @endif
        </a>

        <!-- Super Admin Section -->
        @if(auth()->user()->isSuperAdmin())
            <div class="mt-6 mb-2 transition-all duration-300" :class="sidebarCollapsed ? 'lg:hidden' : 'px-3'">
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Super Admin</p>
            </div>
            <div class="my-4 border-t border-border-light dark:border-border-dark lg:hidden" :class="sidebarCollapsed ? 'lg:block lg:mx-2' : 'hidden'"></div>

            <!-- Kelola Desa -->
            <a href="{{ route('admin.villages.index') }}"
               class="flex items-center rounded-lg transition-all duration-200 group relative"
               :class="[
                   {{ request()->routeIs('admin.villages.*') ? 'true' : 'false' }} 
                   ? 'bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-400' 
                   : 'text-text-secondary dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-dark-grey dark:hover:text-white',
                   sidebarCollapsed ? 'justify-center p-3' : 'p-3'
               ]"
               :title="sidebarCollapsed ? 'Kelola Desa' : ''">
                <span class="material-symbols-outlined transition-colors duration-200"
                      :class="[
                          {{ request()->routeIs('admin.villages.*') ? 'true' : 'false' }} ? 'text-primary' : 'text-gray-400 group-hover:text-primary',
                          sidebarCollapsed ? 'text-[24px]' : 'text-[22px]'
                      ]">location_city</span>
                <span class="font-medium text-sm whitespace-nowrap transition-all duration-300"
                      :class="sidebarCollapsed ? 'lg:hidden' : 'ml-3 block'">Kelola Desa</span>
                @if(request()->routeIs('admin.villages.*'))
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-primary rounded-r-full" :class="sidebarCollapsed ? 'hidden' : 'block'"></div>
                @endif
            </a>
        @endif

        <!-- System Section -->
        <div class="mt-6 mb-2 transition-all duration-300" :class="sidebarCollapsed ? 'lg:hidden' : 'px-3'">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">System</p>
        </div>
        <div class="my-4 border-t border-border-light dark:border-border-dark lg:hidden" :class="sidebarCollapsed ? 'lg:block lg:mx-2' : 'hidden'"></div>

        <!-- Activity Logs -->
        <a href="{{ route('admin.activity-logs.index') }}"
           class="flex items-center rounded-lg transition-all duration-200 group relative"
           :class="[
               {{ request()->routeIs('admin.activity-logs.*') ? 'true' : 'false' }} 
               ? 'bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-400' 
               : 'text-text-secondary dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-dark-grey dark:hover:text-white',
               sidebarCollapsed ? 'justify-center p-3' : 'p-3'
           ]"
           :title="sidebarCollapsed ? 'Activity Logs' : ''">
            <span class="material-symbols-outlined transition-colors duration-200"
                  :class="[
                      {{ request()->routeIs('admin.activity-logs.*') ? 'true' : 'false' }} ? 'text-primary' : 'text-gray-400 group-hover:text-primary',
                      sidebarCollapsed ? 'text-[24px]' : 'text-[22px]'
                  ]">history</span>
            <span class="font-medium text-sm whitespace-nowrap transition-all duration-300"
                  :class="sidebarCollapsed ? 'lg:hidden' : 'ml-3 block'">Activity Logs</span>
            @if(request()->routeIs('admin.activity-logs.*'))
                <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-primary rounded-r-full" :class="sidebarCollapsed ? 'hidden' : 'block'"></div>
            @endif
        </a>

        <!-- Backup -->
        <a href="{{ route('admin.backup.index') }}"
           class="flex items-center rounded-lg transition-all duration-200 group relative"
           :class="[
               {{ request()->routeIs('admin.backup.*') ? 'true' : 'false' }} 
               ? 'bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-400' 
               : 'text-text-secondary dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-dark-grey dark:hover:text-white',
               sidebarCollapsed ? 'justify-center p-3' : 'p-3'
           ]"
           :title="sidebarCollapsed ? 'Backup' : ''">
            <span class="material-symbols-outlined transition-colors duration-200"
                  :class="[
                      {{ request()->routeIs('admin.backup.*') ? 'true' : 'false' }} ? 'text-primary' : 'text-gray-400 group-hover:text-primary',
                      sidebarCollapsed ? 'text-[24px]' : 'text-[22px]'
                  ]">cloud_sync</span>
            <span class="font-medium text-sm whitespace-nowrap transition-all duration-300"
                  :class="sidebarCollapsed ? 'lg:hidden' : 'ml-3 block'">Backup</span>
            @if(request()->routeIs('admin.backup.*'))
                <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-primary rounded-r-full" :class="sidebarCollapsed ? 'hidden' : 'block'"></div>
            @endif
        </a>

        <!-- Pengaturan -->
        <a href="{{ route('admin.settings.index') }}"
           class="flex items-center rounded-lg transition-all duration-200 group relative"
           :class="[
               {{ request()->routeIs('admin.settings.*') ? 'true' : 'false' }} 
               ? 'bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-400' 
               : 'text-text-secondary dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-white/5 hover:text-dark-grey dark:hover:text-white',
               sidebarCollapsed ? 'justify-center p-3' : 'p-3'
           ]"
           :title="sidebarCollapsed ? 'Pengaturan' : ''">
            <span class="material-symbols-outlined transition-colors duration-200"
                  :class="[
                      {{ request()->routeIs('admin.settings.*') ? 'true' : 'false' }} ? 'text-primary' : 'text-gray-400 group-hover:text-primary',
                      sidebarCollapsed ? 'text-[24px]' : 'text-[22px]'
                  ]">settings</span>
            <span class="font-medium text-sm whitespace-nowrap transition-all duration-300"
                  :class="sidebarCollapsed ? 'lg:hidden' : 'ml-3 block'">Pengaturan</span>
            @if(request()->routeIs('admin.settings.*'))
                <div class="absolute left-0 top-1/2 -translate-y-1/2 w-1 h-8 bg-primary rounded-r-full" :class="sidebarCollapsed ? 'hidden' : 'block'"></div>
            @endif
        </a>
    </nav>

    <!-- Collapse Toggle Button -->
    <div class="p-4 border-t border-border-light dark:border-border-dark hidden lg:flex" 
         :class="sidebarCollapsed ? 'justify-center' : 'justify-end'">
        <button @click="toggleSidebar()" 
                class="p-2 rounded-lg text-gray-400 hover:text-primary hover:bg-gray-100 dark:hover:bg-white/5 transition-colors">
            <span class="material-symbols-outlined transition-transform duration-300"
                  :class="sidebarCollapsed ? 'rotate-180' : ''">keyboard_double_arrow_left</span>
        </button>
    </div>

    <!-- Mobile Logout (Bottom) -->
    <div class="p-4 border-t border-border-light dark:border-border-dark lg:hidden">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex items-center w-full p-2 text-red-500 hover:bg-red-50 dark:hover:bg-red-900/10 rounded-lg transition-colors">
                <span class="material-symbols-outlined">logout</span>
                <span class="ml-3 font-medium text-sm">Logout</span>
            </button>
        </form>
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
