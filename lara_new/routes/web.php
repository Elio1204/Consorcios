<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\consorcios_control;
use App\Http\Controllers\gastos_control;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//Muestra consorcios
Route::get('/consorcios', [consorcios_control::class, 'consorcios'])->name('consorcios');

//Muestra gastos
Route::get('/gastos/{idcons}', [gastos_control::class, 'showGastos'])->name('gastos');