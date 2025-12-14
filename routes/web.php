<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

/* ini cuman buat tes tar ganti aja*/
Route::get('/', function () {
    return view('home');
});

// Route::get('katalog', function () {
//     return view('katalog/index');
// });

// Route::get('pemesanan', function () {
//     return view('pemesanan/index');
// });

// Route::get('mypesan', function () {
//     return view('profil/pesanan-saya');
// });

// Route::get('Konfirmasi', function () {
//     return view('pemesanan/konfirPesan');
// });

// Route::get('Konfirmasi-pembayaran', function () {
//     return view('pemesanan/konfirPesan');
// });

// Route::get('/profil', function () {
//     return view('profil/index');
// });


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
});
