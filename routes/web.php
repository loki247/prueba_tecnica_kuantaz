<?php

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
    return view('welcome');
});

Route::get("misbeneficios/{run}", [\App\Http\Controllers\BeneficiosController::class, 'getBeneficiosRun']);

Route::prefix("fichas")->group(function () {
    Route::post("save", [\App\Http\Controllers\FichaController::class, 'saveFicha']);
    Route::post("update", [\App\Http\Controllers\FichaController::class, 'updateFicha']);
});

Route::prefix("beneficios")->group(function () {
    Route::post("save", [\App\Http\Controllers\BeneficiosController::class, 'saveBeneficio']);
    Route::post("update", [\App\Http\Controllers\BeneficiosController::class, 'updateBeneficio']);
});

Route::prefix("montos-maximos")->group(function () {
    Route::post("save", [\App\Http\Controllers\MontosMaximosController::class, 'saveMontoMaximo']);
    Route::post("update", [\App\Http\Controllers\MontosMaximosController::class, 'updateMontoMaximo']);
});

Route::prefix("usuarios")->group(function () {
    Route::post("save", [\App\Http\Controllers\UsersController::class, 'saveUser']);
    Route::post("update", [\App\Http\Controllers\UsersController::class, 'updateUser']);
});
