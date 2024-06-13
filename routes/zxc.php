<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GrammarController;
use App\Http\Controllers\CategoryController;


Route::get('/', function () {
    return view('index');
    });

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('category.show');
    Route::post('/category/unlock/{categoryId}', [CategoryController::class, 'unlockCategory'])->name('category.unlock');
    Route::post('/quiz/complete/{category}', [CategoryController::class, 'completeQuiz'])->name('quiz.complete');

    Route::get('/grammar/category/{category}', [GrammarController::class, 'showCategory'])->name('grammar.category');

    Route::get('/grammar/quiz/{category}', [GrammarController::class, 'startQuiz'])->name('grammar.quiz');
    Route::post('/grammar/quiz/{category}/next', [GrammarController::class, 'nextQuestion'])->name('grammar.quiz.next');
    Route::post('/grammar/quiz/{category}', [GrammarController::class, 'submitQuiz'])->name('grammar.quiz.submit');
    Route::get('/grammar/quiz/{category}/result/{score}', [GrammarController::class, 'quizResult'])->name('grammar.quiz.result');
    Route::get('/grammar/quiz/{category}/question/{questionIndex}', [GrammarController::class, 'previousQuestion'])->name('grammar.quiz.previous');
    Route::post('/category/unlock/{categoryId}', [CategoryController::class, 'unlockCategory'])->name('category.unlock');


    // Route::get('/grammar/{category}', [GrammarController::class, 'showCategoryQuestions'])->name('grammar.category');
    // Route::get('/grammar/{category}/{questionNumber}', [GrammarController::class, 'showQuestion'])->name('grammar.questions');
    // Route::post('/grammar/{category}/{questionNumber}', [GrammarController::class, 'submitAnswer'])->name('grammar.answers');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
