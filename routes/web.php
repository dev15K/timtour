<?php

use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'app-settings'], function () {
        Route::get('/index', [AdminSettingController::class, 'index'])->name('admin.app.setting.index');
        Route::post('/store', [AdminSettingController::class, 'appSetting'])->name('admin.app.setting.store');
    });

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/index', [UserController::class, 'index'])->name('admin.profile.index');
        Route::post('/change-info', [UserController::class, 'changeInfo'])->name('admin.profile.change.info');
        Route::post('/change-password', [UserController::class, 'changePassword'])->name('admin.profile.change.password');
    });

    Route::group(['prefix' => 'items'], function () {
        Route::get('/create', [ItemController::class, 'create'])->name('admin.items.create');
        Route::get('/detail/{id}', [ItemController::class, 'detail'])->name('admin.items.detail');
        Route::get('/view/{id}', [ItemController::class, 'view'])->name('admin.items.view');
        Route::post('/store', [ItemController::class, 'store'])->name('admin.items.store');
        Route::put('/update/{id}', [ItemController::class, 'update'])->name('admin.items.update');
        Route::delete('/delete/{id}', [ItemController::class, 'delete'])->name('admin.items.delete');
    });
});


