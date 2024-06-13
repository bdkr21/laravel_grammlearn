<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class GrammarController extends Controller
{
    public function index()
    {
        $categories = Category::all(); // Mengambil semua kategori sebagai koleksi objek
        return view('index', compact('categories'));
    }


    public function startQuiz($categorySlug)
    {
        $category = $this->getCategoryBySlug($categorySlug);
        $user = Auth::user();

        // Tentukan poin yang dibutuhkan untuk kategori ini
        $pointsRequired = $this->getPointsRequiredForCategory($categorySlug);

        // Periksa apakah pengguna sudah membuka kategori ini sebelumnya
        if (!$user->unlockedCategories->contains($category->id)) {
            // Periksa apakah pengguna memiliki cukup poin
            if ($user->points < $pointsRequired) {
                return redirect()->back()->with('error', 'You do not have enough points to unlock this category.');
            }

            // Kurangi poin pengguna
            $user->points -= $pointsRequired;
            $user->save();

            // Tambahkan kategori ke daftar kategori yang sudah di-unlock oleh pengguna
            $user->unlockedCategories()->attach($category->id);
        }

        return redirect()->route('grammar.quiz.showQuestion', [
            'category' => $categorySlug,
            'questionIndex' => 1
        ]);
    }


    protected function getPointsRequiredForCategory($slug)
    {
        $pointsRequired = [
            'animals' => 0,
            'food' => 150,
            'clothes' => 200,
            // Tambahkan kategori lain dan poin yang dibutuhkan di sini
        ];

        return $pointsRequired[$slug] ?? 0;
    }
    public function showQuestion($categorySlug, $questionIndex)
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $totalQuestions = $category->questions()->count();

        $question = $category->questions()->skip($questionIndex - 1)->first();

        return view('quiz', [
            'category' => $category,
            'currentQuestionIndex' => $questionIndex,
            'totalQuestions' => $totalQuestions,
            'question' => $question
        ]);
    }

    public function nextQuestion(Request $request, $categorySlug)
    {
        $category = $this->getCategoryBySlug($categorySlug);
        $questions = $this->getQuestionsByCategory($category);

        $currentQuestionIndex = $request->input('currentQuestionIndex');
        $answers = $request->session()->get('answers', []);
        $answers[$currentQuestionIndex] = $request->input('answer');
        $request->session()->put('answers', $answers);

        $nextQuestionIndex = $currentQuestionIndex + 1;

        if ($nextQuestionIndex > $questions->count()) {
            $score = $this->calculateScore($request, $questions);
            return redirect()->route('grammar.quiz.result', ['category' => $category->slug, 'score' => $score]);
        }

        $question = $questions->get($nextQuestionIndex - 1);

        return view('grammar.quiz')->with([
            'category' => $category,
            'question' => $question,
            'totalQuestions' => $questions->count(),
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
        $questions = $this->getQuestionsByCategory($category);
        $totalQuestions = $questions->count();
        $answers = $request->session()->get('answers', []);

        // Calculate score
        $score = 0;
        foreach ($questions as $index => $question) {
            // Check if the stored answer matches the correct answer
            if (isset($answers[$index]) && $answers[$index] == $question->answer) {
                $score++;
            }
        }

        return view('grammar.quiz_result')->with([
            'category' => $category,
            'score' => $score,
            'questions' => $questions,
            'totalQuestions' => $totalQuestions,
            'answers' => $answers,
        ]);
    }

    public function confirmOpenQuiz($categorySlug)
    {
        // Lakukan pembukaan kategori di sini setelah konfirmasi
        $category = $this->getCategoryBySlug($categorySlug);
        $user = Auth::user();

        // Kurangi poin pengguna
        $pointsRequired = $this->getPointsRequiredForCategory($categorySlug);
        $user->points -= $pointsRequired;
        $user->save();

        // Redirect ke halaman quiz atau halaman terkait
        return redirect()->route('grammar.quiz.showQuestion', [
            'category' => $categorySlug,
            'questionIndex' => 1
        ]);
    }

    public function submitAnswer(Request $request, $categorySlug, $questionIndex)
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $totalQuestions = $category->questions()->count();

        // Retrieve or initialize the answers array from the session
        $answers = $request->session()->get('answers', []);

        // Store the answer using the question index (subtract 1 for 0-based index)
        $answers[$questionIndex - 1] = $request->input('answer');

        // Update the session with the new answers array
        $request->session()->put('answers', $answers);

        // Debug log to verify answers stored in session
        \Log::info('Answers:', $answers);

        // Redirect to the next question if available
        if ($questionIndex < $totalQuestions) {
            return redirect()->route('grammar.quiz.showQuestion', ['category' => $categorySlug, 'questionIndex' => $questionIndex + 1]);
        } else {
            return redirect()->route('grammar.quiz.completeQuiz', ['category' => $categorySlug]);
        }
    }

    public function completeQuiz($categorySlug)
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $questions = $category->questions;
        $totalQuestions = $questions->count();
        $answers = session('answers', []);

        // Debug log to verify answers before calculating score
        \Log::info('Answers at completeQuiz:', $answers);

        // Calculate score
        $score = 0;
        foreach ($questions as $index => $question) {
            // Check if the stored answer matches the correct answer (0-based index)
            if (isset($answers[$index]) && $answers[$index] == $question->answer) {
                $score++;
            }
        }

        // Add points to user based on the score
        $user = Auth::user();
        $pointsEarned = $score; // Sesuaikan dengan logika perolehan poin yang diinginkan
        $user->points += $pointsEarned;
        $user->save();

        // Debug log to verify score calculation
        \Log::info('Calculated Score:', ['score' => $score, 'answers' => $answers]);

        return view('quiz_result', [
            'category' => $category,
            'questions' => $questions,
            'totalQuestions' => $totalQuestions,
            'score' => $score,
            'points' => $pointsEarned,
            'answers' => $answers
        ]);
    }




    public function quizResult(Request $request, $categorySlug)
    {
        $category = $this->getCategoryBySlug($categorySlug);
        $questions = $this->getQuestionsByCategory($category);
        $totalQuestions = $questions->count();
        $answers = $request->session()->get('answers', []);

        // Calculate score
        $score = 0;
        foreach ($questions as $index => $question) {
            // Check if the stored answer matches the correct answer
            if (isset($answers[$index]) && $answers[$index] == $question->answer) {
                $score++;
            }
        }

        // Debug log to verify score calculation
        \Log::info('Calculated Score:', ['score' => $score, 'answers' => $answers]);

        return view('grammar.quiz_result')->with([
            'category' => $category,
            'score' => $score,
            'questions' => $questions,
            'totalQuestions' => $totalQuestions,
            'answers' => $answers,
        ]);
    }


    protected function getCategoryBySlug($slug)
    {
        return Category::where('slug', $slug)->firstOrFail();
    }

    protected function getQuestionsByCategory($category)
    {
        // Retrieve questions for the given category
        return $category->questions()->get();
    }

    protected function calculateScore(Request $request, $questions)
    {
        $score = 0;
        $answers = $request->session()->get('answers', []);

        foreach ($questions as $question) {
            if (isset($answers[$question->id]) && $answers[$question->id] == $question->answer) {
                $score++;
            }
        }
        return $score;
    }

}
