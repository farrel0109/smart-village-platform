{{-- /resources/views/pages/admin/letters/show.blade.php --}}

@extends('layouts.app')

@section('title', 'Detail Pengajuan Surat')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Detail Pengajuan</h1>
            <p class="mt-1 text-gray-600">{{ $letter->request_number }}</p>
        </div>

        <nav class="text-sm mt-3 sm:mt-0" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-gray-500">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="text-indigo-600 hover:underline">
                        <i class="fas fa-home"></i>
                    </a>
                </li>
                <li>
                    <i class="fas fa-chevron-right text-xs"></i>
                </li>
                <li>
                    <a href="{{ route('admin.letters.index') }}" class="text-indigo-600 hover:underline">Pengajuan Surat</a>
                </li>
                <li>
                    <i class="fas fa-chevron-right text-xs"></i>
                </li>
                <li>
                    <span class="font-medium text-gray-700">Detail</span>
                </li>
            </ol>
        </nav>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Letter Info -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-800">Informasi Pengajuan</h2>
                    <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $letter->getStatusBadgeColor() }}">
                        {{ $letter->getStatusLabel() }}
                    </span>
                </div>
                
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Nomor Pengajuan</label>
                            <p class="mt-1 text-gray-800 font-mono">{{ $letter->request_number }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Jenis Surat</label>
                            <p class="mt-1 text-gray-800">{{ $letter->letterType->name ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Tanggal Pengajuan</label>
                            <p class="mt-1 text-gray-800">{{ $letter->created_at->format('d F Y, H:i') }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Desa</label>
                            <p class="mt-1 text-gray-800">{{ $letter->village->name ?? '-' }}</p>
                        </div>
                    </div>

                    @if($letter->purpose)
                    <div>
                        <label class="text-sm font-medium text-gray-500">Keperluan</label>
                        <p class="mt-1 text-gray-800">{{ $letter->purpose }}</p>
                    </div>
                    @endif

                    @if($letter->notes)
                    <div>
                        <label class="text-sm font-medium text-gray-500">Catatan</label>
                        <p class="mt-1 text-gray-800">{{ $letter->notes }}</p>
                    </div>
                    @endif

                    @if($letter->rejection_reason)
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <label class="text-sm font-medium text-red-600">Alasan Penolakan</label>
                        <p class="mt-1 text-red-800">{{ $letter->rejection_reason }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Requester Info -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">Pemohon</h2>
                </div>
                
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Nama</label>
                            <p class="mt-1 text-gray-800">{{ $letter->user->name ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Email</label>
                            <p class="mt-1 text-gray-800">{{ $letter->user->email ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Actions -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">Aksi</h2>
                </div>
                
                <div class="p-6 space-y-3">
                    @if($letter->status === 'pending')
                        <form action="{{ route('admin.letters.process', $letter) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-cog mr-2"></i>Proses Pengajuan
                            </button>
                        </form>
                    @endif

                    @if($letter->status === 'processing')
                        <form action="{{ route('admin.letters.complete', $letter) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                <i class="fas fa-check mr-2"></i>Selesaikan
                            </button>
                        </form>
                    @endif

                    @if($letter->status !== 'completed' && $letter->status !== 'rejected')
                        <button onclick="showRejectModal()" class="w-full px-4 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            <i class="fas fa-times mr-2"></i>Tolak Pengajuan
                        </button>
                    @endif

                    @if($letter->status === 'completed')
                        <a href="{{ route('admin.letters.download', $letter) }}" class="w-full flex items-center justify-center px-4 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
                            <i class="fas fa-download mr-2"></i>Download PDF
                        </a>
                    @endif

                    <a href="{{ route('admin.letters.index') }}" class="w-full flex items-center justify-center px-4 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>
            </div>

            <!-- Processing Info -->
            @if($letter->processor)
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">Diproses Oleh</h2>
                </div>
                
                <div class="p-6 space-y-2">
                    <p class="text-gray-800">{{ $letter->processor->name }}</p>
                    @if($letter->processed_at)
                    <p class="text-sm text-gray-500">{{ $letter->processed_at->format('d F Y, H:i') }}</p>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-black bg-opacity-50" onclick="hideRejectModal()"></div>
            
            <div class="relative bg-white rounded-xl shadow-xl max-w-md w-full p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Tolak Pengajuan</h3>
                
                <form action="{{ route('admin.letters.reject', $letter) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="mb-4">
                        <label for="rejection_reason" class="block text-sm font-medium text-gray-700 mb-1">
                            Alasan Penolakan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="rejection_reason" id="rejection_reason" rows="4" 
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500"
                                  required></textarea>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="hideRejectModal()" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">
                            Tolak
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showRejectModal() {
            document.getElementById('rejectModal').classList.remove('hidden');
        }
        function hideRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }
    </script>

@endsection
