<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Rincian Keuangan - SIMTIK POLDA DIY</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 11px; color: #333; line-height: 1.4; padding: 20px; }
        .header { text-align: center; margin-bottom: 25px; border-bottom: 2px solid #333; padding-bottom: 15px; }
        .header h1 { margin: 0 0 5px; font-size: 18px; }
        .header p { margin: 0; font-size: 11px; color: #666; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 6px 8px; text-align: left; }
        th { background-color: #f3f4f6; font-weight: bold; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .badge { display: inline-block; padding: 2px 5px; border-radius: 3px; font-size: 9px; font-weight: bold; color: #fff; }
        .badge-pemasukan { background-color: #10b981; }
        .badge-pengeluaran { background-color: #ef4444; }
        .no-print-btn { text-align: right; margin-bottom: 20px; }
        .btn { padding: 6px 12px; background-color: #2563eb; color: #fff; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; font-weight: bold; }
        @media print {
            .no-print { display: none !important; }
            body { padding: 0; }
        }
    </style>
</head>
<body>
    <div class="no-print no-print-btn">
        <button onclick="window.print()" class="btn">Cetak Dokumen</button>
    </div>

    <div class="header">
        <h1>LAPORAN DETIL RINCIAN TRANSAKSI KEUANGAN</h1>
        <p>SIMTIK POLDA DIY</p>
        @if($startDate || $endDate)
            <p>Periode: {{ $startDate ? \Carbon\Carbon::parse($startDate)->format('d/m/Y') : 'Awal' }} s/d {{ $endDate ? \Carbon\Carbon::parse($endDate)->format('d/m/Y') : 'Akhir' }}</p>
        @else
            <p>Semua Transaksi</p>
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 30px;">No</th>
                <th>Tanggal</th>
                <th>Sumber Dana / Acara</th>
                <th>Uraian / Keterangan</th>
                <th>Tipe</th>
                <th class="text-right">Nilai (IDR)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $idx => $item)
            <tr>
                <td class="text-center">{{ $idx + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                <td>{{ $item->acara->source->nama ?? 'Pagu' }} - {{ $item->acara->nama_acara ?? '-' }}</td>
                <td>{{ $item->uraian }} &bull; <small style="color:#666;">{{ $item->keterangan ?? '-' }}</small></td>
                <td>
                    <span class="badge {{ $item->tipe == 'Pemasukan' ? 'badge-pemasukan' : 'badge-pengeluaran' }}">
                        {{ $item->tipe }}
                    </span>
                </td>
                <td class="text-right">Rp{{ number_format($item->nilai, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center">Tidak ada rincian data transaksi keuangan</td></tr>
            @endforelse
        </tbody>
        @if($items->count() > 0)
        <tfoot>
            <tr style="font-weight:bold; background-color:#f9fafb;">
                <td colspan="4">TOTAL PEMASUKAN</td>
                <td><span class="badge badge-pemasukan">Pemasukan</span></td>
                <td class="text-right">Rp{{ number_format($totalPemasukan, 0, ',', '.') }}</td>
            </tr>
            <tr style="font-weight:bold; background-color:#f9fafb;">
                <td colspan="4">TOTAL PENGELUARAN</td>
                <td><span class="badge badge-pengeluaran">Pengeluaran</span></td>
                <td class="text-right">Rp{{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
            </tr>
            <tr style="font-weight:bold; background-color:#f3f4f6;">
                <td colspan="4">SELISIH / SISA DANA</td>
                <td></td>
                <td class="text-right" style="color:{{ ($totalPemasukan - $totalPengeluaran) >= 0 ? '#10b981' : '#ef4444' }};">
                    Rp{{ number_format($totalPemasukan - $totalPengeluaran, 0, ',', '.') }}
                </td>
            </tr>
        </tfoot>
        @endif
    </table>
</body>
</html>
