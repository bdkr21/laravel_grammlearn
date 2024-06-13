<?php

// Controllers/GrammarApiController.php

namespace App\Http\Controllers\Api;

use App\Helpers\GrammarBotHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GrammarApiController extends Controller
{
    public function checkGrammar(Request $request)
    {
        $request->validate([
            'text' => 'required|string'
        ]);

        $text = $request->input('text');
        $grammarCheckResult = GrammarBotHelper::checkGrammar($text);

        if (isset($grammarCheckResult['error'])) {
            return response()->json(['error' => $grammarCheckResult['error']], 500);
        }

        return response()->json($grammarCheckResult);
    }
}
