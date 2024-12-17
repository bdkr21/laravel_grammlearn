<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateKuisRequest;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $quizzes = Quiz::with('questions')->get();
        // return view('quizzes.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.quiz.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'topic' => 'required|string|max:255',
        ]);

        Quiz::create([
            'title' => $request->title,
            'description' => $request->description,
            'topic' => $request->topic,
        ]);

        return redirect()->route('dashboard')->with('success', 'Quiz created successfully!');
    }
    /**
     * Display the specified resource.
     */
    public function show(Quiz $quiz)
    {
        //
        return view('quizzes.show', compact('quiz'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $kuiss)
    {
        //
        return view('admin.quiz.edit', compact('kuiss'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKuisRequest $request, Quiz $kuiss)
    {
        // Debug hasil validasi
        $data = $request->validated();
        $kuiss->update($data);

        return redirect()->route('dashboard')->with('success', 'Quiz updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();

        return redirect()->route('dashboard')->with('success', 'Quiz deleted successfully.');
    }
}
