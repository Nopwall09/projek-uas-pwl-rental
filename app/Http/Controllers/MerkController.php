<?php
namespace App\Http\Controllers;

use App\Models\Merk;
use Illuminate\Http\Request;

class MerkController extends Controller
{
    public function index()
    {
        $merks = Merk::all();
        return response()->json($merks);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'merk_nama' => 'required|string|max:30',
        ]);

        $merk = Merk::create($validated);

        return response()->json(['message' => 'Merk berhasil ditambahkan', 'data' => $merk], 201);
    }

    public function show($id)
    {
        $merk = Merk::findOrFail($id);
        return response()->json($merk);
    }

    public function update(Request $request, $id)
    {
        $merk = Merk::findOrFail($id);

        $validated = $request->validate([
            'merk_nama' => 'required|string|max:30',
        ]);

        $merk->update($validated);

        return response()->json(['message' => 'Merk berhasil diupdate', 'data' => $merk]);
    }

    public function destroy($id)
    {
        $merk = Merk::findOrFail($id);
        $merk->delete();

        return response()->json(['message' => 'Merk berhasil dihapus']);
    }
}
