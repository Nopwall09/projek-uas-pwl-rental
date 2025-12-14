<?php
namespace App\Http\Controllers;

use App\Models\RentalItem;
use Illuminate\Http\Request;

class RentalItemController extends Controller
{
    public function index()
    {
        $rentals = RentalItem::with(['user', 'mobil', 'driver'])->paginate(10);
        return response()->json($rentals);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'mobil_id' => 'required|exists:mobil,mobil_id',
            'driver_id' => 'nullable|exists:driver,driver_id',
            'lama_rental' => 'required|string|max:25',
            'pilihan' => 'required|string|max:30',
            'tgl' => 'required|date',
            'total_sewa' => 'required|numeric|min:0',
            'booking_source' => 'required|in:online,offline',
            'jaminan' => 'required|string|max:30',
        ]);

        $rental = RentalItem::create($validated);

        return response()->json(['message' => 'Rental berhasil dibuat', 'data' => $rental], 201);
    }

    public function show($id)
    {
        $rental = RentalItem::with(['user', 'mobil', 'driver', 'transaksi', 'feedback'])->findOrFail($id);
        return response()->json($rental);
    }
    public function store_offline(Request $request)
    {
        $validated = $request->validate([
            'nama_Pelanggan' => 'required|string|max:100',
            'mobil_id' => 'required|exists:mobil,mobil_id',
            'driver_id' => 'nullable|exists:driver,driver_id',
            'lama_rental' => 'required|string|max:25',
            'pilihan' => 'required|string|max:30',
            'tgl' => 'required|date',
            'total_sewa' => 'required|numeric|min:0',
            'jaminan' => 'required|string|max:30',
        ]);

        $validated['booking_source'] = 'offline';
        $validated['user_id'] = null;

        $rental = RentalItem::create($validated);

        return response()->json([
            'message' => 'Rental offline berhasil dibuat',
            'data' => $rental
        ], 201);
    }


    public function update(Request $request, $id)
    {
        $rental = RentalItem::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'sometimes|required|exists:users,user_id',
            'mobil_id' => 'sometimes|required|exists:mobil,mobil_id',
            'driver_id' => 'nullable|exists:driver,driver_id',
            'lama_rental' => 'sometimes|required|string|max:25',
            'pilihan' => 'sometimes|required|string|max:30',
            'tgl' => 'sometimes|required|date',
            'total_sewa' => 'sometimes|required|numeric|min:0',
            'booking_source' => 'sometimes|required|in:online,offline',
            'jaminan' => 'sometimes|required|string|max:30',
        ]);

        $rental->update($validated);

        return response()->json(['message' => 'Rental berhasil diupdate', 'data' => $rental]);
    }

    public function destroy($id)
    {
        $rental = RentalItem::findOrFail($id);
        $rental->delete();

        return response()->json(['message' => 'Rental berhasil dihapus']);
    }
    public function destroy_offline($id)
    {
        $rental = RentalItem::where('booking_source', 'offline')
            ->findOrFail($id);

        $rental->delete();

        return response()->json([
            'message' => 'Rental offline berhasil dihapus'
        ]);
    }

}

