<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use App\Models\Mobil;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Driver;

class RentalItemController extends Controller
{
    public function index()
    {
        $transaksi = RentalItem::with(['mobil.merk', 'driver'])
            ->orderBy('tgl_sewa', 'desc')
            ->paginate(10);

        return view('kasir.transaksi', compact('transaksi'));
    }

    public function storeoffline(Request $request)
    {
        $validated = $request->validate([
            'nama_Pelanggan' => 'required|string|max:100',
            'mobil_id'       => 'required|exists:mobil,mobil_id',
            'tgl_sewa'       => 'required|date',
            'tgl_kembali'    => 'required|date|after:tgl_sewa',
            'jaminan'        => 'required|string|max:30',
            'driver_option'  => 'required|in:with,without',
            'driver_id'      => 'nullable|exists:driver,driver_id',
        ]);

        // ambil mobil
        $mobil = Mobil::findOrFail($validated['mobil_id']);

        // hitung lama rental (hari)
        $lamaRental = Carbon::parse($validated['tgl_sewa'])
            ->diffInDays(Carbon::parse($validated['tgl_kembali']));

        if ($lamaRental < 1) {
            $lamaRental = 1;
        }

        // hitung total
        $total = $mobil->harga_rental * $lamaRental;

        $driverId = null;

        if ($validated['driver_option'] === 'with') {
            $driver = Driver::findOrFail($validated['driver_id']);
            $driverId = $driver->driver_id;

            $total += $driver->biaya_driver;

            $driver->update(['status' => 'Booked']);
        }

        RentalItem::create([
            'nama_Pelanggan' => $validated['nama_Pelanggan'],
            'mobil_id'       => $mobil->mobil_id,
            'driver_id'      => $driverId,
            'lama_rental'    => $lamaRental,
            'pilihan'        => $validated['driver_option'] === 'with'
                                    ? 'dengan driver'
                                    : 'lepas kunci',
            'tgl_sewa'       => $validated['tgl_sewa'],
            'tgl_kembali'    => $validated['tgl_kembali'],
            'total_sewa'     => $total,
            'jaminan'        => $validated['jaminan'],
            'booking_source' => 'offline',
            'user_id'        => null,
        ]);

        // update status mobil
        $mobil->update(['mobil_status' => 'Disewa']);

        return redirect()
            ->route('kasir.dashboard')
            ->with('success', 'Transaksi kasir berhasil disimpan');
    }
    
    public function storeOnline(Request $request)
    {
        $validated = $request->validate([
            'mobil_id'      => 'required|exists:mobil,mobil_id',
            'lama_rental'   => 'required|numeric|min:1',
            'tgl'           => 'required|date',
            'total_sewa'    => 'required|numeric|min:0',
            'jaminan'       => 'required|string|max:50',
            'driver_option' => 'required|in:with,without',
            'driver_id'     => 'nullable|exists:driver,driver_id',
        ]);

        $driverId = null;

        // Jika pakai driver
        if ($request->driver_option === 'with') {
            $driverId = $request->driver_id;

            Driver::where('driver_id', $driverId)
                ->update(['status' => 'Booked']);
        }

        $rental = RentalItem::create([
            'user_id'        => Auth::id(),
            'mobil_id'       => $validated['mobil_id'],
            'driver_id'      => $driverId,
            'lama_rental'    => $validated['lama_rental'],
            'tgl'            => $validated['tgl'],
            'total_sewa'     => $validated['total_sewa'],
            'jaminan'        => $validated['jaminan'],
            'pilihan'        => $validated['driver_option'],
            'booking_source' => 'online',
            'nama_Pelanggan' => null,
        ]);

        Mobil::where('mobil_id', $validated['mobil_id'])
            ->update(['mobil_status' => 'Disewa']);

        return redirect()
            ->route('pesanan-saya')
            ->with('success', 'Booking online berhasil dibuat');
    }


    /* =====================================================
     | DASHBOARD KASIR
     ===================================================== */

    public function dashboard()
    {
        $today = Carbon::today();

        $mobilTersedia = Mobil::where('mobil_status', 'Tersedia')->count();
        $mobilDisewa   = Mobil::where('mobil_status', 'Disewa')->count();

        // 👉 SAMAKAN DENGAN BLADE
        $transaksiHariIni = RentalItem::whereDate('tgl_sewa', $today)->count();

        $pendapatanHariIni = RentalItem::whereDate('tgl_sewa', $today)
            ->sum('total_sewa');

        // Sewa aktif (belum jatuh tempo)
        $sewaAktif = RentalItem::with('mobil')
            ->whereDate('tgl_kembali', '>=', $today)
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
        $rental = RentalItem::with(['mobil', 'user'])->findOrFail($id);

        $mobils = Mobil::all(); // atau ->where('mobil_status','Tersedia')->get();

        return view('kasir.update', compact('rental', 'mobils'));
    }


    public function update(Request $request, $id)
    {
        $rental = RentalItem::findOrFail($id);

        $validated = $request->validate([
            'lama_rental' => 'required|string|max:25',
            'tgl' => 'required|date',
            'total_sewa' => 'required|numeric|min:0',
        ]);

        $rental->update($validated);

        return redirect()
            ->route('kasir.dashboard')
            ->with('success', 'Sewa berhasil diperpanjang');
    }
    public function detail(Mobil $mobil)
    {
        return view('mobil.detail', compact('mobil'));
    }

    public function pesananSaya()
    {
        $rentals = RentalItem::with([
            'mobil.merk',
            'mobil.carclass',
            'mobil.tipe',
            'feedback'
        ])
        ->where('user_id', Auth::id())
        ->orderBy('tgl_sewa', 'desc')
        ->get();

        return view('pembayaran.index');
    }
    


    public function laporan(Request $request)
    {
        $query = RentalItem::with(['mobil.merk']);

        if ($request->from && $request->to) {
            $query->whereBetween('tgl_sewa', [
                $request->from,
                $request->to
            ]);
        }

        $laporan = $query->orderBy('tgl_sewa', 'desc')->get();

        return view('kasir.laporan', compact('laporan'));
    }


    //kasir

    public function create()
    {
        $mobils = Mobil::with('merk')
            ->where('mobil_status', 'Tersedia')
            ->get();

        $drivers = Driver::where('status', 'Tersedia')->get();

        return view('kasir.create', compact('mobils', 'drivers'));
    }
    public function struk($id)
    {
        $rental = RentalItem::with(['mobil.merk', 'driver'])
            ->findOrFail($id);

        return view('kasir.struk', compact('rental'));
    }



}
