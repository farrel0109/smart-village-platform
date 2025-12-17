@extends('pdf.layouts.official')

@section('content')
    <p>Yang bertanda tangan di bawah ini, Kepala Desa {{ $letter->village->name }}, Kecamatan {{ $letter->village->district }}, Kabupaten {{ $letter->village->regency }}, menerangkan bahwa telah lahir seorang anak:</p>

    <table class="data-table">
        <tr>
            <td>Nama Anak</td>
            <td>:</td>
            <td><strong>{{ $letter->dynamic_data['child_name'] ?? '.........................' }}</strong></td>
        </tr>
        <tr>
            <td>Tempat/Tgl Lahir</td>
            <td>:</td>
            <td>
                {{ $letter->dynamic_data['birth_place'] ?? '...' }}, 
                {{ isset($letter->dynamic_data['birth_date']) ? \Carbon\Carbon::parse($letter->dynamic_data['birth_date'])->translatedFormat('d F Y') : '...' }}
            </td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>{{ isset($letter->dynamic_data['gender']) ? ($letter->dynamic_data['gender'] == 'male' ? 'Laki-laki' : 'Perempuan') : '.........................' }}</td>
        </tr>
    </table>

    <p>Anak dari pasangan suami istri:</p>

    <table class="data-table">
        <tr>
            <td>Nama Ayah</td>
            <td>:</td>
            <td>{{ $letter->dynamic_data['father_name'] ?? '.........................' }}</td>
        </tr>
        <tr>
            <td>Nama Ibu</td>
            <td>:</td>
            <td>{{ $letter->dynamic_data['mother_name'] ?? '.........................' }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $letter->resident->address ?? '-' }}</td>
        </tr>
    </table>

    <p>Demikian Surat Keterangan Kelahiran ini dibuat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.</p>
@endsection
