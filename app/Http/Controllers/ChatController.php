<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function getChatResponse(Request $request)
    {
        $message = $request->input('message');

        // Send POST request to the Flask API
        $response = Http::post('http://127.0.0.1:5000/get_response', [
            'message' => $message,
        ]);

        // Return response back to the front end
        return response()->json($response->json());
    }
}
