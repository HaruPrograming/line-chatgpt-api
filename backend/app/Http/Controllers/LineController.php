<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LineReplyService;
use App\Services\ChatGptService;

class LineController extends Controller
{
    public function __construct(
        private LineReplyService $lineReplyService,
        private ChatGptService $chatGptService,
    ) {}

    public function handle(Request $request)
    {
        $event = $request->input('events.0');
        $replyToken = $event['replyToken'] ?? null;
        $text = $event['message']['text'] ?? '';

        if ($replyToken && $text) {
            $reply = $this->chatGptService->ask($text);
            $this->lineReplyService->reply($replyToken, $reply);
        }

        return response()->json(['status' => 'ok']);
    }
}
