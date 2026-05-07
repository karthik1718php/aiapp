<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OpenAIService
{
    public function generate($prompt)
{
    $response = Http::post('http://localhost:11434/api/generate', [
        'model' => 'llama3',
        'prompt' => "Write a professional product description for {$prompt}",
        'stream' => false
    ]);

    $data = $response->json();

    return $data['response'] ?? 'No response';
}
}
