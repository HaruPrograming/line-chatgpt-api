<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class LineReplyService
{
public function reply(string $replyToken, string $text): void
    {
        Http::withHeaders([
            'Authorization' => 'Bearer ' . env('LINE_CHANNEL_ACCESS_TOKEN'),
        ])->post('https://api.line.me/v2/bot/message/reply', [
            'replyToken' => $replyToken,
            'messages' => [
                [
                    'type' => 'text',
                    'text' => $text,
                ],
            ],
        ]);
    }
}
