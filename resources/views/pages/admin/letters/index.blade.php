@extends('layouts.app')

@section('title', 'Pengajuan Surat')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-black text-dark-grey dark:text-white">Pengajuan Surat</h1>
            <p class="mt-1 text-text-secondary dark:text-gray-400">Kelola pengajuan surat dari warga</p>
        </div>
    </div>

    <!-- Status Tabs -->
    <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark mb-6">
        <div class="border-b border-border-light dark:border-border-dark">
            <nav class="flex -mb-px overflow-x-auto">
                <a href="{{ route('admin.letters.index', ['status' => 'pending']) }}"
                   class="px-6 py-4 text-sm font-bold flex items-center gap-2 border-b-2 transition-colors whitespace-nowrap {{ $status === 'pending' ? 'border-primary text-primary' : 'border-transparent text-text-secondary hover:text-dark-grey dark:hover:text-white' }}">
                    <span class="material-symbols-outlined text-[20px]">schedule</span>
                    Menunggu
                    @if($counts['pending'] > 0)
                        <span class="px-2 py-0.5 text-[10px] font-bold rounded-full bg-yellow-100 text-yellow-800">{{ $counts['pending'] }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.letters.index', ['status' => 'processing']) }}"
                   class="px-6 py-4 text-sm font-bold flex items-center gap-2 border-b-2 transition-colors whitespace-nowrap {{ $status === 'processing' ? 'border-primary text-primary' : 'border-transparent text-text-secondary hover:text-dark-grey dark:hover:text-white' }}">
                    <span class="material-symbols-outlined text-[20px]">sync</span>
                    Diproses
                    <span class="px-2 py-0.5 text-[10px] font-bold rounded-full bg-sky-blue/10 text-sky-blue">{{ $counts['processing'] }}</span>
                </a>
                <a href="{{ route('admin.letters.index', ['status' => 'completed']) }}"
                   class="px-6 py-4 text-sm font-bold flex items-center gap-2 border-b-2 transition-colors whitespace-nowrap {{ $status === 'completed' ? 'border-primary text-primary' : 'border-transparent text-text-secondary hover:text-dark-grey dark:hover:text-white' }}">
                    <span class="material-symbols-outlined text-[20px]">check_circle</span>
                    Selesai
                    <span class="px-2 py-0.5 text-[10px] font-bold rounded-full bg-primary/10 text-primary">{{ $counts['completed'] }}</span>
                </a>
                <a href="{{ route('admin.letters.index', ['status' => 'rejected']) }}"
                   class="px-6 py-4 text-sm font-bold flex items-center gap-2 border-b-2 transition-colors whitespace-nowrap {{ $status === 'rejected' ? 'border-primary text-primary' : 'border-transparent text-text-secondary hover:text-dark-grey dark:hover:text-white' }}">
                    <span class="material-symbols-outlined text-[20px]">cancel</span>
                    Ditolak
                    <span class="px-2 py-0.5 text-[10px] font-bold rounded-full bg-red-100 text-red-800">{{ $counts['rejected'] }}</span>
                </a>
            </nav>
        </div>
    </div>

    <!-- Requests Table -->
    <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
        @if($requests->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-border-light dark:divide-border-dark">
                    <thead class="bg-gray-50 dark:bg-white/5">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">No. Pengajuan</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Pemohon</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Jenis Surat</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-surface-dark divide-y divide-border-light dark:divide-border-dark">
                        @foreach($requests as $request)
                            <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('admin.letters.show', $request) }}" class="text-sm font-bold text-primary hover:underline">{{ $request->request_number }}</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="size-8 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                                            <span class="material-symbols-outlined text-[18px]">person</span>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-bold text-dark-grey dark:text-white">{{ $request->user->name }}</div>
                                            <div class="text-xs text-text-secondary dark:text-gray-400">{{ $request->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-[10px] font-bold uppercase tracking-wide rounded bg-primary/10 text-primary">
                                        {{ $request->letterType->code }}
                                    </span>
                                    <span class="text-sm text-dark-grey dark:text-white ml-2">{{ $request->letterType->name }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary dark:text-gray-400">
                                    {{ $request->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($request->status === 'pending')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide rounded-full bg-yellow-100 text-yellow-800">
                                            <span class="material-symbols-outlined text-[14px]">schedule</span> Menunggu
                                        </span>
                                    @elseif($request->status === 'processing')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide rounded-full bg-sky-blue/10 text-sky-blue">
                                            <span class="material-symbols-outlined text-[14px]">sync</span> Diproses
                                        </span>
                                    @elseif($request->status === 'completed')
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide rounded-full bg-primary/10 text-primary">
                                            <span class="material-symbols-outlined text-[14px]">check_circle</span> Selesai
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide rounded-full bg-red-100 text-red-800">
                                            <span class="material-symbols-outlined text-[14px]">cancel</span> Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.letters.show', $request) }}" class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Lihat Detail">
                                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                                        </a>
                                        
                                        @if($request->status === 'pending')
                                            <form action="{{ route('admin.letters.process', $request) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-sky-blue text-white text-xs font-bold rounded-lg hover:bg-sky-blue/80 transition-colors">
                                                    <span class="material-symbols-outlined text-[16px]">play_arrow</span> Proses
                                                </button>
                                            </form>
                                        @elseif($request->status === 'processing')
                                            <form action="{{ route('admin.letters.complete', $request) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="inline-flex items-center gap-1 px-3 py-1.5 bg-primary text-white text-xs font-bold rounded-lg hover:bg-primary-hover transition-colors">
                                                    <span class="material-symbols-outlined text-[16px]">check</span> Selesai
                                                </button>
                                            </form>
                                        @endif
                                        
                                        @if(in_array($request->status, ['pending', 'processing']))
                                            <button type="button" onclick="showRejectModal({{ $request->id }})" 
                                                    class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-600 text-white text-xs font-bold rounded-lg hover:bg-red-700 transition-colors">
                                                <span class="material-symbols-outlined text-[16px]">close</span> Tolak
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($requests->hasPages())
                <div class="px-6 py-4 border-t border-border-light dark:border-border-dark">
                    {{ $requests->appends(['status' => $status])->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-12">
                <div class="size-16 rounded-full bg-gray-100 dark:bg-white/5 flex items-center justify-center mx-auto mb-4">
                    <span class="material-symbols-outlined text-3xl text-gray-400">description</span>
                </div>
                <h3 class="text-lg font-bold text-dark-grey dark:text-white mb-1">Tidak ada pengajuan</h3>
                <p class="text-text-secondary dark:text-gray-400">Belum ada pengajuan surat dengan status ini.</p>
            </div>
        @endif
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
                <form id="rejectForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-dark-grey dark:text-white mb-2">Alasan Penolakan *</label>
                        <textarea name="rejection_reason" rows="3" required
                                  class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                  placeholder="Masukkan alasan penolakan..."></textarea>
                    </div>
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="hideRejectModal()" class="px-4 py-2 font-bold text-dark-grey dark:text-white bg-gray-100 dark:bg-white/10 rounded-lg hover:bg-gray-200 dark:hover:bg-white/20 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white font-bold rounded-lg hover:bg-red-700 transition-colors">
                            <span class="material-symbols-outlined text-[18px]">close</span> Tolak
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showRejectModal(id) {
            document.getElementById('rejectForm').action = `/admin/letters/${id}/reject`;
            document.getElementById('rejectModal').classList.remove('hidden');
        }
        function hideRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }
    </script>
@endsection
