<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function index() {
        $grammarTopics = Course::all()->groupBy('category');
        return view('courses.index', ['grammarTopics' => $grammarTopics]);
    }
}
