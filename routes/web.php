<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GrammarController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/grammar/quiz/{category}', [GrammarController::class, 'startQuiz'])->name('grammar.quiz');
Route::get('/grammar/quiz/{category}/question/{questionIndex}', [GrammarController::class, 'showQuestion'])->name('grammar.quiz.showQuestion');
Route::post('/grammar/quiz/{category}/submit-answer/{questionIndex}', [GrammarController::class, 'submitAnswer'])->name('grammar.quiz.submitAnswer');
Route::get('/grammar/quiz/{category}/previous-question/{questionIndex}', [GrammarController::class, 'previousQuestion'])->name('grammar.quiz.previousQuestion');
Route::get('/grammar/quiz/{category}/complete', [GrammarController::class, 'completeQuiz'])->name('grammar.quiz.completeQuiz');

Route::get('/grammar/quiz/{categorySlug}/confirm-open', [GrammarController::class, 'confirmOpenQuiz'])->name('grammar.quiz.confirmOpen');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
