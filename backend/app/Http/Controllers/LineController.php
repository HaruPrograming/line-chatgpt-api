<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LineReplyService;

class LineController extends Controller
{
    public function __construct(private LineReplyService $lineReplyService) {}

    public function handle(Request $request)
    {
        $event = $request->input('events.0');
        $replyToken = $event['replyToken'] ?? null;
        $text = $event['message']['text'] ?? '';

        if ($replyToken) {
            $this->lineReplyService->reply($replyToken, '受け取りました！');
        }

        return response()->json(['status' => 'ok']);
    }
}
