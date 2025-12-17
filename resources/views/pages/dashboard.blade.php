{{-- /resources/views/dashboard.blade.php --}}

@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
            <p class="mt-1 text-gray-600">Selamat datang kembali, {{ auth()->user()->name }}!</p>
        </div>

        <nav class="text-sm mt-3 sm:mt-0" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-gray-500">
                <li>
                    <a href="#" class="text-indigo-600 hover:underline">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li>
                    <i class="fas fa-chevron-right text-xs"></i>
                </li>
                <li>
                    <span class="font-medium text-gray-700">Dashboard</span>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
        <!-- Total Residents -->
        <div class="bg-white p-6 rounded-xl shadow-md flex items-center justify-between transform hover:-translate-y-1 transition-all duration-300 hover:shadow-lg">
            <div>
                <div class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Penduduk</div>
                <div class="text-3xl font-bold text-gray-800">{{ number_format($stats['total_penduduk']) }}</div>
                <div class="text-sm text-gray-500 flex items-center mt-1">
                    <i class="fas fa-male mr-1"></i> {{ $stats['laki_laki'] }} L / 
                    <i class="fas fa-female ml-2 mr-1"></i> {{ $stats['perempuan'] }} P
                </div>
            </div>
            <div class="p-4 rounded-full bg-indigo-100 text-indigo-600">
                <i class="fas fa-users fa-2x"></i>
            </div>
        </div>

        <!-- Pending Users -->
        <div class="bg-white p-6 rounded-xl shadow-md flex items-center justify-between transform hover:-translate-y-1 transition-all duration-300 hover:shadow-lg">
            <div>
                <div class="text-sm font-medium text-gray-500 uppercase tracking-wider">User Pending</div>
                <div class="text-3xl font-bold text-gray-800">{{ $userStats['pending'] }}</div>
                <div class="text-sm text-gray-400 flex items-center mt-1">
                    dari {{ $userStats['total'] }} total user
                </div>
            </div>
            <div class="p-4 rounded-full bg-yellow-100 text-yellow-600">
                <i class="fas fa-user-clock fa-2x"></i>
            </div>
        </div>

        <!-- Letters This Month -->
        <div class="bg-white p-6 rounded-xl shadow-md flex items-center justify-between transform hover:-translate-y-1 transition-all duration-300 hover:shadow-lg">
            <div>
                <div class="text-sm font-medium text-gray-500 uppercase tracking-wider">Surat Bulan Ini</div>
                <div class="text-3xl font-bold text-gray-800">{{ $letterStats['this_month'] }}</div>
                <div class="text-sm text-gray-500 flex items-center mt-1">
                    dari {{ $letterStats['total'] }} total
                </div>
            </div>
            <div class="p-4 rounded-full bg-blue-100 text-blue-600">
                <i class="fas fa-envelope-open-text fa-2x"></i>
            </div>
        </div>

        <!-- Pending Letters -->
        <div class="bg-white p-6 rounded-xl shadow-md flex items-center justify-between transform hover:-translate-y-1 transition-all duration-300 hover:shadow-lg">
            <div>
                <div class="text-sm font-medium text-gray-500 uppercase tracking-wider">Surat Pending</div>
                <div class="text-3xl font-bold text-gray-800">{{ $letterStats['pending'] }}</div>
                <div class="text-sm text-gray-500 flex items-center mt-1">
                    perlu ditindaklanjuti
                </div>
            </div>
            <div class="p-4 rounded-full bg-red-100 text-red-600">
                <i class="fas fa-exclamation-circle fa-2x"></i>
            </div>
        </div>
    </div>

    <!-- Charts and Activity Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Gender Distribution Chart -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Distribusi Gender</h3>
            <canvas id="genderChart" height="200"></canvas>
        </div>

        <!-- Letter Status Chart -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Status Surat</h3>
            <canvas id="letterStatusChart" height="200"></canvas>
        </div>

        <!-- Age Distribution Chart -->
        <div class="bg-white p-6 rounded-xl shadow-md">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Distribusi Usia</h3>
            <canvas id="ageChart" height="200"></canvas>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Letters -->
        <div class="bg-white rounded-xl shadow-md">
            <h3 class="text-lg font-semibold text-gray-700 p-6 border-b">Surat Terbaru</h3>
            <ul class="space-y-4 p-6 max-h-96 overflow-y-auto">
                @forelse($recentLetters as $letter)
                <li class="flex items-start space-x-3">
                    <div class="flex-shrink-0 mt-1 p-2 rounded-full 
                        @if($letter->status === 'pending') bg-yellow-100 text-yellow-600
                        @elseif($letter->status === 'processing') bg-blue-100 text-blue-600
                        @elseif($letter->status === 'completed') bg-green-100 text-green-600
                        @else bg-red-100 text-red-600
                        @endif">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">{{ $letter->letterType->name ?? 'Surat' }}</p>
                        <span class="text-xs text-gray-500">{{ $letter->user->name }} - {{ $letter->request_number }}</span>
                        <span class="text-xs text-gray-400 block">{{ $letter->created_at->diffForHumans() }}</span>
                    </div>
                    <span class="px-2 py-1 text-xs font-semibold rounded-full
                        @if($letter->status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($letter->status === 'processing') bg-blue-100 text-blue-800
                        @elseif($letter->status === 'completed') bg-green-100 text-green-800
                        @else bg-red-100 text-red-800
                        @endif">
                        {{ $letter->status_label }}
                    </span>
                </li>
                @empty
                <li class="text-center text-gray-500 py-8">
                    <i class="fas fa-inbox fa-3x mb-2"></i>
                    <p>Belum ada surat</p>
                </li>
                @endforelse
            </ul>
            <div class="p-4 border-t text-center">
                <a href="{{ route('admin.letters.index') }}" class="text-sm text-indigo-600 hover:underline font-medium">Lihat Semua Surat</a>
            </div>
        </div>

        <!-- Recent Users -->
        <div class="bg-white rounded-xl shadow-md">
            <h3 class="text-lg font-semibold text-gray-700 p-6 border-b">Pendaftaran User Terbaru</h3>
            <ul class="space-y-4 p-6 max-h-96 overflow-y-auto">
                @forelse($recentUsers as $user)
                <li class="flex items-start space-x-3">
                    <div class="flex-shrink-0 mt-1 p-2 rounded-full bg-indigo-100 text-indigo-600">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-800">{{ $user->name }}</p>
                        <span class="text-xs text-gray-500">{{ $user->email }}</span>
                        <span class="text-xs text-gray-400 block">{{ $user->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="flex space-x-2">
                        <form action="{{ route('admin.users.approve', $user) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="px-2 py-1 text-xs bg-green-100 text-green-700 rounded hover:bg-green-200">
                                <i class="fas fa-check"></i>
                            </button>
                        </form>
                        <form action="{{ route('admin.users.reject', $user) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="px-2 py-1 text-xs bg-red-100 text-red-700 rounded hover:bg-red-200">
                                <i class="fas fa-times"></i>
                            </button>
                        </form>
                    </div>
                </li>
                @empty
                <li class="text-center text-gray-500 py-8">
                    <i class="fas fa-user-check fa-3x mb-2"></i>
                    <p>Tidak ada user pending</p>
                </li>
                @endforelse
            </ul>
            <div class="p-4 border-t text-center">
                <a href="{{ route('admin.users.index') }}" class="text-sm text-indigo-600 hover:underline font-medium">Lihat Semua User</a>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
    // Gender Distribution Chart
    const genderCtx = document.getElementById('genderChart').getContext('2d');
    new Chart(genderCtx, {
        type: 'doughnut',
        data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                data: [{{ $stats['laki_laki'] }}, {{ $stats['perempuan'] }}],
                backgroundColor: ['#3b82f6', '#ec4899'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
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
                backgroundColor: ['#eab308', '#3b82f6', '#22c55e', '#ef4444'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
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
                backgroundColor: '#6366f1',
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
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endpush
