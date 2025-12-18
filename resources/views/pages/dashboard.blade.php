@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Dashboard</h1>
            <p class="mt-2 text-gray-600 dark:text-gray-300">Selamat datang kembali, {{ auth()->user()->name }}!</p>
        </div>

        <nav class="mt-4 sm:mt-0" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="text-primary-600 hover:text-primary-700 dark:text-primary-400 dark:hover:text-primary-300 flex items-center">
                        <span class="material-symbols-outlined text-lg mr-1">home</span>
                        Home
                    </a>
                </li>
                <li>
                    <span class="material-symbols-outlined text-sm">chevron_right</span>
                </li>
                <li class="font-medium text-gray-900 dark:text-white">
                    Dashboard
                </li>
            </ol>
        </nav>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Residents -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Total Penduduk</p>
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ number_format($stats['total_penduduk']) }}</h3>
                    <div class="flex items-center space-x-4 text-xs text-gray-500 dark:text-gray-400">
                        <span class="flex items-center">
                            <span class="material-symbols-outlined text-sm mr-1 text-blue-500">male</span>
                            {{ $stats['laki_laki'] }} L
                        </span>
                        <span class="flex items-center">
                            <span class="material-symbols-outlined text-sm mr-1 text-pink-500">female</span>
                            {{ $stats['perempuan'] }} P
                        </span>
                    </div>
                </div>
                <div class="ml-4 p-3 rounded-xl bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400">
                    <span class="material-symbols-outlined text-3xl">groups</span>
                </div>
            </div>
        </div>

        <!-- Pending Users -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">User Pending</p>
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $userStats['pending'] }}</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        dari {{ $userStats['total'] }} total user
                    </p>
                </div>
                <div class="ml-4 p-3 rounded-xl bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400">
                    <span class="material-symbols-outlined text-3xl">person_clock</span>
                </div>
            </div>
        </div>

        <!-- Letters This Month -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Surat Bulan Ini</p>
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $letterStats['this_month'] }}</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        dari {{ $letterStats['total'] }} total
                    </p>
                </div>
                <div class="ml-4 p-3 rounded-xl bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                    <span class="material-symbols-outlined text-3xl">mark_email_read</span>
                </div>
            </div>
        </div>

        <!-- Pending Letters -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6 hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-1">Surat Pending</p>
                    <h3 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">{{ $letterStats['pending'] }}</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        perlu ditindaklanjuti
                    </p>
                </div>
                <div class="ml-4 p-3 rounded-xl bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400">
                    <span class="material-symbols-outlined text-3xl">assignment_late</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Gender Distribution Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Distribusi Gender</h3>
                <span class="material-symbols-outlined text-gray-400">pie_chart</span>
            </div>
            <div class="h-64">
                <canvas id="genderChart" height="256"></canvas>
            </div>
        </div>

        <!-- Letter Status Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Status Surat</h3>
                <span class="material-symbols-outlined text-gray-400">donut_small</span>
            </div>
            <div class="h-64">
                <canvas id="letterStatusChart" height="256"></canvas>
            </div>
        </div>

        <!-- Age Distribution Chart -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Distribusi Usia</h3>
                <span class="material-symbols-outlined text-gray-400">bar_chart</span>
            </div>
            <div class="h-64">
                <canvas id="ageChart" height="256"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Letters -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Surat Terbaru</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4 max-h-96 overflow-y-auto pr-2">
                    @forelse($recentLetters as $letter)
                    <div class="flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <div class="flex-shrink-0">
                            <div class="p-2 rounded-lg 
                                @if($letter->status === 'pending') bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400
                                @elseif($letter->status === 'processing') bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400
                                @elseif($letter->status === 'completed') bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400
                                @else bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400
                                @endif">
                                <span class="material-symbols-outlined text-xl">description</span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                                {{ $letter->letterType->name ?? 'Surat' }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                {{ $letter->user->name }} - {{ $letter->request_number }}
                            </p>
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                {{ $letter->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <div class="flex-shrink-0">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                @if($letter->status === 'pending') bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300
                                @elseif($letter->status === 'processing') bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300
                                @elseif($letter->status === 'completed') bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300
                                @else bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300
                                @endif">
                                {{ $letter->status_label }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <span class="material-symbols-outlined text-4xl text-gray-300 dark:text-gray-600 mb-3">inbox</span>
                        <p class="text-gray-500 dark:text-gray-400">Belum ada surat</p>
                    </div>
                    @endforelse
                </div>
                @if($recentLetters->isNotEmpty())
                <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700 text-center">
                    <a href="{{ route('admin.letters.index') }}" class="inline-flex items-center text-sm font-medium text-primary-600 hover:text-primary-700 dark:text-primary-400 dark:hover:text-primary-300">
                        Lihat Semua Surat
                        <span class="material-symbols-outlined text-lg ml-1">arrow_forward</span>
                    </a>
                </div>
                @endif
            </div>
        </div>

        <!-- Recent Users -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg border border-gray-200 dark:border-gray-700">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Pendaftaran User Terbaru</h3>
            </div>
            <div class="p-6">
                <div class="space-y-4 max-h-96 overflow-y-auto pr-2">
                    @forelse($recentUsers as $user)
                    <div class="flex items-center space-x-4 p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                        <div class="flex-shrink-0">
                            <div class="p-2 rounded-lg bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400">
                                <span class="material-symbols-outlined text-xl">person_add</span>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900 dark:text-white truncate">
                                {{ $user->name }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                {{ $user->email }}
                            </p>
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">
                                {{ $user->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <div class="flex-shrink-0 flex space-x-1">
                            <form action="{{ route('admin.users.approve', $user) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="p-2 bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 rounded-lg hover:bg-green-200 dark:hover:bg-green-800 transition-colors" title="Setujui">
                                    <span class="material-symbols-outlined text-lg">check</span>
                                </button>
                            </form>
                            <form action="{{ route('admin.users.reject', $user) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="p-2 bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 rounded-lg hover:bg-red-200 dark:hover:bg-red-800 transition-colors" title="Tolak">
                                    <span class="material-symbols-outlined text-lg">close</span>
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8">
                        <span class="material-symbols-outlined text-4xl text-gray-300 dark:text-gray-600 mb-3">person_check</span>
                        <p class="text-gray-500 dark:text-gray-400">Tidak ada user pending</p>
                    </div>
                    @endforelse
                </div>
                @if($recentUsers->isNotEmpty())
                <div class="mt-6 pt-4 border-t border-gray-200 dark:border-gray-700 text-center">
                    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-sm font-medium text-primary-600 hover:text-primary-700 dark:text-primary-400 dark:hover:text-primary-300">
                        Lihat Semua User
                        <span class="material-symbols-outlined text-lg ml-1">arrow_forward</span>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
    // Colors
    const primaryColor = '#10B981';
    const blueColor = '#3B82F6';
    const purpleColor = '#8B5CF6';
    const yellowColor = '#F59E0B';
    const redColor = '#EF4444';
    const pinkColor = '#EC4899';
    const brownColor = '#92400E';

    // Wait for DOM to load
    document.addEventListener('DOMContentLoaded', function() {
        // Gender Distribution Chart
        const genderCtx = document.getElementById('genderChart');
        if (genderCtx) {
            new Chart(genderCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Laki-laki', 'Perempuan'],
                    datasets: [{
                        data: [{{ $stats['laki_laki'] }}, {{ $stats['perempuan'] }}],
                        backgroundColor: [blueColor, pinkColor],
                        borderWidth: 0,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                font: {
                                    family: "'Inter', sans-serif",
                                    size: 12
                                },
                                color: window.matchMedia('(prefers-color-scheme: dark)').matches ? '#D1D5DB' : '#374151'
                            }
                        },
                        tooltip: {
                            backgroundColor: window.matchMedia('(prefers-color-scheme: dark)').matches ? '#1F2937' : '#FFFFFF',
                            titleColor: window.matchMedia('(prefers-color-scheme: dark)').matches ? '#F9FAFB' : '#111827',
                            bodyColor: window.matchMedia('(prefers-color-scheme: dark)').matches ? '#D1D5DB' : '#374151',
                            borderColor: '#E5E7EB',
                            borderWidth: 1
                        }
                    }
                }
            });
        }

        // Letter Status Chart
        const letterCtx = document.getElementById('letterStatusChart');
        if (letterCtx) {
            new Chart(letterCtx, {
                type: 'pie',
                data: {
                    labels: ['Pending', 'Diproses', 'Selesai', 'Ditolak'],
                    datasets: [{
                        data: [
                            {{ $letterStats['pending'] }}, 
                            {{ $letterStats['processing'] }}, 
                            {{ $letterStats['completed'] }}, 
                            {{ $letterStats['rejected'] }}
                        ],
                        backgroundColor: [yellowColor, blueColor, primaryColor, redColor],
                        borderWidth: 0,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                font: {
                                    family: "'Inter', sans-serif",
                                    size: 12
                                },
                                color: window.matchMedia('(prefers-color-scheme: dark)').matches ? '#D1D5DB' : '#374151'
                            }
                        },
                        tooltip: {
                            backgroundColor: window.matchMedia('(prefers-color-scheme: dark)').matches ? '#1F2937' : '#FFFFFF',
                            titleColor: window.matchMedia('(prefers-color-scheme: dark)').matches ? '#F9FAFB' : '#111827',
                            bodyColor: window.matchMedia('(prefers-color-scheme: dark)').matches ? '#D1D5DB' : '#374151',
                            borderColor: '#E5E7EB',
                            borderWidth: 1
                        }
                    }
                }
            });
        }

        // Age Distribution Chart
        const ageCtx = document.getElementById('ageChart');
        if (ageCtx) {
            new Chart(ageCtx, {
                type: 'bar',
                data: {
                    labels: ['0-17', '18-30', '31-45', '46-60', '60+'],
                    datasets: [{
                        label: 'Jumlah',
                        data: [
                            {{ $ageDistribution['0-17'] }},
                            {{ $ageDistribution['18-30'] }},
                            {{ $ageDistribution['31-45'] }},
                            {{ $ageDistribution['46-60'] }},
                            {{ $ageDistribution['60+'] }}
                        ],
                        backgroundColor: brownColor,
                        borderRadius: 8,
                        borderSkipped: false,
                        barPercentage: 0.6
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: window.matchMedia('(prefers-color-scheme: dark)').matches ? '#1F2937' : '#FFFFFF',
                            titleColor: window.matchMedia('(prefers-color-scheme: dark)').matches ? '#F9FAFB' : '#111827',
                            bodyColor: window.matchMedia('(prefers-color-scheme: dark)').matches ? '#D1D5DB' : '#374151',
                            borderColor: '#E5E7EB',
                            borderWidth: 1
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: window.matchMedia('(prefers-color-scheme: dark)').matches ? '#374151' : '#E5E7EB',
                                drawBorder: false
                            },
                            ticks: {
                                font: {
                                    family: "'Inter', sans-serif",
                                    size: 11
                                },
                                color: window.matchMedia('(prefers-color-scheme: dark)').matches ? '#9CA3AF' : '#6B7280',
                                stepSize: 1
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    family: "'Inter', sans-serif",
                                    size: 11
                                },
                                color: window.matchMedia('(prefers-color-scheme: dark)').matches ? '#9CA3AF' : '#6B7280'
                            }
                        }
                    }
                }
            });
        }
    });
</script>
@endpush