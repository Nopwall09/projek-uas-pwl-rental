<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

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
            'rental_id' => 'required|exists:rental_item,id',
            'komentar' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Feedback::create($validated);

        return redirect()->back()->with('success', 'Feedback berhasil dikirim!');
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
