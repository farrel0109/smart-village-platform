<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pengajuan Surat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 30px;
        }
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            margin: 10px 0;
        }
        .status-pending { background: #fef3c7; color: #92400e; }
        .status-processing { background: #dbeafe; color: #1e40af; }
        .status-completed { background: #d1fae5; color: #065f46; }
        .status-rejected { background: #fee2e2; color: #991b1b; }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        .info-table td {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        .info-table td:first-child {
            font-weight: bold;
            color: #666;
            width: 40%;
        }
        .footer {
            background: #f9fafb;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .btn {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏛️ Desa Pintar</h1>
            <p style="margin: 5px 0 0;">Sistem Layanan Administrasi Desa</p>
        </div>
        
        <div class="content">
            <p>Yth. <strong>{{ $letter->user->name ?? 'Pemohon' }}</strong>,</p>
            
            <p>Status pengajuan surat Anda telah diperbarui:</p>
            
            <div class="status-badge status-{{ $letter->status }}">
                {{ $statusLabel }}
            </div>
            
            <table class="info-table">
                <tr>
                    <td>Nomor Pengajuan</td>
                    <td>{{ $letter->request_number }}</td>
                </tr>
                <tr>
                    <td>Jenis Surat</td>
                    <td>{{ $letter->letterType->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Keperluan</td>
                    <td>{{ $letter->purpose ?? '-' }}</td>
                </tr>
                <tr>
                    <td>Tanggal Pengajuan</td>
                    <td>{{ $letter->created_at->format('d F Y, H:i') }}</td>
                </tr>
                @if($letter->status === 'rejected' && $letter->rejection_reason)
                <tr>
                    <td>Alasan Penolakan</td>
                    <td style="color: #991b1b;">{{ $letter->rejection_reason }}</td>
                </tr>
                @endif
            </table>
            
            @if($letter->status === 'completed')
            <p>Selamat! Surat Anda telah selesai diproses. Silakan datang ke kantor desa untuk mengambil surat atau unduh melalui sistem.</p>
            @elseif($letter->status === 'processing')
            <p>Surat Anda sedang dalam proses. Mohon menunggu konfirmasi selanjutnya.</p>
            @elseif($letter->status === 'rejected')
            <p>Mohon maaf, pengajuan surat Anda ditolak. Silakan perbaiki dan ajukan kembali.</p>
            @endif
        </div>
        
        <div class="footer">
            <p>Email ini dikirim otomatis oleh sistem Desa Pintar.</p>
            <p>Mohon tidak membalas email ini.</p>
        </div>
    </div>
</body>
</html>
