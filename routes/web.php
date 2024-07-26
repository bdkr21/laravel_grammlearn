<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GrammarController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\DailyMissionController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PointController;


Route::get('/courses', [CourseController::class, 'index'])->name('index.courses');
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');
Route::post('/courses/{id}/answers/{latihan}', [CourseController::class, 'storeAnswers'])->name('courses.storeAnswers');

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::post('/shop/buy/{id}', [ShopController::class, 'buy'])->name('shop.buy');


Route::post('/api/give-points', [CourseController::class, 'givePoints'])->name('api.give-points');


Route::get('/', [LandingPageController::class, 'index'])->name('home');


Route::get('/daily-mission', [DailyMissionController::class, 'index'])->name('daily');

// Daily mission quiz routes
Route::get('/daily-mission/quiz', [DailyMissionController::class, 'startQuiz'])->name('daily.quiz.start');
Route::get('/daily-mission/quiz/question/{questionIndex}', [DailyMissionController::class, 'showQuestion'])->name('daily.quiz.showQuestion');
Route::post('/daily-mission/quiz/question/{questionIndex}/submit', [DailyMissionController::class, 'submitAnswer'])->name('daily.quiz.submitAnswer');
Route::get('/daily-mission/quiz/complete', [DailyMissionController::class, 'completeQuiz'])->name('daily.quiz.completeQuiz');

// Grammar Quiz
Route::get('/quiz', [GrammarController::class, 'index'])->name('quiz');
Route::get('/quiz/{course}', [GrammarController::class, 'startQuiz'])->name('grammar.quiz.start');
Route::post('/confirm-open-quiz/{course}', [GrammarController::class, 'confirmOpenQuiz'])->name('confirm.open.quiz');
Route::get('/quiz/{course}/question/{questionIndex}', [GrammarController::class, 'showQuestion'])->name('grammar.quiz.showQuestion');
Route::get('/quiz/{course}/complete', [GrammarController::class, 'completeQuiz'])->name('grammar.quiz.completeQuiz');
Route::get('/quiz/result/{course}', [GrammarController::class, 'quizResult'])->name('grammar.quiz.result');
Route::get('/grammar/quiz/{course}/previous-question/{questionIndex}', [GrammarController::class, 'previousQuestion'])->name('grammar.quiz.previousQuestion');
Route::get('/grammar/quiz/{course}/finish-attempt', [GrammarController::class, 'finishAttempt'])->name('grammar.quiz.finishAttempt');
Route::post('/quiz/{course}/{questionIndex}/saveAnswer', [GrammarController::class, 'saveAnswer'])->name('grammar.quiz.saveAnswer');

// Route::post('/quiz/{course}/question/{questionIndex}/submit', [GrammarController::class, 'submitAnswer'])->name('grammar.quiz.submitAnswer');
// Route::post('/unlock-course', [GrammarController::class, 'unlockCourse'])->name('unlock.course');


Route::middleware(['auth'])->group(function () {
    Route::get('/grammar/quiz/{categorySlug}/confirm-open', [GrammarController::class, 'confirmOpenQuiz'])->name('grammar.quiz.confirmOpen');
    Route::post('/confirm-open-quiz/{categorySlug}', [GrammarController::class, 'confirmOpenQuiz'])->name('grammar.confirmOpenQuiz');

    // Route::get('/dashboard', function () {
    //     return view('dashboard');
    // })->name('dashboard');
    Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
