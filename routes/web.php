<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RentalItemController;
use App\Http\Controllers\AuthController;

/* ini cuman buat tes tar ganti aja*/
Route::get('/home', function () {
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
    // DASHBOARD
    Route::get('/kasir/dashboard', [RentalItemController::class, 'dashboard'])
        ->name('kasir.dashboard');

    // FORM CREATE (ONLINE & OFFLINE)
    Route::get('/kasir/create', [RentalItemController::class, 'create'])
        ->name('kasir.create');

    // SIMPAN TRANSAKSI
    Route::post('/kasir', [RentalItemController::class, 'store'])
        ->name('kasir.store');

    // LIST TRANSAKSI
    Route::get('/kasir', [RentalItemController::class, 'index'])
        ->name('kasir.index');

    // FORM EDIT
    Route::get('/kasir/{id}/edit', [RentalItemController::class, 'edit'])
        ->name('kasir.edit');

    // UPDATE DATA
    Route::put('/kasir/{id}', [RentalItemController::class, 'update'])
        ->name('kasir.update');

    // DELETE (ONLINE & OFFLINE)
    Route::delete('/kasir/{id}', [RentalItemController::class, 'destroy'])
        ->name('kasir.destroy');
});
