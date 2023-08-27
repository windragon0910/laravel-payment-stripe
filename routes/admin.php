<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\HomeController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AuthenticatedSessionController::class, 'create'])->name('admin.login')->middleware('guest:admin');

Route::post('/admin/login/store', [AuthenticatedSessionController::class, 'store'])->name('admin.login.store');

Route::group(['middleware' => 'admin'], function() {
    Route::get('/cards', [HomeController::class, 'getCards'])->name('cards');

    Route::get('/report', [HomeController::class, 'getLogs'])->name('report');

    Route::get('/user_detail/{id}', [HomeController::class, 'userDetail'])->name('user_detail');

    Route::get('/add_user', function() {return view('admin.users'); })->name('add_user');

    Route::post('/add_user', [HomeController::class, 'addUser'])->name('add_user');

    Route::get('/credit_card', function() {return view('admin.creditcard');})->name('credit_card');

    Route::post('/add_card', [HomeController::class, 'addCard'])->name('add_card');

    Route::get('/toggle', [HomeController::class, 'toggleEnabled'])->name('admin.toggle');

    Route::get('/card_toggle', [HomeController::class, 'cardToggleEnabled'])->name('admin.card_toggle');

    Route::get('/admin', [HomeController::class, 'index'])->name('admin.dashboard');

    Route::post('/admin/logout', [AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');
});
