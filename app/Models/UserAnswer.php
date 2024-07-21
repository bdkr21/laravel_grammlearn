<?php
// app/Models/UserAnswer.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'course_id', 'answers'];

    protected $casts = [
        'answers' => 'array', // Menggunakan cast array untuk kolom JSON
    ];
}

