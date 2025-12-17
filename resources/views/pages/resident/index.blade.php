@extends('layouts.app')

@section('title', 'Data Penduduk')

@section('page-title', 'Data Penduduk')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-3xl font-black text-dark-grey dark:text-white">Data Penduduk</h1>
            <p class="mt-1 text-text-secondary dark:text-gray-400">Kelola data penduduk desa</p>
        </div>
        <a href="{{ route('admin.residents.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors shadow-sm font-bold mt-4 sm:mt-0">
            <span class="material-symbols-outlined text-[20px]">person_add</span>
            Tambah Penduduk
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-surface-dark rounded-xl shadow-sm border border-border-light dark:border-border-dark overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-border-light dark:divide-border-dark">
                <thead class="bg-gray-50 dark:bg-white/5">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">NIK</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Jenis Kelamin</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">TTL</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Alamat</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-text-secondary dark:text-gray-400 uppercase tracking-wider">Aksi</th>
                </tr>
                </thead>
                <tbody class="bg-white dark:bg-surface-dark divide-y divide-border-light dark:divide-border-dark">
                @forelse ($residents as $item)
                    <tr class="hover:bg-gray-50 dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-dark-grey dark:text-white">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-dark-grey dark:text-white">{{ $item->nik }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="size-8 rounded-full flex items-center justify-center {{ $item->gender == 'male' ? 'bg-sky-blue/10 text-sky-blue' : 'bg-pink-100 text-pink-600' }}">
                                    <span class="material-symbols-outlined text-[18px]">{{ $item->gender == 'male' ? 'male' : 'female' }}</span>
                                </div>
                                <span class="ml-3 text-sm font-bold text-dark-grey dark:text-white">{{ $item->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide rounded-full {{ $item->gender == 'male' ? 'bg-sky-blue/10 text-sky-blue' : 'bg-pink-100 text-pink-600' }}">
                                <span class="material-symbols-outlined text-[14px]">{{ $item->gender == 'male' ? 'male' : 'female' }}</span>
                                {{ $item->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-text-secondary dark:text-gray-400">{{ $item->birth_place }}, {{ \Carbon\Carbon::parse($item->birth_date)->format('d/m/Y') }}</td>
                        <td class="px-6 py-4 text-sm text-text-secondary dark:text-gray-400 max-w-xs truncate">{{ $item->address }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($item->status == 'active')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide rounded-full bg-primary/10 text-primary">
                                    <span class="material-symbols-outlined text-[14px]">check_circle</span> Aktif
                                </span>
                            @elseif($item->status == 'moved')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide rounded-full bg-sky-blue/10 text-sky-blue">
                                    <span class="material-symbols-outlined text-[14px]">transfer_within_a_station</span> Pindah
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wide rounded-full bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                                    <span class="material-symbols-outlined text-[14px]">person_off</span> Meninggal
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center gap-1">
                                <a href="{{ route('admin.residents.edit', $item) }}"
                                   class="p-2 text-yellow-600 hover:bg-yellow-50 dark:hover:bg-yellow-900/20 rounded-lg transition-colors"
                                   title="Edit">
                                    <span class="material-symbols-outlined text-[20px]">edit</span>
                                </a>
                                <button onclick="openDeleteModal({{ $item->id }}, '{{ $item->name }}')"
                                        class="p-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors"
                                        title="Hapus">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="size-16 rounded-full bg-gray-100 dark:bg-white/5 flex items-center justify-center mb-4">
                                    <span class="material-symbols-outlined text-3xl text-gray-400">groups</span>
                                </div>
                                <h3 class="text-lg font-bold text-dark-grey dark:text-white mb-1">Tidak ada data penduduk</h3>
                                <p class="text-text-secondary dark:text-gray-400 mb-4">Mulai dengan menambahkan data penduduk pertama.</p>
                                <a href="{{ route('admin.residents.create') }}"
                                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-primary text-white rounded-lg hover:bg-primary-hover transition-colors font-bold">
                                    <span class="material-symbols-outlined text-[20px]">person_add</span>
                                    Tambah Data Pertama
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 p-4">
        <div class="bg-white dark:bg-surface-dark rounded-xl shadow-xl border border-border-light dark:border-border-dark max-w-md w-full p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-dark-grey dark:text-white flex items-center gap-2">
                    <span class="material-symbols-outlined text-red-600">warning</span>
                    Konfirmasi Hapus
                </h3>
                <button onclick="closeDeleteModal()" class="p-1.5 rounded-lg hover:bg-gray-100 dark:hover:bg-white/5 text-gray-400 hover:text-gray-600 transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <div class="mb-6">
                <p class="text-text-secondary dark:text-gray-400">Apakah anda yakin menghapus data penduduk ini?</p>
                <p id="delete-resident-info" class="text-sm font-bold text-dark-grey dark:text-white mt-2"></p>
            </div>

            <div class="flex justify-end gap-3">
                <button onclick="closeDeleteModal()" class="px-4 py-2 text-sm font-bold text-dark-grey dark:text-white bg-gray-100 dark:bg-white/10 hover:bg-gray-200 dark:hover:bg-white/20 rounded-lg transition-colors">
                    Batal
                </button>
                <form id="delete-form" method="post" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-bold text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors">
                        <span class="material-symbols-outlined text-[18px]">delete</span>
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function openDeleteModal(id, name) {
            const modal = document.getElementById('delete-modal');
            const form = document.getElementById('delete-form');
            const info = document.getElementById('delete-resident-info');

            form.action = `/admin/residents/${id}`;
            info.textContent = `Nama: ${name}`;
            modal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('delete-modal');
            modal.classList.add('hidden');
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(event) {
            const deleteModal = document.getElementById('delete-modal');
            if (event.target === deleteModal) {
                closeDeleteModal();
            }
        });
    </script>
@endpush
