<?php
// routes/api.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GrammarApiController;

Route::post('/check-grammar', [GrammarApiController::class, 'checkGrammar']);
