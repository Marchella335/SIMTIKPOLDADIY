<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Kegiatan - SIMTIK POLDA DIY</title>
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
            font-size: 0.85rem;
            vertical-align: top;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background-color: #fafafa;
        }
        .text-center {
            text-align: center;
        }
        .footer-note {
            margin-top: 50px;
            font-size: 0.8rem;
            color: #888;
            text-align: center;
        }
        img.kegiatan-img {
            max-width: 120px;
            max-height: 80px;
            border-radius: 4px;
            object-fit: cover;
            border: 1px solid #ddd;
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
    @php
        $days = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];
    @endphp

    <div class="no-print" style="text-align: right;">
        <button onclick="window.print()" class="btn-print">Cetak PDF / Print</button>
    </div>

    <div class="header">
        <h2>Kepolisian Negara Republik Indonesia</h2>
        <p>Daerah Istimewa Yogyakarta | Bidang Teknologi Informasi dan Komunikasi</p>
        <h3 style="margin: 10px 0 0; text-transform: uppercase;">Laporan Rekapitulasi Kegiatan</h3>
    </div>

    <div class="meta-info">
        <div>Tanggal Cetak: <strong>{{ now()->translatedFormat('d F Y H:i') }} WIB</strong></div>
        <div>Jumlah Data: <strong>{{ $kegiatans->count() }} Kegiatan</strong></div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%; text-align: center;">No</th>
                <th style="width: 10%;">Hari / Tanggal</th>
                <th style="width: 20%;">Nama Kegiatan</th>
                <th style="width: 30%;">Keterangan (Deskripsi)</th>
                <th style="width: 20%;">Hasil</th>
                <th style="width: 15%; text-align: center;">Foto Kegiatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kegiatans as $index => $k)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>
                    <strong>{{ $days[\Carbon\Carbon::parse($k->tanggal)->format('l')] ?? $k->tanggal->format('l') }}</strong><br>
                    <small style="color:#555;">{{ \Carbon\Carbon::parse($k->tanggal)->translatedFormat('d M Y') }}</small>
                </td>
                <td><strong>{{ $k->nama_kegiatan }}</strong></td>
                <td>{{ $k->deskripsi }}</td>
                <td>{{ $k->hasil ?? '-' }}</td>
                <td class="text-center">
                    @if($k->gambar)
                        <img src="{{ asset($k->gambar) }}" class="kegiatan-img" alt="Foto Kegiatan">
                    @else
                        <span style="color:#999; font-style:italic; font-size:0.8rem;">Tidak ada foto</span>
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
