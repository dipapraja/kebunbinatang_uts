<?php

// use App\Http\Controllers\KategoriController;
// use App\Http\Controllers\LevelController;
use App\Http\Controllers\HewanController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', [WelcomeController::class, 'index']);

// // Route untuk modul Level
// Route::get('/level', [LevelController::class, 'index']);

// // Route untuk modul Kategori
// Route::get('/kategori', [KategoriController::class, 'index']);

// Route untuk modul Hewan
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

