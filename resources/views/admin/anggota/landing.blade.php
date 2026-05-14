@extends('layouts.admin')
@section('title', 'Pilih Bidang Anggota - SIMTIK')
@section('page-title', 'Pilih Bidang Anggota')

@section('content')
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px; margin-top: 20px;">
    <!-- RENMIN -->
    <div class="card landing-card" onclick="location.href='{{ route('admin.anggota.index', ['bidang' => 'Renmin']) }}'">
        <div class="icon-wrapper renmin">
            <i class="bi bi-briefcase"></i>
        </div>
        <h3>RENMIN</h3>
        <p>Subbag Perencanaan dan Administrasi</p>
        <div class="btn-select renmin">Pilih Bidang</div>
    </div>

    <!-- TEKKOM -->
    <div class="card landing-card" onclick="location.href='{{ route('admin.anggota.index', ['bidang' => 'Tekkom']) }}'">
        <div class="icon-wrapper tekkom">
            <i class="bi bi-broadcast"></i>
        </div>
        <h3>TEKKOM</h3>
        <p>Subbid Teknologi Komunikasi</p>
        <div class="btn-select tekkom">Pilih Bidang</div>
    </div>

    <!-- TEKINFO -->
    <div class="card landing-card" onclick="location.href='{{ route('admin.anggota.index', ['bidang' => 'Tekinfo']) }}'">
        <div class="icon-wrapper tekinfo">
            <i class="bi bi-laptop"></i>
        </div>
        <h3>TEKINFO</h3>
        <p>Subbid Teknologi Informasi</p>
        <div class="btn-select tekinfo">Pilih Bidang</div>
    </div>
</div>

<style>
    .landing-card {
        text-align: center;
        padding: 40px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 1px solid var(--gray-200);
    }
    .landing-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        border-color: var(--accent);
    }
    .icon-wrapper {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 2rem;
    }
    .icon-wrapper.renmin { background: rgba(220, 38, 38, 0.1); color: var(--accent); }
    .icon-wrapper.tekkom { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
    .icon-wrapper.tekinfo { background: rgba(16, 185, 129, 0.1); color: #10b981; }
    
    .landing-card h3 { margin-bottom: 10px; font-family: 'Poppins', sans-serif; font-weight: 700; }
    .landing-card p { color: var(--gray-500); font-size: 0.9rem; margin-bottom: 20px; }
    
    .btn-select {
        padding: 8px 25px;
        border-radius: 20px;
        display: inline-block;
        font-weight: 600;
        color: #fff;
        transition: var(--transition);
    }
    .btn-select.renmin { background: var(--accent); }
    .btn-select.tekkom { background: #3b82f6; }
    .btn-select.tekinfo { background: #10b981; }
</style>
@endsection
