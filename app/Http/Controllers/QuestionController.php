<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\QuestionsAndAnswers;

class QuestionController extends Controller
{
    public function index()
    {
        $data = QuestionsAndAnswers::orderBy('created_at', 'desc')->get();
        return response()->json(['status' => 'success', 'data' => $data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        $qa = QuestionsAndAnswers::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'image_path' => $request->image_path ?? '',
        ]);

        return response()->json(['status' => 'success', 'data' => $qa]);
    }

    public function destroy($id)
    {
        $qa = QuestionsAndAnswers::find($id);
        if ($qa) {
            $qa->delete();
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error', 'message' => 'Not found'], 404);
    }
}
