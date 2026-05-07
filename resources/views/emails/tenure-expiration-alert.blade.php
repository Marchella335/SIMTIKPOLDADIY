<x-mail::message>
# Peringatan Masa Jabatan

Masa jabatan anggota berikut akan segera berakhir dalam waktu kurang dari 3 bulan:

**Nama Anggota:** {{ $anggota->nama_lengkap }}  
**NRP:** {{ $anggota->nrp ?? '-' }}  
**Jabatan:** {{ $anggota->jabatan }}  
**Akhir Masa Jabatan:** {{ \Carbon\Carbon::parse($anggota->akhir_jabatan)->format('d F Y') }}

**Pemberitahuan Penting:**
Admin harus membuat surat perpanjangan pembaruan SK (Surat Keputusan) untuk anggota tersebut.

Terima kasih,<br>
Sistem SIMTIK POLDA DIY
</x-mail::message>
