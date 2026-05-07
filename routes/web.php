<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\KegiatanPublicController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\AdministrasiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\SuratController;
use App\Http\Controllers\Admin\KeuanganController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\ProfileController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
Route::get('/kegiatan', [KegiatanPublicController::class, 'index'])->name('kegiatan');
Route::get('/kegiatan/{id}', [KegiatanPublicController::class, 'show'])->name('kegiatan.show');
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'send'])->name('kontak.send');
Route::get('/administrasi', [AdministrasiController::class, 'index'])->name('administrasi');
Route::get('/administrasi/persuratan', [AdministrasiController::class, 'persuratan'])->name('administrasi.persuratan');
Route::get('/administrasi/keuangan', [AdministrasiController::class, 'keuangan'])->name('administrasi.keuangan');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('anggota', AnggotaController::class);
    Route::resource('persuratan', SuratController::class);
    // Keuangan Baru (Multi Sumber Dana)
    Route::get('keuangan/sumber-dana', [KeuanganController::class, 'getSumberDana'])->name('keuangan.sumber_dana.index');
    Route::post('keuangan/sumber-dana', [KeuanganController::class, 'storeSumberDana'])->name('keuangan.sumber_dana.store');
    Route::delete('keuangan/sumber-dana/{id}', [KeuanganController::class, 'destroySumberDana'])->name('keuangan.sumber_dana.destroy');
    Route::get('keuangan/sumber-dana/{id}/acaras', [KeuanganController::class, 'getAcarasBySource'])->name('keuangan.sumber_dana.acaras');
    Route::post('keuangan/acara', [KeuanganController::class, 'storeAcara'])->name('keuangan.acara.store');
    Route::put('keuangan/acara/{id}', [KeuanganController::class, 'updateAcara'])->name('keuangan.acara.update');
    Route::delete('keuangan/acara/{id}', [KeuanganController::class, 'destroyAcara'])->name('keuangan.acara.destroy');
    Route::post('keuangan/acara/{id}/items', [KeuanganController::class, 'syncAcaraItems'])->name('keuangan.acara.items.sync');
    Route::resource('keuangan', KeuanganController::class);
    Route::post('keuangan/pagu', [KeuanganController::class, 'pagu'])->name('keuangan.pagu');
    Route::resource('kegiatan', KegiatanController::class);
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
