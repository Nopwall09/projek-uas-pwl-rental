<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Tampilkan halaman pembayaran untuk transaksi tertentu
     */
    public function index($rental_id)
    {
        // Ambil data rental
        $rental = RentalItem::with('mobil')->findOrFail($rental_id);

        // Contoh data rekening dan kode pembayaran
        $rekening = '1234567890 (BCA - Naivara Trans Group)';
        $kodePembayaran = 'NTG' . str_pad($rental->id, 4, '0', STR_PAD_LEFT); // misal NTG0001

        return view('pembayaran.index', compact('rental', 'rekening', 'kodePembayaran'));
    }

    /**
     * Konfirmasi pembayaran (update status, dll)
     */
    public function konfirmasi(Request $request, $rental_id)
    {
        $rental = RentalItem::findOrFail($rental_id);

        // Misal langsung update status bayar
        $rental->update([
            'status_pembayaran' => 'Lunas'
        ]);

        return redirect()->route('home')->with('success', 'Pembayaran berhasil dikonfirmasi!');
    }
}
