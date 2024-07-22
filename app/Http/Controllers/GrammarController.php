<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
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
        $course = $this->getCourseBySlug($courseSlug);
        $question = $course->questions()->skip($questionIndex - 1)->first();
        $answers = session()->get('answers', []);

        return view('quiz', [
            'course' => $course,
            'currentQuestionIndex' => $questionIndex,
            'totalQuestions' => $course->questions()->count(),
            'question' => $question,
            'answers' => $answers
        ]);
    }

    public function unlockCourse(Request $request)
    {
        $user = Auth::user();
        $courseSlug = $request->input('course');
        $course = Course::where('slug', $courseSlug)->first();

        if ($user && $course && $user->points >= $course->required_points) {
            // Deduct points from the user
            $user->points -= $course->required_points;
            $user->save();

            // Add course to unlocked courses
            $user->unlockedCourses()->attach($course->id);

            // Redirect to the quiz page
            return redirect()->route('grammar.quiz.showQuestion', [
                'course' => $courseSlug,
                'questionIndex' => 1
            ])->with('success', 'Course unlocked successfully.');
        } else {
            return redirect()->back()->with('error', 'Not enough points to unlock this course.');
        }
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

        $question = $course->questions()->skip($nextQuestionIndex - 1)->first();

        return view('quiz', [
            'course' => $course,
            'question' => $question,
            'totalQuestions' => $totalQuestions,
            'currentQuestionIndex' => $nextQuestionIndex,
        ]);
    }

    public function previousQuestion($courseSlug, $questionIndex)
    {
        return redirect()->route('grammar.quiz.showQuestion', ['course' => $courseSlug, 'questionIndex' => $questionIndex - 1]);
    }

    public function submitAnswer(Request $request, $courseSlug, $questionIndex)
    {
        $course = $this->getCourseBySlug($courseSlug);
        $totalQuestions = $course->questions()->count();
        $answers = $request->session()->get('answers', []);
        $userAnswer = $request->input('answer');
        $answers[$questionIndex - 1] = $userAnswer;

        $question = $course->questions()->skip($questionIndex - 1)->first();
        $grammarCheck = $this->grammarService->checkGrammar($question->question);

        $correctedAnswer = $grammarCheck['correction'] ?? $question->question;

        $request->session()->put('answers', $answers);
        $correctedAnswers = $request->session()->get('corrected_answers', []);
        $correctedAnswers[$questionIndex - 1] = $correctedAnswer;
        $request->session()->put('corrected_answers', $correctedAnswers);

        $message = $userAnswer === $correctedAnswer ? 'OK' : 'Salah';

        if ($questionIndex < $totalQuestions) {
            return redirect()->route('grammar.quiz.showQuestion', ['course' => $courseSlug, 'questionIndex' => $questionIndex + 1])
                             ->with('message', $message);
        } else {
            return redirect()->route('grammar.quiz.completeQuiz', ['course' => $courseSlug])
                             ->with('message', $message);
        }
    }

    public function completeQuiz($courseSlug)
    {
        $course = $this->getCourseBySlug($courseSlug);
        $questions = $course->questions;

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
            'course' => $course,
            'questions' => $questions,
            'totalQuestions' => $questions->count(),
            'score' => $score,
            'points' => $user->points,
            'answers' => $answers,
            'grammarResults' => $correctedAnswers,
            'messages' => $messages,
        ])->with('pointsEarned', $score);
    }

    protected function getCourseBySlug($slug)
    {
        return Course::where('slug', $slug)->firstOrFail();
    }
}
