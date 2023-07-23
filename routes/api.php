<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FallaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::get('/fallas', [FallaController::class, 'index']);
Route::post('/execute-query', [FallaController::class, 'executeQuery']);
Route::post('/loginApi', [LoginController::class, 'loginApi']);
Route::post('/register', [RegisterController::class, 'registerApi']);
//Route::post('/login', 'Auth\LoginController@login');
