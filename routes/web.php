<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\WishlistController;

Route::get('/', function () {
    return view('layout.template');
});

Route::get('/register', [RegisterController::class,'show'])->name('register.show');
Route::post('/register', [RegisterController::class,'register'])->name('register.create');
Route::get('/register/penjual', [RegisterController::class,'show_penjual'])->name('register.show_penjual');
Route::post('/register/penjual', [RegisterController::class,'register_penjual'])->name('register.create_penjual');
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.create');
Route::post('/logout', [LoginController::class, 'logout'])->name('login.logout');

Route::prefix('/fp')->group(function(){
    Route::middleware(['auth'])->group(function(){
        Route::resource('/item', ItemController::class)->parameters(['Item']);
        Route::resource('/kategori', KategoriController::class)->parameters(['Kategori']);
        Route::resource('/order', OrderController::class)->parameters(['Order']);
        Route::resource('/user', UserController::class)->parameters(['user']);
        Route::resource('/review', ReviewController::class)->parameters(['Review']);
        Route::resource('/keranjang', KeranjangController::class)->parameters(['Keranjang']);
        Route::resource('/wishlist', WishlistController::class)->parameters(['Wishlist']);
    });
});

Route::view('/api/schema','api.schema')->name('api.schema');

Route::fallback(function () {
    return redirect('/');
});
