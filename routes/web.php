<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RekapController;
use App\Http\Controllers\Admin\MateriController;
use App\Http\Controllers\Admin\StatistikKehadiranController;
use App\Http\Controllers\Siswa\MateriSiswaController;
use App\Http\Controllers\Siswa\AbsensiController;
use App\Http\Controllers\Guru\MateriController as GuruMateriController;
use App\Http\Controllers\Siswa\KehadiranController;
use App\Http\Controllers\Guru\KehadiranSiswaController;
use App\Http\Controllers\Guru\KehadiranGuruController;
use App\Http\Controllers\Guru\AbsensiController as GuruAbsensiController;
use App\http\Controllers\Guru\AbsensiSiswaController;

Route::get('/', function () {
    return view('welcome');
});

// ✅ Login Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ✅ **Admin Routes**
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // 🔹 **Manajemen Pengguna**
    Route::resource('users', UserController::class);

    // 🔹 **Rekap Absensi**
    Route::get('rekap', [RekapController::class, 'index'])->name('rekap.index');
    Route::put('rekap/{id}', [RekapController::class, 'update'])->name('rekap.update');
    Route::delete('rekap/{id}', [RekapController::class, 'destroy'])->name('rekap.destroy');
    Route::get('rekap/export', [RekapController::class, 'export'])->name('rekap.export');

    // 🔹 **Manajemen Materi**
    Route::resource('materi', MateriController::class);
    Route::delete('/materi/{id}/deleteFile', [MateriController::class, 'deleteFile'])->name('materi.deleteFile');

    // 🔹 **Statistik Kehadiran**
    Route::get('statistik-kehadiran', [StatistikKehadiranController::class, 'index'])->name('statistik-kehadiran');
});

// ✅ **Guru Routes**
Route::middleware(['auth', 'role:guru'])->prefix('guru')->name('guru.')->group(function () {
    Route::get('/dashboard', function () {
        return view('guru.dashboard');
    })->name('dashboard');

    // 🔹 **Manajemen Materi oleh Guru**
    Route::resource('materi', GuruMateriController::class);

    // 🔹 **Absensi Guru**
    Route::get('/absensi', [GuruAbsensiController::class, 'index'])->name('absensi.index');
    Route::post('/absensi', [GuruAbsensiController::class, 'store'])->name('absensi.store');

    Route::get('/guru/absensi/siswa', [AbsensiSiswaController::class, 'index'])->name('absensi.siswa');
    Route::post('/guru/absensi/siswa', [AbsensiSiswaController::class, 'store'])->name('absensi.siswa.store');

    // 🔹 **Kehadiran Siswa oleh Guru**
    Route::prefix('kehadiran')->group(function () {
        Route::get('/', [KehadiranSiswaController::class, 'index'])->name('kehadiran.index');
        Route::get('export-excel', [KehadiranSiswaController::class, 'exportExcel'])->name('kehadiran.exportExcel');
        Route::get('export-pdf', [KehadiranSiswaController::class, 'exportPDF'])->name('kehadiran.exportPDF');
        Route::get('kehadiran/guru', [KehadiranGuruController::class, 'index'])->name('kehadiran.guru');
        Route::get('guru/kehadiran/export-guru', [KehadiranGuruController::class, 'exportGuruExcel'])
        ->name('kehadiran.exportGuruExcel');
    });
});

// ✅ **Siswa Routes**
Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/dashboard', function () {
        return view('siswa.dashboard');
    })->name('dashboard');

    // 🔹 **Materi Siswa**
    Route::get('materi', [MateriSiswaController::class, 'index'])->name('materi.index');
    Route::get('materi/{materi}', [MateriSiswaController::class, 'show'])->name('materi.show');
    Route::get('materi/{materi}/download', [MateriSiswaController::class, 'download'])->name('materi.download');

    // 🔹 **Absensi Siswa**
    Route::get('absensi', [AbsensiController::class, 'index'])->name('absensi.index');
    Route::post('absensi', [AbsensiController::class, 'store'])->name('absensi.store');

    // 🔹 **Rekap Kehadiran Siswa**
    Route::prefix('kehadiran')->group(function () {
        Route::get('/', [KehadiranController::class, 'index'])->name('kehadiran.index');
        Route::get('export', [KehadiranController::class, 'export'])->name('kehadiran.export');
    });
});
