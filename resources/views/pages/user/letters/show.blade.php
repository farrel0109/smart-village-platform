{{-- /resources/views/pages/user/letters/show.blade.php --}}

@extends('layouts.user')

@section('title', 'Detail Pengajuan Surat')

@section('content')

    <div class="max-w-4xl mx-auto">
        <!-- Back Button -->
        <a href="{{ route('user.letters.index') }}" class="inline-flex items-center text-primary hover:text-primary-hover font-bold mb-6 group">
            <span class="material-symbols-outlined mr-2 group-hover:-translate-x-1 transition-transform">arrow_back</span>
            Kembali ke Daftar Surat
        </a>

        <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
            <!-- Header -->
            <div class="p-6 border-b border-border-light dark:border-border-dark">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-black text-dark-grey dark:text-white">{{ $letter->letterType->name ?? 'Surat' }}</h1>
                        <p class="text-text-secondary dark:text-gray-400 mt-1">No. Pengajuan: <span class="font-mono font-bold">{{ $letter->request_number }}</span></p>
                    </div>
                    <span class="self-start px-4 py-2 text-sm font-bold uppercase tracking-wide rounded-full 
                        @if($letter->status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($letter->status === 'processing') bg-sky-blue/10 text-sky-blue
                        @elseif($letter->status === 'completed') bg-primary/10 text-primary
                        @else bg-red-100 text-red-800
                        @endif">
                        {{ $letter->status_label }}
                    </span>
                </div>
            </div>

            <!-- Details -->
            <div class="p-6 space-y-6">
                <!-- Request Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-sm font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider mb-1">Tujuan Pengajuan</p>
                        <p class="text-dark-grey dark:text-white">{{ $letter->purpose }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider mb-1">Tanggal Pengajuan</p>
                        <p class="text-dark-grey dark:text-white">{{ $letter->created_at->format('d F Y, H:i') }}</p>
                    </div>
                </div>

                @if($letter->notes)
                <div>
                    <p class="text-sm font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider mb-1">Catatan</p>
                    <p class="text-dark-grey dark:text-white">{{ $letter->notes }}</p>
                </div>
                @endif

                <!-- Timeline -->
                <div>
                    <p class="text-sm font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider mb-3">Status Timeline</p>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="size-8 rounded-full bg-primary/10 text-primary flex items-center justify-center">
                                <span class="material-symbols-outlined text-[18px]">send</span>
                            </div>
                            <div>
                                <p class="font-bold text-dark-grey dark:text-white">Diajukan</p>
                                <p class="text-xs text-gray-400">{{ $letter->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>

                        @if($letter->processed_at || $letter->status !== 'pending')
                        <div class="flex items-center gap-3">
                            <div class="size-8 rounded-full bg-sky-blue/10 text-sky-blue flex items-center justify-center">
                                <span class="material-symbols-outlined text-[18px]">sync</span>
                            </div>
                            <div>
                                <p class="font-bold text-dark-grey dark:text-white">Diproses</p>
                                <p class="text-xs text-gray-400">{{ $letter->processed_at ? $letter->processed_at->format('d M Y, H:i') : '-' }}</p>
                            </div>
                        </div>
                        @endif

                        @if($letter->status === 'completed')
                        <div class="flex items-center gap-3">
                            <div class="size-8 rounded-full bg-primary/10 text-primary flex items-center justify-center">
                                <span class="material-symbols-outlined text-[18px]">check_circle</span>
                            </div>
                            <div>
                                <p class="font-bold text-dark-grey dark:text-white">Selesai</p>
                                <p class="text-xs text-gray-400">{{ $letter->completed_at ? $letter->completed_at->format('d M Y, H:i') : '-' }}</p>
                            </div>
                        </div>
                        @endif

                        @if($letter->status === 'rejected')
                        <div class="flex items-center gap-3">
                            <div class="size-8 rounded-full bg-red-100 text-red-600 flex items-center justify-center">
                                <span class="material-symbols-outlined text-[18px]">cancel</span>
                            </div>
                            <div>
                                <p class="font-bold text-dark-grey dark:text-white">Ditolak</p>
                                <p class="text-xs text-gray-400">{{ $letter->rejected_at ? $letter->rejected_at->format('d M Y, H:i') : '-' }}</p>
                                @if($letter->rejection_reason)
                                <p class="text-sm text-red-600 mt-1">Alasan: {{ $letter->rejection_reason }}</p>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
