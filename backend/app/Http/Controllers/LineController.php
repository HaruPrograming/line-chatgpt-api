<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LineController extends Controller
{
    public function handle(Request $request)
    {
        \Log::info($request->all());

        return response()->json(['status' => 'ok']);
    }
}
