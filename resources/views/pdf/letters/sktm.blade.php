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

    <p>Berdasarkan pengamatan kami dan data yang ada, orang tersebut di atas tergolong keluarga <strong>TIDAK MAMPU (Pra-Sejahtera)</strong>.</p>

    <p>Surat keterangan ini dibuat untuk keperluan: <strong>{{ $letter->purpose }}</strong>.</p>

    <p>Demikian Surat Keterangan Tidak Mampu ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>
@endsection
