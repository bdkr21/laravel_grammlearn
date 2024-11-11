<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;
use App\Services\GrammarService;
use App\Models\UserAnswer;

class GrammarController extends Controller
{
    protected $grammarService;

    public function __construct(GrammarService $grammarService)
    {
        $this->grammarService = $grammarService;
    }

    public function index()
    {
        session()->forget('answers');
        session()->forget('corrected_answers');
        $courses = Course::all();
        return view('index', compact('courses'));
    }

    public function startQuiz($courseSlug)
    {
        $course = $this->getCourseBySlug($courseSlug);
        return redirect()->route('grammar.quiz.showQuestion', [
            'course' => $courseSlug,
            'questionIndex' => 1
        ]);
    }
    public function showQuestion($courseSlug, $questionIndex)
    {
        $course = Course::where('slug', $courseSlug)->firstOrFail();
        $question = Question::where('course_id', $course->id)->skip($questionIndex - 1)->first();

        $options = $question ? Answer::where('question_id', $question->id)->pluck('answer_text') : [];

        $totalQuestions = Question::where('course_id', $course->id)->count();

        // Fetch the user's answer for this question from the database if available
        $userAnswer = UserAnswer::where([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
            'question_index' => $questionIndex
        ])->first();

        return view('quiz', [
            'course' => $course,
            'question' => $question,
            'questionIndex' => $questionIndex,
            'totalQuestions' => $totalQuestions,
            'options' => $options,
            'userAnswer' => $userAnswer ? $userAnswer->answer : null
        ]);
    }

    public function nextQuestion(Request $request, $courseSlug)
    {
        $course = $this->getCourseBySlug($courseSlug);
        $currentQuestionIndex = $request->input('currentQuestionIndex');

        // Save the answer to the database
        $this->saveUserAnswer(Auth::id(), $course->id, $currentQuestionIndex, $request->input('answer'));

        $nextQuestionIndex = $currentQuestionIndex + 1;
        $totalQuestions = $course->questions()->count();

        if ($nextQuestionIndex > $totalQuestions) {
            return redirect()->route('grammar.quiz.completeQuiz', ['course' => $courseSlug]);
        }

        return redirect()->route('grammar.quiz.showQuestion', [
            'course' => $courseSlug,
            'questionIndex' => $nextQuestionIndex
        ]);
    }

    public function saveUserAnswer($userId, $courseId, $questionIndex, $answer)
    {
        UserAnswer::updateOrCreate(
            [
                'user_id' => $userId,
                'course_id' => $courseId,
                'question_index' => $questionIndex,
            ],
            ['answer' => $answer]
        );
    }

    public function previousQuestion($courseSlug, $questionIndex)
    {
        return redirect()->route('grammar.quiz.showQuestion', [
            'course' => $courseSlug,
            'questionIndex' => $questionIndex - 1
        ]);
    }

    public function saveAnswer(Request $request, $courseSlug, $questionIndex)
    {
        $request->validate([
            'answer' => 'required|string', // Validasi jawaban
        ]);

        // Ambil kursus berdasarkan slug
        $course = $this->getCourseBySlug($courseSlug);

        // Simpan jawaban pengguna ke database atau session
        $user = Auth::user();
        $userAnswer = new UserAnswer(); // Misalkan Anda memiliki model UserAnswer
        $userAnswer->user_id = $user->id;
        $userAnswer->course_id = $course->id;
        $userAnswer->question_index = $questionIndex;
        $userAnswer->answer = $request->input('answer');
        $userAnswer->save();

        return response()->json(['status' => 'success']);
    }

    public function completeQuiz($courseSlug)
    {
        $course = $this->getCourseBySlug($courseSlug);
        $questions = $course->questions;

        // Fetch all the user's answers for this course from the database
        $userAnswers = UserAnswer::where('user_id', Auth::id())
            ->where('course_id', $course->id)
            ->pluck('answer', 'question_index')
            ->toArray();

        $correctedAnswers = [];
        $score = 0;

        foreach ($questions as $index => $question) {
            $userAnswer = $userAnswers[$index + 1] ?? null;
            $correctAnswer = $question->answers()->where('is_correct', true)->first();

            if ($correctAnswer) {
                $correctedAnswers[$index] = $correctAnswer->answer_text;
                if ($userAnswer === $correctAnswer->answer_text) {
                    $score++;
                }
            }
        }

        return view('quiz_result', [
            'course' => $course,
            'questions' => $questions,
            'userAnswers' => $userAnswers,
            'points' => $score * 10, // misalnya 10 poin per jawaban benar
            'correctedAnswers' => $correctedAnswers,
            'score' => $score,
            'totalQuestions' => count($questions),
            'pointsEarned' => $score * 10,
        ]);
    }
    protected function calculateScore(array $userAnswers, $questions)
    {
        $score = 0;

        foreach ($questions as $index => $question) {
            // Ambil jawaban yang benar untuk pertanyaan ini
            $correctAnswer = $question->answers()->where('is_correct', true)->first();

            // Cek apakah jawaban pengguna sesuai dengan jawaban yang benar
            if ($correctAnswer) {
                // Pastikan jawaban pengguna ada dan cocok dengan jawaban yang benar
                if (isset($userAnswers[$index]) && $userAnswers[$index] === $correctAnswer->answer_text) {
                    $score++; // Tambahkan satu poin jika jawaban benar
                }
            }
        }

        return $score; // Kembalikan total skor
    }
    protected function getCourseBySlug($slug)
    {
        return Course::where('slug', $slug)->firstOrFail();
    }

    public function finishAttempt(Request $request, $courseSlug)
    {
        $course = $this->getCourseBySlug($courseSlug);
        $questions = $course->questions;

        // Ambil semua jawaban pengguna dari tabel user_answers
        $userAnswers = UserAnswer::where('user_id', Auth::id())
                                ->where('course_id', $course->id)
                                ->get()
                                ->keyBy('question_index'); // Indeks pertanyaan sebagai kunci

        $correctedAnswers = [];
        $score = 0;
        $answers = []; // Array untuk menampung status benar/salah jawaban

        foreach ($questions as $index => $question) {
            $userAnswer = $userAnswers[$index + 1]->answer ?? null;
            $correctAnswer = $question->answers()->where('is_correct', true)->first();

            if ($correctAnswer) {
                $correctedAnswers[$index] = $correctAnswer->answer_text;

                if ($userAnswer === $correctAnswer->answer_text) {
                    $score++;
                    $answers[$index] = 'OK';
                } else {
                    $answers[$index] = 'Salah';
                }
            } else {
                $answers[$index] = 'No correct answer found for this question.';
            }
        }
        return response()->json([
            'status' => 'success',
            'score' => $score,
            'correctedAnswers' => $correctedAnswers,
            'answers' => $answers
        ]);
    }
    public function finishQuiz($courseSlug)
    {
        $course = $this->getCourseBySlug($courseSlug);

        // Delete answers from `user_answers` table for this course and user
        UserAnswer::where('user_id', Auth::id())
                ->where('course_id', $course->id)
                ->delete();

        return redirect()->route('quiz'); // Redirect to courses or index page
    }
    public function removeAnswer($courseSlug, $questionIndex)
    {
        // Hapus jawaban untuk pertanyaan tertentu dari session
        $answers = session()->get('answers', []);

        if (isset($answers[$questionIndex - 1])) {
            unset($answers[$questionIndex - 1]); // Menghapus jawaban untuk pertanyaan yang ditentukan
            session()->put('answers', $answers); // Simpan kembali ke session

            return response()->json(['status' => 'success']);
        }

        return response()->json(['status' => 'error', 'message' => 'Answer not found.'], 404);
    }
}
