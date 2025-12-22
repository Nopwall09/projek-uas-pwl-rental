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
use App\Models\HistoryRental;


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
            'status'         => 'aktif',
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
            'mobil_id'          => 'required|exists:mobil,mobil_id',
            'tgl_sewa'          => 'required|date',
            'tgl_kembali'       => 'required|date|after:tgl_sewa',
            'lama_rental'       => 'required|integer|min:1',
            'jaminan'           => 'required|string|max:50',
            'metode_pembayaran' => 'required|in:Tunai,Transfer',
            'driver_option'     => 'required|in:with,without',
            'driver_id'         => 'nullable|exists:driver,driver_id',
        ]);

        $mobil = Mobil::findOrFail($validated['mobil_id']);

        $lamaRental = max(
            Carbon::parse($validated['tgl_sewa'])
                ->diffInDays(Carbon::parse($validated['tgl_kembali'])),
            1
        );

        $total = $mobil->harga_rental * $lamaRental;

        $driverId = null;

        if ($validated['driver_option'] === 'with') {
            if (!$validated['driver_id']) {
                return back()->withErrors(['driver_id' => 'Driver wajib dipilih']);
            }

            $driver = Driver::findOrFail($validated['driver_id']);
            $driverId = $driver->driver_id;
            $total += $driver->biaya_driver;
            $driver->update(['status' => 'Booked']);
        }

        $status = $validated['metode_pembayaran'] === 'Transfer'
            ? 'pending'
            : 'aktif';

        $rental = RentalItem::create([
            'user_id'        => Auth::id(),
            'mobil_id'       => $mobil->mobil_id,
            'driver_id'      => $driverId,
            'lama_rental'    => $lamaRental,
            'tgl_sewa'       => $validated['tgl_sewa'],
            'tgl_kembali'    => $validated['tgl_kembali'],
            'total_sewa'     => $total,
            'jaminan'        => $validated['jaminan'],
            'pilihan'        => $validated['driver_option'] === 'with'
                                ? 'dengan driver'
                                : 'lepas kunci',
            'booking_source' => 'online',
            'status'         => $status,
        ]);

        $mobil->update(['mobil_status' => 'Disewa']);

        return $validated['metode_pembayaran'] === 'Transfer'
            ? redirect()->route('pesanan.qr', $rental->rental_id)
            : redirect()->route('pesanan.invoice', $rental->rental_id);
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
        $sewaAktif = RentalItem::with(['mobil', 'user'])
            ->whereIn('status', ['aktif', 'pending'])
            ->whereDate('tgl_kembali', '>=', today())
            ->get();



        return view('kasir.dashboard', compact(
            'mobilTersedia',
            'mobilDisewa',
            'transaksiHariIni',
            'pendapatanHariIni',
            'sewaAktif'
        ));
    }

     public function storeRating(Request $request, $mobilId)
    {
        $request->validate([
            'rating'   => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:255',
        ]);

        $mobil = Mobil::findOrFail($mobilId);

        // Simpan feedback sebagai JSON
        $mobil->feedback = json_encode([
            'rating'   => $request->rating,
            'komentar' => $request->komentar,
            'user_id'  => Auth::id(),
        ]);

        $mobil->save();

        return back()->with('success', 'Rating berhasil dikirim 👍');
    }
    /* =====================================================
     | SELESAIKAN SEWA
     ===================================================== */
    public function destroy($id)
    {
        $rental = RentalItem::with('mobil')->findOrFail($id);

        // 1️⃣ Update status rental
        $rental->update([
            'status' => 'selesai',
            'selesai_at' => now(),
        ]);

        // 2️⃣ Kembalikan mobil
        if ($rental->mobil) {
            $rental->mobil->update([
                'mobil_status' => 'Tersedia'
            ]);
        }

        // 3️⃣ SIMPAN KE HISTORY
        HistoryRental::create([
            'history_id' => 'HIS' . str_pad(
                HistoryRental::count() + 1, 5, '0', STR_PAD_LEFT
            ),
            'user_id'   => Auth::id() ?? 1, // kasir / admin
            'rental_id' => $rental->rental_id,
            'aksi'      => 'Menyelesaikan sewa',
            'waktu'     => now(),
        ]);

        return redirect()
            ->route('kasir.dashboard')
            ->with('success', 'Sewa berhasil diselesaikan & dicatat ke history');
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
            'mobil_id'     => 'required|exists:mobil,mobil_id',
            'lama_rental'  => 'required|integer|min:1',
            'pilihan'      => 'required|in:lepas kunci,dengan driver',
            'tgl_kembali'  => 'required|date|after_or_equal:tgl_sewa',
            'total_sewa'   => 'required|numeric|min:0',
            'jaminan'      => 'required|string|max:50',
            'nama_Pelanggan' => 'nullable|string|max:100',
        ]);

        $rental->update($validated);

        return redirect()
            ->route('kasir.dashboard')
            ->with('success', 'Sewa berhasil diperpanjang');
    }

    // public function detail(Mobil $mobil)
    // {
    //     return view('mobil.detail', compact('mobil'));
    // }

    public function pesananSaya()
    {
        $pesanan = RentalItem::with(['mobil.merk', 'driver'])
            ->where('user_id', Auth::id())
            ->orderBy('tgl_sewa', 'desc')
            ->get();

        return view('profile.pesanan-saya', compact('pesanan'));
    }

    

    public function konfirmasiPembayaran($id)
    {
        $rental = RentalItem::findOrFail($id);

        if ($rental->status !== 'pending') {
            return back()->with('error', 'Status sudah dikonfirmasi');
        }

        $rental->update([
            'status' => 'aktif'
        ]);

        return back()->with('success', 'Pembayaran berhasil dikonfirmasi');
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

    // pesanan online
    public function createOnline(Mobil $mobil)
    {
        $drivers = Driver::where('status', 'tersedia')->get();

        return view('pesanan.konfirmasi', compact('mobil', 'drivers'));
    }
    public function invoice($id)
    {
        $rental = RentalItem::with([
                'mobil.merk',
                'driver',
                'user'
            ])->findOrFail($id);


        return view('pesanan.invoice', compact('rental'));
    }
    public function qr($id)
    {
        $rental = RentalItem::with('mobil.merk')
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        return view('pesanan.qr', compact('rental'));
    }

}
