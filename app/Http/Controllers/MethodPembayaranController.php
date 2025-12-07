<?php

namespace App\Http\Controllers;

use App\Models\MethodPembayaran;
use Illuminate\Http\Request;

class MethodPembayaranController extends Controller
{
    public function index()
    {
        $methods = MethodPembayaran::all();
        return response()->json($methods);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'method' => 'required|string|max:30',
        ]);

        $method = MethodPembayaran::create($validated);

        return response()->json(['message' => 'Method pembayaran berhasil ditambahkan', 'data' => $method], 201);
    }

    public function show($id)
    {
        $method = MethodPembayaran::findOrFail($id);
        return response()->json($method);
    }

    public function update(Request $request, $id)
    {
        $method = MethodPembayaran::findOrFail($id);

        $validated = $request->validate([
            'method' => 'required|string|max:30',
        ]);

        $method->update($validated);

        return response()->json(['message' => 'Method pembayaran berhasil diupdate', 'data' => $method]);
    }

    public function destroy($id)
    {
        $method = MethodPembayaran::findOrFail($id);
        $method->delete();

        return response()->json(['message' => 'Method pembayaran berhasil dihapus']);
    }
}