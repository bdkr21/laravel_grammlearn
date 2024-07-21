<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\UserAnswer;

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

    public function storeAnswers(Request $request, $id, $latihan)
    {
        $request->validate([
            'answers' => 'required|array',
        ]);

        $answers = new UserAnswer([
            'user_id' => auth()->id(),
            'course_id' => $id,
            'latihan' => $latihan,
            'answers' => $request->input('answers'),
        ]);

        $answers->save();

        return redirect()->route('courses.show', $id)->with('success', "Your answers for Latihan $latihan have been submitted.");
    }
}
