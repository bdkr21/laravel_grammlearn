<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GrammarController;
use App\Http\Controllers\DailyMissionController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\HistoryRedeemController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
// use App\Http\Controllers\PointController;


Route::get('/courses', [CourseController::class, 'index'])->name('index.courses');
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');
Route::post('/courses/{id}/answers/{latihan}', [CourseController::class, 'storeAnswers'])->name('courses.storeAnswers');

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::post('/shop/buy/{id}', [ShopController::class, 'buy'])->name('shop.buy');
Route::get('/fetch-items', [ShopController::class, 'fetchItems'])->name('fetch-items');
Route::post('/shop/redeem/{id}', [ShopController::class, 'redeem'])->name('shop.redeem');

Route::get('/history-redeem', [HistoryRedeemController::class, 'index'])->name(name: 'history.redeem');

Route::post('/inventory/redeem/{inventoryId}', [InventoryController::class, 'redeemItem'])->name('inventory.redeemItem');

Route::post('/api/give-points', [CourseController::class, 'givePoints'])->name('api.give-points');


Route::get('/', [LandingPageController::class, 'index'])->name('home');
Route::get('/about', [LandingPageController::class, 'index2'])->name('about');


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
Route::post('/grammar/quiz/{course}/finish-attempt', [GrammarController::class, 'finishAttempt'])->name('grammar.quiz.finishAttempt');
Route::post('/quiz/{course}/{questionIndex}/saveAnswer', [GrammarController::class, 'saveAnswer'])->name('grammar.quiz.saveAnswer');
Route::delete('/courses/{course}/quiz/{questionIndex}/remove-answer', [GrammarController::class, 'removeAnswer'])->name('grammar.quiz.removeAnswer');
Route::get('/quiz/{course}/finish', [GrammarController::class, 'finishQuiz'])->name('quiz.finish');




Route::middleware(['auth'])->group(function () {
    Route::get('/grammar/quiz/{categorySlug}/confirm-open', [GrammarController::class, 'confirmOpenQuiz'])->name('grammar.quiz.confirmOpen');
    Route::post('/confirm-open-quiz/{categorySlug}', [GrammarController::class, 'confirmOpenQuiz'])->name('grammar.confirmOpenQuiz');
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('courses/get-items', [AdminController::class, 'getCourses']);


Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/destroy/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');

    // Route::get('/items/create-form', [ItemController::class, 'createForm'])->name('items.create-form');

    Route::get('items/get-items', [AdminController::class, 'getItems'])->name('items.getItems');

    Route::get('materi/get-items', [AdminController::class, 'getCourses'])->name('materi.getCourses');
    Route::get('quizzes/get-items', [AdminController::class, 'getQuiz'])->name('kuis.getKuis');
    Route::get('users/get-items', [AdminController::class, 'getUsers'])->name('users.getUsers');


    Route::resource('items', ItemController::class);
    Route::resource('materi', CourseController::class);
    Route::resource('users', UserController::class);
    Route::resource('kuiss', QuizController::class);
});


require __DIR__.'/auth.php';
