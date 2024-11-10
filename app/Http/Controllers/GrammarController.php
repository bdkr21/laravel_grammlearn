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

        if ($question) {
            $options = Answer::where('question_id', $question->id)->pluck('answer_text');
        } else {
            $options = [];
        }

        $totalQuestions = Question::where('course_id', $course->id)->count();
        $answers = session()->get('answers', []);

        return view('quiz', [
            'course' => $course,
            'question' => $question,
            'questionIndex' => $questionIndex,
            'totalQuestions' => $totalQuestions,
            'options' => $options,
            'answers' => $answers
        ]);
    }

    public function nextQuestion(Request $request, $courseSlug)
    {
        $course = $this->getCourseBySlug($courseSlug);
        $currentQuestionIndex = $request->input('currentQuestionIndex');
        $answers = $request->session()->get('answers', []);
        $answers[$currentQuestionIndex] = $request->input('answer');
        $request->session()->put('answers', $answers);

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

    public function previousQuestion($courseSlug, $questionIndex)
    {
        return redirect()->route('grammar.quiz.showQuestion', [
            'course' => $courseSlug,
            'questionIndex' => $questionIndex - 1
        ]);
    }

    public function saveAnswer(Request $request, $courseSlug, $questionIndex)
    {
        $course = Course::where('slug', $courseSlug)->firstOrFail();
        $answers = $request->session()->get('answers', []);
        $userAnswer = $request->input('answer');
        $answers[$questionIndex - 1] = $userAnswer;

        $request->session()->put('answers', $answers);

        return response()->json(['status' => 'success']);
    }

    public function completeQuiz($courseSlug)
    {
        $course = $this->getCourseBySlug($courseSlug);
        $questions = $course->questions;
        $answers = session()->get('answers', []);
        $correctedAnswers = session()->get('corrected_answers', []);
        $score = session()->get('score', 0);

        // Clear session data for answers after the quiz is completed
        session()->forget('answers');
        session()->forget('corrected_answers');

        // Calculate points earned
        $pointsEarned = $score;

        // Update user points
        $user = Auth::user();
        $user->points += $pointsEarned;
        $user->save();

        return view('quiz_result', [
            'course' => $course,
            'questions' => $questions,
            'totalQuestions' => $questions->count(),
            'score' => $score,
            'points' => $user->points,
            'answers' => $answers,
            'grammarResults' => $correctedAnswers,
            'messages' => array_fill(0, count($questions), 'OK'),
            'pointsEarned' => $pointsEarned,
        ]);
    }


    protected function getCourseBySlug($slug)
    {
        return Course::where('slug', $slug)->firstOrFail();
    }

    public function finishAttempt(Request $request, $courseSlug)
    {
        $course = $this->getCourseBySlug($courseSlug);
        $totalQuestions = $course->questions()->count();
        $answers = session()->get('answers', []);

        $correctedAnswers = [];
        $score = 0;

        foreach (range(1, $totalQuestions) as $questionIndex) {
            $question = $course->questions()->skip($questionIndex - 1)->first();
            $userAnswer = $answers[$questionIndex - 1] ?? null;

            if ($question) {
                $correctAnswer = $question->answers()->where('is_correct', true)->first();
                if ($correctAnswer) {
                    $correctedAnswers[$questionIndex - 1] = $correctAnswer->answer_text;

                    if ($userAnswer && $userAnswer === $correctAnswer->answer_text) {
                        $score++;
                        $answers[$questionIndex - 1] = 'OK';
                    } else {
                        $answers[$questionIndex - 1] = 'Salah';
                    }
                } else {
                    $answers[$questionIndex - 1] = 'No correct answer found for this question.';
                }
            }
        }

        session()->put('answers', $answers);
        session()->put('corrected_answers', $correctedAnswers);
        session()->put('score', $score);

        if (count($answers) < $totalQuestions) {
            return redirect()->route('grammar.quiz.showQuestion', [
                'course' => $courseSlug,
                'questionIndex' => 1
            ])->with('error', 'Anda belum menjawab semua pertanyaan.');
        }

        return redirect()->route('grammar.quiz.completeQuiz', ['course' => $courseSlug]);
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
