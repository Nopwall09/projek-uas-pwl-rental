<?php

namespace App\Http\Controllers;

use App\Models\HistoryRental;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HistoryRentalController extends Controller
{
    public function index()
    {
        $history = HistoryRental::with(['user', 'rentalitem'])->paginate(10);



        return view('kasir.history', compact('history'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'rental_id' => 'required|exists:rental_item,rental_id',
            'aksi' => 'required|string|max:150',
            'status_book' => 'required|in:pending,confirmed,canceled,completed',
            'waktu' => 'required|date',
        ]);

        $validated['history_id'] = Str::random(8);
        $history = HistoryRental::create($validated);

        return response()->json(['message' => 'History rental berhasil dibuat', 'data' => $history], 201);
    }

    public function show($id)
    {
        $history = HistoryRental::with(['user', 'rentalItem'])->findOrFail($id);
        return response()->json($history);
    }

    public function update(Request $request, $id)
    {
        $history = HistoryRental::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'sometimes|required|exists:users,user_id',
            'rental_id' => 'sometimes|required|exists:rental_item,rental_id',
            'aksi' => 'sometimes|required|string|max:150',
            'status_book' => 'sometimes|required|in:pending,confirmed,canceled,completed',
            'waktu' => 'sometimes|required|date',
        ]);

        $history->update($validated);

        return response()->json(['message' => 'History rental berhasil diupdate', 'data' => $history]);
    }

    public function destroy($id)
    {
        $history = HistoryRental::findOrFail($id);
        $history->delete();

        return response()->json(['message' => 'History rental berhasil dihapus']);
    }
}
