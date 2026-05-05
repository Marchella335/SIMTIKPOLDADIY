<x-mail::message>
# Pesan Baru dari Website

Seseorang telah mengirimkan pesan melalui formulir kontak SIMTIK POLDA DIY.

**Nama:** {{ $data['nama'] }}
**Email:** {{ $data['email'] }}
**Subjek:** {{ $data['subjek'] }}

**Pesan:**
{{ $data['pesan'] }}

Terima Kasih,<br>
Sistem SIMTIK
</x-mail::message>
