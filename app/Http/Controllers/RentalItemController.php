<?php

namespace App\Http\Controllers;

use App\Models\RentalItem;
use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RentalItemController extends Controller
{
    public function dashboard()
    {
        return view('kasir.dashboard', [

            'mobilTersedia' => Mobil::whereHas('status', function ($q) {
                $q->where('nama_status', 'Tersedia');
            })->count(),

            'mobilDisewa' => Mobil::whereHas('status', function ($q) {
                $q->where('nama_status', 'Disewa');
            })->count(),

            'transaksiHariIni' => RentalItem::whereDate('created_at', today())->count(),

            'pendapatanHariIni' => RentalItem::whereDate('created_at', today())
                ->sum('total_sewa'),

            'sewaAktif' => RentalItem::with('mobil')
                ->orderBy('tgl', 'desc')
                ->limit(10)
                ->get(),
        ]);
    }
    public function index()
    {
        $rentals = RentalItem::with(['user', 'mobil', 'driver'])->paginate(10);
        return response()->json($rentals);
    }

    /**
     * STORE RENTAL (ONLINE & OFFLINE)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,user_id',
            'nama_pelanggan' => 'nullable|string|max:100',
            'mobil_id' => 'required|exists:mobil,mobil_id',
            'driver_id' => 'nullable|exists:driver,driver_id',
            'lama_rental' => 'required|string|max:25',
            'pilihan' => 'required|string|max:30',
            'tgl' => 'required|date',
            'total_sewa' => 'required|numeric|min:0',
            'booking_source' => 'required|in:online,offline',
            'jaminan' => 'required|string|max:30',
        ]);

        DB::transaction(function () use ($validated) {

            $mobil = Mobil::findOrFail($validated['mobil_id']);

            if ($mobil->status === 'Disewa') {
                abort(400, 'Mobil sudah disewa');
            }

            // simpan rental
            RentalItem::create($validated);

            // update status mobil
            $mobil->update([
                'status' => 'Disewa'
            ]);
        });

        return response()->json([
            'message' => 'Rental berhasil dibuat & mobil diset Disewa'
        ], 201);
    }

    public function show($id)
    {
        $rental = RentalItem::with([
            'user',
            'mobil',
            'driver',
            'transaksi',
            'feedback'
        ])->findOrFail($id);

        return response()->json($rental);
    }

    public function update(Request $request, $id)
    {
        $rental = RentalItem::findOrFail($id);

        $validated = $request->validate([
            'lama_rental' => 'sometimes|required|string|max:25',
            'pilihan' => 'sometimes|required|string|max:30',
            'tgl' => 'sometimes|required|date',
            'total_sewa' => 'sometimes|required|numeric|min:0',
            'jaminan' => 'sometimes|required|string|max:30',
        ]);

        $rental->update($validated);

        return response()->json([
            'message' => 'Rental berhasil diupdate',
            'data' => $rental
        ]);
    }

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