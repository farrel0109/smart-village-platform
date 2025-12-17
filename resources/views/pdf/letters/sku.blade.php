@extends('pdf.layouts.official')

@section('content')
    <p>Yang bertanda tangan di bawah ini, Kepala Desa {{ $letter->village->name }}, Kecamatan {{ $letter->village->district }}, Kabupaten {{ $letter->village->regency }}, menerangkan bahwa:</p>

    <table class="data-table">
        <tr>
            <td>Nama Lengkap</td>
            <td>:</td>
            <td><strong>{{ $letter->user->name }}</strong></td>
        </tr>
        @if($letter->resident)
        <tr>
            <td>NIK</td>
            <td>:</td>
            <td>{{ $letter->resident->nik }}</td>
        </tr>
        <tr>
            <td>Tempat/Tgl Lahir</td>
            <td>:</td>
            <td>{{ $letter->resident->birth_place }}, {{ \Carbon\Carbon::parse($letter->resident->birth_date)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>{{ $letter->resident->gender == 'male' ? 'Laki-laki' : 'Perempuan' }}</td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>:</td>
            <td>{{ $letter->resident->occupation }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $letter->resident->address }}</td>
        </tr>
        @endif
    </table>

    <p>Orang tersebut di atas adalah benar-benar warga Desa {{ $letter->village->name }} yang memiliki usaha:</p>

    <table class="data-table">
        <tr>
            <td>Nama Usaha</td>
            <td>:</td>
            <td><strong>{{ $letter->dynamic_data['business_name'] ?? '.........................' }}</strong></td>
        </tr>
        <tr>
            <td>Alamat Usaha</td>
            <td>:</td>
            <td>{{ $letter->dynamic_data['business_address'] ?? '.........................' }}</td>
        </tr>
        <tr>
            <td>Keperluan</td>
            <td>:</td>
            <td>{{ $letter->purpose }}</td>
        </tr>
    </table>

    <p>Demikian Surat Keterangan Usaha ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>
@endsection
