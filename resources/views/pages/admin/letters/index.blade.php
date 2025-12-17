@extends('layouts.app')

@section('title', 'Pengajuan Surat')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Pengajuan Surat</h1>
            <p class="text-gray-600">Kelola pengajuan surat dari warga</p>
        </div>
    </div>

    <!-- Status Tabs -->
    <div class="bg-white rounded-xl shadow-sm mb-6">
        <div class="border-b border-gray-200">
            <nav class="flex -mb-px overflow-x-auto">
                <a href="{{ route('admin.letters.index', ['status' => 'pending']) }}"
                   class="px-6 py-4 text-sm font-medium whitespace-nowrap {{ $status === 'pending' ? 'border-b-2 border-indigo-600 text-indigo-600' : 'text-gray-500 hover:text-gray-700' }}">
                    <i class="fas fa-clock mr-2"></i>
                    Menunggu
                    @if($counts['pending'] > 0)
                        <span class="ml-2 px-2 py-0.5 text-xs rounded-full bg-yellow-100 text-yellow-800">{{ $counts['pending'] }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.letters.index', ['status' => 'processing']) }}"
                   class="px-6 py-4 text-sm font-medium whitespace-nowrap {{ $status === 'processing' ? 'border-b-2 border-indigo-600 text-indigo-600' : 'text-gray-500 hover:text-gray-700' }}">
                    <i class="fas fa-spinner mr-2"></i>
                    Diproses
                    <span class="ml-2 px-2 py-0.5 text-xs rounded-full bg-blue-100 text-blue-800">{{ $counts['processing'] }}</span>
                </a>
                <a href="{{ route('admin.letters.index', ['status' => 'completed']) }}"
                   class="px-6 py-4 text-sm font-medium whitespace-nowrap {{ $status === 'completed' ? 'border-b-2 border-indigo-600 text-indigo-600' : 'text-gray-500 hover:text-gray-700' }}">
                    <i class="fas fa-check-circle mr-2"></i>
                    Selesai
                    <span class="ml-2 px-2 py-0.5 text-xs rounded-full bg-green-100 text-green-800">{{ $counts['completed'] }}</span>
                </a>
                <a href="{{ route('admin.letters.index', ['status' => 'rejected']) }}"
                   class="px-6 py-4 text-sm font-medium whitespace-nowrap {{ $status === 'rejected' ? 'border-b-2 border-indigo-600 text-indigo-600' : 'text-gray-500 hover:text-gray-700' }}">
                    <i class="fas fa-times-circle mr-2"></i>
                    Ditolak
                    <span class="ml-2 px-2 py-0.5 text-xs rounded-full bg-red-100 text-red-800">{{ $counts['rejected'] }}</span>
                </a>
            </nav>
        </div>
    </div>

    <!-- Requests Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        @if($requests->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No. Pengajuan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pemohon</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis Surat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($requests as $request)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm font-medium text-indigo-600">{{ $request->request_number }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $request->user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $request->user->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs rounded-full bg-indigo-100 text-indigo-800">
                                        {{ $request->letterType->code }}
                                    </span>
                                    <span class="text-sm text-gray-600 ml-1">{{ $request->letterType->name }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $request->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs rounded-full bg-{{ $request->status_color }}-100 text-{{ $request->status_color }}-800">
                                        {{ $request->status_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <div class="flex items-center space-x-2">
                                        @if($request->status === 'pending')
                                            <form action="{{ route('admin.letters.process', $request) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="px-3 py-1.5 bg-blue-600 text-white text-xs rounded-lg hover:bg-blue-700 transition-colors">
                                                    <i class="fas fa-play mr-1"></i> Proses
                                                </button>
                                            </form>
                                        @elseif($request->status === 'processing')
                                            <form action="{{ route('admin.letters.complete', $request) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="px-3 py-1.5 bg-green-600 text-white text-xs rounded-lg hover:bg-green-700 transition-colors">
                                                    <i class="fas fa-check mr-1"></i> Selesai
                                                </button>
                                            </form>
                                        @endif
                                        
                                        @if(in_array($request->status, ['pending', 'processing']))
                                            <button type="button" onclick="showRejectModal({{ $request->id }})" 
                                                    class="px-3 py-1.5 bg-red-600 text-white text-xs rounded-lg hover:bg-red-700 transition-colors">
                                                <i class="fas fa-times mr-1"></i> Tolak
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
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $requests->appends(['status' => $status])->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-12">
                <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-file-alt text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-1">Tidak ada pengajuan</h3>
                <p class="text-gray-500">Belum ada pengajuan surat dengan status ini.</p>
            </div>
        @endif
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 z-50 hidden overflow-y-auto" x-data>
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-black bg-opacity-50" onclick="hideRejectModal()"></div>
            <div class="relative bg-white rounded-xl shadow-xl max-w-md w-full p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Tolak Pengajuan</h3>
                <form id="rejectForm" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alasan Penolakan *</label>
                        <textarea name="rejection_reason" rows="3" required
                                  class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-red-500"
                                  placeholder="Masukkan alasan penolakan..."></textarea>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="hideRejectModal()" class="px-4 py-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
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
        function showRejectModal(id) {
            document.getElementById('rejectForm').action = `/admin/letters/${id}/reject`;
            document.getElementById('rejectModal').classList.remove('hidden');
        }
        function hideRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }
    </script>
@endsection
