<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use App\Models\Mobil;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RentalItemController extends Controller
{
    /* =====================================================
     | DASHBOARD KASIR
     ===================================================== */
    public function dashboard()
    {
        // Mobil tersedia & disewa (ENUM COLUMN, BUKAN RELATION)
        $mobilTersedia = Mobil::where('mobil_status', 'Tersedia')->count();
        $mobilDisewa   = Mobil::where('mobil_status', 'Disewa')->count();

        // Transaksi hari ini
        $transaksiHariIni = RentalItem::whereDate('tgl', Carbon::today())->count();

        // Pendapatan hari ini
        $pendapatanHariIni = RentalItem::whereDate('tgl', Carbon::today())
            ->sum('total_sewa');

        // Sewa aktif (mobil masih disewa)
        $sewaAktif = RentalItem::with(['mobil', 'user'])
            ->whereHas('mobil', function ($q) {
                $q->where('mobil_status', 'Disewa');
            })
            ->orderBy('tgl', 'desc')
            ->limit(5)
            ->get();

        return view('kasir.dashboard', compact(
            'mobilTersedia',
            'mobilDisewa',
            'transaksiHariIni',
            'pendapatanHariIni',
            'sewaAktif'
        ));
    }

    /* =====================================================
     | SELESAIKAN SEWA
     ===================================================== */
    public function destroy($id)
    {
        $rental = RentalItem::with('mobil')->findOrFail($id);

        // Kembalikan status mobil
        if ($rental->mobil) {
            $rental->mobil->update([
                'mobil_status' => 'Tersedia'
            ]);
        }

        $rental->delete();

        return redirect()
            ->route('kasir.dashboard')
            ->with('success', 'Sewa berhasil diselesaikan');
    }

    /* =====================================================
     | EDIT / PERPANJANG
     ===================================================== */
    public function edit($id)
    {
        $rental = RentalItem::with('mobil', 'user')->findOrFail($id);
        return view('kasir.update', compact('rental'));
    }

    public function update(Request $request, $id)
    {
        $rental = RentalItem::findOrFail($id);

        $validated = $request->validate([
            'lama_rental' => 'required|string|max:25',
            'tgl'         => 'required|date',
            'total_sewa'  => 'required|numeric|min:0',
        ]);

        $rental->update($validated);

        return redirect()
            ->route('kasir.dashboard')
            ->with('success', 'Sewa berhasil diperpanjang');
    }
}
