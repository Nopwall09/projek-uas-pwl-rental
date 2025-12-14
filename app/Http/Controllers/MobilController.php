<?php
namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MobilController extends Controller
{
    public function index()
    {
        $mobils = Mobil::with(['merk', 'status', 'class', 'tipe', 'fasilitas'])->paginate(10);
        return response()->json($mobils);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'merk_id' => 'required|exists:merk,merk_id',
            'status_id' => 'required|exists:status,status_id',
            'class_id' => 'required|exists:class,class_id',
            'tipe_id' => 'required|exists:tipe,tipe_id',
            'mobil_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'Transmisi' => 'required|in:Manual,Matic',
            'mobil_warna' => 'required|string|max:50',
            'mobil_plat' => 'required|string|max:30|unique:mobil,mobil_plat',
            'mobil_tahun' => 'required|string|size:4',
            'harga_rental' => 'required|numeric|min:0',
            'fasilitas' => 'sometimes|array',
            'fasilitas.*' => 'exists:fasilitas,fasilitas_id',
        ]);

        // simpan image
        if ($request->hasFile('mobil_image')) {
            $image = $request->file('mobil_image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('mobil', $filename, 'public');
            $validated['mobil_image'] = $path;
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
        $mobil = Mobil::with(['merk', 'status', 'class', 'tipe', 'fasilitas'])->findOrFail($id);
        return response()->json($mobil);
    }

    

    public function update(Request $request, $id)
    {
        $mobil = Mobil::findOrFail($id);

        $validated = $request->validate([
            'merk_id' => 'sometimes|required|exists:merk,merk_id',
            'status_id' => 'sometimes|required|exists:status,status_id',
            'class_id' => 'sometimes|required|exists:class,class_id',
            'tipe_id' => 'sometimes|required|exists:tipe,tipe_id',
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
            // hapus image lama
            if ($mobil->mobil_image && Storage::disk('public')->exists($mobil->mobil_image)) {
                Storage::disk('public')->delete($mobil->mobil_image);
            }

            $image = $request->file('mobil_image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('mobil', $filename, 'public');
            $validated['mobil_image'] = $path;
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

    public function home()
    {
        $mobils = Mobil::with(['merk', 'status', 'class', 'tipe'])
            ->where('status_id', 1) 
            ->get();
    
        return view('home', compact('mobils'));
    }
    
    public function katalog()
    {
        $cityCars = Mobil::with(['merk','tipe'])
            ->where('class_id', 1)
            ->where('status_id', 1)
            ->get();

        $familyCars = Mobil::with(['merk','tipe'])
            ->where('class_id', 2)
            ->where('status_id', 1)
            ->get();

        $luxuryCars = Mobil::with(['merk','tipe'])
            ->where('class_id', 3)
            ->where('status_id', 1)
            ->get();

        return view('katalog.index', compact(
            'cityCars',
            'familyCars',
            'luxuryCars'
        ));
    }


    public function destroy($id)
    {
        $mobil = Mobil::findOrFail($id);
        $mobil->delete();

        return response()->json(['message' => 'Mobil berhasil dihapus']);
    }
}
