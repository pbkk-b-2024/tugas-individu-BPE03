<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ReviewController;

Route::get('/', function () {
    return view('layout.template');
});

Route::get('/register', [RegisterController::class,'show'])->name('register.show');
Route::post('/register', [RegisterController::class,'register'])->name('register.create');
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.create');
Route::post('/logout', [LoginController::class, 'logout'])->name('login.logout');

Route::prefix('/tugas4')->group(function(){
    Route::middleware(['auth'])->group(function(){
        Route::resource('/item', ItemController::class)->parameters(['Item']);
        Route::resource('/kategori', KategoriController::class)->parameters(['Kategori']);
        Route::resource('/order', OrderController::class)->parameters(['Order']);
        Route::resource('/pengguna', PenggunaController::class)->parameters(['Pengguna']);
        Route::resource('/review', ReviewController::class)->parameters(['Review']);
    });
});

Route::view('/api/schema','api.schema')->name('api.schema');

Route::fallback(function () {
    return redirect('/');
});
