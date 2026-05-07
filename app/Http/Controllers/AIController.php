<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OpenAIService;

class AIController extends Controller
{
    protected $ai;

    public function __construct(OpenAIService $ai)
    {
        $this->ai = $ai;
    }

    public function generate(Request $request)
    {
        $prompt = $request->input('prompt');

        $result = $this->ai->generate($prompt);

        return response()->json($result);
    }
}