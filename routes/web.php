<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\JenisSuratController;
use App\Http\Controllers\SuratDispensasiController;
use App\Http\Controllers\LaporanDispensasiController;
use App\Http\Controllers\JurusanController;


// ===================
// LOGIN
// ===================

Route::get('/', function () {
    return redirect()->route('login');
});


// LOGIN
Route::get('/login', [AuthController::class, 'loginForm'])
    ->middleware('guest:admin')
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest:admin');



Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ===================
// ADMIN AREA
// ===================
Route::middleware('auth:admin')->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // CRUD SISWA
    Route::resource('siswa', SiswaController::class)
        ->except(['show']);

    // CRUD JENIS SURAT
    Route::resource('jenis-surat', JenisSuratController::class)
        ->except(['show']);

    // SURAT DISPENSASI
    Route::resource('surat-dispensasi', SuratDispensasiController::class)
        ->except(['edit', 'update', 'destroy']);

    Route::get(
        'surat-dispensasi/{suratDispensasi}/edit',
        [SuratDispensasiController::class, 'edit']
    )->name('surat-dispensasi.edit');

    Route::put(
        'surat-dispensasi/{suratDispensasi}',
        [SuratDispensasiController::class, 'update']
    )->name('surat-dispensasi.update');


    Route::delete(
        'surat-dispensasi/{suratDispensasi}',
        [SuratDispensasiController::class, 'destroy']
    )->name('surat-dispensasi.destroy');

    // CETAK PDF
    Route::get(
        'surat-dispensasi/{suratDispensasi}/cetak',
        [SuratDispensasiController::class, 'cetak']
    )->name('surat-dispensasi.cetak');

    // LOG DISPENSASI (kembali ke sekolah)
    Route::post(
        'surat-dispensasi/{surat}/kembali',
        [SuratDispensasiController::class, 'kembali']
    )->name('surat-dispensasi.kembali');

    // HALAMAN LAPORAN (LOG)
    Route::get('/laporan-dispensasi', [LaporanDispensasiController::class, 'index'])
        ->name('laporan.dispensasi');

    // UNTUK ECXEL EXPORT
    Route::get(
        '/laporan-dispensasi/export-excel',
        [LaporanDispensasiController::class, 'exportExcel']
    )->name('laporan-dispensasi.export-excel');

    // JURUSAN 
    Route::resource('jurusan', JurusanController::class);
});
