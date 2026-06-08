<x-mail::message>
# Peringatan Kekurangan Anggota Jabatan

Berikut adalah daftar jabatan yang saat ini kekurangan anggota berdasarkan kuota yang telah ditentukan:

| Bidang | Jabatan | Kuota | Jumlah Saat Ini | Kekurangan |
| :--- | :--- | :---: | :---: | :---: |
@foreach($alertData as $data)
| {{ $data['bidang'] }} | {{ $data['nama_jabatan'] }} | {{ $data['kuota'] }} | {{ $data['jumlah_sekarang'] }} | {{ $data['selisih'] }} |
@endforeach

Mohon segera melakukan penyesuaian atau pengisian personil untuk jabatan-jabatan tersebut.

Terima kasih,<br>
Sistem SIMTIK POLDA DIY
</x-mail::message>
