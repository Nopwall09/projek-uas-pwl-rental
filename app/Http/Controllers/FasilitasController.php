<?php
namespace App\Http\Controllers;

use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::all();
        return response()->json($fasilitas);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fasilitas' => 'required|string|max:25',
        ]);

        $fasilitas = Fasilitas::create($validated);

        return response()->json(['message' => 'Fasilitas berhasil ditambahkan', 'data' => $fasilitas], 201);
    }

    public function show($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        return response()->json($fasilitas);
    }

    public function update(Request $request, $id)
    {
        $fasilitas = Fasilitas::findOrFail($id);

        $validated = $request->validate([
            'fasilitas' => 'required|string|max:25',
        ]);

        $fasilitas->update($validated);

        return response()->json(['message' => 'Fasilitas berhasil diupdate', 'data' => $fasilitas]);
    }

    public function destroy($id)
    {
        $fasilitas = Fasilitas::findOrFail($id);
        $fasilitas->delete();

        return response()->json(['message' => 'Fasilitas berhasil dihapus']);
    }
}