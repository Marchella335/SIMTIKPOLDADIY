<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Berita - SIMTIK POLDA DIY</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #333;
            line-height: 1.5;
            margin: 0;
            padding: 30px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px double #000;
            padding-bottom: 15px;
            position: relative;
        }
        .header h2 {
            margin: 0;
            font-size: 1.6rem;
            text-transform: uppercase;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 0.9rem;
            color: #666;
        }
        .meta-info {
            margin-bottom: 20px;
            font-size: 0.9rem;
            display: flex;
            justify-content: space-between;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px 12px;
            text-align: left;
            font-size: 0.9rem;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #fafafa;
        }
        .text-center {
            text-align: center;
        }
        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: bold;
            color: #fff;
        }
        .badge-success { background-color: #10b981; }
        .badge-danger { background-color: #ef4444; }
        .footer-note {
            margin-top: 50px;
            font-size: 0.8rem;
            color: #888;
            text-align: center;
        }
        @media print {
            body {
                padding: 0;
            }
            .no-print {
                display: none;
            }
            tr {
                page-break-inside: avoid;
            }
        }
        .btn-print {
            background-color: #1e3a8a;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            font-size: 0.9rem;
        }
        .btn-print:hover {
            background-color: #172554;
        }
    </style>
</head>
<body>
    <div class="no-print" style="text-align: right;">
        <button onclick="window.print()" class="btn-print">Cetak PDF / Print</button>
    </div>

    <div class="header">
        <h2>Kepolisian Negara Republik Indonesia</h2>
        <p>Daerah Istimewa Yogyakarta | Bidang Teknologi Informasi dan Komunikasi</p>
        <h3 style="margin: 10px 0 0; text-transform: uppercase;">Laporan Rekapitulasi Berita</h3>
    </div>

    <div class="meta-info">
        <div>Tanggal Cetak: <strong>{{ now()->translatedFormat('d F Y H:i') }} WIB</strong></div>
        <div>Jumlah Data: <strong>{{ $beritas->count() }} Berita</strong></div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 15%;">Tanggal</th>
                <th style="width: 60%;">Judul Berita</th>
                <th style="width: 20%; text-align: center;">Status Publikasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($beritas as $index => $b)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($b->tanggal)->translatedFormat('d M Y') }}</td>
                <td>
                    <strong>{{ $b->judul }}</strong>
                </td>
                <td class="text-center">
                    @if($b->tampilkan)
                        <span class="badge badge-success">Tampil di Web</span>
                    @else
                        <span class="badge badge-danger">Draft / Admin</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer-note">
        Dokumen ini dikeluarkan secara resmi oleh Sistem Informasi Teknologi Informasi dan Komunikasi (SIMTIK) Polda DIY.
    </div>

    <script>
        // Auto trigger print when loaded
        window.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                window.print();
            }, 500);
        });
    </script>
</body>
</html>
