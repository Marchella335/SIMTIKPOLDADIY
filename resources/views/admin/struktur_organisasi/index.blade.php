@extends('layouts.admin')
@section('title', 'Manajemen Struktur Organisasi - Admin SIMTIK')
@section('page-title', 'Struktur Organisasi')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Gambar Struktur Organisasi per Bidang</h3>
    </div>
    <div class="card-body">
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th style="width: 200px;">Sub Bidang</th>
                        <th>Gambar Saat Ini</th>
                        <th>Update Gambar</th>
                    </tr>
                </thead>
                <tbody>
                    @php $bidangs = ['TIK', 'Renmin', 'Tekkom', 'Tekinfo']; @endphp
                    @foreach($bidangs as $b)
                    <tr>
                        <td style="font-weight:bold;">Subbid {{ $b }}</td>
                        <td>
                            @if(isset($mapped[$b]) && $mapped[$b]->foto)
                                <img src="{{ asset($mapped[$b]->foto) }}" alt="Struktur {{ $b }}" style="max-height: 100px; border-radius:8px; border:1px solid var(--gray-200);">
                                <form action="{{ route('admin.struktur.destroy', $mapped[$b]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus gambar ini?');" style="margin-top:10px;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Hapus Gambar</button>
                                </form>
                            @else
                                <span style="color:var(--gray-500);"><i class="fas fa-image"></i> Belum ada gambar</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.struktur.store') }}" method="POST" enctype="multipart/form-data" style="display:flex; gap:10px; flex-direction:column;">
                                @csrf
                                <input type="hidden" name="bidang" value="{{ $b }}">
                                <input type="file" name="foto" class="form-control" accept="image/*" required>
                                <button type="submit" class="btn btn-sm btn-primary" style="align-self:flex-start;"><i class="fas fa-upload"></i> Upload</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
