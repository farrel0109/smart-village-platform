@extends('layouts.app')

@section('title', 'Verifikasi User')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-black text-dark-grey dark:text-white">Verifikasi User</h1>
            <p class="mt-1 text-text-secondary dark:text-gray-400">Kelola pendaftaran user baru</p>
        </div>
    </div>

    <!-- Status Tabs -->
    <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark mb-6">
        <div class="border-b border-border-light dark:border-border-dark">
            <nav class="flex -mb-px">
                <a href="{{ route('admin.users.index', ['status' => 'submitted']) }}"
                   class="px-6 py-4 text-sm font-bold flex items-center gap-2 border-b-2 transition-colors {{ $status === 'submitted' ? 'border-primary text-primary' : 'border-transparent text-text-secondary hover:text-dark-grey dark:hover:text-white' }}">
                    <span class="material-symbols-outlined text-[20px]">schedule</span>
                    Menunggu
                    @if($counts['submitted'] > 0)
                        <span class="px-2 py-0.5 text-[10px] font-bold rounded-full bg-yellow-100 text-yellow-800">{{ $counts['submitted'] }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.users.index', ['status' => 'approved']) }}"
                   class="px-6 py-4 text-sm font-bold flex items-center gap-2 border-b-2 transition-colors {{ $status === 'approved' ? 'border-primary text-primary' : 'border-transparent text-text-secondary hover:text-dark-grey dark:hover:text-white' }}">
                    <span class="material-symbols-outlined text-[20px]">check_circle</span>
                    Disetujui
                    <span class="px-2 py-0.5 text-[10px] font-bold rounded-full bg-primary/10 text-primary">{{ $counts['approved'] }}</span>
                </a>
                <a href="{{ route('admin.users.index', ['status' => 'rejected']) }}"
                   class="px-6 py-4 text-sm font-bold flex items-center gap-2 border-b-2 transition-colors {{ $status === 'rejected' ? 'border-primary text-primary' : 'border-transparent text-text-secondary hover:text-dark-grey dark:hover:text-white' }}">
                    <span class="material-symbols-outlined text-[20px]">cancel</span>
                    Ditolak
                    <span class="px-2 py-0.5 text-[10px] font-bold rounded-full bg-red-100 text-red-800">{{ $counts['rejected'] }}</span>
                </a>
            </nav>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
        @if($users->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-border-light dark:divide-border-dark">
                    <thead class="bg-gray-50 dark:bg-white/5">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Desa</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Tanggal Daftar</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-surface-dark divide-y divide-border-light dark:divide-border-dark">
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="size-10 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                            <span class="material-symbols-outlined">person</span>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-dark-grey dark:text-white">{{ $user->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary dark:text-gray-400">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary dark:text-gray-400">
                                    {{ $user->village?->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary dark:text-gray-400">
                                    {{ $user->created_at->format('d M Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($user->status === 'submitted')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide rounded-full bg-yellow-100 text-yellow-800">
                                            <span class="material-symbols-outlined text-[14px]">schedule</span> Menunggu
                                        </span>
                                    @elseif($user->status === 'approved')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide rounded-full bg-primary/10 text-primary">
                                            <span class="material-symbols-outlined text-[14px]">check_circle</span> Disetujui
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide rounded-full bg-red-100 text-red-800">
                                            <span class="material-symbols-outlined text-[14px]">cancel</span> Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <div class="flex items-center gap-2">
                                        @if($user->status === 'submitted')
                                            <form action="{{ route('admin.users.approve', $user) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-primary text-white text-xs font-bold rounded-lg hover:bg-primary-hover transition-colors">
                                                    <span class="material-symbols-outlined text-[16px]">check</span> Setujui
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.users.reject', $user) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-600 text-white text-xs font-bold rounded-lg hover:bg-red-700 transition-colors">
                                                    <span class="material-symbols-outlined text-[16px]">close</span> Tolak
                                                </button>
                                            </form>
                                        @elseif($user->status === 'rejected')
                                            <form action="{{ route('admin.users.approve', $user) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-primary text-white text-xs font-bold rounded-lg hover:bg-primary-hover transition-colors">
                                                    <span class="material-symbols-outlined text-[16px]">undo</span> Setujui Ulang
                                                </button>
                                            </form>
                                        @endif
                                        
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" 
                                              onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">
                                                <span class="material-symbols-outlined text-[18px]">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($users->hasPages())
                <div class="px-6 py-4 border-t border-border-light dark:border-border-dark">
                    {{ $users->appends(['status' => $status])->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-12">
                <div class="size-16 rounded-full bg-gray-100 dark:bg-white/5 flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-3xl text-gray-400">group</span>
                </div>
                <h3 class="text-lg font-bold text-dark-grey dark:text-white mb-1">Tidak ada data</h3>
                <p class="text-text-secondary dark:text-gray-400">
                    @if($status === 'submitted')
                        Tidak ada user yang menunggu verifikasi.
                    @elseif($status === 'approved')
                        Belum ada user yang disetujui.
                    @else
                        Tidak ada user yang ditolak.
                    @endif
                </p>
            </div>
        @endif
    </div>
@endsection
