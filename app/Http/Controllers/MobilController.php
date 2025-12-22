<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\CarClass;
use Illuminate\Support\Facades\Auth;
class MobilController extends Controller

{
    public function index()
    {
        $mobils = Mobil::with([
            'merk',
            'carclass',
            'nama_mobil',
            'fasilitas',
            'feedbacks'
        ])->paginate(10);

        return response()->json($mobils);
    }
    public function tampilMobil()
    {
        $mobils = Mobil::with(['merk', 'carclass', 'seat'])
            ->paginate(10);

        return view('kasir.mobil', compact('mobils'));
    }

    public function detail(Mobil $mobil)
    {
        return view('pesanan.detail', compact('mobil'));
    }
    public function storeRating(Request $request, $mobilId)
    {
        $request->validate([
            'rating'   => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:255',
        ]);

        $mobil = Mobil::findOrFail($mobilId);

        // Simpan feedback sebagai JSON
        $mobil->feedback = json_encode([
            'rating'   => $request->rating,
            'komentar' => $request->komentar,
            'user_id'  => Auth::id(),
        ]);

        $mobil->save();

        return back()->with('success', 'Rating berhasil dikirim 👍');
    }

    public function store(Request $request)
    {
        $request->validate([
            'merk_id'      => 'required|exists:merk,merk_id',
            'class_id'     => 'required|exists:class,class_id',
            'nama_mobil'   => 'required|string|max:100',
            'fasilitas'    => 'required|string',
            'Transmisi'    => 'required|in:Manual,Matic',
            'mobil_warna'  => 'required|string|max:50',
            'mobil_plat'   => 'required|string|max:30|unique:mobil,mobil_plat',
            'mobil_tahun'  => 'required|string|size:4',
            'harga_rental' => 'required|numeric',
            'mobil_image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('mobil_image')) {
            $data['mobil_image'] = $request->file('mobil_image')->store('mobil', 'public');
        }

        Mobil::create($data);

        return back()->with('success', 'Mobil berhasil ditambahkan');
    }

    public function show($id)
    {
        $mobil = Mobil::with([
            'merk',
            'carclass',
            'tipe',
            'fasilitas',
            'feedback'
        ])->findOrFail($id);

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
            'feedback'      => 'nullable|string',
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
            $validated['mobil_image'] = $image->storeAs('mobil', $filename, 'public');
        }

        if (isset($validated['fasilitas'])) {
            $mobil->fasilitas()->sync($validated['fasilitas']);
            unset($validated['fasilitas']);
        }

        $mobil->update($validated);

        return response()->json([
            'message' => 'Mobil berhasil diupdate',
            'data' => $mobil->load(['merk', 'carclass', 'tipe', 'fasilitas', 'feedback'])
        ]);
    }

    public function home()
    {
        $mobils = Mobil::with(['merk'])
            ->where('mobil_status', 'Tersedia')
            ->get();

        return view('home', compact('mobils'));
    }



    

    public function katalog()
    {
        $classes = CarClass::with(['mobils' => function ($q) {
            $q->where('mobil_status', 'Tersedia')
            ->with('merk'); 
        }])->get();

        return view('Katalog.index', compact('classes'));
    }


    

    public function destroy($id)
    {
        $mobil = Mobil::findOrFail($id);

        if ($mobil->mobil_image && Storage::disk('public')->exists($mobil->mobil_image)) {
            Storage::disk('public')->delete($mobil->mobil_image);
        }

        $mobil->delete();

        return response()->json(['message' => 'Mobil berhasil dihapus']);
    }

    public function available()
    {
        return response()->json(
            Mobil::where('mobil_status', 'Tersedia')->get()
        );
    }
    public function konfirmasi(Request $request)
    {
        $mobil = Mobil::findOrFail($request->mobil_id);

        return view('Pemesanan.index', [
            'mobil'        => $mobil,
            'tgl'          => $request->tgl,
            'lama_rental'  => $request->lama_rental,
            'pilihan'      => $request->pilihan,
            'total_sewa'   => $mobil->harga_rental * $request->lama_rental
        ]);
    }

}
