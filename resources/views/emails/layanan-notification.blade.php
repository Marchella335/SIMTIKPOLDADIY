<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"></head>
<body style="font-family:'Segoe UI',Arial,sans-serif; background:#f5f5f5; padding:30px;">
    <div style="max-width:600px; margin:0 auto; background:#fff; border-radius:12px; overflow:hidden; box-shadow:0 4px 20px rgba(0,0,0,0.1);">
        <div style="background:#0a0a0a; padding:25px 30px; text-align:center;">
            <h1 style="color:#fff; font-size:1.2rem; margin:0;">🎧 Permintaan Layanan TIK Baru</h1>
        </div>
        <div style="padding:30px;">
            <p>Hai Admin SIMTIK,</p>
            <p>Ada permintaan layanan baru yang masuk ke sistem:</p>

            <table style="width:100%; border-collapse:collapse; margin:20px 0;">
                <tr><td style="padding:10px; border-bottom:1px solid #eee; color:#666; width:35%;">Pemohon</td><td style="padding:10px; border-bottom:1px solid #eee; font-weight:600;">{{ $layanan->nama_pemohon }}</td></tr>
                <tr><td style="padding:10px; border-bottom:1px solid #eee; color:#666;">Email</td><td style="padding:10px; border-bottom:1px solid #eee;">{{ $layanan->email_pemohon }}</td></tr>
                <tr><td style="padding:10px; border-bottom:1px solid #eee; color:#666;">No. HP</td><td style="padding:10px; border-bottom:1px solid #eee;">{{ $layanan->no_hp ?? '-' }}</td></tr>
                <tr><td style="padding:10px; border-bottom:1px solid #eee; color:#666;">Jenis Layanan</td><td style="padding:10px; border-bottom:1px solid #eee;"><span style="background:#dc2626; color:#fff; padding:3px 10px; border-radius:4px; font-size:0.85rem;">{{ $layanan->jenis_layanan }}</span></td></tr>
                <tr><td style="padding:10px; color:#666;" colspan="2"><strong>Deskripsi:</strong><br>{{ $layanan->deskripsi }}</td></tr>
            </table>

            <a href="{{ url('/admin/layanan/' . $layanan->id . '/edit') }}" style="display:inline-block; background:#dc2626; color:#fff; padding:12px 30px; border-radius:8px; text-decoration:none; font-weight:600;">Kelola Tiket</a>
        </div>
        <div style="background:#f9f9f9; padding:15px 30px; text-align:center; font-size:0.8rem; color:#999;">
            &copy; {{ date('Y') }} SIMTIK POLDA DIY — Bidang TIK
        </div>
    </div>
</body>
</html>
