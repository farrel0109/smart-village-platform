@extends('layouts.user')

@section('title', 'Ajukan Surat')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-black text-dark-grey">Ajukan Surat</h1>
                <p class="mt-1 text-text-secondary">Isi formulir pengajuan surat</p>
            </div>
            <a href="{{ route('user.letters.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2 text-dark-grey bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors font-bold">
                <span class="material-symbols-outlined text-[20px]">arrow_back</span>
                Kembali
            </a>
        </div>

        <form action="{{ route('user.letters.store') }}" method="POST" enctype="multipart/form-data" 
              class="bg-white rounded-xl shadow-sm border border-border-light p-6"
              x-data="{ 
                  selectedType: '{{ old('letter_type_id') }}', 
                  types: {{ $letterTypes->map(fn($t) => ['id' => $t->id, 'code' => $t->code])->toJson() }},
                  getTypeCode() {
                      return this.types.find(t => t.id == this.selectedType)?.code;
                  }
              }">
            @csrf

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg flex items-start gap-3">
                    <span class="material-symbols-outlined text-red-600">error</span>
                    <p class="text-red-800">{{ session('error') }}</p>
                </div>
            @endif

            <div class="space-y-6">
                <!-- Letter Type -->
                <div>
                    <label class="block text-sm font-bold text-dark-grey mb-3">Jenis Surat *</label>
                    <div class="grid grid-cols-1 gap-3">
                        @foreach($letterTypes as $type)
                            <label class="relative cursor-pointer">
                                <input type="radio" name="letter_type_id" value="{{ $type->id }}" 
                                       x-model="selectedType"
                                       class="peer sr-only" required>
                                <div class="p-4 border-2 border-border-light rounded-xl peer-checked:border-primary peer-checked:bg-primary/5 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-start">
                                        <div class="size-10 rounded-lg bg-primary/10 flex items-center justify-center mr-4 shrink-0">
                                            <span class="text-xs font-black text-primary">{{ $type->code }}</span>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-dark-grey">{{ $type->name }}</h4>
                                            @if($type->description)
                                                <p class="text-sm text-text-secondary">{{ $type->description }}</p>
                                            @endif
                                            @if($type->requirements)
                                                <div class="mt-2">
                                                    <p class="text-xs font-bold text-text-secondary mb-1">Syarat Dokumen:</p>
                                                    <ul class="list-disc list-inside text-xs text-text-secondary">
                                                        @foreach($type->requirements as $req)
                                                            <li>{{ $req }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    @error('letter_type_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Dynamic Fields Section -->
                <div x-show="selectedType" x-transition class="border-t border-border-light pt-6">
                    <h3 class="text-lg font-bold text-dark-grey mb-4">Data Tambahan</h3>
                    
                    <!-- SKU Fields -->
                    <template x-if="getTypeCode() === 'SKU'">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold text-dark-grey mb-2">Nama Usaha *</label>
                                <input type="text" name="dynamic_data[business_name]" class="w-full px-4 py-3 border border-border-light rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" placeholder="Contoh: Warung Makan Sejahtera">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-dark-grey mb-2">Alamat Usaha *</label>
                                <textarea name="dynamic_data[business_address]" rows="2" class="w-full px-4 py-3 border border-border-light rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" placeholder="Alamat lengkap tempat usaha"></textarea>
                            </div>
                        </div>
                    </template>

                    <!-- SKPD Fields -->
                    <template x-if="getTypeCode() === 'SKPD'">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold text-dark-grey mb-2">Alamat Tujuan Pindah *</label>
                                <textarea name="dynamic_data[move_address]" rows="2" class="w-full px-4 py-3 border border-border-light rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" placeholder="Alamat lengkap tujuan pindah"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-dark-grey mb-2">Alasan Pindah *</label>
                                <input type="text" name="dynamic_data[move_reason]" class="w-full px-4 py-3 border border-border-light rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" placeholder="Contoh: Pekerjaan / Ikut Suami">
                            </div>
                        </div>
                    </template>

                    <!-- SKM/SKW Fields -->
                    <template x-if="['SKM', 'SKW'].includes(getTypeCode())">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold text-dark-grey mb-2">Nama Almarhum/ah *</label>
                                <input type="text" name="dynamic_data[deceased_name]" class="w-full px-4 py-3 border border-border-light rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-dark-grey mb-2">Tanggal Meninggal *</label>
                                <input type="date" name="dynamic_data[deceased_date]" class="w-full px-4 py-3 border border-border-light rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                            </div>
                            <template x-if="getTypeCode() === 'SKM'">
                                <div>
                                    <label class="block text-sm font-bold text-dark-grey mb-2">Penyebab Kematian</label>
                                    <input type="text" name="dynamic_data[deceased_reason]" class="w-full px-4 py-3 border border-border-light rounded-lg focus:ring-2 focus:ring-primary focus:border-primary" placeholder="Contoh: Sakit / Kecelakaan">
                                </div>
                            </template>
                        </div>
                    </template>

                    <!-- SKL Fields -->
                    <template x-if="getTypeCode() === 'SKL'">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-bold text-dark-grey mb-2">Nama Anak *</label>
                                <input type="text" name="dynamic_data[child_name]" class="w-full px-4 py-3 border border-border-light rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-bold text-dark-grey mb-2">Tempat Lahir *</label>
                                    <input type="text" name="dynamic_data[birth_place]" class="w-full px-4 py-3 border border-border-light rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-dark-grey mb-2">Tanggal Lahir *</label>
                                    <input type="date" name="dynamic_data[birth_date]" class="w-full px-4 py-3 border border-border-light rounded-lg focus:ring-2 focus:ring-primary focus:border-primary">
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Attachments Section -->
                <div class="border-t border-border-light pt-6">
                    <h3 class="text-lg font-bold text-dark-grey mb-4">Lampiran Dokumen</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Surat Pengantar RT -->
                        <div>
                            <label class="block text-sm font-bold text-dark-grey mb-2">Surat Pengantar RT *</label>
                            <input type="file" name="attachments[rt]" accept=".pdf,.jpg,.jpeg,.png" required
                                   class="block w-full text-sm text-text-secondary file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                            <p class="text-xs text-text-secondary mt-1">Format: PDF/JPG/PNG, Max: 2MB</p>
                        </div>

                        <!-- Surat Pengantar RW -->
                        <div>
                            <label class="block text-sm font-bold text-dark-grey mb-2">Surat Pengantar RW *</label>
                            <input type="file" name="attachments[rw]" accept=".pdf,.jpg,.jpeg,.png" required
                                   class="block w-full text-sm text-text-secondary file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                            <p class="text-xs text-text-secondary mt-1">Format: PDF/JPG/PNG, Max: 2MB</p>
                        </div>

                        <!-- Other Attachments (Optional) -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-dark-grey mb-2">Dokumen Pendukung Lainnya (Opsional)</label>
                            <input type="file" name="attachments[other][]" multiple accept=".pdf,.jpg,.jpeg,.png"
                                   class="block w-full text-sm text-text-secondary file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                            <p class="text-xs text-text-secondary mt-1">Bisa upload multiple file. Contoh: KTP, KK, Akta, dll.</p>
                        </div>
                    </div>
                </div>

                <!-- Purpose -->
                <div class="border-t border-border-light pt-6">
                    <label class="block text-sm font-bold text-dark-grey mb-2">Keperluan/Tujuan *</label>
                    <textarea name="purpose" rows="3" required
                              class="w-full px-4 py-3 border border-border-light rounded-lg focus:ring-2 focus:ring-primary focus:border-primary @error('purpose') border-red-500 @enderror"
                              placeholder="Jelaskan keperluan pembuatan surat ini...">{{ old('purpose') }}</textarea>
                    @error('purpose')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Notes -->
                <div>
                    <label class="block text-sm font-bold text-dark-grey mb-2">Catatan Tambahan</label>
                    <textarea name="notes" rows="2"
                              class="w-full px-4 py-3 border border-border-light rounded-lg focus:ring-2 focus:ring-primary focus:border-primary"
                              placeholder="Catatan tambahan jika ada...">{{ old('notes') }}</textarea>
                </div>

                <!-- Info -->
                <div class="p-4 bg-sky-blue/10 rounded-lg flex items-start gap-3">
                    <span class="material-symbols-outlined text-sky-blue">info</span>
                    <p class="text-sm text-sky-blue">
                        Pastikan semua data dan lampiran sudah benar sebelum mengirim pengajuan.
                    </p>
                </div>

                <!-- Submit -->
                <button type="submit"
                        class="w-full py-3 px-4 bg-primary text-white rounded-lg font-bold hover:bg-primary-hover transition-colors inline-flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined">send</span>
                    Kirim Pengajuan
                </button>
            </div>
        </form>
    </div>
@endsection
