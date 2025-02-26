<?php

use App\Http\Controllers\PosesionController;
use App\Http\Controllers\VideojuegoController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');


Route::get('/videojuegos/update/{videojuego}', [VideojuegoController::class, 'update'])->middleware('can:update-videojuego,videojuego');
Route::get('/videojuegos/poseo', [VideojuegoController::class, 'poseo'])->name('poseo');
Route::post('/videojuegos/comprar', [VideojuegoController::class, 'comprar'])->name('videojuegos.comprar');
Route::post('/videojuegos/vender', [VideojuegoController::class, 'vender'])->name('videojuegos.vender');

Route::resource('videojuegos', VideojuegoController::class)->middleware(['auth']);
Route::resource('posesiones', PosesionController::class)
        ->parameters(['posesiones' => 'posesion']);

require __DIR__.'/auth.php';
