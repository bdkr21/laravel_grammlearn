<?php
// routes/api.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GrammarApiController;
use App\Http\Controllers\PointController;



Route::post('/check-grammar', [GrammarApiController::class, 'checkGrammar']);
