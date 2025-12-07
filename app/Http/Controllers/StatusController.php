<?php
namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        $statuses = Status::all();
        return response()->json($statuses);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|string|max:20',
        ]);

        $status = Status::create($validated);

        return response()->json(['message' => 'Status berhasil ditambahkan', 'data' => $status], 201);
    }

    public function show($id)
    {
        $status = Status::findOrFail($id);
        return response()->json($status);
    }

    public function update(Request $request, $id)
    {
        $status = Status::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|string|max:20',
        ]);

        $status->update($validated);

        return response()->json(['message' => 'Status berhasil diupdate', 'data' => $status]);
    }

    public function destroy($id)
    {
        $status = Status::findOrFail($id);
        $status->delete();

        return response()->json(['message' => 'Status berhasil dihapus']);
    }
}
