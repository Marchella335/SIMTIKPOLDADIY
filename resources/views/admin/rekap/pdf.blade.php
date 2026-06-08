<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rekap Universal - SIMTIK POLDA DIY</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 11px; color: #333; line-height: 1.4; padding: 20px; }
        .header { text-align: center; margin-bottom: 25px; border-bottom: 2px solid #333; padding-bottom: 15px; }
        .header h1 { margin: 0 0 5px; font-size: 18px; }
        .header p { margin: 0; font-size: 11px; color: #666; }
        .section-title { font-size: 13px; font-weight: bold; margin: 20px 0 10px; border-bottom: 1px solid #ccc; padding-bottom: 5px; text-transform: uppercase; color: #1e3a8a; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 6px 8px; text-align: left; }
        th { background-color: #f3f4f6; font-weight: bold; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .badge { display: inline-block; padding: 2px 5px; border-radius: 3px; font-size: 9px; font-weight: bold; color: #fff; }
        .badge-masuk { background-color: #3b82f6; }
        .badge-keluar { background-color: #ef4444; }
        .badge-pemasukan { background-color: #10b981; }
        .badge-pengeluaran { background-color: #f59e0b; }
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
        <h1>REKAPITULASI UNIVERSAL DATA SIMTIK POLDA DIY</h1>
        <p>Periode Laporan: {{ \Carbon\Carbon::parse($startDate)->format('d F Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d F Y') }}</p>
    </div>

    <!-- 1. ANGGOTA -->
    <div class="section-title">1. Data Anggota & Distribusi</div>
    <p>Total Anggota Saat Ini: <strong>{{ $totalAnggota }} orang</strong></p>
    <table>
        <thead>
            <tr>
                <th style="width: 30px;">No</th>
                <th>Subbidang (Unit Kerja)</th>
                <th class="text-right">Jumlah Personel</th>
            </tr>
        </thead>
        <tbody>
            @foreach($anggotaPerBidang as $idx => $ab)
            <tr>
                <td>{{ $idx + 1 }}</td>
                <td><strong>{{ strtoupper($ab->bidang) }}</strong></td>
                <td class="text-right">{{ $ab->count }} orang</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- 2. PERSURATAN -->
    <div class="section-title">2. Data Persuratan</div>
    <table>
        <thead>
            <tr>
                <th style="width: 30px;">No</th>
                <th>Tanggal</th>
                <th>Nomor Surat</th>
                <th>Bidang</th>
                <th>Tipe</th>
                <th>Perihal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($surats as $idx => $s)
            <tr>
                <td class="text-center">{{ $idx + 1 }}</td>
                <td>{{ $s->tanggal->format('d/m/Y') }}</td>
                <td>{{ $s->nomor_surat }}</td>
                <td>{{ $s->bidang }}</td>
                <td>
                    <span class="badge {{ $s->tipe == 'masuk' ? 'badge-masuk' : 'badge-keluar' }}">
                        {{ ucfirst($s->tipe) }}
                    </span>
                </td>
                <td>{{ $s->perihal }}</td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center">Tidak ada data surat pada periode ini.</td></tr>
            @endforelse
        </tbody>
    </table>

    <!-- 3. KEUANGAN -->
    <div class="section-title">3. Realisasi Keuangan</div>
    <table>
        <thead>
            <tr>
                <th style="width: 30px;">No</th>
                <th>Tanggal</th>
                <th>Sumber Dana / Uraian</th>
                <th>Tipe</th>
                <th class="text-right">Nilai (IDR)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($keuangans as $idx => $k)
            <tr>
                <td class="text-center">{{ $idx + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($k->tanggal)->format('d/m/Y') }}</td>
                <td>{{ $k->acara->source->nama_sumber ?? 'Pagu' }} - {{ $k->keterangan }}</td>
                <td>
                    <span class="badge {{ $k->tipe == 'Pemasukan' ? 'badge-pemasukan' : 'badge-pengeluaran' }}">
                        {{ $k->tipe }}
                    </span>
                </td>
                <td class="text-right">Rp{{ number_format($k->nilai, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center">Tidak ada transaksi keuangan pada periode ini.</td></tr>
            @endforelse
        </tbody>
    </table>

    <!-- 4. KEGIATAN -->
    <div class="section-title">4. Kegiatan Terlaksana</div>
    <table>
        <thead>
            <tr>
                <th style="width: 30px;">No</th>
                <th>Tanggal</th>
                <th>Nama Kegiatan</th>
                <th>Keterangan</th>
                <th>Hasil / Capaian</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kegiatans as $idx => $kg)
            <tr>
                <td class="text-center">{{ $idx + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($kg->tanggal)->format('d/m/Y') }}</td>
                <td><strong>{{ $kg->nama_kegiatan }}</strong></td>
                <td>{{ $kg->keterangan }}</td>
                <td>{{ $kg->hasil ?? '-' }}</td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center">Tidak ada data kegiatan pada periode ini.</td></tr>
            @endforelse
        </tbody>
    </table>

    <!-- 5. BERITA -->
    <div class="section-title">5. Publikasi Berita</div>
    <table>
        <thead>
            <tr>
                <th style="width: 30px;">No</th>
                <th>Tanggal</th>
                <th>Judul Berita</th>
                <th>Kategori</th>
                <th>Status Tampil</th>
            </tr>
        </thead>
        <tbody>
            @forelse($beritas as $idx => $b)
            <tr>
                <td class="text-center">{{ $idx + 1 }}</td>
                <td>{{ $b->created_at->format('d/m/Y') }}</td>
                <td><strong>{{ $b->judul }}</strong></td>
                <td>{{ $b->kategori }}</td>
                <td>{{ $b->tampilkan ? 'Tampil' : 'Arsip' }}</td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center">Tidak ada data berita pada periode ini.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
