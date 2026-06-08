@extends('layouts.admin')
@section('title', 'Manajemen Jabatan - Admin SIMTIK')
@section('page-title', 'Kelola Jabatan - ' . strtoupper($bidang))

@section('content')
<div class="card">
    <div class="card-header" style="display:flex; justify-content:space-between; align-items:center;">
        <h3>Daftar Jabatan ({{ strtoupper($bidang) }})</h3>
        <div style="display:flex; gap:10px; align-items:center;">
            <form action="{{ route('admin.jabatan.send-alert') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-envelope"></i> Cek & Kirim Notif Kuota</button>
            </form>
            <a href="{{ route('admin.jabatan.index') }}" class="btn btn-outline btn-sm"><i class="fas fa-arrow-left"></i> Kembali Pilih Bidang</a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.jabatan.store') }}" method="POST" class="form-inline" style="margin-bottom:20px; display:flex; flex-wrap:wrap; gap:10px; width:100%;">
            @csrf
            <input type="hidden" name="bidang" value="{{ $bidang }}">
            <div class="form-group" style="margin-bottom:0; flex:2;">
                <input type="text" name="nama_jabatan" class="form-control" placeholder="Nama Jabatan Baru untuk {{ strtoupper($bidang) }}" required style="width:100%;">
            </div>
            <div class="form-group" style="margin-bottom:0; flex:1; min-width:120px;">
                <input type="number" name="kuota" class="form-control" placeholder="Kuota Anggota" required min="0" value="0" style="width:100%;">
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Jabatan</button>
        </form>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama Jabatan</th>
                        <th>Bidang</th>
                        <th>Kuota</th>
                        <th>Jumlah Anggota</th>
                        <th>Status</th>
                        <th style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jabatans as $index => $j)
                    @php
                        $count = \App\Models\Anggota::where('jabatan', $j->nama_jabatan)->count();
                        $isLess = $count < $j->kuota;
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $j->nama_jabatan }}</td>
                        <td><span class="badge {{ $j->bidang ? 'badge-info' : 'badge-secondary' }}">{{ $j->bidang ?? 'Global' }}</span></td>
                        <td>{{ $j->kuota }}</td>
                        <td>{{ $count }}</td>
                        <td>
                            @if($j->kuota > 0)
                                @if($isLess)
                                    <span class="badge" style="background:#ef4444; color:#fff; padding:3px 8px; border-radius:12px; font-size:0.75rem; font-weight:600;">Kurang ({{ $j->kuota - $count }})</span>
                                @else
                                    <span class="badge" style="background:#10b981; color:#fff; padding:3px 8px; border-radius:12px; font-size:0.75rem; font-weight:600;">Terpenuhi</span>
                                @endif
                            @else
                                <span class="badge" style="background:#6b7280; color:#fff; padding:3px 8px; border-radius:12px; font-size:0.75rem; font-weight:600;">Belum Diatur</span>
                            @endif
                        </td>
                        <td>
                            <div class="actions" style="display:flex; gap:5px;">
                                <button onclick="editJabatan({{ $j->id }}, '{{ addslashes($j->nama_jabatan) }}', {{ $j->kuota }})" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></button>
                                <form action="{{ route('admin.jabatan.destroy', $j) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jabatan ini?');" style="margin:0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align:center; padding:20px; color:var(--gray-500);">Belum ada data jabatan untuk bidang {{ $bidang }}.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div id="editModal" style="display:none; position:fixed; z-index:9999; left:0; top:0; width:100%; height:100%; overflow:auto; background-color:rgba(0,0,0,0.5); align-items:center; justify-content:center;">
    <div class="card" style="width:100%; max-width:500px; margin: 10% auto; padding: 20px;">
        <div class="card-header" style="display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid var(--gray-200); padding-bottom:10px; margin-bottom:15px;">
            <h3 style="margin:0;">Edit Jabatan</h3>
            <button onclick="closeEditModal()" style="background:none; border:none; font-size:1.5rem; cursor:pointer;">&times;</button>
        </div>
        <div class="card-body">
            <form id="editForm" method="POST" action="">
                @csrf
                @method('PUT')
                <div class="form-group" style="margin-bottom: 15px;">
                    <label style="font-weight:600; margin-bottom:5px; display:block;">Nama Jabatan</label>
                    <input type="text" name="nama_jabatan" id="edit_nama_jabatan" class="form-control" required style="width:100%;">
                </div>
                <div class="form-group" style="margin-bottom: 15px;">
                    <label style="font-weight:600; margin-bottom:5px; display:block;">Kuota</label>
                    <input type="number" name="kuota" id="edit_kuota" class="form-control" required min="0" style="width:100%;">
                </div>
                <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:20px;">
                    <button type="button" onclick="closeEditModal()" class="btn btn-outline btn-sm">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function editJabatan(id, name, kuota) {
    var form = document.getElementById('editForm');
    form.action = "{{ url('admin/jabatan') }}/" + id;
    document.getElementById('edit_nama_jabatan').value = name;
    document.getElementById('edit_kuota').value = kuota;
    document.getElementById('editModal').style.display = 'flex';
}

function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}

// Close when clicking outside modal content
window.onclick = function(event) {
    var modal = document.getElementById('editModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
@endsection
