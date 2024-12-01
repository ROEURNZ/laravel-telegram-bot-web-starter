<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TelegramController extends Controller
{
    public function sendMessage(Request $request)
    {
        // $chat_id = env('USER_CHAT_ID');
        // $chat_id = $request->input('chat_id');
        $chat_id = env('USER_CHAT_ID') ?? $request->input('chat_id');
        $message = $request->input('message');
        $token = env('TELEGRAM_BOT_TOKEN');

        $response = Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
            'chat_id' => $chat_id,
            'text' => $message
        ]);
        // dd('TELEGRAM BOT TOKEN: '. $token);
        dd('All requests: ' . $token . ' ' . print_r($request->all(), true));

        // Check if the request was successful
        if ($response->successful()) {
            return back()->with('success', 'Message sent successfully!');
        } else {
            return back()->with('error', 'Failed to send message.');
        }
    }
}
