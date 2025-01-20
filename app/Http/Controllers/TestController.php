<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Tambahkan import untuk logging

class TestController extends Controller
{
    public function testGrammarBot()
    {
        // Contoh soal yang akan diuji
        $testQuestion = "She going to the gym every morning.";

        // Kirim soal ke GrammarBot API
        try {
            // Panggil API GrammarBot
            $response = $this->callGrammarBotAPI($testQuestion);

            // Kembalikan response dalam bentuk JSON
            return response()->json([
                'originalQuestion' => $testQuestion,
                'grammarBotResponse' => $response,
            ]);
        } catch (\Exception $e) {
            // Tangani error dengan memberikan response 500
            Log::error('Error in GrammarBot API: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to process the grammar check',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    private function callGrammarBotAPI($text)
    {
        $apiKey = env('GRAMMAR_BOT_API_KEY'); // API Key dari .env
        $url = "https://neural.grammarbot.io/v1/check";

        $data = [
            'text' => $text,
            'api_key' => $apiKey,
        ];

        try {
            // Mengirim request ke GrammarBot API
            $response = \Http::post($url, $data);

            // Log request dan response untuk debugging
            Log::info('Sent to GrammarBot: ' . json_encode($data)); // Log request data
            Log::info('GrammarBot Response: ' . $response->body()); // Log response dari API

            // Periksa apakah response sukses
            if ($response->successful()) {
                return $response->json();
            }

            // Jika response tidak sukses, lemparkan exception
            Log::error('GrammarBot API returned an error: ' . $response->status());
            throw new \Exception('Failed to connect to GrammarBot API, Status Code: ' . $response->status());
        } catch (\Exception $e) {
            // Log error jika ada masalah saat menghubungi API
            Log::error('GrammarBot API request failed: ' . $e->getMessage());
            throw $e;
        }
    }
}
