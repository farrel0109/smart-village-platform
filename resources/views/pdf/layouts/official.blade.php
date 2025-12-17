<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $title ?? 'Surat Resmi' }}</title>
    <style>
        @page {
            margin: 2cm;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.5;
            color: #000;
        }
        .header-container {
            position: relative;
            margin-bottom: 20px;
            border-bottom: 3px double #000;
            padding-bottom: 15px;
        }
        .logo {
            position: absolute;
            top: 0;
            left: 0;
            width: 75px;
            height: auto;
        }
        .header-text {
            text-align: center;
            margin-left: 80px; /* Space for logo */
            margin-right: 80px; /* Balance */
        }
        .header-text h1 {
            font-size: 14pt;
            margin: 0;
            font-weight: bold;
            text-transform: uppercase;
        }
        .header-text h2 {
            font-size: 16pt;
            margin: 5px 0;
            font-weight: bold;
            text-transform: uppercase;
        }
        .header-text p {
            margin: 2px 0;
            font-size: 10pt;
        }
        .letter-info {
            text-align: center;
            margin: 30px 0;
        }
        .letter-info h3 {
            font-size: 14pt;
            text-decoration: underline;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
        }
        .letter-info p {
            font-size: 12pt;
            margin: 5px 0 0 0;
        }
        .content {
            text-align: justify;
            margin: 20px 0;
        }
        .content p {
            margin: 10px 0;
            text-indent: 40px;
        }
        .data-table {
            width: 100%;
            margin: 15px 0;
        }
        .data-table td {
            padding: 3px 0;
            vertical-align: top;
        }
        .data-table td:first-child {
            width: 160px;
        }
        .data-table td:nth-child(2) {
            width: 15px;
            text-align: center;
        }
        .signature-section {
            margin-top: 50px;
            float: right;
            width: 300px;
            text-align: center;
        }
        .signature-section .date {
            margin-bottom: 10px;
        }
        .signature-section .position {
            font-weight: bold;
            margin-bottom: 70px; /* Space for signature */
        }
        .signature-section .name {
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 2px;
        }
        .signature-section .nip {
            font-size: 11pt;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
</head>
<body>
    <div class="header-container clearfix">
        @if($letter->village->logo_path)
            <img src="{{ public_path('storage/' . $letter->village->logo_path) }}" class="logo" alt="Logo">
        @endif
        
        <div class="header-text">
            <h1>PEMERINTAH KABUPATEN {{ strtoupper($letter->village->regency ?? '...') }}</h1>
            <h1>KECAMATAN {{ strtoupper($letter->village->district ?? '...') }}</h1>
            <h2>DESA {{ strtoupper($letter->village->name ?? '...') }}</h2>
            <p>{{ $letter->village->address ?? 'Alamat Desa' }}</p>
            @if($letter->village->village_code)
                <p>Kode Desa: {{ $letter->village->village_code }}</p>
            @endif
        </div>
    </div>

    <div class="letter-info">
        <h3>{{ $letter->letterType->name }}</h3>
        <p>Nomor: {{ $letter->letter_number ?? '.../..../..../..../....' }}</p>
    </div>

    <div class="content">
        @yield('content')
    </div>

    <div class="signature-section">
        <p class="date">
            {{ $letter->village->name }}, {{ $letter->processed_at ? $letter->processed_at->translatedFormat('d F Y') : date('d F Y') }}
        </p>
        
        @if($letter->signed_by === 'secretary')
            <p class="position">Sekretaris Desa</p>
            <p class="name">{{ $letter->village->secretary_name ?? '.........................' }}</p>
            @if($letter->village->secretary_nip)
                <p class="nip">NIP. {{ $letter->village->secretary_nip }}</p>
            @endif
        @else
            <p class="position">Kepala Desa {{ $letter->village->name }}</p>
            <p class="name">{{ $letter->village->head_name ?? '.........................' }}</p>
            @if($letter->village->head_nip)
                <p class="nip">NIP. {{ $letter->village->head_nip }}</p>
            @endif
        @endif
    </div>
</body>
</html>
