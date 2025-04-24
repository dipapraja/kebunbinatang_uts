<?php

use App\Http\Controllers\HewanController;
use App\Http\Controllers\KandangController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;



// Route untuk welcome
Route::get('/', [WelcomeController::class, 'index']);
,
// Route untuk Hewan
Route::prefix('hewan')->group(function () {
    Route::get('/', [HewanController::class, 'index'])->name('hewan.index');
    Route::get('/list', [HewanController::class, 'list'])->name('hewan.list'); // AJAX/DataTables (GET)
    Route::get('/create', [HewanController::class, 'create'])->name('hewan.create'); // Form tambah
    Route::post('/', [HewanController::class, 'store'])->name('hewan.store'); // Simpan data baru
    Route::get('/{id}', [HewanController::class, 'show'])->name('hewan.show'); // Detail
    Route::get('/{id}/edit', [HewanController::class, 'edit'])->name('hewan.edit'); // Form edit
    Route::put('/{id}', [HewanController::class, 'update'])->name('hewan.update'); // Simpan edit
    Route::delete('/{id}', [HewanController::class, 'destroy'])->name('hewan.destroy'); // Hapus
});

// Route untuk kandang
Route::group(['prefix' => 'kandang'], function () {
    Route::get('/', [KandangController::class, 'index'])->name('kandang.index');
    Route::post('/list', [KandangController::class, 'list'])->name('kandang.list'); // Ajax DataTables
    Route::get('/list', [KandangController::class, 'list']);
    Route::get('/create', [KandangController::class, 'create'])->name('kandang.create'); // form tambah kandang
    Route::post('/', [KandangController::class, 'store'])->name('kandang.store'); // simpan kandang baru
    Route::get('/{id}', [KandangController::class, 'show'])->name('kandang.show'); // detail kandang
    Route::get('/{id}/edit', [KandangController::class, 'edit'])->name('kandang.edit'); // form edit kandang
    Route::put('/{id}', [KandangController::class, 'update'])->name('kandang.update'); // simpan perubahan
    Route::delete('/{id}', [KandangController::class, 'destroy'])->name('kandang.destroy'); // hapus kandang
});