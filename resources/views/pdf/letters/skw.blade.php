@extends('pdf.layouts.official')

@section('content')
    <p>Yang bertanda tangan di bawah ini, Kepala Desa {{ $letter->village->name }}, Kecamatan {{ $letter->village->district }}, Kabupaten {{ $letter->village->regency }}, menerangkan bahwa:</p>

    <table class="data-table">
        <tr>
            <td>Nama Pewaris</td>
            <td>:</td>
            <td><strong>{{ $letter->dynamic_data['deceased_name'] ?? '.........................' }}</strong></td>
        </tr>
        <tr>
            <td>Tanggal Meninggal</td>
            <td>:</td>
            <td>{{ isset($letter->dynamic_data['deceased_date']) ? \Carbon\Carbon::parse($letter->dynamic_data['deceased_date'])->translatedFormat('d F Y') : '.........................' }}</td>
        </tr>
        <tr>
            <td>Alamat Terakhir</td>
            <td>:</td>
            <td>{{ $letter->resident->address ?? '-' }}</td>
        </tr>
    </table>

    <p>Adalah benar telah meninggal dunia dan meninggalkan Ahli Waris sebagai berikut:</p>

    <table class="data-table" border="1" style="border-collapse: collapse; text-align: center;">
        <thead>
            <tr>
                <th style="padding: 5px;">No</th>
                <th style="padding: 5px;">Nama</th>
                <th style="padding: 5px;">Hubungan</th>
                <th style="padding: 5px;">Umur</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($letter->dynamic_data['heirs']) && is_array($letter->dynamic_data['heirs']))
                @foreach($letter->dynamic_data['heirs'] as $index => $heir)
                <tr>
                    <td style="padding: 5px;">{{ $index + 1 }}</td>
                    <td style="padding: 5px;">{{ $heir['name'] ?? '-' }}</td>
                    <td style="padding: 5px;">{{ $heir['relation'] ?? '-' }}</td>
                    <td style="padding: 5px;">{{ $heir['age'] ?? '-' }} Thn</td>
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" style="padding: 10px;">Data ahli waris terlampir</td>
                </tr>
            @endif
        </tbody>
    </table>

    <p>Demikian Surat Keterangan Waris ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>
@endsection
