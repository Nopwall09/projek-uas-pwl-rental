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
<<<<<<< HEAD
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
=======
{
    return view('kasir.dashboard', [
        'mobilTersedia' => Mobil::where('status', 'Tersedia')->count(),
        'mobilDisewa' => Mobil::where('status', 'Disewa')->count(),

        'transaksiHariIni' => RentalItem::whereDate('created_at', today())->count(),

        'pendapatanHariIni' => RentalItem::whereDate('created_at', today())
            ->sum('total_sewa'),

        'sewaAktif' => RentalItem::with('mobil')
            ->where('status', 'aktif')
            ->orderBy('tgl', 'desc')
            ->limit(10)
            ->get()
    ]);
}
    public function index()
    {
        $rentals = RentalItem::with(['user', 'mobil', 'driver'])->paginate(10);
        return response()->json($rentals);
>>>>>>> bf34e9f2971cfe1f9454f1e0ba70a2465a966584
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
<<<<<<< HEAD
}
=======

    public function destroy($id)
{
    DB::transaction(function () use ($id) {

        $rental = RentalItem::findOrFail($id);

        // ambil mobil
        $mobil = Mobil::find($rental->mobil_id);

        // hapus transaksi
        $rental->delete();

        // balikin status mobil
        if ($mobil) {
            $mobil->update([
                'status' => 'Tersedia'
            ]);
        }
    });

    return redirect()->route('kasir.index')
        ->with('success', 'Transaksi dihapus, mobil kembali tersedia');
}

    public function create()
    {
        $mobils = Mobil::orderBy('mobil_id')->get();

        return view('kasir.create', compact('mobils'));
    }
}
>>>>>>> bf34e9f2971cfe1f9454f1e0ba70a2465a966584
