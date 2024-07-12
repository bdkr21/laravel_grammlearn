<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index() {
        $grammarTopics = Course::all()->groupBy('category');
        return view('courses.index', ['grammarTopics' => $grammarTopics]);
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.show', ['course' => $course]);
    }
}
