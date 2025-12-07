<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function index()
    {
        $seats = Seat::all();
        return response()->json($seats);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'seat_jumlah' => 'required|string|max:10',
        ]);

        $seat = Seat::create($validated);

        return response()->json(['message' => 'Seat berhasil ditambahkan', 'data' => $seat], 201);
    }

    public function show($id)
    {
        $seat = Seat::with('mobil')->findOrFail($id);
        return response()->json($seat);
    }

    public function update(Request $request, $id)
    {
        $seat = Seat::findOrFail($id);

        $validated = $request->validate([
            'seat_jumlah' => 'required|string|max:10',
        ]);

        $seat->update($validated);

        return response()->json(['message' => 'Seat berhasil diupdate', 'data' => $seat]);
    }

    public function destroy($id)
    {
        $seat = Seat::findOrFail($id);
        $seat->delete();

        return response()->json(['message' => 'Seat berhasil dihapus']);
    }
}