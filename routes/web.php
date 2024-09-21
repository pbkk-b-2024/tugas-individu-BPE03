<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return view('layout.template');
});

Route::prefix('/tugas2')->group(function(){
    Route::resource('/item', ItemController::class)->parameters(['crud-Item' => 'Item']);
    Route::resource('/kategori', KategoriController::class)->parameters(['crud-kategori' => 'Kategori']);
    Route::resource('/order', OrderController::class)->parameters(['crud-Order' => 'Order']);
    Route::resource('/pengguna', PenggunaController::class)->parameters(['crud-Pengguna' => 'Pengguna']);
    Route::resource('/review', ReviewController::class)->parameters(['crud-Review' => 'Review']);
});

Route::fallback(function () {
    return redirect('/');
});
