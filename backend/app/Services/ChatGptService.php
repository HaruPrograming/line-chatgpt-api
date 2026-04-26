<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ChatGptService
{
    public function ask(string $message): string
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api.openai.com/v1/responses', [
            'prompt' => [
                'id' => env('OPENAI_PROMPT_ID'),
                'version' => '10',
            ],
            'input' => $message,
        ]);

        $outputs = $response->json('output') ?? [];
        $message = collect($outputs)->firstWhere('type', 'message');

        return $message['content'][0]['text'] ?? 'エラーが発生しました。';
    }
}
