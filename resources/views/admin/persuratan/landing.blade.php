@extends('layouts.admin')
@section('title', 'Pilih Bidang Persuratan - SIMTIK')
@section('page-title', 'Pilih Bidang Persuratan')

@section('content')
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px; margin-top: 20px;">
    <!-- RENMIN -->
    <div class="card" style="text-align: center; padding: 40px; cursor: pointer; transition: transform 0.3s;" onclick="location.href='{{ route('admin.persuratan.index', ['bidang' => 'Renmin']) }}'">
        <div style="width: 80px; height: 80px; background: rgba(220, 38, 38, 0.1); color: var(--accent); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 2rem;">
            <i class="bi bi-briefcase"></i>
        </div>
        <h3 style="margin-bottom: 10px;">RENMIN</h3>
        <p style="color: var(--gray-500); font-size: 0.9rem;">Urusan Perencanaan dan Administrasi</p>
        <div style="margin-top: 20px; padding: 8px 20px; background: var(--accent); color: #fff; border-radius: 20px; display: inline-block; font-weight: 600;">Pilih Bidang</div>
    </div>

    <!-- TEKKOM -->
    <div class="card" style="text-align: center; padding: 40px; cursor: pointer; transition: transform 0.3s;" onclick="location.href='{{ route('admin.persuratan.index', ['bidang' => 'Tekkom']) }}'">
        <div style="width: 80px; height: 80px; background: rgba(59, 130, 246, 0.1); color: #3b82f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 2rem;">
            <i class="bi bi-broadcast"></i>
        </div>
        <h3 style="margin-bottom: 10px;">TEKKOM</h3>
        <p style="color: var(--gray-500); font-size: 0.9rem;">Urusan Teknologi Komunikasi</p>
        <div style="margin-top: 20px; padding: 8px 20px; background: #3b82f6; color: #fff; border-radius: 20px; display: inline-block; font-weight: 600;">Pilih Bidang</div>
    </div>

    <!-- TEKINFO -->
    <div class="card" style="text-align: center; padding: 40px; cursor: pointer; transition: transform 0.3s;" onclick="location.href='{{ route('admin.persuratan.index', ['bidang' => 'Tekinfo']) }}'">
        <div style="width: 80px; height: 80px; background: rgba(16, 185, 129, 0.1); color: #10b981; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 2rem;">
            <i class="bi bi-laptop"></i>
        </div>
        <h3 style="margin-bottom: 10px;">TEKINFO</h3>
        <p style="color: var(--gray-500); font-size: 0.9rem;">Urusan Teknologi Informasi</p>
        <div style="margin-top: 20px; padding: 8px 20px; background: #10b981; color: #fff; border-radius: 20px; display: inline-block; font-weight: 600;">Pilih Bidang</div>
    </div>
</div>

<style>
    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        border-color: var(--accent);
    }
</style>
@endsection
