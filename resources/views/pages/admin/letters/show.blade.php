{{-- /resources/views/pages/admin/letters/show.blade.php --}}

@extends('layouts.app')

@section('title', 'Detail Pengajuan Surat')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-black text-dark-grey dark:text-white">Detail Pengajuan</h1>
            <p class="mt-1 text-text-secondary dark:text-gray-400">{{ $letter->request_number }}</p>
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
                    <a href="{{ route('admin.letters.index') }}" class="text-primary hover:underline">Pengajuan Surat</a>
                </li>
                <li>
                    <span class="material-symbols-outlined text-[16px]">chevron_right</span>
                </li>
                <li>
                    <span class="font-bold text-dark-grey dark:text-white">Detail</span>
                </li>
            </ol>
        </nav>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Letter Info -->
            <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
                <div class="p-6 border-b border-border-light dark:border-border-dark flex items-center justify-between">
                    <h2 class="text-lg font-bold text-dark-grey dark:text-white">Informasi Pengajuan</h2>
                    <span class="px-3 py-1 text-sm font-bold rounded-full {{ $letter->getStatusBadgeColor() }}">
                        {{ $letter->getStatusLabel() }}
                    </span>
                </div>
                
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Nomor Pengajuan</label>
                            <p class="mt-1 text-dark-grey dark:text-white font-mono">{{ $letter->request_number }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Nomor Surat (Resmi)</label>
                            <p class="mt-1 text-dark-grey dark:text-white font-mono">{{ $letter->letter_number ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Jenis Surat</label>
                            <p class="mt-1 text-dark-grey dark:text-white">{{ $letter->letterType->name ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Tanggal Pengajuan</label>
                            <p class="mt-1 text-dark-grey dark:text-white">{{ $letter->created_at->format('d F Y, H:i') }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Desa</label>
                            <p class="mt-1 text-dark-grey dark:text-white">{{ $letter->village->name ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Penandatangan</label>
                            <p class="mt-1 text-dark-grey dark:text-white">
                                {{ $letter->signed_by === 'secretary' ? 'Sekretaris Desa' : 'Kepala Desa' }}
                            </p>
                        </div>
                    </div>

                    @if($letter->purpose)
                    <div>
                        <label class="text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Keperluan</label>
                        <p class="mt-1 text-dark-grey dark:text-white">{{ $letter->purpose }}</p>
                    </div>
                    @endif

                    <!-- Dynamic Data -->
                    @if($letter->dynamic_data)
                    <div class="bg-gray-50 dark:bg-white/5 rounded-lg p-4">
                        <h3 class="text-sm font-bold text-dark-grey dark:text-white mb-3">Data Tambahan</h3>
                        <dl class="grid grid-cols-1 gap-x-4 gap-y-4 sm:grid-cols-2">
                            @foreach($letter->dynamic_data as $key => $value)
                                @if(!is_array($value))
                                <div>
                                    <dt class="text-xs font-bold text-text-secondary dark:text-gray-400 uppercase">{{ str_replace('_', ' ', $key) }}</dt>
                                    <dd class="mt-1 text-sm text-dark-grey dark:text-white">{{ $value }}</dd>
                                </div>
                                @endif
                            @endforeach
                        </dl>
                    </div>
                    @endif

                    <!-- Attachments -->
                    @if($letter->attachments)
                    <div class="bg-gray-50 dark:bg-white/5 rounded-lg p-4">
                        <h3 class="text-sm font-bold text-dark-grey dark:text-white mb-3">Lampiran Dokumen</h3>
                        <ul class="space-y-2">
                            @foreach($letter->attachments as $key => $path)
                                @if(is_string($path))
                                <li>
                                    <a href="{{ asset('storage/' . $path) }}" target="_blank" class="flex items-center text-sm text-primary hover:underline">
                                        <span class="material-symbols-outlined text-[18px] mr-2">attach_file</span>
                                        {{ ucfirst($key) }} (Klik untuk lihat)
                                    </a>
                                </li>
                                @elseif(is_array($path))
                                    @foreach($path as $index => $subPath)
                                    <li>
                                        <a href="{{ asset('storage/' . $subPath) }}" target="_blank" class="flex items-center text-sm text-primary hover:underline">
                                            <span class="material-symbols-outlined text-[18px] mr-2">attach_file</span>
                                            {{ ucfirst($key) }} {{ $index + 1 }}
                                        </a>
                                    </li>
                                    @endforeach
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if($letter->notes)
                    <div>
                        <label class="text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Catatan</label>
                        <p class="mt-1 text-dark-grey dark:text-white">{{ $letter->notes }}</p>
                    </div>
                    @endif

                    @if($letter->rejection_reason)
                    <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                        <label class="text-sm font-bold text-red-600 dark:text-red-400">Alasan Penolakan</label>
                        <p class="mt-1 text-red-800 dark:text-red-300">{{ $letter->rejection_reason }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Requester Info -->
            <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
                <div class="p-6 border-b border-border-light dark:border-border-dark">
                    <h2 class="text-lg font-bold text-dark-grey dark:text-white">Pemohon</h2>
                </div>
                
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Nama</label>
                            <p class="mt-1 text-dark-grey dark:text-white">{{ $letter->user->name ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Email</label>
                            <p class="mt-1 text-dark-grey dark:text-white">{{ $letter->user->email ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Actions -->
            <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
                <div class="p-6 border-b border-border-light dark:border-border-dark">
                    <h2 class="text-lg font-bold text-dark-grey dark:text-white">Aksi</h2>
                </div>
                
                <div class="p-6 space-y-3">
                    @if($letter->status === 'pending')
                        <form action="{{ route('admin.letters.process', $letter) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-sky-blue text-white rounded-lg hover:bg-sky-blue/80 transition-colors font-bold">
                                <span class="material-symbols-outlined">settings</span>Proses Pengajuan
                            </button>
                        </form>
                    @endif

                    @if($letter->status === 'processing')
                        <form action="{{ route('admin.letters.complete', $letter) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors font-bold">
                                <span class="material-symbols-outlined">check</span>Selesaikan
                            </button>
                        </form>
                    @endif

                    @if($letter->status !== 'completed' && $letter->status !== 'rejected')
                        <button onclick="showRejectModal()" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-bold">
                            <span class="material-symbols-outlined">close</span>Tolak Pengajuan
                        </button>
                    @endif

                    @if($letter->status === 'completed')
                        <a href="{{ route('admin.letters.download', $letter) }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors font-bold">
                            <span class="material-symbols-outlined">download</span>Download PDF
                        </a>
                    @endif

                    <a href="{{ route('admin.letters.index') }}" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 border border-border-light dark:border-border-dark text-dark-grey dark:text-white rounded-lg hover:bg-gray-50 dark:hover:bg-white/5 transition-colors font-bold">
                        <span class="material-symbols-outlined">arrow_back</span>Kembali
                    </a>
                </div>
            </div>

            <!-- Processing Info -->
            @if($letter->processor)
            <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
                <div class="p-6 border-b border-border-light dark:border-border-dark">
                    <h2 class="text-lg font-bold text-dark-grey dark:text-white">Diproses Oleh</h2>
                </div>
                
                <div class="p-6 space-y-2">
                    <p class="text-dark-grey dark:text-white font-bold">{{ $letter->processor->name }}</p>
                    @if($letter->processed_at)
                    <p class="text-sm text-text-secondary dark:text-gray-400">{{ $letter->processed_at->format('d F Y, H:i') }}</p>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="hideRejectModal()"></div>
            
            <div class="relative bg-white dark:bg-surface-dark rounded-xl shadow-xl border border-border-light dark:border-border-dark max-w-md w-full p-6">
                <h3 class="text-lg font-bold text-dark-grey dark:text-white mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-red-600">warning</span>
                    Tolak Pengajuan
                </h3>
                
                <form action="{{ route('admin.letters.reject', $letter) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="mb-4">
                        <label for="rejection_reason" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">
                            Alasan Penolakan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="rejection_reason" id="rejection_reason" rows="4" 
                                  class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-red-500"
                                  required></textarea>
                    </div>
                    
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="hideRejectModal()" class="px-4 py-2 font-bold text-dark-grey dark:text-white bg-gray-100 dark:bg-white/10 rounded-lg hover:bg-gray-200 dark:hover:bg-white/20 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white font-bold rounded-lg hover:bg-red-700 transition-colors">
                            <span class="material-symbols-outlined text-[18px]">close</span>Tolak
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
