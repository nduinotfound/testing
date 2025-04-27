<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;

Route::resource('barang', BarangController::class);
// use App\Http\Controllers\BarangController;

Route::get('/barang', [BarangController::class, 'index'])->name('index');
Route::get('barang-trashed', [BarangController::class, 'trashed'])->name('barang.trashed');
Route::patch('/barang/{id}/restore', [BarangController::class, 'restore'])->name('barang.restore');
Route::get('/barang/{barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('/barang/{barang}', [BarangController::class, 'update'])->name('barang.update');
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
