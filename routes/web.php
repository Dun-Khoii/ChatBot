<?php

use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Route;
use OpenAI\Laravel\Facades\OpenAI;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-openai', function () {
    try {
        $result = OpenAI::completions()->create([
            'model' => 'gpt-3.5-turbo',
            'prompt' => 'Hello, World!',
            'max_tokens' => 100,
        ]);

        return response()->json($result);
    }catch(\Exception $e){
        return $e->getMessage();
    }
});

Route::post('/send',[ChatController::class,'sendChat']);


