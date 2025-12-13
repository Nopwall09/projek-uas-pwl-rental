<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/* ini cuman buat tes tar ganti aja*/
Route::get('/', function () {
    return view('home');
});

Route::get('katalog', function () {
    return view('katalog/index');
});

Route::get('pemesanan', function () {
    return view('pemesanan/index');
});

Route::get('mypesan', function () {
    return view('profil/pesanan-saya');
});

Route::get('Konfirmasi', function () {
    return view('pemesanan/konfirPesan');
});

Route::get('Konfirmasi-pembayaran', function () {
    return view('pemesanan/konfirPesan');
});

Route::get('/profil', function () {
    return view('profil/index');
});

Route::get('/login', function () {
    return view('auth/login');
}); 

/* ------------------------------------------------------------*/

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
});


Route::middleware(['auth', 'role:kasir'])->group(function () {
    Route::get('/kasir/dashboard', [UserController::class, 'dashboard'])->name('kasir.dashboard');
});

