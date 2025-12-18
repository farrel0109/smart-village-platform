@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-dark-grey dark:text-white">Dashboard</h1>
            <p class="mt-1 text-text-secondary dark:text-gray-400">Selamat datang kembali, {{ auth()->user()->name }}!</p>
        </div>

        <nav class="text-sm mt-3 sm:mt-0" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-text-secondary dark:text-gray-400">
                <li>
                    <a href="#" class="text-primary hover:underline flex items-center">
                        <span class="material-symbols-outlined text-[20px]">home</span>
                    </a>
                </li>
                <li>
                    <span class="material-symbols-outlined text-[16px] align-middle">chevron_right</span>
                </li>
                <li>
                    <span class="font-bold text-dark-grey dark:text-white">Dashboard</span>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Total Residents -->
        <div class="bg-white dark:bg-surface-dark p-6 rounded-xl shadow-sm border border-border-light dark:border-border-dark flex items-center justify-between transform hover:-translate-y-1 transition-all duration-300 hover:shadow-md">
            <div>
                <div class="text-sm font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Total Penduduk</div>
                <div class="text-3xl font-black text-dark-grey dark:text-white mt-1">{{ number_format($stats['total_penduduk']) }}</div>
                <div class="text-xs text-text-secondary dark:text-gray-500 flex items-center mt-2 font-medium">
                    <span class="flex items-center mr-3"><span class="material-symbols-outlined text-[14px] mr-1">male</span> {{ $stats['laki_laki'] }} L</span>
                    <span class="flex items-center"><span class="material-symbols-outlined text-[14px] mr-1">female</span> {{ $stats['perempuan'] }} P</span>
                </div>
            </div>
            <div class="p-3 rounded-xl bg-primary/10 text-primary">
                <span class="material-symbols-outlined text-[32px]">groups</span>
            </div>
        </div>

        <!-- Pending Users -->
        <div class="bg-white dark:bg-surface-dark p-6 rounded-xl shadow-sm border border-border-light dark:border-border-dark flex items-center justify-between transform hover:-translate-y-1 transition-all duration-300 hover:shadow-md">
            <div>
                <div class="text-sm font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">User Pending</div>
                <div class="text-3xl font-black text-dark-grey dark:text-white mt-1">{{ $userStats['pending'] }}</div>
                <div class="text-xs text-text-secondary dark:text-gray-500 flex items-center mt-2">
                    dari {{ $userStats['total'] }} total user
                </div>
            </div>
            <div class="p-3 rounded-xl bg-yellow-100 text-yellow-600">
                <span class="material-symbols-outlined text-[32px]">person_clock</span>
            </div>
        </div>

        <!-- Letters This Month -->
        <div class="bg-white dark:bg-surface-dark p-6 rounded-xl shadow-sm border border-border-light dark:border-border-dark flex items-center justify-between transform hover:-translate-y-1 transition-all duration-300 hover:shadow-md">
            <div>
                <div class="text-sm font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Surat Bulan Ini</div>
                <div class="text-3xl font-black text-dark-grey dark:text-white mt-1">{{ $letterStats['this_month'] }}</div>
                <div class="text-xs text-text-secondary dark:text-gray-500 flex items-center mt-2">
                    dari {{ $letterStats['total'] }} total
                </div>
            </div>
            <div class="p-3 rounded-xl bg-sky-blue/10 text-sky-blue">
                <span class="material-symbols-outlined text-[32px]">mark_email_read</span>
            </div>
        </div>

        <!-- Pending Letters -->
        <div class="bg-white dark:bg-surface-dark p-6 rounded-xl shadow-sm border border-border-light dark:border-border-dark flex items-center justify-between transform hover:-translate-y-1 transition-all duration-300 hover:shadow-md">
            <div>
                <div class="text-sm font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Surat Pending</div>
                <div class="text-3xl font-black text-dark-grey dark:text-white mt-1">{{ $letterStats['pending'] }}</div>
                <div class="text-xs text-text-secondary dark:text-gray-500 flex items-center mt-2">
                    perlu ditindaklanjuti
                </div>
            </div>
            <div class="p-3 rounded-xl bg-red-100 text-red-600">
                <span class="material-symbols-outlined text-[32px]">assignment_late</span>
            </div>
        </div>
    </div>

    <!-- Charts and Activity Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Gender Distribution Chart -->
        <div class="bg-white dark:bg-surface-dark p-6 rounded-xl shadow-sm border border-border-light dark:border-border-dark">
            <h3 class="text-lg font-bold text-dark-grey dark:text-white mb-4">Distribusi Gender</h3>
            <canvas id="genderChart" height="200"></canvas>
        </div>

        <!-- Letter Status Chart -->
        <div class="bg-white dark:bg-surface-dark p-6 rounded-xl shadow-sm border border-border-light dark:border-border-dark">
            <h3 class="text-lg font-bold text-dark-grey dark:text-white mb-4">Status Surat</h3>
            <canvas id="letterStatusChart" height="200"></canvas>
        </div>

        <!-- Age Distribution Chart -->
        <div class="bg-white dark:bg-surface-dark p-6 rounded-xl shadow-sm border border-border-light dark:border-border-dark">
            <h3 class="text-lg font-bold text-dark-grey dark:text-white mb-4">Distribusi Usia</h3>
            <canvas id="ageChart" height="200"></canvas>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Letters -->
        <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark">
            <h3 class="text-lg font-bold text-dark-grey dark:text-white p-6 border-b border-border-light dark:border-border-dark">Surat Terbaru</h3>
            <ul class="space-y-4 p-6 max-h-96 overflow-y-auto">
                @forelse($recentLetters as $letter)
                <li class="flex items-start space-x-3">
                    <div class="flex-shrink-0 mt-1 p-2 rounded-lg 
                        @if($letter->status === 'pending') bg-yellow-100 text-yellow-600
                        @elseif($letter->status === 'processing') bg-sky-blue/10 text-sky-blue
                        @elseif($letter->status === 'completed') bg-primary/10 text-primary
                        @else bg-red-100 text-red-600
                        @endif">
                        <span class="material-symbols-outlined text-[20px]">description</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-bold text-dark-grey dark:text-white">{{ $letter->letterType->name ?? 'Surat' }}</p>
                        <span class="text-xs text-text-secondary dark:text-gray-400">{{ $letter->user->name }} - {{ $letter->request_number }}</span>
                        <span class="text-xs text-gray-400 block mt-0.5">{{ $letter->created_at->diffForHumans() }}</span>
                    </div>
                    <span class="px-2.5 py-1 text-[10px] font-bold rounded-full uppercase tracking-wide
                        @if($letter->status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($letter->status === 'processing') bg-sky-blue/10 text-sky-blue
                        @elseif($letter->status === 'completed') bg-primary/10 text-primary
                        @else bg-red-100 text-red-800
                        @endif">
                        {{ $letter->status_label }}
                    </span>
                </li>
                @empty
                <li class="text-center text-text-secondary dark:text-gray-400 py-8">
                    <span class="material-symbols-outlined text-4xl mb-2 text-gray-300 dark:text-gray-600">inbox</span>
                    <p>Belum ada surat</p>
                </li>
                @endforelse
            </ul>
            <div class="p-4 border-t border-border-light dark:border-border-dark text-center">
                <a href="{{ route('admin.letters.index') }}" class="text-sm text-primary hover:text-primary-hover font-bold hover:underline">Lihat Semua Surat</a>
            </div>
        </div>

        <!-- Recent Users -->
        <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark">
            <h3 class="text-lg font-bold text-dark-grey dark:text-white p-6 border-b border-border-light dark:border-border-dark">Pendaftaran User Terbaru</h3>
            <ul class="space-y-4 p-6 max-h-96 overflow-y-auto">
                @forelse($recentUsers as $user)
                <li class="flex items-start space-x-3">
                    <div class="flex-shrink-0 mt-1 p-2 rounded-lg bg-primary/10 text-primary">
                        <span class="material-symbols-outlined text-[20px]">person_add</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-bold text-dark-grey dark:text-white">{{ $user->name }}</p>
                        <span class="text-xs text-text-secondary dark:text-gray-400">{{ $user->email }}</span>
                        <span class="text-xs text-gray-400 block mt-0.5">{{ $user->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="flex space-x-2">
                        <form action="{{ route('admin.users.approve', $user) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="p-1.5 bg-primary/10 text-primary rounded-lg hover:bg-primary hover:text-white transition-colors" title="Setujui">
                                <span class="material-symbols-outlined text-[18px]">check</span>
                            </button>
                        </form>
                        <form action="{{ route('admin.users.reject', $user) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="p-1.5 bg-red-100 text-red-600 rounded-lg hover:bg-red-600 hover:text-white transition-colors" title="Tolak">
                                <span class="material-symbols-outlined text-[18px]">close</span>
                            </button>
                        </form>
                    </div>
                </li>
                @empty
                <li class="text-center text-text-secondary dark:text-gray-400 py-8">
                    <span class="material-symbols-outlined text-4xl mb-2 text-gray-300 dark:text-gray-600">person_check</span>
                    <p>Tidak ada user pending</p>
                </li>
                @endforelse
            </ul>
            <div class="p-4 border-t border-border-light dark:border-border-dark text-center">
                <a href="{{ route('admin.users.index') }}" class="text-sm text-primary hover:text-primary-hover font-bold hover:underline">Lihat Semua User</a>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
    // Colors
    const primaryColor = '#2E7D32';
    const skyBlueColor = '#0288D1';
    const earthColor = '#795548';
    const yellowColor = '#EAB308';
    const redColor = '#EF4444';

    // Gender Distribution Chart
    const genderCtx = document.getElementById('genderChart').getContext('2d');
    new Chart(genderCtx, {
        type: 'doughnut',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                data: [{{ $stats['laki_laki'] }}, {{ $stats['perempuan'] }}],
                backgroundColor: [skyBlueColor, '#EC4899'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: { family: "'Public Sans', sans-serif" }
                    }
                }
            }
        }
    });

    // Letter Status Chart
    const letterCtx = document.getElementById('letterStatusChart').getContext('2d');
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
                backgroundColor: [yellowColor, skyBlueColor, primaryColor, redColor],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        font: { family: "'Public Sans', sans-serif" }
                    }
                }
            }
        }
    });

    // Age Distribution Chart
    const ageCtx = document.getElementById('ageChart').getContext('2d');
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
                backgroundColor: earthColor,
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        font: { family: "'Public Sans', sans-serif" }
                    }
                },
                x: {
                    ticks: {
                        font: { family: "'Public Sans', sans-serif" }
                    }
                }
            }
        }
    });
</script>
@endpush
