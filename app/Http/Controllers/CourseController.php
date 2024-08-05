<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\UserAnswer;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {
        $grammarTopics = Course::all()->groupBy('category');
        return view('courses.index', ['grammarTopics' => $grammarTopics]);
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
        ]);

        Course::create($request->all());

        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.show', ['course' => $course]);
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('courses.edit', ['course' => $course]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
        ]);

        $course = Course::findOrFail($id);
        $course->update($request->all());

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
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

    public function givePoints(Request $request)
    {
        $user = Auth::user();
        $courseId = $request->input('course_id');

        if (!$user || !$courseId) {
            return response()->json(['success' => false, 'message' => 'Invalid request'], 400);
        }

        $user->points += 10;
        $user->save();

        return response()->json(['success' => true, 'message' => 'Points added successfully']);
    }
}
