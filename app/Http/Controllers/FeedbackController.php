<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'solutionId' => 'required|integer',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $feedback = Feedback::create([
            'solution_id' => $validated['solutionId'],
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? '',
        ]);

        return response()->json(['success' => true, 'data' => $feedback]);
    }

    public function getBySolutionId($solution_id)
    {
        $feedbacks = Feedback::where('solution_id', $solution_id)->get();
        return response()->json(['success' => true, 'data' => $feedbacks]);
    }
}
