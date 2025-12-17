<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $title ?? 'Surat Keterangan' }}</title>
    <style>
        @page {
            margin: 2cm;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12pt;
            line-height: 1.6;
            color: #000;
        }
        .header {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 14pt;
            margin: 0;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .header h2 {
            font-size: 16pt;
            margin: 5px 0;
            font-weight: bold;
            text-transform: uppercase;
        }
        .header p {
            margin: 3px 0;
            font-size: 10pt;
        }
        .letter-title {
            text-align: center;
            margin: 30px 0;
        }
        .letter-title h3 {
            font-size: 14pt;
            text-decoration: underline;
            font-weight: bold;
            margin: 0;
            text-transform: uppercase;
        }
        .letter-title p {
            font-size: 11pt;
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
            width: 150px;
        }
        .data-table td:nth-child(2) {
            width: 15px;
            text-align: center;
        }
        .closing {
            margin-top: 30px;
        }
        .signature {
            float: right;
            width: 250px;
            text-align: center;
            margin-top: 20px;
        }
        .signature .date {
            margin-bottom: 60px;
        }
        .signature .name {
            font-weight: bold;
            text-decoration: underline;
        }
        .signature .position {
            font-size: 11pt;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        .footer {
            margin-top: 50px;
            font-size: 9pt;
            color: #666;
            text-align: center;
            border-top: 1px solid #ccc;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>
