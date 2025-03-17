<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Admin\{UserController, RekapController, MateriController, StatistikKehadiranController};
use App\Http\Controllers\Guru\{MateriController as GuruMateriController, KehadiranSiswaController, KehadiranGuruController, AbsensiController as GuruAbsensiController, AbsensiSiswaController};
use App\Http\Controllers\Siswa\{MateriSiswaController, KehadiranController};

// ✅ Login Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ✅ Lupa Password Routes
Route::prefix('password')->group(function () {
    Route::get('/forgot', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset', [PasswordResetController::class, 'reset'])->name('password.update');
});

// ✅ **Admin Routes**
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::view('/dashboard', 'admin.dashboard')->name('dashboard');
    Route::resource('users', UserController::class);
    Route::post('/users/import', [UserController::class, 'import'])->name('users.import'); // ✅ Tambahkan ini
    Route::resource('materi', MateriController::class);
    Route::delete('/materi/{id}/deleteFile', [MateriController::class, 'deleteFile'])->name('materi.deleteFile');
    
    Route::get('rekap', [RekapController::class, 'index'])->name('rekap.index');
    Route::put('rekap/{id}', [RekapController::class, 'update'])->name('rekap.update');
    Route::delete('rekap/{id}', [RekapController::class, 'destroy'])->name('rekap.destroy');
    Route::get('rekap/export', [RekapController::class, 'export'])->name('rekap.export');
    
    Route::get('/statistik', [StatistikKehadiranController::class, 'statistik'])->name('statistik');
});

// ✅ **Guru Routes**
Route::middleware(['auth', 'role:guru'])->prefix('guru')->name('guru.')->group(function () {
    Route::view('/dashboard', 'guru.dashboard')->name('dashboard');
    Route::resource('materi', GuruMateriController::class);
    
    Route::get('/absensi', [GuruAbsensiController::class, 'index'])->name('absensi.index');
    Route::post('/absensi', [GuruAbsensiController::class, 'store'])->name('absensi.store');
    
    Route::get('/absensi/siswa', [AbsensiSiswaController::class, 'index'])->name('absensi.siswa');
    Route::post('/absensi/siswa', [AbsensiSiswaController::class, 'store'])->name('absensi.siswa.store');
    
    Route::prefix('kehadiran')->group(function () {
        Route::get('/', [KehadiranSiswaController::class, 'index'])->name('kehadiran.index');
        Route::get('/export-excel', [KehadiranSiswaController::class, 'exportExcel'])->name('kehadiran.exportExcel');
        Route::get('/export-pdf', [KehadiranSiswaController::class, 'exportPDF'])->name('kehadiran.exportPDF');
        
        Route::get('/guru', [KehadiranGuruController::class, 'index'])->name('kehadiran.guru');
        Route::get('/guru/export-excel', [KehadiranGuruController::class, 'exportGuruExcel'])->name('kehadiran.exportGuruExcel');
    });
});

// ✅ **Siswa Routes**
Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::view('/dashboard', 'siswa.dashboard')->name('dashboard');
    Route::get('/materi', [MateriSiswaController::class, 'index'])->name('materi.index');
    Route::get('/materi/{materi}', [MateriSiswaController::class, 'show'])->name('materi.show');
    Route::get('/materi/{materi}/download', [MateriSiswaController::class, 'download'])->name('materi.download');
    
    Route::prefix('kehadiran')->group(function () {
        Route::get('/', [KehadiranController::class, 'index'])->name('kehadiran.index');
        Route::get('/export', [KehadiranController::class, 'export'])->name('kehadiran.export');
    });
});
