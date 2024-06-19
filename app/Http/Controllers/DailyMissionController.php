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
        return view('daily.index');
    }

    public function startQuiz()
    {
        // Get a random set of questions
        $questions = Question::inRandomOrder()->take(2)->get();
        session()->put('daily_questions', $questions);

        return redirect()->route('daily.quiz.showQuestion', ['questionIndex' => 1]);
    }

    public function showQuestion($questionIndex)
    {
        $questions = session()->get('daily_questions');
        $question = $questions[$questionIndex - 1];
        $answers = session()->get('daily_answers', []);

        return view('daily.quiz', [
            'currentQuestionIndex' => $questionIndex,
            'totalQuestions' => count($questions),
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

        // Check the answer with the grammar service
        $question = $questions[$questionIndex - 1];
        $grammarCheck = $this->grammarService->checkGrammar($question->question);
        $correctedAnswer = $grammarCheck['correction'] ?? $question->question;

        // Save the corrected answer
        $correctedAnswers = session()->get('daily_corrected_answers', []);
        $correctedAnswers[$questionIndex - 1] = $correctedAnswer;
        session()->put('daily_corrected_answers', $correctedAnswers);

        // Determine the message
        $message = $userAnswer === $correctedAnswer ? 'OK' : 'Salah';

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
        $questions = session()->get('daily_questions');
        $answers = session()->get('daily_answers', []);
        $correctedAnswers = session()->get('daily_corrected_answers', []);

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
            'totalQuestions' => count($questions),
            'score' => $score,
            'points' => $user->points,
            'answers' => $answers,
            'grammarResults' => $correctedAnswers,
            'messages' => $messages,
        ])->with('pointsEarned', $score);
    }
}
