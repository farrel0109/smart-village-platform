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
            <td>Asal</td>
            <td>:</td>
            <td>Desa {{ $letter->village->name }}</td>
        </tr>
        @endif
    </table>

    <p>Orang tersebut di atas bermaksud untuk <strong>PINDAH DOMISILI</strong> ke:</p>

    <table class="data-table">
        <tr>
            <td>Alamat Tujuan</td>
            <td>:</td>
            <td><strong>{{ $letter->dynamic_data['move_address'] ?? '.........................' }}</strong></td>
        </tr>
        <tr>
            <td>Alasan Pindah</td>
            <td>:</td>
            <td>{{ $letter->dynamic_data['move_reason'] ?? '-' }}</td>
        </tr>
        <tr>
            <td>Pengikut</td>
            <td>:</td>
            <td>{{ $letter->dynamic_data['followers_count'] ?? '0' }} Orang</td>
        </tr>
    </table>

    <p>Demikian Surat Keterangan Pindah Domisili ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>
@endsection
