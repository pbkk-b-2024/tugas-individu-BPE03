<?php

use App\Http\Controllers\Tugas1Controller;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('dashboard.base');
});

Route::get('named-route', fn() => view('tugas1.named-route')) -> name('named-route');
Route::get('/param', fn() => view('tugas1.param'))->name('param');
Route::get('/param/{param1}', [Tugas1Controller::class, 'param1'])->name('param1');
Route::get('/404notfound', fn() => view('tugas1.error'))->name('error');

Route::prefix('/tugas1')->group(function(){
 Route::match(['get', 'post'], '/ganjilgenap', [Tugas1Controller::class, 'GanjilGenap'])->name('ganjilgenap');
 Route::get('/fibbonaci',[Tugas1Controller::class,'Fibonacci'])->name('fibonacci');
 Route::get('/prima', [Tugas1Controller::class, 'Prima'])->name('prima');

});

Route::fallback(function () {
    return redirect('/404notfound');
});