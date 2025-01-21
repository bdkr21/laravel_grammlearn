<?php

namespace App\Services;

use GuzzleHttp\Client;

class GrammarService
{
    protected $client;
    protected $apiUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiUrl = 'https://neural.grammarbot.io/v1/check';
        // Ambil API key dari file .env
        $this->apiKey = env('GRAMMARBOT_BOT_API_KEY'); // Mendapatkan nilai dari .env
    }

    public function checkGrammar($text)
    {
        try {
            $response = $this->client->post($this->apiUrl, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'text' => $text,
                    'api_key' => $this->apiKey,
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            // Log error jika API gagal
            \Log::error('GrammarBot API Error: ' . $e->getMessage());
            throw new \Exception('GrammarBot service unavailable');
        }
    }
}
