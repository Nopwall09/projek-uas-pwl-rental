<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RentalItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ChatController;

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
Route::get('/',[MobilController::class, 'home'])->name('home');
/*
|--------------------------------------------------------------------------
| USER
|--------------------------------------------------------------------------
*/
// });
Route::middleware(['user'])->group(function () {
    Route::get('/chat/messages', [ChatController::class, 'getMessages']);
    Route::post('/send-message', [ChatController::class, 'sendMessage']);
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::get('/katalog', [MobilController::class, 'katalog'])->name('katalog');

    Route::get('/pesanan-saya', [RentalItemController::class, 'pesananSaya'])->name('pesanan-saya');
    // Route::post('/pesanan/store', [RentalItemController::class, 'store'])->name('pesanan.store');

    Route::get('/mobil/{mobil}', [MobilController::class, 'detail'])->name('pesanan.detail');
    // Route::get('/pesanan-saya',function(){
    //     return view('Pemesanan.pesanan-saya')->name('pesanan.saya');
    // });
    Route::get('/pemesanan', function () {
        return view('Pemesanan.index');
    })->name('pemesanan.konfirmasi');

    Route::post('/pemesanan/konfirmasi', [MobilController::class, 'konfirmasi'])->name('pemesanan.konfirmasi');

    Route::get('/pembayaran/{rental}', [PembayaranController::class, 'index'])->name('pembayaran.index');
    Route::post('/pembayaran/{rental}/konfirmasi', [PembayaranController::class, 'konfirmasi'])->name('pembayaran.konfirmasi');
    Route::post('/pemesanan', [MobilController::class, 'konfirmasi'])
    ->name('pemesanan.konfirmasi');
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

    // CREATE TRANSAKSI
    Route::get('/kasir/create', [RentalItemController::class, 'create'])
        ->name('kasir.create');

    // SIMPAN TRANSAKSI OFFLINE
    Route::post('/kasir/store', [RentalItemController::class, 'storeoffline'])
        ->name('kasir.store');

    // DATA TRANSAKSI
    Route::get('/kasir/transaksi', [RentalItemController::class, 'index'])
        ->name('kasir.transaksi');

    // EDIT / PERPANJANG
    Route::get('/kasir/{id}/edit', [RentalItemController::class, 'edit'])
        ->name('kasir.edit');
    Route::get('/kasir/{id}/struk', [RentalItemController::class, 'struk'])
    ->name('kasir.struk');
    Route::get('/kasir/mobil', [MobilController::class, 'tampilMobil'])
        ->name('kasir.mobil');
    Route::put('/kasir/{id}', [RentalItemController::class, 'update'])
        ->name('kasir.update');

    // SELESAIKAN SEWA
    Route::delete('/kasir/{id}', [RentalItemController::class, 'destroy'])
        ->name('kasir.destroy');

    // LAPORAN
    Route::get('/kasir/laporan', [RentalItemController::class, 'laporan'])
        ->name('kasir.laporan');
});


Route::middleware(['admin'])->group(function () {
    Route::get('/admin/chat', [ChatController::class, 'adminChatList']);
    Route::get('/admin/chat/{user_id}', [ChatController::class, 'adminChatUser']);
    Route::post('/admin/chat/{user_id}/send', [ChatController::class, 'adminSend']);
});