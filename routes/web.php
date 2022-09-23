<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//register
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'register_action'])->name('register.action');
//login
Route::get('/', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'login_action'])->name('login.action');

//middleware auth
Route::group(['middleware' => ['auth']], function () {
    Route::resource('user', UserController::class);
    Route::post('/password', [UserController::class, 'password_action'])->name('password.action');
    Route::get('logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/product', [ProductController::class, 'index'])->name('product.index');
    Route::post('/product', [ProductController::class, 'store'])->name('product.store');
});
