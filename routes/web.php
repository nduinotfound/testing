<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;

Route::resource('barang', BarangController::class);
Route::get('barang-trashed', [BarangController::class, 'trashed'])->name('barang.trashed');
Route::patch('/barang/{id}/restore', [BarangController::class, 'restore'])->name('barang.restore');
