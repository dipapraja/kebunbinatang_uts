<?php

use App\Http\Controllers\HewanController;
use App\Http\Controllers\KandangController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;



// Route untuk welcome
Route::get('/', [WelcomeController::class, 'index']);

// Route untuk Hewan
Route::group(['prefix'=>'hewan'], function(){
    Route::get('/', [HewanController::class, 'index'])->name('index');
    Route::post('/list', [HewanController::class, 'list']);
    Route::get('/list', [HewanController::class, 'list']);
    Route::get('/create', [HewanController::class, 'create'])->name('create'); // form tambah hewan
    Route::post('/', [HewanController::class, 'store'])->name('store'); // simpan hewan baru
    Route::get('/{id}', [HewanController::class, 'show'])->name('show'); // detail hewan
    Route::get('/{id}/edit', [HewanController::class, 'edit'])->name('edit'); // form edit hewan
    Route::put('/{id}', [HewanController::class, 'update'])->name('update'); // simpan perubahan
    Route::delete('/{id}', [HewanController::class, 'destroy'])->name('destroy'); // hapus hewan
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