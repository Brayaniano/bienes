<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PisoController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\EdificioController;
use App\Http\Controllers\InquilinoController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\EgresoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('index');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //** Rutas para piso */
    Route::get('/pisos', [PisoController::class, 'index'])->name('pisos.index');
    Route::get('/pisos/create', [PisoController::class, 'create'])->name('pisos');
    Route::post('/pisos', [PisoController::class, 'store'])->name('pisos');
    Route::get('/piso/{id}', [PisoController::class, 'show'])->name('pisos.show');
    Route::get('/piso/{id}/edit', [PisoController::class, 'edit'])->name('pisos.edit');
    Route::post('/piso/{id}', [PisoController::class, 'update']);
    Route::get('/piso/{id}/delete', [PisoController::class, 'destroy'])->name('pisos.delete');
    //** Rutas para piso */
    //** Rutas para Local */
    Route::get('/locales', [LocalController::class, 'index'])->name('locales.index');
    Route::get('/locales/create', [LocalController::class, 'create'])->name('locales');
    Route::get('/local/{id}', [LocalController::class, 'show'])->name('locales.show');
    Route::post('/locales', [LocalController::class, 'store'])->name('locales');
    Route::get('/locales/{id}/edit', [LocalController::class, 'edit'])->name('locales.edit');
    Route::post('/local/{id}', [LocalController::class, 'update']);
    Route::get('/locales/{id}/delete', [LocalController::class, 'destroy'])->name('locales.delete');
    //** Rutas para Local */
    //** Rutas para Edificio */
        Route::get('/edificios', [EdificioController::class, 'index'])->name('edificios.index');
        Route::get('/edificios/create', [EdificioController::class, 'create'])->name('edificios');
        Route::get('/edificio/{id}', [EdificioController::class, 'show'])->name('edificios.show');
        Route::post('/edificios', [EdificioController::class, 'store'])->name('edificios');
        Route::get('/edificios/{id}/edit', [EdificioController::class, 'edit'])->name('edificios.edit');
        Route::post('/edificio/{id}', [EdificioController::class, 'update']);
        Route::get('/edificios/{id}/delete', [EdificioController::class, 'destroy'])->name('edificios.delete');
    //** Rutas para Edificio */
    //** Rutas para Inquilino */
        Route::get('/inquilinos', [InquilinoController::class, 'index'])->name('inquilinos.index');
        Route::get('/inquilinos/create', [InquilinoController::class, 'create'])->name('inquilinos');
        Route::get('/inquilino/{id}', [InquilinoController::class, 'show'])->name('inquilinos.show');
        Route::post('/inquilinos', [InquilinoController::class, 'store'])->name('inquilinos');
        Route::get('/inquilinos/{id}/edit', [InquilinoController::class, 'edit'])->name('inquilinos.edit');
        Route::post('/inquilino/{id}', [InquilinoController::class, 'update']);
        Route::get('/inquilinos/{id}/delete', [InquilinoController::class, 'destroy'])->name('inquilinos.delete');
    //** Rutas para Inquilino */
    //** Rutas para Contrato */
        Route::get('/contratos', [ContratoController::class, 'index'])->name('contratos.index');
        Route::get('/contratos/create', [ContratoController::class, 'create'])->name('contratos');
        Route::get('/contrato/{id}', [ContratoController::class, 'show'])->name('contratos.show');
        Route::post('/contratos', [ContratoController::class, 'store'])->name('contratos');
        Route::get('/contratos/{id}/edit', [ContratoController::class, 'edit'])->name('contratos.edit');
        Route::post('/contrato/{id}', [ContratoController::class, 'update']);
        Route::get('/contratos/{id}/delete', [ContratoController::class, 'destroy'])->name('contratos.delete');
    //** Rutas para Contrato */
    //** Rutas para Cuenta */
        Route::get('/cuentas', [CuentaController::class, 'index'])->name('cuentas.index');
        Route::get('/cuentas/create', [CuentaController::class, 'create'])->name('cuentas');
        Route::get('/cuenta/{id}', [CuentaController::class, 'show'])->name('cuentas.show');
        Route::post('/cuentas', [CuentaController::class, 'store'])->name('cuentas');
        Route::get('/cuentas/{id}/edit', [CuentaController::class, 'edit'])->name('cuentas.edit');
        Route::post('/cuenta/{id}', [CuentaController::class, 'update']);
        Route::get('/cuentas/{id}/delete', [CuentaController::class, 'destroy'])->name('cuentas.delete');
    //** Rutas para Cuenta */
    //** Rutas para Cuenta */
        Route::get('/egresos', [EgresoController::class, 'index'])->name('egresos.index');
        Route::get('/egresos/create', [EgresoController::class, 'create'])->name('egresos');
        Route::get('/egreso/{id}', [EgresoController::class, 'show'])->name('egresos.show');
        Route::post('/egresos', [EgresoController::class, 'store'])->name('egresos');
        Route::get('/egresos/{id}/edit', [EgresoController::class, 'edit'])->name('egresos.edit');
        Route::post('/egreso/{id}', [EgresoController::class, 'update']);
        Route::get('/egresos/{id}/delete', [EgresoController::class, 'destroy'])->name('egresos.delete');
    //** Rutas para Cuenta */
});


require __DIR__.'/auth.php';
