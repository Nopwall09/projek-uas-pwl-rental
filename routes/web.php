<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\RentalItemController;
use App\Http\Controllers\UserController;



/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/register', fn () => view('auth.register'))->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
*/
Route::middleware(['user'])->group(function () {

    Route::get('/', [MobilController::class, 'home'])->name('home');


    // PROFILE
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');

    // KATALOG
    Route::get('/katalog', [MobilController::class, 'katalog'])->name('katalog');

    // PEMESANAN
    Route::get('/pemesanan', fn () => view('Pemesanan.index'))->name('pemesanan');
    Route::get('/konfirmasi', fn () => view('Pemesanan.konfirPesan'))->name('konfirmasi');

    // PESANAN SAYA
    Route::get('/pesanan-saya', [RentalItemController::class, 'pesananSaya'])
        ->name('pesanan.saya');

    // CHAT
    Route::post('/send-message', [ChatController::class, 'sendMessage']);
    Route::get('/chat/messages', [ChatController::class, 'getMessages']);

    // FEEDBACK
    Route::prefix('feedback')->group(function () {
        Route::get('/', [FeedbackController::class, 'index'])->name('feedback.index');
        Route::post('/', [FeedbackController::class, 'store'])->name('feedback.store');
        Route::get('/{id}', [FeedbackController::class, 'show'])->name('feedback.show');
        Route::put('/{id}', [FeedbackController::class, 'update'])->name('feedback.update');
        Route::delete('/{id}', [FeedbackController::class, 'destroy'])->name('feedback.destroy');
    });
});

/*
|--------------------------------------------------------------------------
| KASIR
|--------------------------------------------------------------------------
*/
Route::middleware(['kasir'])->group(function () {

    Route::get('/kasir/dashboard', [RentalItemController::class, 'dashboard'])
<<<<<<< HEAD
        ->name('kasir.dashboard')
        ->middleware('kasir');
<<<<<<< HEAD
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
=======
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
>>>>>>> 2a5f8055e5454781de82ea364bb0a1f4b0dbc920
    //Buat CREATE
    Route::get('/kasir/create', [RentalItemController::class, 'create'])
        ->name('kasir.create');
=======
        ->name('kasir.dashboard');

    Route::get('/kasir', [RentalItemController::class, 'index'])->name('kasir.index');
    Route::get('/kasir/create', [RentalItemController::class, 'create'])->name('kasir.create');
    Route::post('/kasir', [RentalItemController::class, 'store'])->name('kasir.store');
    Route::delete('/kasir/{id}', [RentalItemController::class, 'destroy'])->name('kasir.destroy');
>>>>>>> b20a5791bcf37303a79f9131d84d8d1b5154a815

    Route::get('/laporan', [RentalItemController::class, 'laporan'])->name('laporan.index');
    Route::get('/mobil', [MobilController::class, 'tampilMobil'])->name('kasir.mobil');
    Route::get('/transaksi', [RentalItemController::class, 'tampilTransaksi'])->name('transaksi.index');
});

/*
|--------------------------------------------------------------------------
| ADMIN CHAT
|--------------------------------------------------------------------------
*/
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/chat', [ChatController::class, 'adminChatList']);
    Route::get('/admin/chat/{user_id}', [ChatController::class, 'adminChatUser']);
    Route::post('/admin/chat/{user_id}/send', [ChatController::class, 'adminSend']);
});
