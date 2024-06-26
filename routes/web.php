<?php

use App\Http\Controllers\CodigoController;
use App\Http\Controllers\ComponenteController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FallaController;

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
    return view('auth.login');
});

Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::get('password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset')->name('password.update');
Auth::routes();




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/update-credentials/{user}', [HomeController::class, 'updateCredentials'])->name('update.status');
Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
Route::get('/usuarios/buscar', [UserController::class, 'index'])->name('usuarios.buscar');
Route::get('/home', [UserController::class, 'index'])->name('home');



Route::get('/fallas', [FallaController::class, 'index'])->name('fallas.index');
Route::post('/importar', [FallaController::class, 'importar'])->name('import');
Route::post('/importar-stock', [ComponenteController::class, 'importar'])->name('import-stock');
Route::post('/import-codigos-all', [CodigoController::class, 'importarCodigosAll'])->name('import-codigos-all');
// Route::post('/importar-codigos', [CodigoController::class, 'importar'])->name('import-codigos');
// Route::post('/importar-codigos-E2', [CodigoController::class, 'importar930E2'])->name('import-codigos-E2');
// Route::post('/importar-codigos-E4', [CodigoController::class, 'importar930E4'])->name('import-codigos-E4');
