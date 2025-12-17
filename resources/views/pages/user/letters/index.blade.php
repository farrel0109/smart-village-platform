@extends('layouts.user')

@section('title', 'Pengajuan Surat')

@section('content')
    <div class="mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-3xl font-black text-dark-grey">Pengajuan Surat</h1>
                <p class="mt-1 text-text-secondary font-medium">Riwayat pengajuan surat Anda</p>
            </div>
            <a href="{{ route('user.letters.create') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors shadow-sm font-bold mt-4 sm:mt-0">
                <span class="material-symbols-outlined text-[20px]">add</span>
                Ajukan Surat Baru
            </a>
        </div>
    </div>

    <!-- Requests List -->
    <div class="space-y-4">
        @forelse($requests as $request)
            <a href="{{ route('user.letters.show', $request) }}" class="block bg-white rounded-xl shadow-sm border border-border-light p-6 hover:shadow-md hover:border-primary/30 transition-all group">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="text-sm font-bold text-primary">{{ $request->request_number }}</span>
                            <span class="px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide rounded-full
                                @if($request->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($request->status === 'processing') bg-sky-blue/10 text-sky-blue
                                @elseif($request->status === 'completed') bg-primary/10 text-primary
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ $request->status_label }}
                            </span>
                        </div>
                        <h3 class="text-lg font-bold text-dark-grey mb-1 group-hover:text-primary transition-colors">{{ $request->letterType->name }}</h3>
                        <p class="text-sm text-text-secondary mb-2">{{ Str::limit($request->purpose, 100) }}</p>
                        <p class="text-xs text-gray-400 flex items-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">calendar_today</span>
                            Diajukan {{ $request->created_at->diffForHumans() }}
                        </p>
                    </div>
                    <div class="ml-4">
                        <div class="size-12 rounded-xl bg-primary/10 flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-colors">
                            <span class="material-symbols-outlined">description</span>
                        </div>
                    </div>
                </div>

                @if($request->status === 'rejected' && $request->rejection_reason)
                    <div class="mt-4 p-3 bg-red-50 rounded-lg border border-red-100">
                        <p class="text-sm text-red-800 flex items-start gap-2">
                            <span class="material-symbols-outlined text-[18px] mt-0.5">info</span>
                            <span><strong>Alasan penolakan:</strong> {{ $request->rejection_reason }}</span>
                        </p>
                    </div>
                @endif

                @if($request->status === 'completed')
                    <div class="mt-4 p-3 bg-primary/5 rounded-lg border border-primary/20">
                        <p class="text-sm text-primary flex items-start gap-2">
                            <span class="material-symbols-outlined text-[18px] mt-0.5">check_circle</span>
                            <span>Surat Anda sudah selesai. Silakan ambil di kantor desa.</span>
                        </p>
                    </div>
                @endif
            </a>
        @empty
            <div class="bg-white rounded-xl shadow-sm border border-border-light p-12 text-center">
                <div class="size-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-3xl text-gray-400">description</span>
                </div>
                <h3 class="text-lg font-bold text-dark-grey mb-1">Belum ada pengajuan</h3>
                <p class="text-text-secondary mb-4">Anda belum pernah mengajukan surat.</p>
                <a href="{{ route('user.letters.create') }}" 
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-hover font-bold">
                    <span class="material-symbols-outlined text-[20px]">add</span>
                    Ajukan Surat
                </a>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($requests->hasPages())
        <div class="mt-6">
            {{ $requests->links() }}
        </div>
    @endif
@endsection
