<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with('mobil')->paginate(10);
        return response()->json($feedbacks);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'rental_id' => [
                'required',
                'exists:rental_item,rental_id',
                Rule::unique('feedback')->where(function ($q) {
                    return $q->where('rental_id', request('rental_id'));
                }),
            ],
            'rating' => 'required|numeric|min:1|max:5',
            'komentar' => 'required|string',
            'tanggal_feedback' => 'required|date',
        ]);

        // 🔒 PASTIKAN RENTAL MILIK USER LOGIN
        $rental = \App\Models\RentalItem::where('rental_id', $validated['rental_id'])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        \App\Models\Feedback::create([
            'rental_id' => $validated['rental_id'],
            'rating' => $validated['rating'],
            'komentar' => $validated['komentar'],
            'tanggal_feedback' => $validated['tanggal_feedback'],
        ]);

        return back()->with('success', 'Feedback berhasil dikirim');
    }
    public function show($id)
    {
        $feedback = Feedback::with('mobil')->findOrFail($id);
        return response()->json($feedback);
    }

    public function update(Request $request, $id)
    {
        $feedback = Feedback::findOrFail($id);

        $validated = $request->validate([
            'rental_id' => 'sometimes|required|integer',
            'rating' => 'sometimes|required|string|max:50',
            'komentar' => 'sometimes|required|string',
            'tanggal_feedback' => 'sometimes|required|date',
        ]);

        $feedback->update($validated);

        return response()->json([
            'message' => 'Feedback berhasil diupdate',
            'data' => $feedback
        ]);
    }

    public function destroy($id)
    {
        Feedback::findOrFail($id)->delete();
        return response()->json(['message' => 'Feedback berhasil dihapus']);
    }
}
