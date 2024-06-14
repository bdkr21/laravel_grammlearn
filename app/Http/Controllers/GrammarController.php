<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class GrammarController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    public function startQuiz($categorySlug)
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $user = Auth::user();

        if (!$user->unlockedCategories->contains($category->id)) {
            if ($user->points < $category->required_points) {
                return redirect()->back()->with('error', 'You do not have enough points to unlock this category.');
            }

            return view('confirm_open_quiz', compact('category'));
        }

        return redirect()->route('grammar.quiz.showQuestion', [
            'category' => $categorySlug,
            'questionIndex' => 1
        ]);
    }

    public function showQuestion($categorySlug, $questionIndex)
    {
        $category = $this->getCategoryBySlug($categorySlug);
        $question = $category->questions()->skip($questionIndex - 1)->first();

        return view('quiz', [
            'category' => $category,
            'currentQuestionIndex' => $questionIndex,
            'totalQuestions' => $category->questions()->count(),
            'question' => $question
        ]);
    }

    public function unlockCategory(Request $request)
    {
        $user = Auth::user();
        $categorySlug = $request->input('category');
        $category = Category::where('slug', $categorySlug)->first();

        if ($user && $category && $user->points >= $category->required_points) {
            // Kurangi poin pengguna
            $user->points -= $category->required_points;
            $user->save();

            // Tambahkan kategori ke unlocked categories
            $user->unlockedCategories()->attach($category->id);

            // Redirect to the quiz page
            return redirect()->route('grammar.quiz.showQuestion', [
                'category' => $categorySlug,
                'questionIndex' => 1
            ])->with('success', 'Category unlocked successfully.');
        } else {
            return redirect()->back()->with('error', 'Not enough points to unlock this category.');
        }
    }

    public function nextQuestion(Request $request, $categorySlug)
    {
        $category = $this->getCategoryBySlug($categorySlug);
        $currentQuestionIndex = $request->input('currentQuestionIndex');
        $answers = $request->session()->get('answers', []);
        $answers[$currentQuestionIndex] = $request->input('answer');
        $request->session()->put('answers', $answers);

        $nextQuestionIndex = $currentQuestionIndex + 1;
        $totalQuestions = $category->questions()->count();

        if ($nextQuestionIndex > $totalQuestions) {
            $score = $this->calculateScore($request, $category->questions);
            return redirect()->route('grammar.quiz.result', ['category' => $categorySlug, 'score' => $score]);
        }

        $question = $category->questions()->skip($nextQuestionIndex - 1)->first();

        return view('grammar.quiz', [
            'category' => $category,
            'question' => $question,
            'totalQuestions' => $totalQuestions,
            'currentQuestionIndex' => $nextQuestionIndex,
        ]);
    }

    public function previousQuestion($categorySlug, $questionIndex)
    {
        return redirect()->route('grammar.quiz.showQuestion', ['category' => $categorySlug, 'questionIndex' => $questionIndex - 1]);
    }

    public function submitQuiz(Request $request, $categorySlug)
    {
        $category = $this->getCategoryBySlug($categorySlug);
        $questions = $category->questions;
        $answers = $request->session()->get('answers', []);

        $score = $this->calculateScore($answers, $questions);

        return view('grammar.quiz_result', [
            'category' => $category,
            'score' => $score,
            'questions' => $questions,
            'totalQuestions' => $questions->count(),
            'answers' => $answers,
        ]);
    }

    public function confirmOpenQuiz($categorySlug)
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $user = Auth::user();

        if ($user->points < $category->required_points) {
            return redirect()->back()->with('error', 'You do not have enough points to unlock this category.');
        }

        $user->points -= $category->required_points;
        $user->save();

        $user->unlockedCategories()->attach($category->id);

        return redirect()->route('grammar.quiz.showQuestion', [
            'category' => $categorySlug,
            'questionIndex' => 1
        ]);
    }

    public function submitAnswer(Request $request, $categorySlug, $questionIndex)
    {
        $category = $this->getCategoryBySlug($categorySlug);
        $totalQuestions = $category->questions()->count();
        $answers = $request->session()->get('answers', []);
        $answers[$questionIndex - 1] = $request->input('answer');
        $request->session()->put('answers', $answers);

        \Log::info('Answers:', $answers);

        if ($questionIndex < $totalQuestions) {
            return redirect()->route('grammar.quiz.showQuestion', ['category' => $categorySlug, 'questionIndex' => $questionIndex + 1]);
        } else {
            return redirect()->route('grammar.quiz.completeQuiz', ['category' => $categorySlug]);
        }
    }

    public function completeQuiz($categorySlug)
    {
        $category = $this->getCategoryBySlug($categorySlug);
        $questions = $category->questions;
        $answers = session('answers', []);

        \Log::info('Answers at completeQuiz:', $answers);

        $score = $this->calculateScore($answers, $questions);
        $user = Auth::user();
        $user->points += $score;
        $user->save();

        \Log::info('Calculated Score:', ['score' => $score, 'answers' => $answers]);

        return view('quiz_result', [
            'category' => $category,
            'questions' => $questions,
            'totalQuestions' => $questions->count(),
            'score' => $score,
            'points' => $score,
            'answers' => $answers
        ]);
    }

    public function quizResult(Request $request, $categorySlug)
    {
        $category = $this->getCategoryBySlug($categorySlug);
        $questions = $category->questions;
        $answers = $request->session()->get('answers', []);

        $score = $this->calculateScore($answers, $questions);

        \Log::info('Calculated Score:', ['score' => $score, 'answers' => $answers]);

        return view('grammar.quiz_result', [
            'category' => $category,
            'score' => $score,
            'questions' => $questions,
            'totalQuestions' => $questions->count(),
            'answers' => $answers,
        ]);
    }

    protected function getCategoryBySlug($slug)
    {
        return Category::where('slug', $slug)->firstOrFail();
    }

    protected function calculateScore($answers, $questions)
    {
        $score = 0;

        foreach ($questions as $index => $question) {
            if (isset($answers[$index]) && $answers[$index] == $question->answer) {
                $score++;
            }
        }

        return $score;
    }
}
