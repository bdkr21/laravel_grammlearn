<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GrammarService;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class DailyMissionController extends Controller
{
    protected $grammarService;

    // public function __construct(GrammarService $grammarService)
    // {
    //     $this->grammarService = $grammarService;
    // }

    public function index()
    {
        return view('daily.index');
    }

    public function startQuiz()
    {
        // Get a random set of questions
        $questions = Question::inRandomOrder()->take(1)->get();
        session()->put('daily_questions', $questions);

        return redirect()->route('daily.quiz.showQuestion', ['questionIndex' => 1]);
    }

    public function showQuestion($questionIndex)
    {
        // Ambil semua soal dari database
        $allQuestions = Question::all();

        // Acak soal hanya sekali dan simpan di sesi
        if (!session()->has('daily_questions')) {
            $shuffledQuestions = $allQuestions->shuffle();
            session()->put('daily_questions', $shuffledQuestions);
        } else {
            $shuffledQuestions = session()->get('daily_questions');
        }

        // Validasi indeks pertanyaan
        if ($questionIndex < 1 || $questionIndex > count($shuffledQuestions)) {
            abort(404, 'Question not found');
        }

        $question = $shuffledQuestions[$questionIndex - 1];

        // Kirim soal ke GrammarBot API
        try {
            $grammarCheck = $this->grammarService->checkGrammar($question->question);

            // Simpan hasil koreksi di sesi
            $correctedQuestions = session()->get('daily_corrected_questions', []);
            $correctedQuestions[$questionIndex - 1] = $grammarCheck['correction'] ?? $question->question;
            session()->put('daily_corrected_questions', $correctedQuestions);
        } catch (\Exception $e) {
            // Tangani error jika API gagal
            $correctedQuestions = session()->get('daily_corrected_questions', []);
            $correctedQuestions[$questionIndex - 1] = $question->question;
            session()->put('daily_corrected_questions', $correctedQuestions);
        }

        $answers = session()->get('daily_answers', []);

        return view('daily.quiz', [
            'currentQuestionIndex' => $questionIndex,
            'totalQuestions' => count($shuffledQuestions),
            'question' => $question,
            'answers' => $answers,
        ]);
    }



    public function submitAnswer(Request $request, $questionIndex)
    {
        $questions = session()->get('daily_questions');
        $totalQuestions = count($questions);

        // Save the user's answer
        $userAnswer = $request->input('answer');
        $answers = session()->get('daily_answers', []);
        $answers[$questionIndex - 1] = $userAnswer;
        session()->put('daily_answers', $answers);

        // Fetch the current question
        $question = $questions[$questionIndex - 1];

        // Call GrammarBot API
        try {
            // Memeriksa jawaban dengan GrammarBot API
            $grammarCheck = $this->grammarService->checkGrammar($userAnswer);

            // Ambil koreksi dari respon GrammarBot
            $correctedAnswer = $grammarCheck['correction'] ?? $userAnswer;

            // Simpan jawaban yang sudah dikoreksi untuk evaluasi nanti
            $correctedAnswers = session()->get('daily_corrected_answers', []);
            $correctedAnswers[$questionIndex - 1] = $correctedAnswer;
            session()->put('daily_corrected_answers', $correctedAnswers);

            // Bandingkan jawaban pengguna dan koreksi
            $message = $userAnswer === $correctedAnswer ? 'OK' : 'Salah';
        } catch (\Exception $e) {
            // Tangani kegagalan API
            $message = 'Error in grammar checking service';
        }

        // Redirect to the next question or finish
        if ($questionIndex < $totalQuestions) {
            return redirect()->route('daily.quiz.showQuestion', ['questionIndex' => $questionIndex + 1])
                            ->with('message', $message);
        } else {
            return redirect()->route('daily.quiz.completeQuiz')
                            ->with('message', $message);
        }
    }



    public function completeQuiz()
    {
        // Ambil soal dari sesi
        $questions = session()->get('daily_questions', []);
        $answers = session()->get('daily_answers', []);
        $correctedQuestions = session()->get('daily_corrected_questions', []); // Soal yang sudah dikoreksi GrammarBot
        $correctedAnswers = session()->get('daily_corrected_answers', []); // Jawaban yang sudah dikoreksi GrammarBot

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
        }

        $user = Auth::user();
        $user->points += $score;
        $user->save();

        return view('daily.quiz_result', [
            'questions' => $questions,
            'correctedQuestions' => $correctedQuestions, // Tambahkan soal yang dikoreksi
            'totalQuestions' => count($questions),
            'score' => $score,
            'points' => $user->points,
            'answers' => $answers,
            'grammarResults' => $correctedAnswers,
            'messages' => $messages,
        ])->with('pointsEarned', $score);
    }
}
