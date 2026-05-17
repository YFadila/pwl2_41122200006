<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\NotifikasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;

Route::get('/', function () {
    return redirect()->route('beranda');
});

Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('laporan', LaporanController::class)->except(['edit', 'update', 'destroy']);

    Route::post('/laporan/{laporan_id}/komentar', [KomentarController::class, 'store'])->name('komentar.store');
    Route::put('/komentar/{komentar}', [KomentarController::class, 'update'])->name('komentar.update');
    Route::delete('/komentar/{komentar}', [KomentarController::class, 'destroy'])->name('komentar.destroy');

    Route::get('/notifikasi/json', [NotifikasiController::class, 'getJson'])->name('notifikasi.json');
    Route::post('/notifikasi/mark-read', [NotifikasiController::class, 'markRead'])->name('notifikasi.markRead');
    Route::post('/notifikasi/{id}/baca', [NotifikasiController::class, 'markOne'])->name('notifikasi.markOne');
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');

    Route::middleware(['admin'])->group(function () {
        Route::get('/laporan/{laporan}/edit', [LaporanController::class, 'edit'])->name('laporan.edit');
        Route::put('/laporan/{laporan}', [LaporanController::class, 'update'])->name('laporan.update');
        Route::delete('/laporan/{laporan}', [LaporanController::class, 'destroy'])->name('laporan.destroy');
    });

});

require __DIR__.'/auth.php';