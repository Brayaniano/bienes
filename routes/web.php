<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ingreso;
use App\Http\Controllers\PisoController;
use App\Http\Controllers\LocalController;
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
    return view('welcome');
});

Route::resource('ingreso', Ingreso::class);
Route::resource('piso', PisoController::class);
Route::resource('local', LocalController::class);
Route::get('/piso-locales/{id}', [PisoController::class, 'getPisoConLocales']);