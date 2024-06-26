<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FallaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\CustomResetPasswordController;
use App\Http\Controllers\CodigoController;
use App\Http\Controllers\ComponenteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/change-password', [CustomResetPasswordController::class, 'changePassword']);
Route::get('/fallas', [FallaController::class, 'index']);
Route::post('/execute-query', [FallaController::class, 'executeQuery']);
Route::post('/execute-query-codigos', [CodigoController::class, 'executeQuery']);
Route::post('/execute-query-stock', [ComponenteController::class, 'executeQuery']);
Route::post('/execute-query-stock-general', [ComponenteController::class, 'getStock']);
Route::post('/loginApi', [LoginController::class, 'loginApi']);
Route::post('/register', [RegisterController::class, 'registerApi']);
