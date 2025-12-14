<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RentalItemController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\FeedbackController;

use App\Http\Controllers\MobilController;


/* ini cuman buat tes tar ganti aja*/

use App\Http\Controllers\ChatController;

/* ini cuman buat tes tar ganti aja*/
// Route::get('/home', function () {
//     return view('home');
// });


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
    Route::get('/home', [MobilController::class, 'home'])->name('home');
    Route::get('profile', [UserController::class, 'show'])->name('open.profile');
    Route::get('edit', [UserController::class, 'update'])->name('update.profile');
    Route::get('edit', [AuthController::class, 'logout'])->name('logout');
    Route::post('/send-message', [ChatController::class, 'sendMessage'])->middleware('auth');


    Route::get('/katalog', function () {
        return view('Katalog.index');
    })->name('katalog');
    Route::get('/katalog', [MobilController::class, 'katalog'])->name('katalog');

});

Route::middleware(['user'])->group(function () {
    Route::get('/pemesanan', function () {
        return view('Pemesanan.index');
    })->name('pemesanan');
    Route::get('/Konfirmasi', function () {
        return view('Pemesanan.konfirPesan');
    })->name('Konfirmasi');

    Route::get('/pesanan-saya', [RentalItemController::class, 'pesananSaya'])
    ->middleware('auth');

    Route::prefix('feedback')->group(function () {
        Route::post('/', [FeedbackController::class, 'store'])->name('feedback.store');
        Route::get('/', [FeedbackController::class, 'index'])->name('feedback.index');
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
        ->name('kasir.dashboard')
        ->middleware('kasir');

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

    Route::get('/kasir/create', [RentalItemController::class, 'store'])->name('kasir.create');
    Route::post('/kasir', [RentalItemController::class, 'store'])->name('kasir.store');
    Route::get('/kasir', [RentalItemController::class, 'index'])->name('kasir.index');
    Route::get('transaksi', function () {
        return view('kasir.create');
    })->name('kasir.transaksi');
});

// Route::middleware(['admin'])->group(function () {
//     Route::get('/admin/chat', [ChatController::class, 'adminChat']);
//     Route::post('/admin/send-message', [ChatController::class, 'adminSend']);
// });

// Route::middleware(['user'])->get('/chat/messages', [ChatController::class, 'getMessages']);

Route::middleware(['admin'])->group(function () {
    Route::get('/admin/chat', [ChatController::class, 'adminChatList']);
    Route::get('/admin/chat/{user_id}', [ChatController::class, 'adminChatUser']);
    Route::post('/admin/chat/{user_id}/send', [ChatController::class, 'adminSend']);
});

Route::middleware(['user'])->group(function () {
    Route::post('/send-message', [ChatController::class, 'sendMessage']);
    Route::get('/chat/messages', [ChatController::class, 'getMessages']);
});
