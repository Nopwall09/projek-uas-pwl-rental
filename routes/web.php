<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RentalItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MobilController;

/* ini cuman buat tes tar ganti aja*/


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
    Route::get('/', function () {
        return view('home');
    })->name('home');

    // PROFILE USER
    Route::get('/profile', [UserController::class, 'profile'])
        ->name('profile');

    Route::get('/profile/edit', [UserController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profile', [UserController::class, 'updateProfile'])
        ->name('profile.update');

    // LOGOUT
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');


    Route::get('/katalog', function () {
        return view('Katalog.index');
    })->name('katalog');
    Route::get('/pemesanan', function () {
        return view('Pemesanan.index');
    })->name('pemesanan');
    Route::get('/Konfirmasi', function () {
        return view('Pemesanan.konfirPesan');
    })->name('Konfirmasi');
    
    Route::get('/pesanan-saya', function () {
        return view('profil.pesanan-saya');
    })->name('pesanan-saya');
});

/*
|--------------------------------------------------------------------------
| KASIR
|--------------------------------------------------------------------------
*/
Route::middleware(['kasir'])->group(function () {
    Route::get('/kasir/dashboard', [RentalItemController::class, 'dashboard'])
        ->name('kasir.dashboard')
        ->middleware('kasir');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    //Buat CREATE
    Route::get('/kasir/create', [RentalItemController::class, 'create'])
        ->name('kasir.create');

    // SIMPAN TRANSAKSI
    Route::post('/kasir', [RentalItemController::class, 'store'])
        ->name('kasir.store');

    // LIST TRANSAKSI
    Route::get('/kasir', [RentalItemController::class, 'index'])
        ->name('kasir.index');

    //Buat UPDATE
    Route::get('/kasir/update', [RentalItemController::class, 'update'])
        ->name('kasir.update');

    //Buat DELETE
    Route::delete('/kasir/{id}', [RentalItemController::class, 'destroy'])
    ->name('kasir.destroy');

    Route::get('/laporan', [RentalItemController::class, 'laporan'])
    ->name('laporan.index');

    Route::get('/mobil', [MobilController::class, 'tampilMobil'])
    ->name('kasir.mobil');

    Route::get('/transaksi', [RentalItemController::class, 'tampilTransaksi'])
    ->name('transaksi.index');
});