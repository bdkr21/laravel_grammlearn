<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GrammarService;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class DailyMissionController extends Controller
{
    protected $grammarService;

    public function __construct(GrammarService $grammarService)
    {
        $this->grammarService = $grammarService;
    }

    public function index()
    {
        $user = Auth::user();

        // Pastikan kolom last_attempted_at ada, jika null, anggap belum melakukan misi harian
        $lastAttemptedAt = \Carbon\Carbon::parse($user->last_attempted_at ?? '1900-01-01'); // Menggunakan tanggal default jika null

        // Cek apakah misi harian sudah dilakukan hari ini
        if ($lastAttemptedAt->isToday()) {
            // Kirim pesan alert ke session dan tetap di halaman yang sama
            return back()->with('alertMessage', 'Anda sudah melakukan misi harian hari ini.');
        }

        // Tandai waktu saat ini sebagai waktu terakhir mencoba misi harian
        $user->last_attempted_at = now();
        $user->save();

        // Get a random set of questions
        $questions = Question::inRandomOrder()->take(1)->get();
        session()->put('daily_questions', $questions);

        return redirect()->route('daily.quiz.showQuestion', ['questionIndex' => 1]);
    }

    public function startQuiz()
    {
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
        $questions = session()->get('daily_questions', []);
        $answers = session()->get('daily_answers', []);
        $correctedQuestions = session()->get('daily_corrected_questions', []);

        $score = 0;
        $messages = [];

        foreach ($questions as $index => $question) {
            $userAnswer = trim(strtolower($answers[$index] ?? ''));
            $correctAnswer = trim(strtolower($correctedQuestions[$index] ?? ''));

            if ($userAnswer === $correctAnswer) {
                $score++;
                $messages[$index] = 'OK';
            } else {
                $messages[$index] = 'Salah';
            }
        }

        // Update user points and last attempted timestamp
        $user = Auth::user();
        $user->points += $score;
        $user->last_attempted_at = now();  // Set the last attempted time to now
        $user->save();

        return view('daily.quiz_result', [
            'questions' => $questions,
            'correctedQuestions' => $correctedQuestions,
            'totalQuestions' => count($questions),
            'score' => $score,
            'points' => $user->points,
            'answers' => $answers,
            'messages' => $messages,
        ])->with('pointsEarned', $score);
    }


}
