<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionsAndAnswers extends Model
{
    use HasFactory;

    protected $fillable = ['question', 'answer', 'image_path', 'user_id'];

      public function feedback()
    {
        return $this->hasOne(Feedback::class, 'solution_id', 'id');
    }

        public function user()
    {
        return $this->belongsTo(User::class);
    }
}
