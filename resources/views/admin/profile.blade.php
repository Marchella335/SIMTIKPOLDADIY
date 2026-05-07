@extends('layouts.admin')
@section('title', 'Pengaturan Profil - Admin SIMTIK')
@section('page-title', 'Pengaturan Profil')

@section('content')
<div class="card" style="max-width: 800px;">
    <div class="card-header">
        <h3><i class="bi bi-person-gear"></i> Informasi Akun</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 30px;">
                <div class="profile-section">
                    <h4 style="margin-bottom: 20px; color: var(--primary); border-bottom: 2px solid var(--gray-100); padding-bottom: 10px;">Data Pribadi</h4>
                    
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        @error('name')<div class="form-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label>Alamat Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        @error('email')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="profile-section">
                    <h4 style="margin-bottom: 20px; color: var(--primary); border-bottom: 2px solid var(--gray-100); padding-bottom: 10px;">Keamanan</h4>
                    <p style="font-size: 0.85rem; color: var(--gray-500); margin-bottom: 15px;">Kosongkan jika tidak ingin mengubah kata sandi.</p>

                    <div class="form-group">
                        <label>Kata Sandi Baru</label>
                        <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter">
                        @error('password')<div class="form-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label>Konfirmasi Kata Sandi Baru</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi kata sandi baru">
                    </div>
                </div>
            </div>

            <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid var(--gray-100); display: flex; justify-content: flex-end; gap: 10px;">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle"></i> Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<div class="card" style="max-width: 800px; margin-top: 25px;">
    <div class="card-header">
        <h3><i class="bi bi-info-circle"></i> Informasi Login</h3>
    </div>
    <div class="card-body">
        <div style="display: flex; gap: 20px; align-items: center;">
            <div style="font-size: 2.5rem; color: var(--gray-300);">
                <i class="bi bi-shield-lock"></i>
            </div>
            <div>
                <p style="margin-bottom: 5px;"><strong>Terakhir diperbarui:</strong> {{ $user->updated_at->format('d F Y, H:i') }}</p>
                <p style="color: var(--gray-500); font-size: 0.9rem;">Pastikan Anda menggunakan kata sandi yang kuat dan unik untuk melindungi akun Anda.</p>
            </div>
        </div>
    </div>
</div>
@endsection
