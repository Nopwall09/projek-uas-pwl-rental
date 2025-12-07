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
            'rules' => 'required|string',
        ]);

        $rule = Rules::create($validated);

        return response()->json(['message' => 'Rule berhasil ditambahkan', 'data' => $rule], 201);
    }

    public function show($id)
    {
        $rule = Rules::with('users')->findOrFail($id);
        return response()->json($rule);
    }

    public function update(Request $request, $id)
    {
        $rule = Rules::findOrFail($id);

        $validated = $request->validate([
            'rules' => 'required|string',
        ]);

        $rule->update($validated);

        return response()->json(['message' => 'Rule berhasil diupdate', 'data' => $rule]);
    }

    public function destroy($id)
    {
        $rule = Rules::findOrFail($id);
        $rule->delete();

        return response()->json(['message' => 'Rule berhasil dihapus']);
    }

    // Assign rule to user
    public function assignToUser(Request $request, $id)
    {
        $rule = Rules::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
        ]);

        $rule->users()->attach($validated['user_id']);

        return response()->json(['message' => 'Rule berhasil di-assign ke user']);
    }

    // Remove rule from user
    public function removeFromUser(Request $request, $id)
    {
        $rule = Rules::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
        ]);

        $rule->users()->detach($validated['user_id']);

        return response()->json(['message' => 'Rule berhasil dihapus dari user']);
    }
}