<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with(['methodPembayaran', 'rentalItem'])->paginate(10);
        return response()->json($transaksis);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'method_id' => 'required|exists:method_pembayaran,method_id',
            'rental_id' => 'required|exists:rental_item,rental_id',
            'tanggal_transaksi' => 'required|date',
            'status' => 'required|in:berhasi,pending,gagal',
            'total_bayar' => 'required|integer|min:0',
        ]);

        $transaksi = Transaksi::create($validated);

        return response()->json(['message' => 'Transaksi berhasil dibuat', 'data' => $transaksi], 201);
    }

    public function show($id)
    {
        $transaksi = Transaksi::with(['methodPembayaran', 'rentalItem'])->findOrFail($id);
        return response()->json($transaksi);
    }

    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        $validated = $request->validate([
            'method_id' => 'sometimes|required|exists:method_pembayaran,method_id',
            'rental_id' => 'sometimes|required|exists:rental_item,rental_id',
            'tanggal_transaksi' => 'sometimes|required|date',
            'status' => 'sometimes|required|in:berhasi,pending,gagal',
            'total_bayar' => 'sometimes|required|integer|min:0',
        ]);

        $transaksi->update($validated);

        return response()->json(['message' => 'Transaksi berhasil diupdate', 'data' => $transaksi]);
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return response()->json(['message' => 'Transaksi berhasil dihapus']);
    }
}
