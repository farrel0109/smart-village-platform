@extends('layouts.user')

@section('title', 'Pengajuan Surat')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Pengajuan Surat</h1>
            <p class="text-gray-600">Riwayat pengajuan surat anda</p>
        </div>
        <a href="{{ route('user.letters.create') }}"
           class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors shadow-sm mt-4 sm:mt-0">
            <i class="fas fa-plus mr-2"></i>
            Ajukan Surat Baru
        </a>
    </div>

    <!-- Requests List -->
    <div class="space-y-4">
        @forelse($requests as $request)
            <div class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <div class="flex items-center space-x-3 mb-2">
                            <span class="text-sm font-medium text-indigo-600">{{ $request->request_number }}</span>
                            <span class="px-2 py-1 text-xs rounded-full bg-{{ $request->status_color }}-100 text-{{ $request->status_color }}-800">
                                {{ $request->status_label }}
                            </span>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $request->letterType->name }}</h3>
                        <p class="text-sm text-gray-600 mb-2">{{ Str::limit($request->purpose, 100) }}</p>
                        <p class="text-xs text-gray-400">
                            <i class="fas fa-calendar mr-1"></i>
                            Diajukan {{ $request->created_at->diffForHumans() }}
                        </p>
                    </div>
                    <div class="ml-4">
                        <div class="w-12 h-12 rounded-xl bg-indigo-100 flex items-center justify-center">
                            <i class="fas fa-file-alt text-indigo-600 text-xl"></i>
                        </div>
                    </div>
                </div>

                @if($request->status === 'rejected' && $request->rejection_reason)
                    <div class="mt-4 p-3 bg-red-50 rounded-lg">
                        <p class="text-sm text-red-800">
                            <i class="fas fa-info-circle mr-1"></i>
                            <strong>Alasan penolakan:</strong> {{ $request->rejection_reason }}
                        </p>
                    </div>
                @endif

                @if($request->status === 'completed')
                    <div class="mt-4 p-3 bg-green-50 rounded-lg">
                        <p class="text-sm text-green-800">
                            <i class="fas fa-check-circle mr-1"></i>
                            Surat anda sudah selesai. Silakan ambil di kantor desa.
                        </p>
                    </div>
                @endif
            </div>
        @empty
            <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-file-alt text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-1">Belum ada pengajuan</h3>
                <p class="text-gray-500 mb-4">Anda belum pernah mengajukan surat.</p>
                <a href="{{ route('user.letters.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                    <i class="fas fa-plus mr-2"></i> Ajukan Surat
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
