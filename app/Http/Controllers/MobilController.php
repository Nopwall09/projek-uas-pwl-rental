<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MobilController extends Controller
{
    public function index()
    {
        $mobils = Mobil::with(['merk', 'class', 'tipe', 'fasilitas'])
            ->paginate(10);

        return response()->json($mobils);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'merk_id' => 'required|exists:merk,merk_id',
            'class_id' => 'required|exists:class,class_id',
            'tipe_id' => 'required|exists:tipe,tipe_id',
            'mobil_status' => 'required|in:Tersedia,Disewa',
            'mobil_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'Transmisi' => 'required|in:Manual,Matic',
            'mobil_warna' => 'required|string|max:50',
            'mobil_plat' => 'required|string|max:30|unique:mobil,mobil_plat',
            'mobil_tahun' => 'required|string|size:4',
            'harga_rental' => 'required|numeric|min:0',
            'fasilitas' => 'sometimes|array',
            'fasilitas.*' => 'exists:fasilitas,fasilitas_id',
        ]);

        if ($request->hasFile('mobil_image')) {
            $image = $request->file('mobil_image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $validated['mobil_image'] =
                $image->storeAs('mobil', $filename, 'public');
        }

        $fasilitas = $validated['fasilitas'] ?? [];
        unset($validated['fasilitas']);

        $mobil = Mobil::create($validated);

        if (!empty($fasilitas)) {
            $mobil->fasilitas()->attach($fasilitas);
        }

        return response()->json([
            'message' => 'Mobil berhasil ditambahkan',
            'data' => $mobil
        ], 201);
    }

    public function show($id)
    {
        $mobil = Mobil::with(['merk', 'class', 'tipe', 'fasilitas'])
            ->findOrFail($id);

        return response()->json($mobil);
    }

    public function update(Request $request, $id)
    {
        $mobil = Mobil::findOrFail($id);

        $validated = $request->validate([
            'merk_id' => 'sometimes|required|exists:merk,merk_id',
            'class_id' => 'sometimes|required|exists:class,class_id',
            'tipe_id' => 'sometimes|required|exists:tipe,tipe_id',
            'mobil_status' => 'sometimes|required|in:Tersedia,Disewa',
            'mobil_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'Transmisi' => 'sometimes|required|in:Manual,Matic',
            'mobil_warna' => 'sometimes|required|string|max:50',
            'mobil_plat' => 'sometimes|required|string|max:30|unique:mobil,mobil_plat,' . $id . ',mobil_id',
            'mobil_tahun' => 'sometimes|required|string|size:4',
            'harga_rental' => 'sometimes|required|numeric|min:0',
            'fasilitas' => 'sometimes|array',
            'fasilitas.*' => 'exists:fasilitas,fasilitas_id',
        ]);

        if ($request->hasFile('mobil_image')) {
            if ($mobil->mobil_image && Storage::disk('public')->exists($mobil->mobil_image)) {
                Storage::disk('public')->delete($mobil->mobil_image);
            }

            $image = $request->file('mobil_image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $validated['mobil_image'] =
                $image->storeAs('mobil', $filename, 'public');
        }

        if (isset($validated['fasilitas'])) {
            $mobil->fasilitas()->sync($validated['fasilitas']);
            unset($validated['fasilitas']);
        }

        $mobil->update($validated);

        return response()->json([
            'message' => 'Mobil berhasil diupdate',
            'data' => $mobil
        ]);
    }

    public function destroy($id)
    {
        Mobil::findOrFail($id)->delete();
        return response()->json(['message' => 'Mobil berhasil dihapus']);
    }

    public function available()
    {
        return Mobil::where('mobil_status', 'Tersedia')->get();
    }
}
