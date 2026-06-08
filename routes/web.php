<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\KegiatanPublicController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\AdministrasiController;
use App\Http\Controllers\AuthController;
<<<<<<< HEAD
=======
use App\Http\Controllers\LayananPublicController; // kept for BC — routes removed
>>>>>>> de99b69c751d845bd6236f9de158f1c6c0f00c94
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\SuratController;
use App\Http\Controllers\Admin\KeuanganController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ExecutiveReportController;
use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\SettingsController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
Route::get('/kegiatan', [KegiatanPublicController::class, 'index'])->name('kegiatan');
Route::get('/kegiatan/{id}', [KegiatanPublicController::class, 'show'])->name('kegiatan.show');
Route::get('/berita', [\App\Http\Controllers\BeritaPublicController::class, 'index'])->name('berita');
Route::get('/berita/{id}', [\App\Http\Controllers\BeritaPublicController::class, 'show'])->name('berita.show');
Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'send'])->name('kontak.send');
Route::get('/administrasi', [AdministrasiController::class, 'index'])->name('administrasi');
Route::get('/administrasi/persuratan', [AdministrasiController::class, 'persuratanLanding'])->name('administrasi.persuratan.landing');
Route::get('/administrasi/persuratan/data', [AdministrasiController::class, 'persuratan'])->name('administrasi.persuratan');
Route::get('/administrasi/keuangan', [AdministrasiController::class, 'keuangan'])->name('administrasi.keuangan');

<<<<<<< HEAD
=======
// Layanan TIK (Public CRM) removed

>>>>>>> de99b69c751d845bd6236f9de158f1c6c0f00c94
// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('anggota/landing', [AnggotaController::class, 'landing'])->name('anggota.landing');
    Route::resource('anggota', AnggotaController::class);
    Route::post('jabatan/send-alert', [\App\Http\Controllers\Admin\JabatanController::class, 'sendAlert'])->name('jabatan.send-alert');
    Route::resource('jabatan', \App\Http\Controllers\Admin\JabatanController::class)->except(['create', 'show', 'edit']);
    Route::resource('struktur', \App\Http\Controllers\Admin\StrukturOrganisasiController::class)->only(['index', 'store', 'destroy']);
    Route::get('persuratan/landing', [SuratController::class, 'landing'])->name('persuratan.landing');
<<<<<<< HEAD
    Route::get('persuratan/export-pdf', [SuratController::class, 'exportPdf'])->name('persuratan.export-pdf');
    Route::post('persuratan/{persuratan}/teruskan', [SuratController::class, 'teruskan'])->name('persuratan.teruskan');
=======
    Route::get('persuratan/export', [SuratController::class, 'export'])->name('persuratan.export');
>>>>>>> de99b69c751d845bd6236f9de158f1c6c0f00c94
    Route::resource('persuratan', SuratController::class);
    // Keuangan Baru (Multi Sumber Dana)
    Route::get('keuangan/sumber-dana', [KeuanganController::class, 'getSumberDana'])->name('keuangan.sumber_dana.index');
    Route::post('keuangan/sumber-dana', [KeuanganController::class, 'storeSumberDana'])->name('keuangan.sumber_dana.store');
    Route::delete('keuangan/sumber-dana/{id}', [KeuanganController::class, 'destroySumberDana'])->name('keuangan.sumber_dana.destroy');
    Route::get('keuangan/sumber-dana/{id}/acaras', [KeuanganController::class, 'getAcarasBySource'])->name('keuangan.sumber_dana.acaras');
    Route::post('keuangan/acara', [KeuanganController::class, 'storeAcara'])->name('keuangan.acara.store');
    Route::post('keuangan/acara/{id}/tambah-dana', [KeuanganController::class, 'addDanaToSheet'])->name('keuangan.acara.tambah_dana');
    Route::put('keuangan/acara/{id}', [KeuanganController::class, 'updateAcara'])->name('keuangan.acara.update');
    Route::delete('keuangan/acara/{id}', [KeuanganController::class, 'destroyAcara'])->name('keuangan.acara.destroy');
    Route::post('keuangan/acara/{id}/items', [KeuanganController::class, 'syncAcaraItems'])->name('keuangan.acara.items.sync');
    Route::get('keuangan/rekap', [KeuanganController::class, 'rekap'])->name('keuangan.rekap');
    Route::get('keuangan/export-pdf', [KeuanganController::class, 'exportPdf'])->name('keuangan.export-pdf');
    Route::resource('keuangan', KeuanganController::class);
    Route::post('keuangan/pagu', [KeuanganController::class, 'pagu'])->name('keuangan.pagu');
    Route::get('kegiatan/export-pdf', [\App\Http\Controllers\Admin\KegiatanController::class, 'exportPdf'])->name('kegiatan.export-pdf');
    Route::get('kegiatan/trend', [\App\Http\Controllers\Admin\KegiatanController::class, 'trend'])->name('kegiatan.trend');
    Route::resource('kegiatan', KegiatanController::class);
    Route::resource('rencana-kegiatan', \App\Http\Controllers\Admin\RencanaKegiatanController::class);
    Route::get('berita/export-pdf', [\App\Http\Controllers\Admin\BeritaController::class, 'exportPdf'])->name('berita.export-pdf');
    Route::resource('berita', \App\Http\Controllers\Admin\BeritaController::class);
    Route::resource('carousel', \App\Http\Controllers\Admin\CarouselController::class);
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // === CPMK Features ===
    // Executive Intelligence Hub (Data Warehouse & ERP)
    Route::get('/executive-report', [ExecutiveReportController::class, 'index'])->name('executive-report');
<<<<<<< HEAD
    Route::get('/rekap', [\App\Http\Controllers\Admin\RekapController::class, 'index'])->name('rekap.index');
    Route::get('/rekap/export-pdf', [\App\Http\Controllers\Admin\RekapController::class, 'exportPdf'])->name('rekap.export-pdf');

=======
>>>>>>> de99b69c751d845bd6236f9de158f1c6c0f00c94
    // Security & Activity Log
    Route::get('/activity-log', [ActivityLogController::class, 'index'])->name('activity-log');
    // Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
});

