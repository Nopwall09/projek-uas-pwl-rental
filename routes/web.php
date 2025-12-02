<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;

Route::get('/', function () {
    return view('welcome');
});

// route middleware admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\userController::class, 'dashboard'])->name('admin.dashboard');
    // other admin routes
});
// route middleware user
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [App\Http\Controllers\userController::class, 'dashboard'])->name('user.dashboard');
    // other user routes
});
// route middleware kasir
Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/kasir/dashboard', [App\Http\Controllers\userController::class, 'dashboard'])->name('kasir.dashboard');
    // other kasir routes
});