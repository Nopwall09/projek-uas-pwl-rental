<?php
namespace App\Http\Controllers;

use App\Models\CarClass;
use Illuminate\Http\Request;

class CarClassController extends Controller
{
    public function index()
    {
        $classes = CarClass::all();
        return response()->json($classes);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_nama' => 'required|string|max:30',
        ]);

        $class = CarClass::create($validated);

        return response()->json(['message' => 'Class berhasil ditambahkan', 'data' => $class], 201);
    }

    public function show($id)
    {
        $class = CarClass::findOrFail($id);
        return response()->json($class);
    }

    public function update(Request $request, $id)
    {
        $class = CarClass::findOrFail($id);

        $validated = $request->validate([
            'class_nama' => 'required|string|max:30',
        ]);

        $class->update($validated);

        return response()->json(['message' => 'Class berhasil diupdate', 'data' => $class]);
    }

    public function destroy($id)
    {
        $class = CarClass::findOrFail($id);
        $class->delete();

        return response()->json(['message' => 'Class berhasil dihapus']);
    }
}

