<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function sendChat(Request $request)
    {
        $userMessage = $request->input('input');

        $responses = [
            'Hello' => 'Hello qq',
            'How are you?' => 'I am fine, thank you',
            'What is your name?' => 'I am Chatbot',
            'What is your purpose?' => 'I am here to help you',
            'default' => 'I am sorry, I do not understand'
        ];

        $response = $responses['default'];
        foreach ($responses as $key => $reply) {
            if (stripos($userMessage, $key) !== false) {
                $response = $reply;
                break;
            } 
        }

        return response()->json($response);
    }
}
