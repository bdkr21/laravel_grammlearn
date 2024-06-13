<?php
// helpers/GrammarBotHelper.php
namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class GrammarBotHelper
{
    public static function checkGrammar($text)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-rapidapi-host' => 'grammarbot-neural.p.rapidapi.com',
            'x-rapidapi-key' => 'b6c4337eb6msh87cbb3d9555152cp132e22jsn38e19558df62',
        ])->post('https://grammarbot-neural.p.rapidapi.com/v1/check', [
            'text' => $text,
            'lang' => 'en'
        ]);

        if ($response->successful()) {
            return $response->json();
        } else {
            return ['error' => $response->body()];
        }
    }
}
