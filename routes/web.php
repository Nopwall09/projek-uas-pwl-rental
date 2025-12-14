<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RentalItemController;
use App\Http\Controllers\AuthController;

/* ini cuman buat tes tar ganti aja*/
Route::get('/home', function () {
    return view('home');
});

Route::get('katalog', function () {
    return view('Katalog.index');
});

Route::get('pemesanan', function () {
    return view('Pemesanan.index');
});

Route::get('mypesan', function () {
    return view('Profil.pesanan-saya');
});

Route::get('Konfirmasi', function () {
    return view('Pemesanan.konfirPesan');
});

Route::get('Konfirmasi-pembayaran', function () {
    return view('Pemesanan.konfirPesan');
});

Route::get('/profil', function () {
    return view('Profil.index');
});


/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

// Register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/register', [AuthController::class, 'register'])
    ->name('register.process');
// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
*/
Route::middleware(['user'])->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('profile', [UserController::class, 'show'])->name('open.profile');
    Route::get('edit', [UserController::class, 'update'])->name('update.profile');
    Route::get('edit', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['user'])->group(function () {
    Route::get('/katalog', function () {
        return view('katalog/index');
    })->name('katalog');
});

Route::middleware(['user'])->group(function () {
    Route::get('/pemesanan', function () {
        return view('pemesanan/index');
    })->name('pemesanan');
});

Route::middleware(['user'])->group(function () {
    Route::get('/Konfirmasi', function () {
        return view('Pemesanan.konfirPesan');
    })->name('Konfirmasi');
});

/*
|--------------------------------------------------------------------------
| KASIR
|--------------------------------------------------------------------------
*/
Route::middleware(['kasir'])->group(function () {
    Route::get('/kasir/dashboard', function () {
        return view('kasir.dashboard');
    })->name('kasir.dashboard');

    Route::get('/kasir/create', [RentalItemController::class, 'store'])->name('kasir.create');
    Route::post('/kasir', [RentalItemController::class, 'store'])->name('kasir.store');
    Route::get('/kasir', [RentalItemController::class, 'index'])->name('kasir.index');
    Route::get('transaksi', function () {
        return view('kasir.create');
    })->name('kasir.transaksi');
});
