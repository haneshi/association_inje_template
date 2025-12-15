<?php

use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Admin\Home\AdminHomeController;
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

Route::controller(AdminHomeController::class)
    ->group(function () {
        Route::get('/admin', 'index')->name('admin.home');
    });

Route::controller(AdminAuthController::class)
    ->group(function () {
        Route::get('/admin/login', 'login')->name('admin.login');
    });
