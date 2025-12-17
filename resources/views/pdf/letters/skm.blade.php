@extends('pdf.layouts.official')

@section('content')
    <p>Yang bertanda tangan di bawah ini, Kepala Desa {{ $letter->village->name }}, Kecamatan {{ $letter->village->district }}, Kabupaten {{ $letter->village->regency }}, menerangkan bahwa telah meninggal dunia:</p>

    <table class="data-table">
        <tr>
            <td>Nama Almarhum/ah</td>
            <td>:</td>
            <td><strong>{{ $letter->dynamic_data['deceased_name'] ?? '.........................' }}</strong></td>
        </tr>
        <tr>
            <td>Tanggal Meninggal</td>
            <td>:</td>
            <td>{{ isset($letter->dynamic_data['deceased_date']) ? \Carbon\Carbon::parse($letter->dynamic_data['deceased_date'])->translatedFormat('d F Y') : '.........................' }}</td>
        </tr>
        @if(isset($letter->dynamic_data['deceased_reason']))
        <tr>
            <td>Penyebab Kematian</td>
            <td>:</td>
            <td>{{ $letter->dynamic_data['deceased_reason'] }}</td>
        </tr>
        @endif
        <tr>
            <td>Alamat Terakhir</td>
            <td>:</td>
            <td>{{ $letter->resident->address ?? '-' }}</td>
        </tr>
    </table>

    <p>Surat keterangan ini dibuat atas laporan dari:</p>

    <table class="data-table">
        <tr>
            <td>Nama Pelapor</td>
            <td>:</td>
            <td><strong>{{ $letter->user->name }}</strong></td>
        </tr>
        <tr>
            <td>Hubungan</td>
            <td>:</td>
            <td>Keluarga/Ahli Waris</td>
        </tr>
    </table>

    <p>Demikian Surat Keterangan Kematian ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>
@endsection
