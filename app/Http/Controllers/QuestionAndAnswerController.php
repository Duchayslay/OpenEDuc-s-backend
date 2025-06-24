<?php

namespace App\Http\Controllers;

use App\Models\QuestionsAndAnswers;
use Illuminate\Http\Request;

class QuestionAndAnswerController extends Controller
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

    $userId = auth()->id();
    \Log::info("UserID khi upload: " . $userId);  // Xem log

    if (!$userId) {
        return response()->json(['status' => 'error', 'message' => 'User không xác thực'], 401);
    }

    $qa = QuestionsAndAnswers::create([
        'question' => $request->question,
        'answer' => $request->answer,
        'image_path' => $request->image_path ?? '',
        'user_id' => $userId
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


public function getAllQuestionsAndAnswers()
{
    // Lấy tất cả câu hỏi và câu trả lời, kèm feedback nếu có
    $items = QuestionsAndAnswers::with('feedback')->orderBy('id', 'desc')->get();

    return response()->json([
        'success' => true,
        'data' => $items,
    ]);
}

}
