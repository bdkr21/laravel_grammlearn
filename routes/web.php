<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GrammarController;
use App\Http\Controllers\CategoryController;

Route::get('/', [GrammarController::class, 'index'])->name('home');
Route::get('/quiz/{category}', [GrammarController::class, 'startQuiz'])->name('grammar.quiz');
Route::post('/confirm-open-quiz/{category}', [GrammarController::class, 'confirmOpenQuiz'])->name('confirm.open.quiz');
Route::get('/quiz/{category}/question/{questionIndex}', [GrammarController::class, 'showQuestion'])->name('grammar.quiz.showQuestion');
Route::post('/quiz/{category}/question/{questionIndex}/submit', [GrammarController::class, 'submitAnswer'])->name('grammar.quiz.submitAnswer');
Route::get('/quiz/{category}/complete', [GrammarController::class, 'completeQuiz'])->name('grammar.quiz.completeQuiz');
Route::get('/quiz/result/{category}', [GrammarController::class, 'quizResult'])->name('grammar.quiz.result');
Route::post('/unlock-category', [GrammarController::class, 'unlockCategory'])->name('unlock.category');
Route::get('/grammar/quiz/{category}/previous-question/{questionIndex}', [GrammarController::class, 'previousQuestion'])->name('grammar.quiz.previousQuestion');

Route::middleware(['auth'])->group(function () {
    Route::get('/grammar/quiz/{categorySlug}/confirm-open', [GrammarController::class, 'confirmOpenQuiz'])->name('grammar.quiz.confirmOpen');
    Route::post('/confirm-open-quiz/{categorySlug}', [GrammarController::class, 'confirmOpenQuiz'])->name('grammar.confirmOpenQuiz');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\ProfileController;
// use App\Http\Controllers\GrammarController;
// use App\Http\Controllers\CategoryController;

// Route::get('/', [GrammarController::class, 'index'])->name('home');
// Route::get('/quiz/{category}', [GrammarController::class, 'startQuiz'])->name('grammar.quiz');
// Route::post('/confirm-open-quiz/{category}', [GrammarController::class, 'confirmOpenQuiz'])->name('confirm.open.quiz');
// Route::get('/quiz/{category}/question/{questionIndex}', [GrammarController::class, 'showQuestion'])->name('grammar.quiz.showQuestion');
// Route::post('/quiz/{category}/question/{questionIndex}/submit', [GrammarController::class, 'submitAnswer'])->name('grammar.quiz.submitAnswer');
// Route::get('/quiz/{category}/complete', [GrammarController::class, 'completeQuiz'])->name('grammar.quiz.completeQuiz');
// Route::get('/quiz/result/{category}', [GrammarController::class, 'quizResult'])->name('grammar.quiz.result');
// Route::post('/unlock-category', [GrammarController::class, 'unlockCategory'])->name('unlock.category');
// Route::get('/grammar/quiz/{category}/previous-question/{questionIndex}', [GrammarController::class, 'previousQuestion'])->name('grammar.quiz.previousQuestion');



// Route::middleware(['auth'])->group(function () {
//     Route::get('/grammar/quiz/{categorySlug}/confirm-open', [GrammarController::class, 'confirmOpenQuiz'])->name('grammar.quiz.confirmOpen');
//     Route::post('/confirm-open-quiz/{categorySlug}', [GrammarController::class, 'confirmOpenQuiz'])->name('grammar.confirmOpenQuiz');

//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');

//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';
