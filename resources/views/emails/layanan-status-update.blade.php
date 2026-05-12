<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"></head>
<body style="font-family:'Segoe UI',Arial,sans-serif; background:#f5f5f5; padding:30px;">
    <div style="max-width:600px; margin:0 auto; background:#fff; border-radius:12px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.1);">
        <div style="background:#0a0a0a; padding:25px 30px; text-align:center;">
            @if($layanan->status == 'Completed')
                <h1 style="color:#10b981; font-size:1.2rem; margin:0;">✅ Layanan Anda Telah Selesai!</h1>
            @else
                <h1 style="color:#3b82f6; font-size:1.2rem; margin:0;">🔄 Layanan Anda Sedang Diproses</h1>
            @endif
        </div>
        <div style="padding:30px;">
            <p>Halo <strong>{{ $layanan->nama_pemohon }}</strong>,</p>

            @if($layanan->status == 'In Progress')
                <p>Kami ingin menginformasikan bahwa permintaan layanan Anda <strong>sedang diproses</strong> oleh Tim Bid TIK Polda DIY.</p>
            @else
                <p>Kami dengan senang hati menginformasikan bahwa permintaan layanan Anda telah <strong>selesai dikerjakan</strong>.</p>
            @endif

            <table style="width:100%; border-collapse:collapse; margin:20px 0;">
                <tr>
                    <td style="padding:10px; border-bottom:1px solid #eee; color:#666; width:35%;">No. Tiket</td>
                    <td style="padding:10px; border-bottom:1px solid #eee; font-weight:600;">#{{ $layanan->id }}</td>
                </tr>
                <tr>
                    <td style="padding:10px; border-bottom:1px solid #eee; color:#666;">Jenis Layanan</td>
                    <td style="padding:10px; border-bottom:1px solid #eee;">
                        <span style="background:#dc2626; color:#fff; padding:3px 10px; border-radius:4px; font-size:0.85rem;">{{ $layanan->jenis_layanan }}</span>
                    </td>
                </tr>
                <tr>
                    <td style="padding:10px; border-bottom:1px solid #eee; color:#666;">Status</td>
                    <td style="padding:10px; border-bottom:1px solid #eee;">
                        @if($layanan->status == 'In Progress')
                            <span style="background:#3b82f6; color:#fff; padding:4px 12px; border-radius:6px; font-weight:600;">🔄 In Progress</span>
                        @else
                            <span style="background:#10b981; color:#fff; padding:4px 12px; border-radius:6px; font-weight:600;">✅ Completed</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="padding:10px; color:#666;" colspan="2">
                        <strong>Deskripsi:</strong><br>{{ $layanan->deskripsi }}
                    </td>
                </tr>
            </table>

            @if($layanan->status == 'Completed')
                <div style="background:#fef3c7; border:1px solid #fbbf24; padding:20px; border-radius:10px; margin:20px 0; text-align:center;">
                    <p style="font-weight:700; margin-bottom:10px; color:#92400e;">⭐ Beri Penilaian Layanan Kami</p>
                    <p style="color:#92400e; font-size:0.9rem; margin-bottom:15px;">Pendapat Anda sangat berarti untuk meningkatkan kualitas layanan kami.</p>
                    <a href="{{ url('/layanan/rate/' . $layanan->token) }}" style="display:inline-block; background:#dc2626; color:#fff; padding:14px 40px; border-radius:8px; text-decoration:none; font-weight:700; font-size:1rem;">
                        Beri Rating Sekarang →
                    </a>
                </div>
            @else
                <p style="color:#666; font-size:0.9rem;">Kami akan menginformasikan lagi setelah layanan selesai. Terima kasih atas kesabaran Anda.</p>
            @endif
        </div>
        <div style="background:#f9f9f9; padding:15px 30px; text-align:center; font-size:0.8rem; color:#999;">
            &copy; {{ date('Y') }} SIMTIK POLDA DIY — Bidang Teknologi Informasi dan Komunikasi
        </div>
    </div>
</body>
</html>
