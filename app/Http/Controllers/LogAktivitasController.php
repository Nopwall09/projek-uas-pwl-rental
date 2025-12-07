<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    public function index()
    {
        $logs = LogAktivitas::with('user')->paginate(20);
        return response()->json($logs);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'aktivitas' => 'required|string',
            'waktu_aktivitas' => 'required|date',
        ]);

        $log = LogAktivitas::create($validated);

        return response()->json(['message' => 'Log aktivitas berhasil dibuat', 'data' => $log], 201);
    }

    public function show($id)
    {
        $log = LogAktivitas::with('user')->findOrFail($id);
        return response()->json($log);
    }

    public function destroy($id)
    {
        $log = LogAktivitas::findOrFail($id);
        $log->delete();

        return response()->json(['message' => 'Log aktivitas berhasil dihapus']);
    }
}
