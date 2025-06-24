<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\QuestionAndAnswerController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;

Route::post('/feedbacks', [FeedbackController::class, 'store']);
Route::get('/feedbacks/{solution_id}', [FeedbackController::class, 'getBySolutionId']);

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);

// Các route không cần xác thực
Route::get('/question', [QuestionAndAnswerController::class, 'index']);

// Các route cần xác thực mới được truy cập
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/upload', [QuestionAndAnswerController::class, 'store']);
    Route::delete('/questions/{id}', [QuestionAndAnswerController::class, 'destroy']);

    Route::get('/user/stats/{id}', [UserController::class, 'stats']);

    Route::get('/profile', function (Request $request) {
        $user = $request->user();

        $solvedCount = \App\Models\QuestionsAndAnswers::where('user_id', $user->id)->count();

        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'solved_count' => $solvedCount
        ]);
    });
});
