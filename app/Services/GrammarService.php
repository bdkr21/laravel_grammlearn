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
        $this->apiKey = 'gb-3KJ-FrpBqdb5Ety7zcGvpYbVi0fU5sKew2aqVfH01yNcnxw';// Pastikan API Key ada di .env
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
