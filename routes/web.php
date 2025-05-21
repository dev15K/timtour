<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
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
Route::get('/lang/{locale}', [MainController::class, 'setLanguage'])->name('language');

Route::fallback(function () {
    return view('error.404');
});

Route::group(['prefix' => 'auth'], function () {
    Route::get('/login', [AuthController::class, 'processLogin'])->name('auth.processLogin');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
});

Route::group(['prefix' => 'error'], function () {
    Route::get('/not-found', [ErrorController::class, 'notFound'])->name('error.not.found');
    Route::get('/forbidden', [ErrorController::class, 'forbidden'])->name('error.forbidden');
    Route::get('/unauthorized', [ErrorController::class, 'unauthorized'])->name('error.unauthorized');
});

Route::group(['prefix' => ''], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});

Route::middleware(['auth'])->group(function () {

});


