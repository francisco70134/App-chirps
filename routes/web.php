<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Chirp;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


/* para hacer las consultas de cuanto estamos consumiendo */
/* DB::listen(function($query){
    dump($query->sql);
}); */

Route::view('/','welcome')->name("welcome");

/* Route::get('/', function () {
    return view('welcome');
}); */

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::middleware('auth')->group(function () {

    Route::view('/dashboard','dashboard')->name("dashboard");
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /* colocamos la funcion chirps aqui para poder autenticar que solo se pueda entrar mientras el usuario este logueado*/
    Route::get('/chirps',[ChirpController::class, 'index'])->name('chirps.index');
    Route::post('/chirps', [ChirpController::class, 'store'])->name('chirps.store');
    Route::get('/chirps/{chirp}/edit', [ChirpController::class, 'edit'])->name('chirps.edit');
    Route::put('/chirps/{chirp}', [ChirpController::class, 'update'])->name('chirps.update');
    Route::delete('/chirps/{chirp}', [ChirpController::class,  'destroy'])->name('chirps.destroy');

});

require __DIR__ . '/auth.php';
