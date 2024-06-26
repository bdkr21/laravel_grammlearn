<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Services\GrammarService;

class GrammarController extends Controller
{
    protected $grammarService;

    public function __construct(GrammarService $grammarService)
    {
        $this->grammarService = $grammarService;
    }

    public function index()
    {
        $categories = Category::all();
        return view('index', compact('categories'));
    }

    public function startQuiz($categorySlug)
    {
        $category = $this->getCategoryBySlug($categorySlug);
        return redirect()->route('grammar.quiz.showQuestion', [
            'category' => $categorySlug,
            'questionIndex' => 1
        ]);
    }

    public function showQuestion($categorySlug, $questionIndex)
    {
        $category = $this->getCategoryBySlug($categorySlug);
        $question = $category->questions()->skip($questionIndex - 1)->first();
        $answers = session()->get('answers', []);

        return view('quiz', [
            'category' => $category,
            'currentQuestionIndex' => $questionIndex,
            'totalQuestions' => $category->questions()->count(),
            'question' => $question,
            'answers' => $answers
        ]);
    }

    public function unlockCategory(Request $request)
    {
        $user = Auth::user();
        $categorySlug = $request->input('category');
        $category = Category::where('slug', $categorySlug)->first();

        if ($user && $category && $user->points >= $category->required_points) {
            // Deduct points from the user
            $user->points -= $category->required_points;
            $user->save();

            // Add category to unlocked categories
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
            return redirect()->route('grammar.quiz.completeQuiz', ['category' => $categorySlug]);
        }

        $question = $category->questions()->skip($nextQuestionIndex - 1)->first();

        return view('quiz', [
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

    public function submitAnswer(Request $request, $categorySlug, $questionIndex)
    {
        $category = $this->getCategoryBySlug($categorySlug);
        $totalQuestions = $category->questions()->count();
        $answers = $request->session()->get('answers', []);
        $userAnswer = $request->input('answer');
        $answers[$questionIndex - 1] = $userAnswer;

        $question = $category->questions()->skip($questionIndex - 1)->first();
        $grammarCheck = $this->grammarService->checkGrammar($question->question);

        $correctedAnswer = $grammarCheck['correction'] ?? $question->question;

        $request->session()->put('answers', $answers);
        $correctedAnswers = $request->session()->get('corrected_answers', []);
        $correctedAnswers[$questionIndex - 1] = $correctedAnswer;
        $request->session()->put('corrected_answers', $correctedAnswers);

        $message = $userAnswer === $correctedAnswer ? 'OK' : 'Salah';

        if ($questionIndex < $totalQuestions) {
            return redirect()->route('grammar.quiz.showQuestion', ['category' => $categorySlug, 'questionIndex' => $questionIndex + 1])
                             ->with('message', $message);
        } else {
            return redirect()->route('grammar.quiz.completeQuiz', ['category' => $categorySlug])
                             ->with('message', $message);
        }
    }

    public function completeQuiz($categorySlug)
    {
        $category = $this->getCategoryBySlug($categorySlug);
        $questions = $category->questions;

        $answers = session()->get('answers', []);
        $correctedAnswers = session()->get('corrected_answers', []);

        $score = 0;
        $messages = [];

        foreach ($questions as $index => $question) {
            $userAnswer = $answers[$index] ?? null;
            $correctedAnswer = $correctedAnswers[$index] ?? null;

            if ($userAnswer && $userAnswer === $correctedAnswer) {
                $score++;
                $messages[$index] = 'OK';
            } else {
                $messages[$index] = 'Salah';
            }

            // Add correct answer to question object for the view
            $question->correct_answer = $correctedAnswer;
        }

        $user = Auth::user();
        $user->points += $score;
        $user->save();

        return view('quiz_result', [
            'category' => $category,
            'questions' => $questions,
            'totalQuestions' => $questions->count(),
            'score' => $score,
            'points' => $user->points,
            'answers' => $answers,
            'grammarResults' => $correctedAnswers,
            'messages' => $messages,
        ])->with('pointsEarned', $score);
    }


    public function quizResult(Request $request, $categorySlug)
    {
        $category = $this->getCategoryBySlug($categorySlug);
        $questions = $category->questions;
        $answers = $request->session()->get('answers', []);

        $score = $this->grammarService->calculateScore($answers, $questions);

        $grammarResults = [];
        foreach ($answers as $index => $answer) {
            $grammarResults[$index] = $this->grammarService->checkGrammar($answer);
        }

        \Log::info('Calculated Score:', ['score' => $score, 'answers' => $answers]);

        return view('grammar.quiz_result', [
            'category' => $category,
            'score' => $score,
            'questions' => $questions,
            'totalQuestions' => $questions->count(),
            'answers' => $answers,
            'grammarResults' => $grammarResults,
        ]);
    }

    protected function getCategoryBySlug($slug)
    {
        return Category::where('slug', $slug)->firstOrFail();
    }

}
