{{-- /resources/views/pages/admin/families/show.blade.php --}}

@extends('layouts.app')

@section('title', 'Detail Kartu Keluarga')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Kartu Keluarga</h1>
            <p class="mt-1 text-gray-600 font-mono">{{ $family->kk_number }}</p>
        </div>

        <div class="mt-3 sm:mt-0 flex space-x-2">
            <a href="{{ route('admin.families.edit', $family) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors">
                <i class="fas fa-edit mr-2"></i>Edit
            </a>
            <a href="{{ route('admin.families.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
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
        <!-- Family Info -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-800">Data Kartu Keluarga</h2>
                    <span class="px-3 py-1 text-sm font-semibold rounded-full {{ $family->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ $family->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                </div>
                
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-sm font-medium text-gray-500">Nomor KK</label>
                            <p class="mt-1 text-lg text-gray-800 font-mono">{{ $family->kk_number }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Kepala Keluarga</label>
                            <p class="mt-1 text-lg text-gray-800 font-semibold">{{ $family->head_name }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-sm font-medium text-gray-500">Alamat</label>
                            <p class="mt-1 text-gray-800">{{ $family->full_address }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Desa</label>
                            <p class="mt-1 text-gray-800">{{ $family->village->name ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-500">Jumlah Anggota</label>
                            <p class="mt-1 text-gray-800">{{ $family->members->count() }} orang</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Members List -->
            <div class="mt-6 bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-gray-800">Anggota Keluarga</h2>
                    <button onclick="showAddMemberModal()" class="px-3 py-1 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700">
                        <i class="fas fa-plus mr-1"></i>Tambah Anggota
                    </button>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIK</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($family->members as $member)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm text-gray-800">{{ $member->name }}</td>
                                <td class="px-6 py-4 text-sm font-mono text-gray-600">{{ $member->nik }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $member->family_role === 'head' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $member->family_role_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($member->family_role !== 'head')
                                    <form action="{{ route('admin.families.remove-member', [$family, $member]) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus dari keluarga?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                                            <i class="fas fa-user-minus"></i>
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                    Belum ada anggota keluarga
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <div class="bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl shadow-md text-white p-6">
                <div class="flex items-center mb-4">
                    <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center text-2xl">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="ml-4">
                        <p class="font-semibold text-lg">KK {{ substr($family->kk_number, -4) }}</p>
                        <p class="text-sm text-indigo-100">{{ $family->members->count() }} Anggota</p>
                    </div>
                </div>
                <div class="border-t border-white border-opacity-20 pt-4 space-y-2 text-sm">
                    <p><i class="fas fa-map-marker-alt mr-2"></i>RT {{ $family->rt ?? '-' }} / RW {{ $family->rw ?? '-' }}</p>
                    <p><i class="fas fa-building mr-2"></i>{{ $family->village->name ?? 'Desa' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Member Modal -->
    <div id="addMemberModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-black bg-opacity-50" onclick="hideAddMemberModal()"></div>
            
            <div class="relative bg-white rounded-xl shadow-xl max-w-md w-full p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Tambah Anggota Keluarga</h3>
                
                <form action="{{ route('admin.families.add-member', $family) }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="resident_id" class="block text-sm font-medium text-gray-700 mb-1">
                            Pilih Penduduk <span class="text-red-500">*</span>
                        </label>
                        <select name="resident_id" id="resident_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                            <option value="">-- Pilih Penduduk --</option>
                            @foreach(\App\Models\Resident::whereNull('family_id')->orderBy('name')->get() as $resident)
                                <option value="{{ $resident->id }}">{{ $resident->name }} ({{ $resident->nik }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="family_role" class="block text-sm font-medium text-gray-700 mb-1">
                            Status dalam Keluarga <span class="text-red-500">*</span>
                        </label>
                        <select name="family_role" id="family_role" class="w-full px-4 py-2 border border-gray-300 rounded-lg" required>
                            <option value="wife">Istri</option>
                            <option value="child">Anak</option>
                            <option value="parent">Orang Tua</option>
                            <option value="other">Lainnya</option>
                        </select>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="hideAddMemberModal()" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showAddMemberModal() {
            document.getElementById('addMemberModal').classList.remove('hidden');
        }
        function hideAddMemberModal() {
            document.getElementById('addMemberModal').classList.add('hidden');
        }
    </script>

@endsection
