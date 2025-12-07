<?php

namespace App\Http\Controllers;

use App\Models\Tipe;
use Illuminate\Http\Request;

class TipeController extends Controller
{
    public function index()
    {
        $tipes = Tipe::all();
        return response()->json($tipes);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipe_nama' => 'required|string|max:30',
        ]);

        $tipe = Tipe::create($validated);

        return response()->json(['message' => 'Tipe berhasil ditambahkan', 'data' => $tipe], 201);
    }

    public function show($id)
    {
        $tipe = Tipe::findOrFail($id);
        return response()->json($tipe);
    }

    public function update(Request $request, $id)
    {
        $tipe = Tipe::findOrFail($id);

        $validated = $request->validate([
            'tipe_nama' => 'required|string|max:30',
        ]);

        $tipe->update($validated);

        return response()->json(['message' => 'Tipe berhasil diupdate', 'data' => $tipe]);
    }

    public function destroy($id)
    {
        $tipe = Tipe::findOrFail($id);
        $tipe->delete();

        return response()->json(['message' => 'Tipe berhasil dihapus']);
    }
}