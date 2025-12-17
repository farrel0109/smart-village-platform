@extends('pdf.layouts.letter')

@section('content')
    <!-- Header -->
    <div class="header">
        <h1>Pemerintah {{ $letter->village->regency ?? 'Kabupaten' }}</h1>
        <h2>{{ $letter->village->name ?? 'Desa' }}</h2>
        <p>{{ $letter->village->address ?? 'Alamat Desa' }}</p>
        <p>Telp: {{ $letter->village->phone ?? '-' }} | Email: {{ $letter->village->email ?? '-' }}</p>
    </div>

    <!-- Letter Title -->
    <div class="letter-title">
        <h3>{{ $letter->letterType->name ?? 'Surat Keterangan' }}</h3>
        <p>Nomor: {{ $letter->request_number }}</p>
    </div>

    <!-- Content -->
    <div class="content">
        <p>Yang bertanda tangan di bawah ini, Kepala {{ $letter->village->name ?? 'Desa' }}, {{ $letter->village->regency ?? 'Kabupaten' }}, menerangkan bahwa:</p>

        <table class="data-table">
            <tr>
                <td>Nama</td>
                <td>:</td>
                <td><strong>{{ $letter->user->name ?? '-' }}</strong></td>
            </tr>
            @if($letter->resident)
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td>{{ $letter->resident->nik ?? '-' }}</td>
            </tr>
            <tr>
                <td>Tempat/Tgl Lahir</td>
                <td>:</td>
                <td>{{ $letter->resident->birth_place ?? '-' }}, {{ $letter->resident->birth_date ? \Carbon\Carbon::parse($letter->resident->birth_date)->format('d F Y') : '-' }}</td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td>{{ $letter->resident->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>:</td>
                <td>{{ ucfirst($letter->resident->religion ?? '-') }}</td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>:</td>
                <td>{{ $letter->resident->occupation ?? '-' }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>:</td>
                <td>{{ $letter->resident->address ?? '-' }}</td>
            </tr>
            @else
            <tr>
                <td>Email</td>
                <td>:</td>
                <td>{{ $letter->user->email ?? '-' }}</td>
            </tr>
            @endif
        </table>

        <p>Adalah benar warga {{ $letter->village->name ?? 'Desa' }} yang beralamat sebagaimana tersebut di atas.</p>

        @if($letter->purpose)
        <p>Surat keterangan ini dibuat untuk keperluan: <strong>{{ $letter->purpose }}</strong>.</p>
        @endif

        @if($letter->notes)
        <p>Keterangan tambahan: {{ $letter->notes }}</p>
        @endif

        <p>Demikian surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>
    </div>

    <!-- Signature -->
    <div class="closing clearfix">
        <div class="signature">
            <p class="date">{{ $letter->village->name ?? 'Desa' }}, {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
            <p class="position">Kepala {{ $letter->village->name ?? 'Desa' }}</p>
            <br><br><br>
            <p class="name">{{ $letter->village->head_name ?? '___________________' }}</p>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Dokumen ini dicetak secara otomatis oleh sistem Desa Pintar pada {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
    </div>
@endsection
