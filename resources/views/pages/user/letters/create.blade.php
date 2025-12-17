@extends('layouts.user')

@section('title', 'Ajukan Surat')

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Ajukan Surat</h1>
                <p class="text-gray-600">Isi formulir pengajuan surat</p>
            </div>
            <a href="{{ route('user.letters.index') }}"
               class="inline-flex items-center px-4 py-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <form action="{{ route('user.letters.store') }}" method="POST" class="bg-white rounded-xl shadow-sm p-6">
            @csrf

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <p class="text-red-800">{{ session('error') }}</p>
                </div>
            @endif

            <div class="space-y-6">
                <!-- Letter Type -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Surat *</label>
                    <div class="grid grid-cols-1 gap-3">
                        @foreach($letterTypes as $type)
                            <label class="relative cursor-pointer">
                                <input type="radio" name="letter_type_id" value="{{ $type->id }}" 
                                       class="peer sr-only" {{ old('letter_type_id') == $type->id ? 'checked' : '' }} required>
                                <div class="p-4 border-2 rounded-xl peer-checked:border-indigo-600 peer-checked:bg-indigo-50 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-start">
                                        <div class="w-10 h-10 rounded-lg bg-indigo-100 flex items-center justify-center mr-4 shrink-0">
                                            <span class="text-xs font-bold text-indigo-600">{{ $type->code }}</span>
                                        </div>
                                        <div>
                                            <h4 class="font-medium text-gray-900">{{ $type->name }}</h4>
                                            @if($type->description)
                                                <p class="text-sm text-gray-500">{{ $type->description }}</p>
                                            @endif
                                            @if($type->requirements)
                                                <p class="text-xs text-gray-400 mt-1">
                                                    <i class="fas fa-info-circle mr-1"></i>
                                                    Syarat: {{ $type->requirements }}
                                                </p>
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

                <!-- Purpose -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Keperluan/Tujuan *</label>
                    <textarea name="purpose" rows="3" required
                              class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500 @error('purpose') border-red-500 @enderror"
                              placeholder="Jelaskan keperluan pembuatan surat ini...">{{ old('purpose') }}</textarea>
                    @error('purpose')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Notes -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Tambahan</label>
                    <textarea name="notes" rows="2"
                              class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-indigo-500"
                              placeholder="Catatan tambahan jika ada...">{{ old('notes') }}</textarea>
                </div>

                <!-- Info -->
                <div class="p-4 bg-blue-50 rounded-lg">
                    <p class="text-sm text-blue-800">
                        <i class="fas fa-info-circle mr-1"></i>
                        Setelah mengajukan, admin desa akan memproses pengajuan anda. Anda akan mendapat notifikasi jika surat sudah selesai.
                    </p>
                </div>

                <!-- Submit -->
                <button type="submit"
                        class="w-full py-3 px-4 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition-colors">
                    <i class="fas fa-paper-plane mr-2"></i>
                    Kirim Pengajuan
                </button>
            </div>
        </form>
    </div>
@endsection
