<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekapitulasi Persuratan - SIMTIK POLDA DIY</title>
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
            padding: 8px 10px;
            text-align: left;
            font-size: 0.8rem;
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
        .badge {
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.7rem;
            font-weight: bold;
            color: #fff;
            text-transform: uppercase;
        }
        .badge-masuk { background-color: #3b82f6; }
        .badge-keluar { background-color: #ef4444; }
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
        <h3 style="margin: 10px 0 0; text-transform: uppercase;">Laporan Rekapitulasi Persuratan ({{ $bidang ?? 'Semua Bagian' }})</h3>
    </div>

    <div class="meta-info">
        <div>
            Tanggal Cetak: <strong>{{ now()->translatedFormat('d F Y H:i') }} WIB</strong><br>
            @if($startDate || $endDate)
                Periode Laporan: 
                <strong>
                    {{ $startDate ? \Carbon\Carbon::parse($startDate)->translatedFormat('d M Y') : 'Awal' }}
                    s/d
                    {{ $endDate ? \Carbon\Carbon::parse($endDate)->translatedFormat('d M Y') : 'Sekarang' }}
                </strong>
            @endif
        </div>
        <div style="text-align: right;">
            Jumlah Surat: <strong>{{ $surats->count() }} Surat</strong>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 4%; text-align: center;">No</th>
                <th style="width: 18%;">Nomor Surat / Agenda</th>
                <th style="width: 8%; text-align: center;">Tipe</th>
                <th style="width: 10%;">Jenis</th>
                <th style="width: 20%;">Tentang / Perihal</th>
                <th style="width: 18%;">Asal / Tujuan</th>
                <th style="width: 9%;">Tanggal</th>
                <th style="width: 13%;">Disposisi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($surats as $index => $s)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>
                    No: <strong>{{ $s->nomor_surat }}</strong><br>
                    Agenda: <span style="font-weight:600;">{{ $s->nomor_agenda ?? '-' }}</span><br>
                    Tgl. Agenda: <small>{{ $s->tanggal_agenda ? $s->tanggal_agenda->format('d/m/Y') : '-' }}</small>
                </td>
                <td class="text-center">
                    <span class="badge badge-{{ $s->tipe }}">{{ $s->tipe }}</span>
                </td>
                <td>{{ $s->jenis_surat }}</td>
                <td>{{ $s->perihal }}</td>
                <td>
                    @if($s->tipe == 'masuk')
                        <small style="color:#555;">Dari:</small><br>{!! nl2br(e($s->dari)) !!}
                    @else
                        <small style="color:#555;">Kepada:</small><br>{!! nl2br(e($s->kepada)) !!}
                    @endif
                </td>
                <td>{{ $s->tanggal->format('d/m/Y') }}</td>
                <td><span style="font-style:italic;">{{ $s->disposisi ?? '-' }}</span></td>
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
