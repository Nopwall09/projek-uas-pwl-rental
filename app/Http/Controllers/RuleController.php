<?php
namespace App\Http\Controllers;

use App\Models\Rules;
use Illuminate\Http\Request;

class RulesController extends Controller
{
    public function index()
    {
        $rules = Rules::all();
        return response()->json($rules);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'rules' => 'required|string'
        ]);

        $rule = Rules::create($validated);

        return response()->json(['message' => 'Rules berhasil ditambahkan', 'data' => $rule], 201);
    }

    public function show($id)
    {
        $rule = Rules::findOrFail($id);
        return response()->json($rule);
    }

    public function update(Request $request, $id)
    {
        $rule = Rules::findOrFail($id);

        $validated = $request->validate([
            'rules' => 'required|string'
        ]);

        $rule->update($validated);

        return response()->json(['message' => 'Rules berhasil diupdate', 'data' => $rule]);
    }

    public function destroy($id)
    {
        $rule = Rules::findOrFail($id);
        $rule->delete();

        return response()->json(['message' => 'Rules berhasil dihapus']);
    }
}
