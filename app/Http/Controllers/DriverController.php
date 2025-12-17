<?php
namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::paginate(10);
        return view('kasir.driver', compact('drivers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'driver_nama' => 'required|string|max:50',
            'driver_no_sim' => 'required|string|max:20|unique:driver,driver_no_sim',
            'driver_no_telp' => 'required|string|max:15',
        ]);

        $driver = Driver::create($validated);

        return response()->json(['message' => 'Driver berhasil ditambahkan', 'data' => $driver], 201);
    }

    public function show($id)
    {
        $driver = Driver::findOrFail($id);
        return response()->json($driver);
    }

    public function update(Request $request, $id)
    {
        $driver = Driver::findOrFail($id);

        $validated = $request->validate([
            'driver_nama' => 'sometimes|required|string|max:50',
            'driver_no_sim' => 'sometimes|required|string|max:20|unique:driver,driver_no_sim,' . $id . ',driver_id',
            'driver_no_telp' => 'sometimes|required|string|max:15',
        ]);

        $driver->update($validated);

        return response()->json(['message' => 'Driver berhasil diupdate', 'data' => $driver]);
    }

    public function destroy($id)
    {
        $driver = Driver::findOrFail($id);
        $driver->delete();

        return response()->json(['message' => 'Driver berhasil dihapus']);
    }
}

