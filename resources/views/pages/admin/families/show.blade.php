{{-- /resources/views/pages/admin/families/show.blade.php --}}

@extends('layouts.app')

@section('title', 'Detail Kartu Keluarga')

@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-black text-dark-grey dark:text-white">Kartu Keluarga</h1>
            <p class="mt-1 text-text-secondary dark:text-gray-400 font-mono">{{ $family->kk_number }}</p>
        </div>

        <div class="mt-3 sm:mt-0 flex gap-2">
            <a href="{{ route('admin.families.edit', $family) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition-colors font-bold">
                <span class="material-symbols-outlined text-[20px]">edit</span>Edit
            </a>
            <a href="{{ route('admin.families.index') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-border-light dark:border-border-dark text-dark-grey dark:text-white rounded-lg hover:bg-gray-50 dark:hover:bg-white/5 transition-colors font-bold">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span>Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Family Info -->
        <div class="lg:col-span-2">
            <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
                <div class="p-6 border-b border-border-light dark:border-border-dark flex items-center justify-between">
                    <h2 class="text-lg font-bold text-dark-grey dark:text-white">Data Kartu Keluarga</h2>
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide rounded-full {{ $family->status === 'active' ? 'bg-primary/10 text-primary' : 'bg-gray-100 text-gray-800 dark:bg-white/10 dark:text-gray-300' }}">
                        <span class="material-symbols-outlined text-[14px]">{{ $family->status === 'active' ? 'check_circle' : 'cancel' }}</span>
                        {{ $family->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                    </span>
                </div>
                
                <div class="p-6 space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Nomor KK</label>
                            <p class="mt-1 text-lg text-dark-grey dark:text-white font-mono">{{ $family->kk_number }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Kepala Keluarga</label>
                            <p class="mt-1 text-lg text-dark-grey dark:text-white font-bold">{{ $family->head_name }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Alamat</label>
                            <p class="mt-1 text-dark-grey dark:text-white">{{ $family->full_address }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Desa</label>
                            <p class="mt-1 text-dark-grey dark:text-white">{{ $family->village->name ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Jumlah Anggota</label>
                            <p class="mt-1 text-dark-grey dark:text-white">{{ $family->members->count() }} orang</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Members List -->
            <div class="mt-6 bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
                <div class="p-6 border-b border-border-light dark:border-border-dark flex items-center justify-between">
                    <h2 class="text-lg font-bold text-dark-grey dark:text-white">Anggota Keluarga</h2>
                    <button onclick="showAddMemberModal()" class="inline-flex items-center gap-1 px-3 py-1.5 bg-primary text-white rounded-lg text-sm hover:bg-primary-hover transition-colors font-bold">
                        <span class="material-symbols-outlined text-[18px]">add</span>Tambah Anggota
                    </button>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 dark:bg-white/5">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">NIK</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-border-light dark:divide-border-dark">
                            @forelse($family->members as $member)
                            <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                                <td class="px-6 py-4 text-sm text-dark-grey dark:text-white font-bold">{{ $member->name }}</td>
                                <td class="px-6 py-4 text-sm font-mono text-text-secondary dark:text-gray-400">{{ $member->nik }}</td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide rounded-full {{ $member->family_role === 'head' ? 'bg-earth/10 text-earth' : 'bg-gray-100 text-gray-800 dark:bg-white/10 dark:text-gray-300' }}">
                                        {{ $member->family_role_label }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($member->family_role !== 'head')
                                    <form action="{{ route('admin.families.remove-member', [$family, $member]) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus dari keluarga?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">
                                            <span class="material-symbols-outlined text-[20px]">person_remove</span>
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-text-secondary dark:text-gray-400">
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
            <div class="bg-gradient-to-br from-primary to-primary-hover rounded-xl shadow-sm text-white p-6">
                <div class="flex items-center mb-4">
                    <div class="size-16 bg-white/20 rounded-full flex items-center justify-center">
                        <span class="material-symbols-outlined text-3xl">family_restroom</span>
                    </div>
                    <div class="ml-4">
                        <p class="font-bold text-lg">KK {{ substr($family->kk_number, -4) }}</p>
                        <p class="text-sm text-white/80">{{ $family->members->count() }} Anggota</p>
                    </div>
                </div>
                <div class="border-t border-white/20 pt-4 space-y-2 text-sm">
                    <p class="flex items-center gap-2"><span class="material-symbols-outlined text-[18px]">location_on</span>RT {{ $family->rt ?? '-' }} / RW {{ $family->rw ?? '-' }}</p>
                    <p class="flex items-center gap-2"><span class="material-symbols-outlined text-[18px]">location_city</span>{{ $family->village->name ?? 'Desa' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Member Modal -->
    <div id="addMemberModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" onclick="hideAddMemberModal()"></div>
            
            <div class="relative bg-white dark:bg-surface-dark rounded-xl shadow-xl border border-border-light dark:border-border-dark max-w-md w-full p-6">
                <h3 class="text-lg font-bold text-dark-grey dark:text-white mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">person_add</span>
                    Tambah Anggota Keluarga
                </h3>
                
                <form action="{{ route('admin.families.add-member', $family) }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="resident_id" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">
                            Pilih Penduduk <span class="text-red-500">*</span>
                        </label>
                        <select name="resident_id" id="resident_id" class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary" required>
                            <option value="">-- Pilih Penduduk --</option>
                            @foreach(\App\Models\Resident::whereNull('family_id')->orderBy('name')->get() as $resident)
                                <option value="{{ $resident->id }}">{{ $resident->name }} ({{ $resident->nik }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="family_role" class="block text-sm font-bold text-dark-grey dark:text-white mb-2">
                            Status dalam Keluarga <span class="text-red-500">*</span>
                        </label>
                        <select name="family_role" id="family_role" class="w-full px-4 py-3 border border-border-light dark:border-border-dark rounded-lg bg-white dark:bg-surface-dark text-dark-grey dark:text-white focus:ring-2 focus:ring-primary focus:border-primary" required>
                            <option value="wife">Istri</option>
                            <option value="child">Anak</option>
                            <option value="parent">Orang Tua</option>
                            <option value="other">Lainnya</option>
                        </select>
                    </div>
                    
                    <div class="flex justify-end gap-3">
                        <button type="button" onclick="hideAddMemberModal()" class="px-4 py-2 font-bold text-dark-grey dark:text-white bg-gray-100 dark:bg-white/10 rounded-lg hover:bg-gray-200 dark:hover:bg-white/20 transition-colors">
                            Batal
                        </button>
                        <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-primary text-white font-bold rounded-lg hover:bg-primary-hover transition-colors">
                            <span class="material-symbols-outlined text-[18px]">add</span>Tambah
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
