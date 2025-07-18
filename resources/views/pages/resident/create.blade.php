@extends('layouts.app')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Penduduk</h1>

</div>
{{-- Form --}}
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('pages.resident.index') }}">
                    @csrf
                    @method('POST')
                    {{-- NIK --}}
                    <div class="form-group mb-3">
                        <label for="nik">NIK</label>
                        <input type="text" name="nik" id="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}">
                        @error('nik')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Nama Lengkap --}}
                    <div class="form-group mb-3">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="form-group mb-3">
                        <label for="gender">Jenis Kelamin</label>
                        <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
                            <option value="">-- Pilih --</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('gender')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Tempat Lahir --}}
                    <div class="form-group mb-3">
                        <label for="birth_place">Tempat Lahir</label>
                        <input type="text" name="birth_place" id="birth_place" class="form-control @error('birth_place') is-invalid @enderror" value="{{ old('birth_place') }}">
                        @error('birth_place')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div class="form-group mb-3">
                        <label for="birth_date">Tanggal Lahir</label>
                        <input type="date" name="birth_date" id="birth_date" class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date') }}">
                        @error('birth_date')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="form-group mb-3">
                        <label for="address">Alamat</label>
                        <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                        @error('address')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Agama (nullable) --}}
                    <div class="form-group mb-3">
                        <label for="religion">Agama</label>
                        <input type="text" name="religion" id="religion" class="form-control @error('religion') is-invalid @enderror" value="{{ old('religion') }}">
                        @error('religion')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Status Pernikahan --}}
                    <div class="form-group mb-3">
                        <label for="marital_status">Status Pernikahan</label>
                        <select name="marital_status" id="marital_status" class="form-control @error('marital_status') is-invalid @enderror">
                            <option value="">-- Pilih --</option>
                            <option value="single" {{ old('marital_status') == 'single' ? 'selected' : '' }}>Belum Menikah</option>
                            <option value="married" {{ old('marital_status') == 'married' ? 'selected' : '' }}>Menikah</option>
                            <option value="divorced" {{ old('marital_status') == 'divorced' ? 'selected' : '' }}>Cerai</option>
                            <option value="widowed" {{ old('marital_status') == 'widowed' ? 'selected' : '' }}>Duda/Janda</option>
                        </select>
                        @error('marital_status')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Pekerjaan (nullable) --}}
                    <div class="form-group mb-3">
                        <label for="occupation">Pekerjaan</label>
                        <input type="text" name="occupation" id="occupation" class="form-control @error('occupation') is-invalid @enderror" value="{{ old('occupation') }}">
                        @error('occupation')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- No. Telepon (nullable) --}}
                    <div class="form-group mb-3">
                        <label for="phone">No. Telepon</label>
                        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                        @error('phone')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="form-group mb-3">
                        <label for="status">Status Penduduk</label>
                        <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="">-- Pilih --</option>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="moved" {{ old('status') == 'moved' ? 'selected' : '' }}>Pindah</option>
                            <option value="deceased" {{ old('status') == 'deceased' ? 'selected' : '' }}>Meninggal</option>
                        </select>
                        @error('status')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <div class="card-footer text-right">
                            <div class="d-flex justify-content-end" style="gap: 10px;">
                                {{-- Tombol Kembali (link) --}}
                                <a href="/resident" class="btn btn-sm btn-outline-secondary shadow-sm">
                                    <i class="text-white-50"></i> Kembali
                                </a>
                                {{-- Tombol Simpan (submit) --}}
                                <button type="submit" class="btn btn-sm btn-primary shadow-sm">
                                    <i class="text-white-50"></i> Simpan
                                </button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection