<?php


use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\consorcios_control;
use App\Http\Controllers\gastos_control;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\bancos_movs;
use App\Models\gastosParticulares;
use App\Http\Controllers\GastosParticularesController;
use App\Http\Controllers\gastosProveedoresController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard route showing consorcios

Route::get('/dashboard', [consorcios_control::class, 'consorcios'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

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

//Muestra datos del consorcio
Route::get('/consorcios/{idcons}', [consorcios_control::class, 'show'])->name('consorcios.show');

// Rutas para mostrar y procesar envio de datos de gastos.
// Route::get('/gastos/create/{idcons}', [GastosParticularesController::class, 'create'])->name('gastos.create');
Route::post('/gastos/store', [GastosParticularesController::class, 'store'])->name('gastos.store');

// Ruta para los gastos

Route::post('/proveedores/store', [gastosProveedoresController::class, 'store'])->name('proveedore.store');

