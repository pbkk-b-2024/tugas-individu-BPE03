<?php

use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\api\LogoutController;
use App\Http\Controllers\api\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\ItemController;
use App\Http\Controllers\api\KategoriController;

Route::middleware('throttle:60,1')->group(function () {
    Route::post('/register', RegisterController::class);
    Route::post('/login', LoginController::class);
    Route::post('/logout', LogoutController::class)->middleware('auth:sanctum');

    Route::prefix('/tugas4')->group(function(){
        Route::middleware(['auth:sanctum'])->group(function(){
            Route::prefix('items')->group(function(){
                Route::get('/', [ItemController::class, 'index']);
                Route::post('/{id}', [ItemController::class, 'store']);
                Route::get('/{id}', [ItemController::class, 'show']);
                Route::put('/{id}', [ItemController::class, 'update']);
                Route::delete('/{id}', [ItemController::class, 'destroy']);
            });

            Route::prefix('kategoris')->group(function(){
                Route::get('/', [KategoriController::class, 'index']);
                Route::post('/{id}', [KategoriController::class, 'store']);
                Route::get('/{id}', [KategoriController::class, 'show']);
                Route::put('/{id}', [KategoriController::class, 'update']);
                Route::delete('/{id}', [KategoriController::class, 'destroy']);
            });
        });
    });
});

Route::fallback(function () {
    return response()->json([
        'message' => 'Not Found'], 404
    );
});
