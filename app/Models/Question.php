<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'question_text', 'correct_answer_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
