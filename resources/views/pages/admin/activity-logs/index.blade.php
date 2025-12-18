{{-- /resources/views/pages/admin/activity-logs/index.blade.php --}}

@extends('layouts.app')

@section('title', 'Activity Logs')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-black text-dark-grey dark:text-white">Activity Logs</h1>
            <p class="mt-1 text-text-secondary dark:text-gray-400">Riwayat aktivitas pengguna sistem</p>
        </div>

        <nav class="text-sm mt-3 sm:mt-0" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-text-secondary dark:text-gray-400">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="text-primary hover:underline">
                        <span class="material-symbols-outlined text-[20px]">home</span>
                    </a>
                </li>
                <li>
                    <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                </li>
                <li>
                    <span class="font-bold text-dark-grey dark:text-white">Activity Logs</span>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark p-6 mb-6">
        <form method="GET" action="{{ route('admin.activity-logs.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label for="action" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Aksi</label>
                <select name="action" id="action" class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary">
                    <option value="">Semua Aksi</option>
                    @foreach($actions as $action)
                        <option value="{{ $action }}" {{ request('action') == $action ? 'selected' : '' }}>
                            {{ ucfirst($action) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="date_from" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Dari Tanggal</label>
                <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                       class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary">
            </div>

            <div>
                <label for="date_to" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Sampai Tanggal</label>
                <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}"
                       class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary">
            </div>

            <div class="flex items-end gap-2">
                <button type="submit" class="inline-flex items-center gap-2 px-4 py-3 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors font-bold">
                    <span class="material-symbols-outlined text-[20px]">filter_alt</span>Filter
                </button>
                <a href="{{ route('admin.activity-logs.index') }}" class="inline-flex items-center justify-center px-4 py-3 border border-border-light dark:border-border-dark text-dark-grey dark:text-white rounded-lg hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                    <span class="material-symbols-outlined">refresh</span>
                </a>
            </div>
        </form>
    </div>

    <!-- Activity Logs Table -->
    <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 dark:bg-white/5 border-b border-border-light dark:border-border-dark">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Waktu</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Deskripsi</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">IP Address</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-light dark:divide-border-dark">
                    @forelse($logs as $log)
                    <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary dark:text-gray-400">
                            <div class="text-dark-grey dark:text-white">{{ $log->created_at->format('d M Y') }}</div>
                            <div class="text-xs">{{ $log->created_at->format('H:i:s') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if($log->user)
                                <div class="font-bold text-dark-grey dark:text-white">{{ $log->user->name }}</div>
                                <div class="text-xs text-text-secondary dark:text-gray-400">{{ $log->user->email }}</div>
                            @else
                                <span class="text-text-secondary dark:text-gray-400 italic">System</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide rounded-full
                                @if($log->action === 'created') bg-primary/10 text-primary
                                @elseif($log->action === 'updated') bg-sky-blue/10 text-sky-blue
                                @elseif($log->action === 'deleted') bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400
                                @else bg-gray-100 text-gray-800 dark:bg-white/10 dark:text-gray-300
                                @endif">
                                {{ ucfirst($log->action) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-dark-grey dark:text-white">
                            {{ $log->description }}
                            @if($log->model_type)
                                <div class="text-xs text-text-secondary dark:text-gray-400 mt-1">
                                    {{ class_basename($log->model_type) }} #{{ $log->model_id }}
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary dark:text-gray-400 font-mono">
                            {{ $log->ip_address ?? '-' }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="size-16 rounded-full bg-gray-100 dark:bg-white/5 flex items-center justify-center mx-auto mb-4">
                                <span class="material-symbols-outlined text-3xl text-gray-400">history</span>
                            </div>
                            <h3 class="text-lg font-bold text-dark-grey dark:text-white mb-1">Belum ada activity log</h3>
                            <p class="text-text-secondary dark:text-gray-400">Aktivitas akan muncul di sini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($logs->hasPages())
        <div class="px-6 py-4 border-t border-border-light dark:border-border-dark">
            {{ $logs->links() }}
        </div>
        @endif
    </div>

@endsection
