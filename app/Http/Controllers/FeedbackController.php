<?php
namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with('rentalItem')->paginate(10);
        return response()->json($feedbacks);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'rental_id' => 'required|exists:rental_item,rental_id',
            'rating' => 'required|string|max:50',
            'komentar' => 'required|string',
            'tanggal_feedback' => 'required|date',
        ]);

        $feedback = Feedback::create($validated);

        return response()->json(['message' => 'Feedback berhasil dibuat', 'data' => $feedback], 201);
    }

    public function show($id)
    {
        $feedback = Feedback::with('rentalItem')->findOrFail($id);
        return response()->json($feedback);
    }

    public function update(Request $request, $id)
    {
        $feedback = Feedback::findOrFail($id);

        $validated = $request->validate([
            'rental_id' => 'sometimes|required|exists:rental_item,rental_id',
            'rating' => 'sometimes|required|string|max:50',
            'komentar' => 'sometimes|required|string',
            'tanggal_feedback' => 'sometimes|required|date',
        ]);

        $feedback->update($validated);

        return response()->json(['message' => 'Feedback berhasil diupdate', 'data' => $feedback]);
    }

    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return response()->json(['message' => 'Feedback berhasil dihapus']);
    }
}