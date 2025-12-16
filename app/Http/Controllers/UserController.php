<?php

// app/Http/Controllers/UserController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('rules')->paginate(10);
        return response()->json($users);
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'role' => 'required|in:admin,user,kasir',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8',
            'email' => 'required|email|unique:users,email',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);

        return response()->json(['message' => 'User berhasil dibuat', 'data' => $user], 201);
    }

    public function show($id)
    {
        $user = User::with('rentalItems')->findOrFail($id);
        return response()->json($user);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($user->user_id, 'user_id'),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->user_id, 'user_id'),
            ],

            // password opsional
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Jika password diisi → hash
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()
            ->route('profile')
            ->with('success', 'Profil berhasil diperbarui');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User berhasil dihapus']);
    }
    public function profile()
    {
        return view('profile.index', [
            'user' => Auth::user()
        ]);
    }
    public function edit()
    {
        return view('profile.edit', [
            'user' => Auth::user()
        ]);
    }
}
