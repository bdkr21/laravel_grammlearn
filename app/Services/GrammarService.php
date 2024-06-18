<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GrammarService
{
    public function checkGrammar($text)
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-rapidapi-key' => '9910a6a4demsh7b347ede676a635p116e34jsn97127ab1454a',  // Ensure this is your actual API key
            'x-rapidapi-host' => 'grammarbot-neural.p.rapidapi.com',
        ])->post('https://grammarbot-neural.p.rapidapi.com/v1/check', [
            'text' => $text,
            'lang' => 'en',
        ]);

        // Log the response status and body
        Log::error('GrammarBot API Response', [
            'status' => $response->status(),
            'body' => $response->body()
        ]);

        if ($response->failed()) {
            throw new \Exception('Failed to call GrammarBot API. Status: ' . $response->status() . ' Body: ' . $response->body());
        }

        return json_decode($response->body(), true);
    }

    public function calculateScore($answers, $questions)
    {
        $score = 0;

        foreach ($questions as $index => $question) {
            if (isset($answers[$index])) {
                $grammarCheck = $this->checkGrammar($answers[$index]);
                $correctedAnswer = $grammarCheck['matches'][0]['replacements'][0]['value'] ?? $answers[$index];

                if ($correctedAnswer == $question->answer) {
                    $score++;
                }
            }
        }

        return $score;
    }
}
